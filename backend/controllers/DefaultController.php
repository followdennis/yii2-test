<?php

namespace app\backend\controllers;

use yii\web\Controller;

/**
 * Default controller for the `backend` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionBackTest(){
        echo 'bktest';
    }
}
