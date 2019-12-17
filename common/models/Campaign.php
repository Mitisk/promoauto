<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "campaign".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $datetime
 * @property string $balance
 * @property string $text
 * @property integer $status
 */
class Campaign extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'campaign';
    }
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['user_id', 'status', 'period'], 'integer'],
            [['balance', 'blocked_balance', 'spend_balance'], 'number'],
            [['datetime'], 'safe'],
            [['text'], 'string'],
            [['name', 'tariff_plan'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'name' => 'Name',
            'datetime' => 'Datetime',
            'text' => 'Text',
            'status' => 'Status',
        ];
    }
}
