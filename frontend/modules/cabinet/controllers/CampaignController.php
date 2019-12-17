<?php

namespace app\modules\cabinet\controllers;

use common\models\Autos;
use app\models\CampaignForm;
use yii\web\UploadedFile;
use Yii;
use common\models\Campaign;
use common\models\CampaignPlace;
use common\models\AutoAdvertPlace;
use common\models\User;
use common\models\Aword;
use frontend\components\Func;
use common\controllers\AuthController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Setting;

/**
 * CampaignController implements the CRUD actions for Campaign model.
 */
class CampaignController extends AuthController
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
                    'delete', 'bank' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $userid = Yii::$app->user->id;
        $campaigns = Campaign::find()->where(['user_id' => $userid, 'status' => ['0','1','2']])->all();
        $oldcampaigns = Campaign::find()->where(['user_id' => $userid, 'status' => '3'])->all();
        return $this->render('index', [
            'campaigns' => $campaigns,
            'oldcampaigns' => $oldcampaigns
        ]);
    }

    public function actionView($id)
    {
        $cplaces = CampaignPlace::find()->where(['campaign_id' => $id]);
        $campaignplaces = $cplaces->all();
        foreach ($campaignplaces as $campaignplace) {
            $autoplase = AutoAdvertPlace::findOne($campaignplace->auto_advert_place_id);
            $recommendsumm += Func::autoprice($autoplase->price, $autoplase->price_for, 'formonth');
        }
        $campaignplacescount = $cplaces->count();
        $money = Yii::$app->user->identity->balance;
        return $this->render('view', [
            'model' => $this->findModel($id),
            'campaignplaces' => $campaignplaces,
            'recommendsumm' => $recommendsumm,
            'campaignplacescount' => $campaignplacescount,
            'money' => $money
        ]);
    }

    public function actionBank($operation = null)
    {
        $id = Yii::$app->request->Get('id');
        if ($operation == 'refund') {
            $campaign = $this->findModel($id);
            if ($campaign->status != '1') {
                $refund = $campaign->balance;
                $user = User::findOne(Yii::$app->user->identity->getId());
                $user->balance = $user->balance + $refund;
                $user->save();
                $campaign->balance = '0';
                $campaign->save();
                Yii::$app->session->setFlash('success', 'Денежные средства в размере ' . Yii::$app->formatter->asDecimal($refund) . ' рублей были возвращены на Ваш счет.');
            }
        } else {
            $addmoney = Yii::$app->request->post('balance');
            $user = User::findOne(Yii::$app->user->identity->getId());
            if (is_numeric($addmoney)) {
                if ($addmoney >= 50) {
                    if ($addmoney <= $user->balance) {
                        $user->balance = $user->balance - $addmoney;
                        $user->save();
                        $campaign = $this->findModel($id);
                        $campaign->balance = $campaign->balance + $addmoney;
                        $campaign->save();
                        Yii::$app->session->setFlash('success', 'Пополнение баланса рекламной кампании на сумму ' . Yii::$app->formatter->asDecimal($addmoney) . ' рублей прошло успешно.');
                    } else {
                        Yii::$app->session->setFlash('danger', 'У Вас на счету недостаточно средств.');
                    }
                } else {
                    Yii::$app->session->setFlash('danger', 'Минимальная сумма пополнения 50 рублей.');
                }
            } else {
                Yii::$app->session->setFlash('danger', 'Введите целое число.');
            }
        }
        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionRun($id) {
        $campaign = $this->findModel($id);
        if ($campaign->user_id == Yii::$app->user->id){
            $campaignplaces = CampaignPlace::find()->where(['campaign_id' => $campaign->id]);
            $campaignplacescount = $campaignplaces->count();
            $campaign_places = $campaignplaces->all();
            $campaignprice = Func::campaignprice($campaignplacescount, $campaign->tariff_plan);
            $campaign->status = '1';
            $campaign->balance -= $campaignprice;
            $campaign->blocked_balance += $campaignprice;
            $campaign->save();
            foreach ($campaign_places as $campaign_place) {
                $placestatus = AutoAdvertPlace::findOne($campaign_place->auto_advert_place_id);
                $auto = Autos::findOne($placestatus->auto_id);
                $to_user_id = $auto->auto_user_id;
                $from_user_id = Yii::$app->user->id;
                Func::noty($to_user_id, $from_user_id, 'campaignplace/view?id='.$campaign_place->id, 'car', 'success', 'Новая заявка', 'Рекламодатель хочет разместить свой рекламный материал на Вашем автомобиле. Перейдите по ссылке, чтобы узнать подробнее и дать свой ответ.');
                $placestatus->status = '2';
                $placestatus->save();
            }
            Yii::$app->session->setFlash('success', 'Кампания запущена. После утверждения рекламных мест водителями и размещения рекламы, начнут списываться денежные средства.');
            return $this->redirect(['view', 'id' => $id]);
        }
    }

    public function actionCreate() {
        $model = new Campaign();
        $model->user_id = Yii::$app->user->id;
        $tariff = Yii::$app->request->post('submit');
        $model->tariff_plan = $tariff;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($campaign = 'new') {
                //Проверяем, получал ли пользователь награду 3 или нет
                //Бонусы
                $aword3 = Aword::find()->where(['user_id' => Yii::$app->user->id, 'view' => '3'])->count();
                if (!$aword3)
                {
                    $touserid = Yii::$app->user->id;
                    $fromuserid = '1';
                    Func::reward($touserid, '3', '5');
                    Func::bonus('5');
                    Func::noty($touserid, $fromuserid, '/cabinet/default/index', 'trophy', 'info', 'Новая награда', 'Вы получили награду за создание своей первой рекламной кампании и 5 бонусных баллов.');
                }
            }
            return $this->redirect([$tariff, 'id' => $model->id]);
        } else {
            $tariff1_price = Setting::findOne('1');
            $tariff2_price = Setting::findOne('2');
            $tariff3_price = Setting::findOne('3');
            return $this->render('create', [
                'model' => $model,
                'tariff1_price' => $tariff1_price->value,
                'tariff2_price' => $tariff2_price->value,
                'tariff3_price' => $tariff3_price->value,
            ]);
        }
    }
    public function actionTariff1($id) {
        $model = $this->findModel($id);
        if ($model->user_id == Yii::$app->user->id) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('tariff1', [
                    'model' => $model,
                ]);
            }
        }
    }
    public function actionTariff2($id) {
        $model = $this->findModel($id);
        $upload = new CampaignForm();
        $upload->id = $id;
        if ($model->user_id == Yii::$app->user->id) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $upload->imageFile = UploadedFile::getInstance($upload, 'imageFile');
                if ($upload->upload()) {
                    Yii::$app->session->setFlash('success', 'Настройка успешно завершена.');
                }
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('tariff2', [
                    'model' => $model,
                    'upload' => $upload
                ]);
            }
        }
    }
    public function actionTariff3($id) {
        $model = $this->findModel($id);
        if ($model->user_id == Yii::$app->user->id) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('tariff3', [
                    'model' => $model,
                ]);
            }
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $tariff = Yii::$app->request->post('submit');
        $model->tariff_plan = $tariff;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $tariff = Yii::$app->request->post('submit');
            return $this->redirect([$tariff, 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        if (Yii::$app->user->id == $this->findModel($id)->user_id) {
            $campaignplaces = CampaignPlace::find()->where(['campaign_id' => $id])->all();
            foreach ($campaignplaces as $campaignplace) {
                $placestatus = AutoAdvertPlace::findOne($campaignplace->auto_advert_place_id);
                $placestatus->status = '0';
                $placestatus->save();
                $campaignplace->delete();
            }
            $this->findModel($id)->delete();
            Yii::$app->session->setFlash('success', 'Кампания удалена.');
        } else {Yii::$app->session->setFlash('danger', 'Кампания не найдена.');}
        return $this->redirect(['index']);
    }



    /**
     * Finds the Campaign model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Campaign the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Campaign::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
