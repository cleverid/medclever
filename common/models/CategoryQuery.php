<?php
/**
  * User: Eugeny Shaposhnikov
 * Date: 20.01.15
 * Time: 13:19
 */

namespace common\models;


use valentinek\behaviors\ClosureTableQuery;
use yii\db\ActiveQuery;

class CategoryQuery extends ActiveQuery
{
    public function behaviors() {
        return [
            [
                'class' => ClosureTableQuery::className(),
                'tableName' => 'rubric_tree'
            ],
        ];
    }
}