<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/3/14
 * Time: 20:43
 */

namespace app\backend\controllers;

use app\models\Article;
use yii\web\Controller;

class ArticleController extends Controller
{
    public $layout = 'main';
    public function actionIndex(){

        return $this->render('index',['data'=>'test']);
    }
    public function actionDetail(){
        $data = Article::find()->orderBy('id desc')->limit(1)->asArray()->one();
        return $this->render('detail',['data'=>$data]);
    }
}