<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/3/22
 * Time: 20:12
 */

namespace app\backend\controllers;


use Mpdf\Mpdf;
use yii\web\Controller;

class PDFController extends Controller
{
    public function actionIndex(){
        $pdf = new Mpdf(["zh-Cn",'utf-8']);

        $view = \Yii::$app->runAction('backend/article/detail');
        $pdf->WriteHTML($view );
        $pdf->Output();
        echo 'ok';
        exit;
    }
    public function actionRun(){
        $view = \Yii::$app->runAction('backend/article/detail');
        return $view;
    }

}