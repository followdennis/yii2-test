<?php

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class Lizhi extends ActiveRecord  {

    public static function tableName(){
        return '{{%chefs}}';
    }

}