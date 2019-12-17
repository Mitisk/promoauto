<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property integer $id
 * @property integer $campaign_place_id
 * @property string $date
 * @property string $name
 * @property string $text
 * @property integer $status
 * @property integer $visible
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'to_user_id', 'campaign_place_id', 'name'], 'required'],
            [['user_id', 'to_user_id', 'campaign_place_id', 'status', 'view'], 'integer'],
            [['price'], 'number'],
            [['date'], 'safe'],
            [['text'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'campaign_place_id' => 'Campaign Place ID',
            'date' => 'Date',
            'name' => 'Name',
            'text' => 'Text',
            'status' => 'Status',
            'visible' => 'Visible',
        ];
    }
}
