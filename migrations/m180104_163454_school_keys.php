<?php

use yii\db\Migration;
use yii\db\Schema;

class m180104_163454_school_keys extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%school_keys}}', [
            'id' => Schema::TYPE_PK,
            'school_id' => Schema::TYPE_INTEGER,
            'code' => Schema::TYPE_STRING . '(255) DEFAULT NULL',
            'is_used' => Schema::TYPE_BOOLEAN . ' DEFAULT FALSE',
            'date_update' => Schema::TYPE_INTEGER . ' NOT NULL',
            'date_create' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%school_keys}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180104_163454_school_keys cannot be reverted.\n";

        return false;
    }
    */
}
