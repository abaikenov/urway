<?php

use yii\db\Migration;
use yii\db\Schema;

class m180104_162939_school extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%school}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . '(255) DEFAULT NULL',
            'email' => Schema::TYPE_STRING . '(255) DEFAULT NULL',
            'is_paid' => Schema::TYPE_BOOLEAN . ' DEFAULT FALSE',
            'amount' => Schema::TYPE_INTEGER,
            'date_update' => Schema::TYPE_INTEGER . ' NOT NULL',
            'date_create' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%school}}');
    }

}
