<?

namespace frontend\models;

use common\models\User;
use yii\base\Model;

class ChangePasswordForm extends Model{

    public $password;
    public $newpassword;
    public $repassword;
    /**
     * @var User
     */
    private $_user;


    public function rules(){

        return [
            [['password', 'newpassword', 'repassword'], 'required'],
            ['newpassword', 'string', 'min' => 6],
            ['repassword', 'compare', 'compareAttribute' => 'newpassword'],
        ];
    }

    /**
     * @param string $attribute
     * @param array $params
     */
    public function currentPassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if (!$this->_user->validatePassword($this->$attribute)) {
                $this->addError($attribute, Yii::t('app', 'ERROR_WRONG_CURRENT_PASSWORD'));
            }
        }
    }
    /**
     * @return boolean
     */
    public function changepassword(){
        if($this->validate()){
            $user = User::findOne(\Yii::$app->user->id);
            $user->setPassword($this->newpassword);
            $user->save(true,['password_hash']);
            return true;
        }
    }



}