<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return boolean whether the email was sent
     */
    public function sendMail($subject, $text, $emailFrom='masterhof@mail.ru', $nameFrom='ѕисьмо с сайта ѕромојвто.рф') {
        if(\Yii::$app->mail->compose()
            ->setFrom(['otprawka.po4ty@ya.ru' => 'ѕромојвто'])
            ->setTo([$emailFrom => $nameFrom])
            ->setSubject($subject)
            ->setTextBody($text)
            ->send()) {
            $this->trigger(self::EVENT_NOTIFY);
            return true;
        }
    }
}
