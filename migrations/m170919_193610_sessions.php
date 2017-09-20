<?php

use yii\db\Migration;

class m170919_193610_sessions extends Migration
{
    public function safeUp()
    {
        $tableName = 'sessions';

        $this->createTable($tableName, [
            'id' => $this->primaryKey(),
            'bedTemp' => $this->string(3)->defaultValue('0'),
            'hotendTemp' => $this->string(3)->defaultValue('0'),
            'printStart' => $this->boolean()->defaultValue(0),
            'turnOn'=> $this->boolean()->defaultValue(0),
            'updated_at' => $this->timestamp()->defaultValue(mysqltime()),
            'created_at' => $this->timestamp(),
        ]);
        
        $this->insert($tableName, [
            'created_at' => mysqltime()
        ]);
    }

    public function safeDown()
    {
        $this->delete($tableName, ['id' => 1]);

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170919_193610_sessions cannot be reverted.\n";

        return false;
    }
    */
}
