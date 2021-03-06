<?php
/**
 * Created by PhpStorm.
 * User: Li_Jing
 * Date: 2017/5/17
 * Time: 09:52
 */

namespace app\controllers;
use yii\web\Controller;
include('../models/User.php');


class InfoController extends Controller
{
    public function actionInfo()
    {
        $user = new \app\models\User();
        $request = \YII::$app->request;
        $username = $request->get('username');
        header("Access-Control-Allow-Origin: *");//同源策略 跨域请求 头设置
        header('content-type:text/html;charset=utf8 ');
        $info = $user->getInfo($username);
        echo json_encode($info);
    }
}