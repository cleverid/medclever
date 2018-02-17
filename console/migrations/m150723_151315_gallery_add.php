<?php

use yii\db\Schema;
use yii\db\Migration;

class m150723_151315_gallery_add extends Migration {

    public function up() {
        $this->addColumn(
            'rubric',
            'description_src',
            Schema::TYPE_TEXT . ' NULL DEFAULT NULL COMMENT "Описание исходные данные" AFTER description'
        );
        $this->db->createCommand('UPDATE rubric SET description_src = description')->execute();

        $this->addColumn(
            'post',
            'content_src',
            Schema::TYPE_TEXT . ' NULL DEFAULT NULL COMMENT "Контент исходные данные" AFTER content'
        );
        $this->db->createCommand('UPDATE post SET content_src = content')->execute();
    }

    public function down() {
        $this->dropColumn('rubric', 'description_src');
        $this->dropColumn('post', 'content_src');
    }

}
