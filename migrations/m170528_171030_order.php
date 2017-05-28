<?php

use yii\db\Migration;
use yii\db\Schema;

class m170528_171030_order extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%order}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . '(255) NOT NULL',
            'email' => Schema::TYPE_STRING . '(255) NOT NULL',
            'amount' => Schema::TYPE_INTEGER . ' NOT NULL',
            'is_paid' => Schema::TYPE_BOOLEAN . ' DEFAULT FALSE',
            'result' => Schema::TYPE_TEXT . ' NOT NULL',
            'date_update' => Schema::TYPE_INTEGER . ' NOT NULL',
            'date_create' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%order}}');
    }
}
