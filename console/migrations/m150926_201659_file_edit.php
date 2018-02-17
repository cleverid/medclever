<?php

use yii\db\Schema;
use yii\db\Migration;

class m150926_201659_file_edit extends Migration
{

    private $t = "file";

    public function safeUp()
    {
        $this->alterColumn($this->t, "description", Schema::TYPE_TEXT . ' NULL DEFAULT NULL COMMENT "Описание"' );
        $this->addColumn($this->t, "description_short", Schema::TYPE_STRING . ' NULL DEFAULT NULL COMMENT "Короткое описание" AFTER description');
    }

    public function safeDown()
    {
        $this->alterColumn($this->t, 'description', Schema::TYPE_STRING . ' NULL DEFAULT NULL COMMENT "Описание" ');
        $this->dropColumn($this->t, "description_short");
    }

}
