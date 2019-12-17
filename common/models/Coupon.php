<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "coupon".
 *
 * @property integer $id
 * @property string $name
 * @property string $category
 * @property string $text
 * @property string $code
 * @property string $address
 * @property string $date
 * @property string $size
 */
class Coupon extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'coupon';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'category', 'text', 'date'], 'required'],
            [['text'], 'string'],
            [['date'], 'safe'],
            [['name', 'category', 'code', 'address'], 'string', 'max' => 255],
            [['size'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'category' => 'Category',
            'text' => 'Text',
            'code' => 'Code',
            'address' => 'Address',
            'date' => 'Date',
            'size' => 'Size',
        ];
    }

    public function afterValidate() {
        $this->user_id = Yii::$app->user->id;
    }
}
