<?php
/**
 * Created by PhpStorm.
 * User: eugen
 * Date: 04.01.15
 * Time: 13:20
 */

namespace frontend\models\interfaces;


interface ISEO {

    /**
     * Возращает сео заголовок для страници (title)
     * @return string
     */
    public function getSeoTitle();

    /**
     * Возращает сео описание для страници (meta description)
     * @return string
     */
    public function getSeoDescription();

}