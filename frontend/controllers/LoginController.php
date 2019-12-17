<?php

namespace frontend\controllers;

use Yii;
use common\models\LoginForm;


class LoginController extends \yii\web\Controller {
    public $layout = 'login';
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['/cabinet/default/index']);
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['/cabinet/default/index']);
        } else {
            return $this->render('index', [
                'model' => $model,
            ]);
        }
    }

}
