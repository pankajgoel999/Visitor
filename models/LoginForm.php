<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $duppassword;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        //echo $params;
        //die("234");
        if (!$this->hasErrors()) {
            $user1 = $this->getUser();
            // echo "<pre>"; print_r($user1);die("123");
            if(empty($user1)){
                return $this->addError($attribute, 'Incorrect username or password.');
                exit;
            }
               $chkpass = User::validatePassword($_POST['LoginForm']['username'], $_POST['LoginForm']['password']);
            // echo $chkpass; die;
            if(empty($chkpass)){
                return $this->addError($attribute, 'Incorrect username or password.');
                exit;
            }
    
        }
    }
    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'password' => 'Password',
            'duppassword' => 'Password',
            
        ];
    }
    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
     public function login()
    {
        
        if ($this->validate()) {
            //echo "<pre>"; print_r($this->getUser());die("123");
            
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        return User::findByemail($_POST['LoginForm']['username']);
    }
}
