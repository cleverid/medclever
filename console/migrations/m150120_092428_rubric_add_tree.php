<?php

use yii\db\Schema;
use yii\db\Migration;

class m150120_092428_rubric_add_tree extends Migration
{
    public $t = "rubric";
    public $columns = [];

    public function init() {
        $this->columns = [
            'tree' => Schema::TYPE_INTEGER,
            'lft' => Schema::TYPE_INTEGER . ' NOT NULL',
            'rgt' => Schema::TYPE_INTEGER . ' NOT NULL',
            'depth' => Schema::TYPE_INTEGER . ' NOT NULL',
        ];
    }

    public function up()
    {
        foreach($this->columns as $name => $type) {
            $this->addColumn($this->t, $name, $type);
        }
    }

    public function down()
    {
        foreach($this->columns as $name => $type) {
            $this->dropColumn($this->t, $name);
        }
    }
}
