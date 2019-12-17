<?php

namespace app\modules\cabinet\controllers;

use Yii;
use common\controllers\AuthController;
use common\models\User;
use common\models\Autos;
use common\models\Aword;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `cabinet` module
 */
class DefaultController extends AuthController
{

    public $layout = 'cabinet';
    public function actionIndex()
    {
        $user = \Yii::$app->user;
        $autocount = Autos::find()->where(['auto_user_id' => $user->id])->count();
        $aword1 = Aword::find()->where(['user_id' => $user->id, 'view' => '1'])->count();
        $aword2 = Aword::find()->where(['user_id' => $user->id, 'view' => '2'])->count();
        $aword3 = Aword::find()->where(['user_id' => $user->id, 'view' => '3'])->count();
        $aword4 = Aword::find()->where(['user_id' => $user->id, 'view' => '4'])->count();
        $aword5 = Aword::find()->where(['user_id' => $user->id, 'view' => '5'])->count();
        $aword6 = Aword::find()->where(['user_id' => $user->id, 'view' => '6'])->count();
        $aword7 = Aword::find()->where(['user_id' => $user->id, 'view' => '7'])->count();
        return $this->render('index', [
            'user' => $user,
            'autocount' => $autocount,
            'aword1' => $aword1,
            'aword2' => $aword2,
            'aword3' => $aword3,
            'aword4' => $aword4,
            'aword5' => $aword5,
            'aword6' => $aword6,
            'aword7' => $aword7,
        ]);
    }
    public function actionHelp()
    {
        return $this->render('help');
    }

    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
