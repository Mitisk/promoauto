<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "support".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $category
 * @property string $question
 * @property string $answer
 * @property integer $show
 */
class Support extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'support';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question'], 'required'],
            [['user_id', 'show'], 'integer'],
            [['question', 'answer'], 'string'],
            [['category'], 'string', 'max' => 255],
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
            'category' => 'Category',
            'question' => 'Question',
            'answer' => 'Answer',
            'show' => 'Show',
        ];
    }

    public function afterValidate() {
        $this->user_id = Yii::$app->user->identity->id;
    }
}
