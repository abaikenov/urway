<?php

use yii\db\Migration;
use yii\db\Schema;

class m170525_184517_lang extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%lang}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . '(255) NOT NULL',
            'local' => Schema::TYPE_STRING . '(255) NOT NULL',
            'name' => Schema::TYPE_STRING . '(255) NOT NULL',
            'short_name' => Schema::TYPE_STRING . '(255) NOT NULL',
            'default' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'date_update' => Schema::TYPE_INTEGER . ' NOT NULL',
            'date_create' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

        $this->batchInsert('lang', ['url', 'local', 'name', 'short_name', 'default', 'date_update', 'date_create'], [
            ['ru', 'ru-RU', 'Русский', 'РУС', 1, time(), time()],
            ['kz', 'kz-KZ', 'Казахский', 'ҚАЗ', 0, time(), time()],
            ['en', 'en-EN', 'English', 'ENG', 0, time(), time()],
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%lang}}');
    }
}
