<?php
namespace frontend\widgets;
use common\models\Notification;
use yii\jui\Widget;

class Notifications extends Widget{
    public function run(){
        $userid = \Yii::$app->user->id;
        $notifications = Notification::find()->where(['to_user_id' => $userid, 'active' => 1])->orderBy(['id' => SORT_DESC])->limit(4)->all();
        $notificationscount = Notification::find()->where(['to_user_id' => $userid, 'active' => 1])->count();
        return $this->render('notifications', [
            'notifications' => $notifications,
            'notificationscount' => $notificationscount,
        ]);
    }
}

