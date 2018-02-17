<?php

use yii\db\Schema;
use yii\db\Migration;

class m151214_210515_post_to_null extends Migration
{
    public function up()
    {
        $this->alterColumn('post', 'views', Schema::TYPE_INTEGER . ' NULL DEFAULT 0 COMMENT "Количество просмотров" ');
        $this->alterColumn('post', 'sort', Schema::TYPE_INTEGER . ' NULL DEFAULT 0 COMMENT "Сортировка"');
        $this->alterColumn('post', 'active', Schema::TYPE_BOOLEAN . ' NULL DEFAULT 0 COMMENT "Активность"');
    }

    public function down()
    {
        $this->alterColumn('post', 'views', Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0 COMMENT "Количество просмотров" ');
        $this->alterColumn('post', 'sort', Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0 COMMENT "Сортировка"');
        $this->alterColumn('post', 'active', Schema::TYPE_BOOLEAN . ' NOT NULL DEFAULT 0 COMMENT "Активность"');
    }

}
