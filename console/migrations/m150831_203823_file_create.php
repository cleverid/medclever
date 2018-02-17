<?php

use yii\db\Schema;
use yii\db\Migration;

class m150831_203823_file_create extends Migration
{
    private $t = "file";

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%'.$this->t.'}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . ' NULL DEFAULT NULL COMMENT "Заголовок для файла" ',
            'name' => Schema::TYPE_STRING . ' NOT NULL COMMENT "Имя файла" ',
            'size' => Schema::TYPE_BIGINT . ' NOT NULL COMMENT "Размер файла в байтах" ',
            'description' => Schema::TYPE_STRING . ' NULL DEFAULT NULL COMMENT "Описание" ',
            'meta_title' => Schema::TYPE_STRING . ' NULL DEFAULT NULL COMMENT "SEO заголовок (title)"',
            'meta_description' => Schema::TYPE_STRING . ' NULL DEFAULT NULL COMMENT "SEO описание (meta description)"',
            'views' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0 COMMENT "Количество просмотров" ',
            'downloads' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0 COMMENT "Количество скачиваний" ',
            'sort' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0 COMMENT "Сортировка"',
            'active' => Schema::TYPE_BOOLEAN . ' NOT NULL DEFAULT 0 COMMENT "Активность"',
            'published_at' => Schema::TYPE_TIMESTAMP . ' NOT NULL DEFAULT "0000-00-00 00:00:00" COMMENT "Время публикации" ',
            'created_at' => Schema::TYPE_TIMESTAMP . ' NOT NULL DEFAULT "0000-00-00 00:00:00" COMMENT "Время создания" ',
            'updated_at' => schema::TYPE_TIMESTAMP . ' on update current_timestamp not null default current_timestamp COMMENT "Время обновления" ',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%'.$this->t.'}}');
    }

}
