<?php

use yii\db\Migration;
use yii\base\Security;

class m170505_104039_create_tables extends Migration
{
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey()->unsigned(),
            'email' => $this->string()->unique()->notNull(),
            'auth_key' => $this->string()->unique(),
            'access_token' => $this->string()->unique(),
            'refresh_token' => $this->string()->unique(),
            'password' => $this->string(),
            'password_reset_token' => $this->string()->unique(),
            'updated_at' => $this->timestamp()->defaultValue(mysqltime()),
            'created_at' => $this->timestamp(),
        ]);
        
         $this->insert('user', [
            'email' => 'mb.fizyka@gmail.com',
            'password' => Yii::$app->getSecurity()->generatePasswordHash('asd123'),
            'created_at' => mysqltime()
        ]);
    }

    public function safeDown()
    {
        $this->delete('user', ['id' => 1]);
        $this->dropTable('user');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170505_104039_create_tables cannot be reverted.\n";

        return false;
    }
    */
}
