<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "campaign_place".
 *
 * @property integer $id
 * @property integer $campaign_id
 * @property integer $auto_advert_place_id
 * @property string $datetime
 * @property string $datetime_run
 * @property string $datetime_end
 */
class CampaignPlace extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return 'campaign_place';
    }
    public function rules()
    {
        return [
            [['campaign_id', 'auto_advert_place_id'], 'required'],
            [['campaign_id', 'auto_advert_place_id'], 'integer'],
            [['datetime', 'datetime_run', 'datetime_end'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'campaign_id' => 'Campaign ID',
            'auto_advert_place_id' => 'Auto Advert Place ID',
            'datetime' => 'Datetime',
            'datetime_run' => 'Datetime Run',
            'datetime_end' => 'Datetime End',
        ];
    }
}
