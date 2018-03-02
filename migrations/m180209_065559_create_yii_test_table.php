<?php

use yii\db\Migration;

/**
 * Handles the creation of table `yii_test`.
 */
class m180209_065559_create_yii_test_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('c_test', [
            'id' => $this->primaryKey(),
            'title'=>$this->string(),
            'content'=> $this->text()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('yii_test');
    }
}
