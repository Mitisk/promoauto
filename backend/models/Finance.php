<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "finance".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $action
 * @property string $promo
 * @property string $summ
 * @property string $method
 * @property integer $result
 */
class Finance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'finance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'action', 'promo', 'summ', 'method', 'result'], 'required'],
            [['user_id', 'result'], 'integer'],
            [['summ'], 'number'],
            [['action', 'promo', 'method'], 'string', 'max' => 255],
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
            'action' => 'Action',
            'promo' => 'Promo',
            'summ' => 'Summ',
            'method' => 'Method',
            'result' => 'Result',
        ];
    }
}
