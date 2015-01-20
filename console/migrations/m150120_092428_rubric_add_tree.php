<?php

use yii\db\Schema;
use yii\db\Migration;

class m150120_092428_rubric_add_tree extends Migration
{
    private $tTable = 'rubric';
    private $tTree = 'rubric_tree';

    public function up()
    {
        $this->createTable($this->tTree, [
            'parent' => Schema::TYPE_INTEGER. ' NOT NULL',
            'child' => Schema::TYPE_INTEGER. ' NOT NULL',
            'depth' => Schema::TYPE_INTEGER. ' NOT NULL DEFAULT "0"',
        ], 'ENGINE = InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci');

        $this->addPrimaryKey('primary_'.$this->tTree, $this->tTree, ['parent', 'child']);
        $this->addForeignKey('fk_'.$this->tTree.'_child_'.$this->tTable, $this->tTree, 'child', $this->tTable, 'id', 'CASCADE');
        $this->addForeignKey('fk_'.$this->tTree.'_parent_'.$this->tTable, $this->tTree, 'parent', $this->tTable, 'id', 'CASCADE');
    }

//  CREATE TABLE IF NOT EXISTS `category_tree` (
//    `parent` int(11) unsigned NOT NULL,
//    `child` int(11) unsigned NOT NULL,
//    `depth` int(11) NOT NULL DEFAULT '0',
//    PRIMARY KEY(`parent`, `child`),
//    KEY `fk_category_tree_child_category` (`child`),
//    CONSTRAINT `fk_category_tree_child_category` FOREIGN KEY(`child`) REFERENCES `category` (`id`) ON DELETE CASCADE,
//    CONSTRAINT `fk_category_tree_parent_category` FOREIGN KEY(`parent`) REFERENCES `category` (`id`) ON DELETE CASCADE
//  ) ENGINE = InnoDB DEFAULT CHARSET = utf8;

    public function down()
    {
        $this->dropTable($this->tTree);

        return true;
    }
}
