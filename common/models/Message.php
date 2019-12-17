<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "message".
 *
 * @property integer $id
 * @property integer $to_user_id
 * @property integer $from_user_id
 * @property string $date
 * @property string $text
 * @property integer $report
 * @property string $active
 * @property integer $to_del
 * @property integer $from_del
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['to_user_id', 'text'], 'required'],
            [['to_user_id'], 'integer'],
            [['date'], 'safe'],
            [['text'], 'string'],
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
            'date' => 'Date',
            'text' => 'Text',
            'report' => 'Report',
            'to_del' => 'To Del',
            'from_del' => 'From Del',
        ];
    }

}
