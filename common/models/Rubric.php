<?php

namespace common\models;

use creocoder\nestedsets\NestedSetsBehavior;
use frontend\models\interfaces\ISEO;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\Expression;
use yii\helpers\StringHelper;

/**
 * This is the model class for table "{{%rubric}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $image_file
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
 *
 * // NestedSetsQueryBehavior
 * @method ActiveQuery roots()
 * @method ActiveQuery children()
 * @method bool makeRoot()
 * @method bool insertAfter()
 * @method bool prependTo()
 * @method bool isLeaf()
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

    // ------------------------------------------------------------------------

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

    /**
     * @param bool $absolute
     * @return string
     */
    public function getUrl($absolute = false) {
        $url = '';

        $urlBase =  $absolute
            ?Yii::$app->params['shemaSite'].Yii::$app->params['domenSite']
            :'';

        if(empty($this->url)) {
            return $urlBase.$url;
        }

        if(preg_match('#^\/\.*#', $this->url)) {
            return $urlBase.$this->url;
        }

        if($absolute) {
            return  $urlBase
                    .'/rubric/'.$this->url;
        } else {
            return $urlBase.'/rubric/'.$this->url;
        }
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
        if(strlen(trim(strip_tags($this->meta_title))) > 0) {
            return $this->meta_title;
        } else {
            return $this->name;
        }
    }

    /**
     * Возращает сео описание для страници (meta description)
     * @return string
     */
    public function getSeoDescription() {
        if(strlen(trim(strip_tags($this->meta_description))) > 0) {
            return $this->meta_description;
        } else {
            return StringHelper::truncateWords($this->description_short, 30, '');
        }
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
            [['image_file', 'parent_id', 'after_id', 'created_at', 'updated_at'], 'safe'],
            [['name', 'url', 'meta_title', 'meta_description'], 'string', 'max' => 255],
            ['parent_id', 'validateParent', 'skipOnError' => false],
            ['url', 'unique'],
        ];
    }

    public function validateParent($attribute, $params) {
        if($this->parent_id == $this->id) {
            $this->addError($attribute, 'Не может быть вложено само в себя');
        }

        if($chldren = $this->children()->all()) {
            foreach($chldren as $child) {
                if($child->id == $this->parent_id) {
                    $this->addError($attribute, 'Не может быть вложено в собственное дерево');
                }
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'image_file' => 'Изображение',
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
