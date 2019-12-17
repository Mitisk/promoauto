<?php

namespace app\modules\cabinet\controllers;

use common\models\Setting;
use Yii;
use common\models\CampaignPlace;
use common\models\Campaign;
use common\models\AutoAdvertPlace;
use common\models\Autos;
use common\models\AutoMark;
use common\models\AutoModel;
use common\models\Task;
use frontend\components\Func;
use common\controllers\AuthController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;

/**
 * CampaignplaceController implements the CRUD actions for CampaignPlace model.
 */
class CampaignplaceController extends AuthController
{
    public $layout = 'cabinet';
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete', 'answer' => ['POST'],
                ],
            ],
        ];
    }


    /**
     * Displays a single CampaignPlace model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $campaign = Campaign::findOne($model->campaign_id);
        $aaplace = AutoAdvertPlace::findOne($model->auto_advert_place_id);
        $auto = Autos::findOne($aaplace->auto_id);
        $autoname = AutoMark::findOne($auto->auto_mark_id)->name.' '.AutoModel::findOne($auto->auto_model_id)->name;
        $tasks = Task::find()->where(['campaign_place_id' => $model->id])->orderBy(['id' => SORT_DESC])->all();
        $task1 = Task::find()->where(['campaign_place_id' => $model->id, 'status' => ['0', '1'], 'view' => '1'])->one();
        $task2 = Task::find()->where(['campaign_place_id' => $model->id, 'status' => ['0', '1'], 'view' => '2'])->one();
        $task3 = Task::find()->where(['campaign_place_id' => $model->id, 'status' => ['0', '1'], 'view' => '3'])->one();
        return $this->render('view', [
            'model' => $model,
            'campaign' => $campaign,
            'aaplace' => $aaplace,
            'auto' => $auto,
            'autoname' => $autoname,
            'tasks' => $tasks,
            'task1' => $task1,
            'task2' => $task2,
            'task3' => $task3,
        ]);
    }

    public function actionAnswer($id, $answer, $from)
    {
        $aaplace = AutoAdvertPlace::findOne($id);
        $campaign_place = CampaignPlace::findOne($from);
        $campaign_id = $campaign_place->campaign_id;
        $campaign = Campaign::findOne($campaign_id);
        $campaign_tariff_plan = $campaign->tariff_plan;
        $settings_tariff_plan = Setting::find()->where(['name' => $campaign_tariff_plan])->one();
        $settings_tariff_plan_price = $settings_tariff_plan->value;
        $touserid = $campaign->user_id;
        $fromuserid = Yii::$app->user->id;
        if ($answer == 'yes') {
            $aaplace->status = '3';
            $aaplace->save();
            $campaign->blocked_balance -= $settings_tariff_plan_price;
            $campaign->spend_balance += $settings_tariff_plan_price;
            $campaign->save();
            Func::noty($touserid, $fromuserid, 'campaignplace/view?id='.$from, 'check-square-o', 'info', 'Место одобрено', 'Рекламное место было одобрено автовладельцем!');
        } else {
            $aaplace->status = '0';
            $aaplace->save();
            $campaign->blocked_balance -= $settings_tariff_plan_price;
            $campaign->balance += $settings_tariff_plan_price;
            $campaign->save();
            Func::noty($touserid, $fromuserid, 'campaignplace/view?id='.$from, 'exclamation-triangle', 'danger', 'Заявка отклонена', 'Автовладелец отклонил Ваше предложение о размещении рекламной конструкции!');
        }
        return $this->redirect(['campaignplace/view', 'id' => $from]);
    }

    /**
     * Creates a new CampaignPlace model.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CampaignPlace();
        $autoid = Yii::$app->request->get('autoid');
        $autoadvertplace = Yii::$app->request->get('autoadvertplace');
        $campaignid = Yii::$app->request->get('campaign');
        $placestatus = AutoAdvertPlace::findOne($autoadvertplace);
        $placestatus->status = '1';
        $placestatus->save();
        if ($campaignid) {
            $campaign = Campaign::findOne($campaignid);
        } else {
            $campaign = Campaign::find()->where(['user_id' => Yii::$app->user->id, 'status' => '0'])->one();
        }

        if ($campaign->user_id == Yii::$app->user->id) {
            $model->campaign_id = $campaign->id;
            $model->auto_advert_place_id = $autoadvertplace;
            $model->save();
            Yii::$app->session->setFlash('success', 'Позиция добавлена в кампанию &laquo;'.Html::a($campaign->name, ['campaign/view', 'id' => $campaign->id], ['target' => '_blank']).'&raquo;.');
        }
            return $this->redirect(['autos/view', 'id' => $autoid]);
    }

    /**
     * @param integer $id
     * @param integer $from
     * @return mixed
     */
    public function actionDelete($id, $from)
    {
        $campaign = Campaign::findOne($from);
        if ($campaign->user_id == Yii::$app->user->id) {
            $campaign_place = $this->findModel($id);
            $auto_place = AutoAdvertPlace::findOne($campaign_place->auto_advert_place_id);
            $auto_place->status = '0';
            $auto_place->save();
            $campaign_place->delete();
            Yii::$app->session->setFlash('success', 'Позиция удалена.');
        }
        return $this->redirect(['campaign/view', 'id' => $from]);
    }

    /**
     * Finds the CampaignPlace model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CampaignPlace the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CampaignPlace::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
