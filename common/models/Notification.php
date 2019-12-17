<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notification".
 *
 * @property integer $id
 * @property integer $to_user_id
 * @property integer $from_user_id
 * @property integer $url
 * @property string $icon
 * @property string $name
 * @property string $text
 * @property string $date
 * @property integer $active
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['to_user_id', 'from_user_id', 'icon', 'type', 'name', 'text'], 'required'],
            [['to_user_id', 'from_user_id'], 'integer'],
            [['text'], 'string'],
            [['date'], 'safe'],
            [['url', 'icon', 'type', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'to_user_id' => 'To User ID',
            'from_user_id' => 'From User ID',
            'url' => 'From url',
            'icon' => 'Icon',
            'name' => 'Name',
            'text' => 'Text',
            'date' => 'Date',
        ];
    }
}
