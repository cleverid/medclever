<?php

use yii\db\Schema;
use yii\db\Migration;

class m141228_105237_create_rubric_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%rubric}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL COMMENT "Имя" ',
            'url' => Schema::TYPE_STRING . ' NOT NULL COMMENT "URL адрес страницы" ',
            'description' => Schema::TYPE_TEXT . ' NULL DEFAULT NULL COMMENT "Описание" ',
            'meta_title' => Schema::TYPE_STRING . ' NULL DEFAULT NULL COMMENT "SEO заголовок (title)"',
            'meta_description' => Schema::TYPE_STRING . ' NULL DEFAULT NULL COMMENT "SEO описание (meta description)"',
            'created_at' => Schema::TYPE_TIMESTAMP . ' NOT NULL DEFAULT "0000-00-00 00:00:00" COMMENT "Время создания" ',
            'updated_at' => schema::TYPE_TIMESTAMP . ' on update current_timestamp not null default current_timestamp COMMENT "Время обновления" ',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%rubric}}');
    }
}
