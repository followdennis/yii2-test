<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/3/22
 * Time: 20:17
 */

namespace app\controllers;


use yii\web\Controller;

class TestController extends Controller
{

    public function index(){
        $this->layout = false;
        echo 'abc';
    }
}