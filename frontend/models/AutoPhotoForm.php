<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class AutoPhotoForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $auto_image;
    public $auto_id;

    public function rules()
    {
        return [
            [['auto_image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->auto_image->saveAs('uploads/auto/' . $this->auto_id . '.' . $this->auto_image->extension);
            return true;
        } else {
            return false;
        }
    }
}
?>