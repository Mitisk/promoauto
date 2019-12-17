<?php

namespace app\modules\cabinet\controllers;

use Yii;
use common\models\Notification;
use yii\data\Pagination;
use common\controllers\AuthController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NotificationController implements the CRUD actions for Notification model.
 */
class NotificationController extends AuthController
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Notification models.
     * @return mixed
     */
    public function actionIndex()
    {
        $userid = Yii::$app->user->id;
        $allnotifications = Notification::find()->where(['to_user_id' => $userid])->orderBy(['active' => SORT_DESC, 'id' => SORT_DESC]);
        $pages = new Pagination(['totalCount' => $allnotifications->count(), 'pageSize' => 5]);
        $notifications = $allnotifications->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('index', [
            'notifications' => $notifications,
            'pages' => $pages,
        ]);

    }

    /**
     * Displays a single Notification model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $userid = Yii::$app->user->id;
        $to_user_id = Notification::findOne($id)->to_user_id;
        if ($userid = $to_user_id) {
        $notify = Notification::findOne($id);
            if ($notify->active = 1) {
                $notify->active = '0';
                $notify->save();
            }
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'Ошибка! Такого уведомления не существует.');
            return $this->redirect('index');
        }
    }

    /**
     * Finds the Notification model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Notification the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Notification::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
