<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "autos".
 *
 * @property integer $auto_id
 * @property integer $auto_user_id
 * @property integer $auto_location_id
 * @property string $auto_date
 * @property string $auto_image
 * @property integer $auto_price
 * @property string $auto_price_for
 * @property string $auto_type
 * @property integer $auto_year
 * @property integer $auto_city
 * @property string $auto_view
 * @property string $auto_parking
 * @property string $auto_comment
 * @property integer $auto_confirmed
 * @property integer $auto_occupied
 * @property integer $auto_vip
 */
class Autos extends \yii\db\ActiveRecord
{
    public function scenarios(){
        $scenarios = parent::scenarios();
        $scenarios['step2'] = ['auto_image'];
        return $scenarios;
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'autos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['auto_mark_id'], 'required'],
            [['auto_user_id', 'auto_location_id', 'auto_mark_id',
                'auto_model_id', 'auto_year', 'auto_damage',
                'auto_confirmed', 'auto_occupied', 'auto_vip'], 'integer'],
            [['auto_date'], 'safe'],
            [['auto_price'], 'number'],
            [['auto_parking', 'auto_comment'], 'string'],
            [['auto_image', 'auto_price_for'], 'string', 'max' => 200],
            [['auto_type'], 'string', 'max' => 100],
            [['auto_view'], 'string', 'max' => 10],
            [['auto_city', 'auto_color'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'auto_id' => 'Auto ID',
            'auto_user_id' => 'Auto User ID',
            'auto_location_id' => 'Auto Location ID',
            'auto_date' => 'Auto Date',
            'auto_image' => 'Auto Image',
            'auto_price' => 'Auto Price',
            'auto_price_for' => 'Auto Price For',
            'auto_type' => 'Auto Type',
            'auto_year' => 'Auto Year',
            'auto_city' => 'Auto City',
            'auto_parking' => 'Auto Parking',
            'auto_comment' => 'Auto Comment',
            'auto_confirmed' => 'Auto Confirmed',
            'auto_occupied' => 'Auto Occupied',
            'auto_vip' => 'Auto Vip',
        ];
    }

}
