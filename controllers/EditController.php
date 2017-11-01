<?php
/**
 * Created by PhpStorm.
 * User: Li_Jing
 * Date: 2017/7/13
 * Time: 12:37
 */

namespace app\controllers;
use yii\web\Controller;
include('../models/User.php');

class EditController extends Controller
{
    public function actionEdit()
    {
        $customer = new \app\models\User();
        $request = \YII::$app->request;
        $action = $request->post('action');
        $name = $request->post('username');
        $birth = $request->post('birthday');
        $gender = $request->post('gender');
        $intro = $request->post('intro');
        $success = Array('state'=>'success');
        $fail = Array('state'=>'fail');
        header("Access-Control-Allow-Origin: *");//同源策略 跨域请求 头设置
        header('content-type:text/html;charset=utf8');
        if($action=='edit')
        {
            $state = $customer->editInfo($name, $birth, $gender, $intro);
            if($state==true)
            {
                echo json_encode($success);
            }
        }
        else{
            echo json_encode($fail);
        }
    }
}