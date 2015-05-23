<?php

use yii\db\Schema;
use yii\db\Migration;

class m150523_201537_create_post extends Migration
{
    private $t = 'post';

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%'.$this->t.'}}', [
            'id' => Schema::TYPE_PK,
            'rubric_id' => Schema::TYPE_INTEGER . ' NULL DEFAULT NULL COMMENT "Рубрика" ',
            'name' => Schema::TYPE_STRING . ' NOT NULL COMMENT "Имя" ',
            'url' => Schema::TYPE_STRING . ' NOT NULL COMMENT "URL адрес" ',
            'content' => Schema::TYPE_TEXT . ' NULL DEFAULT NULL COMMENT "Контент" ',
            'content_short' => Schema::TYPE_TEXT . ' NULL DEFAULT NULL COMMENT "Контент короткий" ',
            'meta_title' => Schema::TYPE_STRING . ' NULL DEFAULT NULL COMMENT "SEO заголовок (title)"',
            'meta_description' => Schema::TYPE_STRING . ' NULL DEFAULT NULL COMMENT "SEO описание (meta description)"',
            'views' => Schema::TYPE_INTEGER . ' DEFAULT 0 COMMENT "Количество просмотров" ',
            'sort' => Schema::TYPE_INTEGER . ' DEFAULT 0 COMMENT "Сортировка"',
            'active' => Schema::TYPE_BOOLEAN . ' DEFAULT 0 COMMENT "Активность"',
            'published_at' => Schema::TYPE_TIMESTAMP . ' NOT NULL DEFAULT "0000-00-00 00:00:00" COMMENT "Время публикации" ',
            'created_at' => Schema::TYPE_TIMESTAMP . ' NOT NULL DEFAULT "0000-00-00 00:00:00" COMMENT "Время создания" ',
            'updated_at' => schema::TYPE_TIMESTAMP . ' on update current_timestamp not null default current_timestamp COMMENT "Время обновления" ',
        ], $tableOptions);

        $this->createIndex('rubric', $this->t, 'rubric_id');
        $this->addForeignKey('fk_post_rubric', $this->t, 'rubric_id', 'rubric', 'id', 'SET NULL');
    }

    public function safeDown()
    {
        $this->dropTable('{{%'.$this->t.'}}');
    }
}
