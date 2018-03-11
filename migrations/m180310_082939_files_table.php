<?php

use yii\db\Migration;

class m180310_082939_files_table extends Migration
{
    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('files', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(),
            'slug' => $this->string()->unique(),
            'ext' => $this->string(6),
            'updated_at' => $this->integer(),
            'created_at' => $this->integer()
        ]);
    }

    public function down()
    {
        $this->dropTable('files');
    }
    
}
