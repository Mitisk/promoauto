<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "auto_model".
 *
 * @property integer $id
 * @property integer $mark_id
 * @property string $name
 */
class AutoModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auto_model';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mark_id', 'name'], 'required'],
            [['mark_id'], 'integer'],
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
            'mark_id' => 'Mark ID',
            'name' => 'Name',
        ];
    }
}
