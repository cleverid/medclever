<?php

use yii\db\Schema;
use yii\db\Migration;

class m150109_093535_rubric_edit_table extends Migration {

    private $tUser = '{{%rubric}}';
    private $fields;

    public function init() {
        parent::init();

        $this->fields = [
            'description_short' => Schema::TYPE_TEXT . ' NULL DEFAULT NULL COMMENT "Описание короткое" AFTER description',
            'sort' => Schema::TYPE_INTEGER . ' DEFAULT 0 COMMENT "Сортировка" AFTER meta_description',
            'active' => Schema::TYPE_BOOLEAN . ' DEFAULT 0 COMMENT "Активность" AFTER sort',
        ];
    }


    public function up() {
        foreach ($this->fields as $name => $field) {
            $this->addColumn($this->tUser, $name, $field);
        }
    }

    public function down() {
        foreach ($this->fields as $name => $field) {
            $this->dropColumn($this->tUser, $name);
        }
    }
}
