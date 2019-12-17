<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "auto_advert_place".
 *
 * @property integer $id
 * @property string $side
 * @property integer $place
 * @property integer $price
 * @property string $price_for
 */
class AutoAdvertPlace extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auto_advert_place';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['side', 'place', 'price', 'price_for'], 'required'],
            [['auto_id', 'place', 'point', 'status'], 'integer'],
            [['price'], 'number'],
            [['side', 'price_for'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'side' => 'Side',
            'place' => 'Place',
            'price' => 'Price',
            'price_for' => 'Price For',
        ];
    }
}
