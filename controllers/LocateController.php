<?php
/**
 * Created by PhpStorm.
 * User: Li_Jing
 * Date: 2017/4/25
 * Time: 00:05
 */

namespace app\controllers;

use yii\web\Controller;
require_once('../utils/FileUtils.php');

class LocateController extends Controller
{
    public function actionDest()
    {
        $json = new \FileUtils();
        $request = \YII::$app->request;
        $type = $request->get('type');
        $data = $json->getJSONInfo('../data/allprovinces.json',$type);
        header("Access-Control-Allow-Origin: *");//同源策略 跨域请求 头设置
        header('content-type:text/html;charset=utf8 ');
        //$jsoncallback = htmlspecialchars($_REQUEST['callback']);
        //echo $jsoncallback . "(" . json_encode($data) . ")";
        echo json_encode($data);
    }
}