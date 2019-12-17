<?php
namespace frontend\components;

use yii\base\Component;

class Common extends Component {

    const EVENT_NOTIFY = 'notify_admin';

    public function sendMail($subject, $text, $emailFrom='masterhof@mail.ru', $nameFrom='Письмо с сайта ПромоАвто.рф') {
        if(\Yii::$app->mail->compose()
            ->setFrom(['otprawka.po4ty@ya.ru' => 'ПромоАвто'])
            ->setTo([$emailFrom => $nameFrom])
            ->setSubject($subject)
            ->setTextBody($text)
            ->send()) {
            $this->trigger(self::EVENT_NOTIFY);
            return true;
        }
    }
    public function notifiAdmin($event) {
        print "Уведомление администратору";
    }

}