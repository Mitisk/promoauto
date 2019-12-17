<?php
namespace frontend\widgets;
use common\models\Message;
use yii\jui\Widget;

class Messages extends Widget{
    public function run(){
        $userid = \Yii::$app->user->id;
        $allmessages = Message::find()->where(['to_user_id' => $userid, 'active' => 1])->orderBy(['id' => SORT_DESC]);
        $messages = $allmessages->limit(3)->all();
        $messagescount = $allmessages->count();
        return $this->render('messages', [
            'messages' => $messages,
            'messagescount' => $messagescount,
        ]);
    }
}