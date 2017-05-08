<?php
/**
 * Created by PhpStorm.
 * User: Li_Jing
 * Date: 2017/5/7
 * Time: 22:02
 */

namespace app\controllers;
use yii\web\Controller;
include('../models/User.php');

class LoginController extends Controller
{
    public $enableCsrfValidation = false;
    public function actionReg()
    {
        $user = new \app\models\User();
        $request = \YII::$app->request;
        $type = $request->post('regType');
        $success = Array('state'=>'success');
        $fail = Array('state'=>'fail');
        $nameError = Array('state'=>'nameError');
        $pwdError = Array('state'=>'pwdError');
        header("Access-Control-Allow-Origin: *");//同源策略 跨域请求 头设置
        header('content-type:text/html;charset=utf8 ');
        if($type == 'register')
        {
            $name = $request->post('username');
            $pwd = $request->post('password');
            $state = $user->addNewUser($name, $pwd);
            if($state == true)
            {
                echo json_encode($success);
            }
            else
            {
                echo json_encode($fail);
            }
        }
        else if($type == 'checkName')
        {
            $name = $request->post('username');
            $state = $user->checkUser($name, '');
            if($state == 0)
            {
                echo json_encode($success);
            }
            else
            {
                echo json_encode($fail);
            }
        }
        else if($type == 'login')
        {
            $name = $request->post('username');
            $pwd = $request->post('password');
            $state = $user->checkUser($name, $pwd);
            switch($state)
            {
                case 0: echo json_encode($nameError);
                        break;
                case 1: echo json_encode($success);
                        break;
                case 2: echo json_encode($pwdError);
                        break;
            }
        }
    }
}