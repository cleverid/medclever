<?php
/**
 * User: eugen
 * Date: 26.01.15
 * Time: 0:04
 */

namespace common\models;
use creocoder\nestedsets\NestedSetsQueryBehavior;

class RubricQuery extends \yii\db\ActiveQuery
{
    public function behaviors() {
        return [
            NestedSetsQueryBehavior::className(),
        ];
    }

    /**
     * @param bool $state
     * @return $this
     */
    public function active($state = true) {
        $this->andWhere(['active' => $state]);
        return $this;
    }
}