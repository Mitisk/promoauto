<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "aword".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $date
 * @property integer $view
 * @property integer $bonus
 */
class Aword extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'aword';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'view', 'bonus'], 'required'],
            [['user_id', 'view', 'bonus'], 'integer'],
            [['date'], 'safe'],
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
            'date' => 'Date',
            'view' => 'View',
            'bonus' => 'Bonus',
        ];
    }
}
