<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[File]].
 *
 * @see File
 */
class FileQuery extends \yii\db\ActiveQuery
{

    /**
     * @param bool $state
     * @return $this
     */
    public function active($state = true) {
        $this->andWhere(['active' => $state]);
        return $this;
    }

    /**
     * @inheritdoc
     * @return File[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return File|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}