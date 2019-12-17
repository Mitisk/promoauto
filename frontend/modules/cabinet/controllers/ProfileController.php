<?php

namespace app\modules\cabinet\controllers;

use Yii;
use common\models\User;
use common\controllers\AuthController;
use frontend\models\ChangePasswordForm;
use yii\data\ActiveDataProvider;
use yii\helpers\BaseFileHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Imagine\Image\Point;
use app\models\AvatarForm;

/**
 * ProfileController implements the CRUD actions for User model.
 */
class ProfileController extends AuthController
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $id = Yii::$app->user->id;
        $model = $this->findModel($id);
        $model->scenario = 'update';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', 'Профиль успешно обновлен.');
                return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    public function actionAvatar()
    {
        $model = new AvatarForm();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
                // file is uploaded successfully
                Yii::$app->session->setFlash('success', 'Аватар установлен.');
                return $this->render('update_avatar', ['model' => $model]);
            }
        }

        return $this->render('update_avatar', ['model' => $model]);
    }
    public function actionPassword()
    {
        $model = new ChangePasswordForm();

        if ($model->load(Yii::$app->request->post()) && $model->changepassword()) {
            Yii::$app->session->setFlash('success', 'Пароль успешно обновлен.');
            return $this->render('update_password', [
                'model' => $model,
            ]);
        }
            return $this->render('update_password', [
                'model' => $model,
            ]);
    }


    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
