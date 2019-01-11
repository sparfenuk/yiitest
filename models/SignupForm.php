<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class SignupForm extends Model
{

    public $username;
    public $email;
    public $password_hash;
    public $password_hash_confirm;
    public $verifyCode;
    protected $_user = false; // object of user from UserModel

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['username', 'email', 'password', 'password_confirm','mobile_number','country'], 'required'],
            // email has to be a valid email address
            ['email', 'validateEmail'],
            ['password', 'validatePassword'],
            ['password_conform','validatePassword']
            // verifyCode needs to be entered correctly
//            ['verifyCode', 'captcha'],
        ];
    }

    public function validateEmail($attribute, $params)
    {
        return filter_var($this->email, FILTER_VALIDATE_EMAIL);
    }

    public function validatePassword($attribute, $params)
    {
        if ($this->password_hash != $this->password_hash_confirm) {
            $this->addError($attribute, 'Passwords do not matches');
            return false;
        }
        return true;
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function signUp()
    {
        if ($this->validate()) {
            $this->_user = $this->getUser();
            //todo: all "randomly generated data make rly randomly generated"
            if ($this->_user !== false)
                $this->_user->setAttributes([
                    'username' => $this->username,
                    'email' => $this->email,
                    'status' => 0,
                    'crated_at' => time(),
                    'updated_at' => time()

                ]);
            else return false;
            $this->_user->save();
            return true;
        }


    }

    public
    function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
            //todo:: user already exist !it is error
            if ($this->_user === null) {
                $this->_user = new User();
            } else return false;

        }
        return $this->_user;
    }
}
