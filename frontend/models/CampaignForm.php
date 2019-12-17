<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class CampaignForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
    public $id;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/campaign/' . $this->id . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}