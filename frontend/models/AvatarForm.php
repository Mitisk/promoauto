<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class AvatarForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $filename = 'uploads/users/avatar/usr_' . \Yii::$app->user->id . '.jpg';
            $filename2 = 'uploads/users/avatar/usr_' . \Yii::$app->user->id . '.png';
            if (file_exists($filename)) {
                unlink($filename);
            } elseif (file_exists($filename2)) {
                unlink($filename2);
            }
            $this->imageFile->saveAs('uploads/users/avatar/usr_' . \Yii::$app->user->id . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}
?>