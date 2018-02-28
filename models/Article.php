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
    public function rules(){
        return [
            [['title','name'],'safe'],  //必须使用安全模式，才能使用块定义
            ['name','required','message'=>'必填'],
            ['click','required','message'=>'数字']
        ];
    }
}