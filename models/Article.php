<?php
/**
 * Created by PhpStorm.
 * User: timlu
 * Date: 18/2/6
 * Time: 下午3:12
 */
namespace app\models;

use yii\db\ActiveRecord;

class Article extends ActiveRecord {
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public static function tableName()
    {
//        return parent::tableName(); // TODO: Change the autogenerated stub
        return '{{%lizhi}}';
    }
}