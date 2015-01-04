<?php

namespace common\models;

use frontend\models\interfaces\ISEO;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%rubric}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property string $description
 * @property string $meta_title
 * @property string $meta_description
 * @property string $created_at
 * @property string $updated_at
 */
class Rubric extends \yii\db\ActiveRecord implements ISEO
{

    public function getUrl() {
        return '/rubric/'.$this->url;
    }

    // ========================================================================

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%rubric}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'value' => new Expression("NOW()"),
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'url'], 'required'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'url', 'meta_title', 'meta_description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'url' => 'URL адрес страницы',
            'description' => 'Описание',
            'meta_title' => 'SEO заголовок (title)',
            'meta_description' => 'SEO описание (meta description)',
            'created_at' => 'Время создания',
            'updated_at' => 'Время обновления',
        ];
    }

    /**
     * Проверяет активность объекта
     * @param $url
     * @return bool
     */
    public function isActiveByUrl($url) {
        $url = preg_replace("~\?.*$~", '', $url);

        return preg_match("~\/".$this->url."$~", $url);
    }

    /**
     * Возращает сео заголовок для страници (title)
     * @return string
     */
    public function getSeoTitle() {
        return $this->meta_title;
    }

    /**
     * Возращает сео описание для страници (meta description)
     * @return string
     */
    public function getSeoDescription() {
        return $this->meta_description;
    }
}
