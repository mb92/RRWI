<?php

use yii\db\Migration;

class m180808_233139_rm_option_from_settings extends Migration
{
    public function Up()
    {
        $tableName = 'settings';
        
        $this->delete($tableName, ['id' => 3]);
    }

    public function Down()
    {
        $tableName = 'settings';

        $param = 'External power adapter';
        $val = "true";
        $desc = "Adapter with relay for power control. Allows you to remotely control the printer power.";
            $this->insert($tableName, [
                'param' => $param,
                'slug' => slug($param),
                'value' => $val,
                'description' => $desc
            ]);
    }
}
