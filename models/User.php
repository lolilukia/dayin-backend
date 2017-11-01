<?php

namespace app\models;
use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    //public $id;
    //public $username;
    //public $password;
    //public $register_time;
    //public $authKey;
    //public $accessToken;

    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            //'authKey' => 'test100key',
            //'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            //'authKey' => 'test101key',
            //'accessToken' => '101-token',
        ],
    ];

    public static function tableName()
    {
        return 'user';
    }

    public static function addNewUser($username, $password)
    {
        $customer = new User();
        $customer->username = $username;
        $customer->password = $password;
        $customer->save();
        return true;
    }

    public static function checkUser($username, $password)
    {
        $customer = User::find()->where(['username'=>$username])->one();
        if(!$customer){
            return 0;
        }
        else{
            $customerPwd = $customer->password;
            if($customerPwd==$password){
                return 1;
            }
            else{
                return 2;
            }
        }
    }

    public static function getInfo($username)
    {
        $customer = User::find()->where(['username'=>$username])->one();
        $info = array('birthday'=>$customer->birthday, 'gender'=>$customer->gender, 'register_time'=>$customer->register_time, 'introduction'=>$customer->introduction);
        return $info;
    }

    public static function editInfo($username, $birth, $gender, $intro)
    {
        $customer = User::find()->where(['username'=>$username])->one();
        //$customer->birthday = date("Y/m/d G:i:s A",strtotime($birth));
        if($gender==1){
            $customer->$gender = 'male';
        }
        else{
            $customer->$gender = 'female';
        }
        $customer->intro = $intro;
        return true;
    }
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
