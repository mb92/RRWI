<?php

use yii\db\Migration;

class m180606_174441_connection_params extends Migration
{
    public function up() {

        $param = 'Port of printer (USB RPi)';
        $val = "/dev/ttyACM0";
        $desc = "Default port is: /dev/ttyACM0";
            $this->insert('settings', [
                'param' => $param,
                'slug' => slug($param),
                'value' => $val,
                'description' => $desc
            ]);

        $param = 'Baudrate';
        $val = '14400';
        $desc = "Baud rate connection to the printer Prusa i3. For my priter: 14400bps";
            $this->insert('settings', [
                'param' => $param,
                'slug' => slug($param),
                'value' => $val,
                'description' => $desc
            ]);
    }

    public function down() {
       $this->delete('settings', ['value' => "/dev/ttyACM0"]);
       $this->delete('settings', ['value' => "14400"]);
    }
}
