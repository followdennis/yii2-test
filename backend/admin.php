<?php

namespace app\backend;

/**
 * backend module definition class
 */
class admin extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\backend\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
        \Yii::configure($this,require(__DIR__ .'/config/main.php'));
    }
}
