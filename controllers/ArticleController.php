<?php
/**
 * Created by PhpStorm.
 * User: timlu
 * Date: 18/1/31
 * Time: 下午2:41
 */
namespace app\controllers;


use app\models\Article;
use yii\db\Query;
use yii\helpers\Url;
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
    public function actionTest(){
        return 'test';
    }

    /**
     * 请求测试
     */
    public function actionTestRequest(){
        $request = \Yii::$app->request;
        $get = $request->get('id',1);
        echo "<pre>";
        print_r($get);
        if($request->isGet){
            echo 'get';
        }
       echo "<hr>";
        $headers = \Yii::$app->request->headers;
        echo $request->userIp;
    }
    public function actionTestResponse(){
        \Yii::$app->response->statusCode = 200;
        \Yii::$app->response->content = 'hello world';
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;//json数据格式
        return [
            'code'=>200,
            'msg'=>'success'
        ];
    }

    /**
     * @return \yii\web\Response
     * 跳转测试
     */
    public function actionTestJump(){
        return $this->redirect('/article/test',301);
    }

    /**
     * session测试
     */
    public function actionTestSession(){
        $session = \Yii::$app->session;
        if($session->isActive){
            echo '已开启session';
        }else{
            $session->open();
            echo '手动打开session';
        }
//        $session->destory();销毁session中的已注册数据
        // $session->set('lang','en-us');
        // $session->get('language');
        // $session->remove('lan');
    }

    /**
     * cookie测试
     */
    public function actionTestCookie(){
        $cookies = \Yii::$app->response->cookies;
        //在要发送的响应中添加新的cookie
        $cookies->add(new \Yii\web\Cookie([
            'name'=>'languate',
            'value'=>'zh-Cn'
        ]));

        // $cookies->remove('languate');//删除cookie
        return 'cookie-ok';
    }

    /**
     * 表单测试
     */
    public function actionForm(){
        $model = new Article();

        if($model->load(\Yii::$app->request->post()) && $model->save()){
            return $this->redirect(['article/test','id'=>$model->id]);
        }else{
            return $this->render('form',[
                'model'=>$model
            ]);
        }
    }
    /**
     * url test
     */
    public function actionTestUrl(){
        echo Url::to(['article/test','is'=>2]);//生成url
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
//        $query = $query->where(['and',['>=','id',10],['or','id=10','id=20']])->from('c_lizhi')->all();
//        $query = $query->where(['and',['>=','id',10],['or','id=10','id=20']])->from('{{%lizhi}}')->indexBy('id')->all();//指定索引id


//        $query = $query->where(['and',['>=','id',10],['or','id=10','id=20']])->from('{{%lizhi}}')
//            ->indexBy(function($row){
//                return $row['id'].$row['click'];
//            })->all();//回调写法


        $data = $query->from('{{%lizhi}}')->orderBy('id');//批量处理数据集 每次获取指定数量的数据，默认是100
        echo "<pre>";
        foreach($data->batch(10) as $users){
            print_r($users);
            return false;
        }



    }
    public function actionSql(){
        $command = (new Query())->select(['id','title','name'])->from('{{%lizhi}}')->where(['<','id',10])->createCommand();
        echo $command->sql;
        echo "打印参数<br/>";
        print_r($command->params);
        echo "查询所有行<pre>";
        print_r($command->queryAll());
        $arr = [1,2,3,4];
        $status = true;
        foreach($arr as $id){
            $status = $status && $id;
        }
        print_r($status);
    }

    //active_record  获取数据
    public function actionActiveRecord(){
//        $info = Article::find()->where(['id'=>5])->one();
        $info = Article::find()->where(['id'=>5])->asArray()->one();
        print_r($info);
    }
    public function actionHandle(){
//        $info = new Article();
//        $values = [
//            'name'=>'111',
//            'title'=>'title2222'
//        ];
//        $info->attributes = $values;//需要制定安全字段 在模型中
//        if($info->save()){
//            echo 'ok';
//        }

        //更新计数
        $info = Article::findOne(1007);
        $info->updateCounters(['click'=>1]);
        echo 'yes';

    }
    public function actionHandleUpdate(){
        $update = Article::updateAll(['click'=>10],['and',['=','name','111'],['=','title','title2222']]);
        if($update){
            echo 'update yes';
        }
    }
    public function actionHandleDel(){
//        $model = Article::findOne(10);
//        $model->delete();

        $model = Article::deleteAll(['click'=>100]);
    }


}