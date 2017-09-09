<?php

use yii\db\Migration;
use yii\db\ActiveRecord;
/**
 * Handles the creation of table `general_settings`.
 */
class m170909_181423_create_general_settings_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableName = 'settings';

        $this->createTable($tableName, [
            'id' => $this->primaryKey(),
            'param' => $this->string(100)->unique()->notNull(),
            'slug' => $this->string(120)->unique()->notNull(),
            'value' => $this->string(100)->notNull(),
            'description' => $this->string()->notNull(),
        ]);

        $id = 1;

        $param = 'Base Url';
        $val = "http://192.168.1.6";
        $desc = "IP address of printing server (ip or ddns name Raspberry). Example: http://192.168.1.6";
            $this->insert($tableName, [
                'id' => $id,
                'param' => $param,
                'slug' => slug($param),
                'value' => $val,
                'description' => $desc
            ]);
        $id++;


        $param = 'Port RRWI-API';
        $val = "3000";
        $desc = "The port number on which the node's server works - API application (printing server).";
            $this->insert($tableName, [
                'id' => $id,
                'param' => $param,
                'slug' => slug($param),
                'value' => $val,
                'description' => $desc
            ]);
            $id++;

        $param = 'Api doc';
        $val = "http://192.168.1.6/api";
        $desc = "Link to the documentation of api node application.";
            $this->insert($tableName, [
                'id' => $id,
                'param' => $param,
                'slug' => slug($param),
                'value' => $val,
                'description' => $desc
            ]);
            $id++;

        $param = 'Port RRWI-CAM';
        $val = "4000";
        $desc = "The port number on which the node's streaming server works - CAM application (live streaming by raspiCam).";
            $this->insert($tableName, [
                'id' => $id,
                'param' => $param,
                'slug' => slug($param),
                'value' => $val,
                'description' => $desc
            ]);
            $id++;

        $param = 'Upload file location';
        $val = "/home/pi/rrwi/tmp";
        $desc = "Destination path for upload files for printing (*.gcode)";
            $this->insert($tableName, [
                'id' => $id,
                'param' => $param,
                'slug' => slug($param),
                'value' => $val,
                'description' => $desc
            ]);
            $id++;

        $param = 'Max hotend temp';
        $val = "250";
        $desc = "Max. temperature of hotend in deg of C";
            $this->insert($tableName, [
                'id' => $id,
                'param' => $param,
                'slug' => slug($param),
                'value' => $val,
                'description' => $desc
            ]);
            $id++;

        $param = 'Max bed temp';
        $val = "120";
        $desc = "Max. temperature of bed in deg of C";
            $this->insert($tableName, [
                'id' => $id,
                'param' => $param,
                'slug' => slug($param),
                'value' => $val,
                'description' => $desc
            ]);
            $id++;

        $param = 'X len';
        $val = "200";
        $desc = "Maximum length of the X axis [mm]";
            $this->insert($tableName, [
                'id' => $id,
                'param' => $param,
                'slug' => slug($param),
                'value' => $val,
                'description' => $desc
            ]);
            $id++;

        $param = 'Y len';
        $val = "200";
        $desc = "Maximum length of the Y axis [mm]";
            $this->insert($tableName, [
                'id' => $id,
                'param' => $param,
                'slug' => slug($param),
                'value' => $val,
                'description' => $desc
            ]);
            $id++;


        $param = 'Z len';
        $val = "200";
        $desc = "Maximum length of the Z axis [mm]";
            $this->insert($tableName, [
                'id' => $id,
                'param' => $param,
                'slug' => slug($param),
                'value' => $val,
                'description' => $desc
            ]);
            $id++;


        $param = 'E step';
        $val = "2";
        $desc = "Default length of step E axis [mm]";
            $this->insert($tableName, [
                'id' => $id,
                'param' => $param,
                'slug' => slug($param),
                'value' => $val,
                'description' => $desc
            ]);
            $id++;


        $param = 'X step';
        $val = "10";
        $desc = "Default length of step X axis [mm]";
            $this->insert($tableName, [
                'id' => $id,
                'param' => $param,
                'slug' => slug($param),
                'value' => $val,
                'description' => $desc
            ]);
            $id++;

        $param = 'Y step';
        $val = "10";
        $desc = "Default length of step Y axis [mm]";
            $this->insert($tableName, [
                'id' => $id,
                'param' => $param,
                'slug' => slug($param),
                'value' => $val,
                'description' => $desc
            ]);
            $id++;


        $param = 'Z step';
        $val = "5";
        $desc = "Default length of step Z axis [mm]";
            $this->insert($tableName, [
                'id' => $id,
                'param' => $param,
                'slug' => slug($param),
                'value' => $val,
                'description' => $desc
            ]);
            $id++;

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        for ($i=1; $i<=14 ; $i++) { 
            $this->delete($tableName, ['id' => $i]);
        }
        
        $this->dropTable($tableName);
    }
}
