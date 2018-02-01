<?php
/**
 * Created by PhpStorm.
 * User: timlu
 * Date: 18/1/31
 * Time: 下午2:41
 */
namespace app\controllers;


use yii\db\Query;
use yii\web\Controller;

class ArticleController extends Controller {

    //查
    public function actionIndex(){
//        $record = \Yii::$app->db->createCommand('select * from c_lizhi limit 0,10')
//            ->queryAll(); //返回二维数组

//        $record = \Yii::$app->db->createCommand('select * from c_lizhi')
//            ->queryOne();//返回第一条

//           $title = \Yii::$app->db->createCommand('select title from c_lizhi')
//               ->queryColumn(); //返回一列，一维数组

//            $count = \Yii::$app->db->createCommand('select count(*) from c_lizhi')->queryScalar();//返回一个值

//           $record = \Yii::$app->db->createCommand('select * from c_lizhi where id=:id')
//               ->bindValue(':id',10)
//               ->queryOne(); //绑定值
            $record = \Yii::$app->db->createCommand('select * from {{%lizhi}} where click=:click',[':click'=>10])->queryOne();//或者bindValues


        echo "<pre>";
        print_r($record);
    }
    //增
    public function actionAdd(){
        //插入一行
//        $insert = \Yii::$app->db->createCommand()->insert('c_lizhi',[
//            'name'=>'yii2 插入单挑数据',
//            'click'=>10,
//            'title' => 'yii2插入单挑数据'
//        ])->execute();
        //插入多行
        $mass = \Yii::$app->db->createCommand()->batchInsert('c_lizhi',['title','name','click'],[
            ['批量插入1','mass insert 1','1'],
            ['批量插入2','mass insert 2','2'],
            ['批量插入3','mass insert 3','3'],
        ])->execute();
        print_r($mass);
    }
    //删
    public function actionDel(){
        $del = \Yii::$app->db->createCommand()->delete('c_lizhi','click = 2')->execute();
        print_r($del);
    }
    //改
    public function actionEdit(){
//        $status = \Yii::$app->db->createCommand('update c_lizhi set name="你好 yii2" where id=:id',[':id'=>11])->execute();
//        echo $status;// 1  返回影响行数
        $status = \Yii::$app->db->createCommand()->update('c_lizhi',['title'=>'yii 更新标题'],'click = 10')->execute();
        print_r($status);

    }

    //事务
    public function actionTransaction(){
        \Yii::$app->db->transaction(function($db){
            $sql1 = 'aaa';
            $sql2 = 'bbb';
            $db->createCommand($sql1)->execute();
            $db->createCommand($sql2)->execute();
        });
        //等价于
        $db = \Yii::$app->db;
        $transaction = $db->beginTransaction();
        try{
            $sql1 = 'ab';
            $sql2 = 'bc';
            $db->createCommand($sql1)->execute();
            $db->createCommand($sql2)->execute();
            $transaction->commit();
        } catch(\Exception $e){
            $transaction->rollBack();
            throw $e;
        }
    }

    //查询构造器
    public function actionQuery(){
        $query = new Query();
//        $list = $query->select(['id as a_id','title','name'])->from('{{%lizhi}}')->all();

        //子查询的方法

//        $subQuery = (new Query())->select('count(*)')->from('c_users');
//        $query = (new Query())->select(['id','count'=>$subQuery])->from('c_lizhi')->all();

//        $res = $query->from('cms.c_users','cms.c_lizhi')->all();  //那个数据表在前查哪个

//        $res = $query->select('title','id')
//            ->where([
//                'id'=>[10,100,1000],
//                'click'=>'10'
//            ])->from('c_lizhi')->all();

        //复杂的条件模式
        $query = $query->where(['and','id=10',['or','id=10','id=20']])->from('c_lizhi')->all();
        echo "<pre>";
        print_r($query);

    }

}