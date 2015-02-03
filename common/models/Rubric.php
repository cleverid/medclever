<?php

namespace common\models;

use creocoder\nestedsets\NestedSetsBehavior;
use frontend\models\interfaces\ISEO;
use valentinek\behaviors\ClosureTable;
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
 * @property string $description_short
 * @property string $meta_title
 * @property string $meta_description
 * @property integer $sort
 * @property integer $active
 * @property string $created_at
 * @property string $updated_at
 * @property integer $parent_id
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 */
class Rubric extends \yii\db\ActiveRecord implements ISEO
{

    public $leaf;
    public $after_id;
    private static $_cRoot;

    /**
     * Возращает верхнего уровня элемент если его нет то создает
     * @return Rubric
     */
    public static function getRoot() {
        if(self::$_cRoot) {
            return self::$_cRoot;
        }

        $root = self::find()->roots()->one();
        if(!$root) {
            $root = new Rubric();
            $root->name = 'Рубрики';
            $root->url = 'rubrics';
            $root->active = 1;
            $root->makeRoot();
        }

        return self::$_cRoot = $root;
    }

    /**
     * Применяет древовидную структуру
     */
    public function applayRoot() {
        if(empty($this->parent_id)) {
            $this->parent_id = Rubric::getRoot()->id;
        }

        if($after = Rubric::findOne($this->after_id)) {
            $this->insertAfter($after);
        } elseif($parent = Rubric::findOne($this->parent_id)) {
            $this->prependTo($parent);
        } else {
            $this->prependTo(Rubric::getRoot());
        }
    }

    public function getUrl() {
        return '/rubric/'.$this->url;
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

    // ========================================================================

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find()
    {
        return new RubricQuery(get_called_class());
    }

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
            ],
            [
                'class' => NestedSetsBehavior::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'url'], 'required'],
            [['description', 'description_short'], 'string'],
            [['sort', 'active'], 'integer'],
            [['parent_id', 'after_id', 'created_at', 'updated_at'], 'safe'],
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
            'description_short' => 'Описание короткое',
            'meta_title' => 'SEO заголовок (title)',
            'meta_description' => 'SEO описание (meta description)',
            'sort' => 'Сортировка',
            'active' => 'Активность',
            'created_at' => 'Время создания',
            'updated_at' => 'Время обновления',
            'parent_id' => 'Вложенность в',
            'after_id' => 'После',
        ];
    }

}
