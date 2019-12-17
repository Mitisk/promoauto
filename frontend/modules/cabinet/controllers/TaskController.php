<?php
namespace app\modules\cabinet\controllers;

use common\models\AutoAdvertPlace;
use common\models\Autos;
use Yii;
use common\models\Task;
use common\models\CampaignPlace;
use common\models\Campaign;
use frontend\components\Func;
use common\controllers\AuthController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends AuthController
{
    /**
     * @inheritdoc
     */
    public $layout = 'cabinet';
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'advertising-photo', 'speedometer-photo', 'wash-car' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Task models.
     * @return mixed
     */
    public function actionIndex()
    {
        $tasks_for_me = Task::find()->where(['to_user_id' => Yii::$app->user->id])->orderBy(['id' => SORT_DESC])->all();
        $tasks = Task::find()->where(['user_id' => Yii::$app->user->id])->orderBy(['id' => SORT_DESC])->all();

        return $this->render('index', [
            'tasks' => $tasks,
            'tasks_for_me' => $tasks_for_me
        ]);
    }
    public function actionAdvertisingPhoto($campaignplaceid)
    {
        $campaignplace = CampaignPlace::findOne($campaignplaceid);
        $campaign = Campaign::findOne($campaignplace->campaign_id);
        $user_id = $campaign->user_id;
        $aadvert = AutoAdvertPlace::findOne($campaignplace->auto_advert_place_id);
        $auto = Autos::findOne($aadvert->auto_id);
        $to_user_id = $auto->auto_user_id;
        if ($user_id == Yii::$app->user->id) {
            //Добавляем задание
            $model = new Task();
            $model->user_id = Yii::$app->user->id;
            $model->to_user_id = $to_user_id;
            $model->campaign_place_id = $campaignplaceid;
            $model->name = 'Рекламодатель запросил фотографию рекламной конструкции.';
            $model->view = '1';
            $model->save();
            //Добавляем флеш-уведомление
            Yii::$app->session->setFlash('success', 'Запрос выслан.');
            //Отправляем уведомление автовладельцу
            $auto_advert_place = AutoAdvertPlace::findOne($campaignplace->auto_advert_place_id);
            $auto_user_id = Autos::findOne($auto_advert_place->auto_id)->auto_user_id;
            Func::noty($auto_user_id, $user_id, 'task/index', 'thumb-tack', 'info', 'Новое задание', 'Ранее Вы размещали рекламную конструкцию на своем автомобиле. Рекламодатель дал Вам задание. Перейдите по ссылке, чтобы узнать подробности.');
            return $this->redirect(['campaignplace/view', 'id' => $campaignplaceid]);
        } else {
            Yii::$app->session->setFlash('danger', 'Кампании не существует.');
        }
    }
    public function actionSpeedometerPhoto($campaignplaceid)
    {
        $campaignplace = CampaignPlace::findOne($campaignplaceid);
        $campaign = Campaign::findOne($campaignplace->campaign_id);
        $user_id = $campaign->user_id;
        $aadvert = AutoAdvertPlace::findOne($campaignplace->auto_advert_place_id);
        $auto = Autos::findOne($aadvert->auto_id);
        $to_user_id = $auto->auto_user_id;
        if ($user_id == Yii::$app->user->id) {
            //Добавляем задание
            $model = new Task();
            $model->user_id = Yii::$app->user->id;
            $model->to_user_id = $to_user_id;
            $model->campaign_place_id = $campaignplaceid;
            $model->name = 'Рекламодатель запросил фотографию спидометра.';
            $model->view = '2';
            $model->save();
            //Добавляем флеш-уведомление
            Yii::$app->session->setFlash('success', 'Запрос выслан.');
            //Отправляем уведомление автовладельцу
            $auto_advert_place = AutoAdvertPlace::findOne($campaignplace->auto_advert_place_id);
            $auto_user_id = Autos::findOne($auto_advert_place->auto_id)->auto_user_id;
            Func::noty($auto_user_id, $user_id, 'task/index', 'thumb-tack', 'info', 'Новое задание', 'Ранее Вы размещали рекламную конструкцию на своем автомобиле. Рекламодатель дал Вам задание. Перейдите по ссылке, чтобы узнать подробности.');
            return $this->redirect(['campaignplace/view', 'id' => $campaignplaceid]);
        } else {
            Yii::$app->session->setFlash('danger', 'Кампании не существует.');
        }
    }
    public function actionWashCar($campaignplaceid)
    {
        $campaignplace = CampaignPlace::findOne($campaignplaceid);
        $campaign = Campaign::findOne($campaignplace->campaign_id);
        $user_id = $campaign->user_id;
        $aadvert = AutoAdvertPlace::findOne($campaignplace->auto_advert_place_id);
        $auto = Autos::findOne($aadvert->auto_id);
        $to_user_id = $auto->auto_user_id;
        if ($user_id == Yii::$app->user->id) {
            if ($campaign->balance >= '300') {
                //Блокируем деньги на счету
                $campaign->balance -= 300;
                $campaign->blocked_balance += 300;
                $campaign->save();
                //Добавляем задание
                $model = new Task();
                $model->user_id = Yii::$app->user->id;
                $model->to_user_id = $to_user_id;
                $model->campaign_place_id = $campaignplaceid;
                $model->name = 'Рекламодатель просит помыть автомобиль и оплачивает 300 рублей.';
                $model->view = '3';
                $model->save();
                //Добавляем флеш-уведомление
                Yii::$app->session->setFlash('success', 'Запрос выслан. На счету кампании заблокировано 300 рублей.');
                //Отправляем уведомление автовладельцу
                $auto_advert_place = AutoAdvertPlace::findOne($campaignplace->auto_advert_place_id);
                $auto_user_id = Autos::findOne($auto_advert_place->auto_id)->auto_user_id;
                Func::noty($auto_user_id, $user_id, 'task/index', 'thumb-tack', 'info', 'Новое задание', 'Ранее Вы размещали рекламную конструкцию на своем автомобиле. Рекламодатель дал Вам задание. Перейдите по ссылке, чтобы узнать подробности.');
                return $this->redirect(['campaignplace/view', 'id' => $campaignplaceid]);
            } else {
                Yii::$app->session->setFlash('success', 'Пополните счет кампании.');
                return $this->redirect(['campaignplace/view', 'id' => $campaignplaceid]);
            }
        } else {
            Yii::$app->session->setFlash('danger', 'Кампании не существует.');
        }
    }
    public function actionToBegin($id, $campaignplaceid)
    {
        $model = $this->findModel($id);
        $model->status = '1';
        $model->save();
        Yii::$app->session->setFlash('success', 'Осталось выполнить задание и прислать отчет.');
        return $this->redirect(['campaignplace/view', 'id' => $campaignplaceid]);
    }
    public function actionConfirmation($id, $campaignplaceid)
    {
        $from_task = $this->findModel($id);
        $model = new Task();
        $model->user_id = Yii::$app->user->id;
        $model->to_user_id = $from_task->user_id;
        $model->campaign_place_id = $campaignplaceid;
        $model->name = 'Получено подтверждение от автовладельца.';
        $model->view = '10';
        $model->status = '2';
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $from_task->status = '2';
            $from_task->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('confirmation', [
                'model' => $model,
            ]);
        }
    }
    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }


    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
