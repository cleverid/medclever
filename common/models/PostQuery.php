<?php
/**
 * Created by PhpStorm.
 * User: eugen
 * Date: 24.05.15
 * Time: 10:10
 */

namespace common\models;


class PostQuery extends \yii\db\ActiveQuery
{

    /**
     * @param bool $state
     * @return $this
     */
    public function active($state = true) {
        $this->andWhere(['active' => $state]);
        return $this;
    }
}