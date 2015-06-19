<?php

use common\models\Rubric;
use yii\db\Schema;
use yii\db\Migration;

class m150618_210710_add_image_to_rubric extends Migration {

    public $imageAttr = 'image_file';

    public function up() {
        $this->addColumn(Rubric::tableName(), $this->imageAttr, Schema::TYPE_TEXT . ' NULL DEFAULT NULL COMMENT "Изображение" ');
    }

    public function down() {
        $this->dropColumn(Rubric::tableName(), $this->imageAttr);
    }

}
