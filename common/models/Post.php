<?php

namespace common\models;

use common\components\BBCode\BBCodeBehavior;
use frontend\models\interfaces\ISEO;
use Yii;
use yii\helpers\StringHelper;
use yii\web\View;

/**
 * This is the model class for table "{{%post}}".
 *
 * @property integer $id
 * @property integer $rubric_id
 * @property string $name
 * @property string $url
 * @property string $content
 * @property string $content_short
 * @property string $meta_title
 * @property string $meta_description
 * @property integer $views
 * @property integer $sort
 * @property integer $active
 * @property string $published_at
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Rubric $rubric
 */
class Post extends \yii\db\ActiveRecord implements  ISEO
{

    /**
     * @param $urlPage
     * @return Post|null
     */
    public static function findByUrlPage($urlPage) {
        $post = null;

        if( preg_match("~\/(.[^\/]*)$~", $urlPage, $match) ) {
            /** @var Post $post */
            $post = Post::findOne(['url' => $match[1]]);
        }

        return $post;
    }

    /**
     * @param bool $absolute
     * @return string
     */
    public function getUrl($absolute = false) {
        if(empty($this->url)) {
            return '';
        }

        if($absolute) {
            return  Yii::$app->params['shemaSite']
            .Yii::$app->params['domenSite']
            .'/post/'.$this->url;
        } else {
            return '/post/'.$this->url;
        }
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
            return StringHelper::truncateWords(strip_tags($this->content_short), 30, '');
        }
    }

    /**
     * Проссматривал ли пользователь статью
     * @return bool
     */
    public function isViewed() {
        return !empty(Yii::$app->session->get('post_viewed'));
    }

    /**
     * Установка значения проссмотра статьи
     * @param int $value
     */
    public function setViewed($value) {
        Yii::$app->session->set('post_viewed', (int)$value);
    }

    /**
     * Увеличивает ко-во проссмотров на 1-у
     * @throws \Exception
     */
    public function viewsCountUp() {
        $this->views++;
        $this->update();
    }

    /**
     * @param View $view
     */
    public function viewsRegistrJSIncrimenter($view) {
        $script = <<<JS
            setTimeout(function() {
                $.get('/post/countup/{$this->id}')
            }, 5000);
JS;

        $view->registerJs($script, View::POS_READY, 'post_counter_script');
    }

    // ========================================================================

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            [
                'class' => BBCodeBehavior::className(),
                'attribute' => 'content_src',
                'saveAttribute' => 'content',
            ],
        ];
    }

    public static function find()
    {
        return new PostQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%post}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rubric_id', 'views', 'sort', 'active'], 'integer'],
            [['name', 'url'], 'required'],
            [['content', 'content_src', 'content_short'], 'string'],
            [['published_at', 'created_at', 'updated_at'], 'safe'],
            [['name', 'url', 'meta_title', 'meta_description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'rubric_id' => Yii::t('app', 'Рубрика'),
            'name' => Yii::t('app', 'Имя'),
            'url' => Yii::t('app', 'URL адрес'),
            'content' => Yii::t('app', 'Контент'),
            'content_src' => Yii::t('app', 'Контент'),
            'content_short' => Yii::t('app', 'Контент короткий'),
            'meta_title' => Yii::t('app', 'SEO заголовок (title)'),
            'meta_description' => Yii::t('app', 'SEO описание (meta description)'),
            'views' => Yii::t('app', 'Количество просмотров'),
            'sort' => Yii::t('app', 'Сортировка'),
            'active' => Yii::t('app', 'Активность'),
            'published_at' => Yii::t('app', 'Время публикации'),
            'created_at' => Yii::t('app', 'Время создания'),
            'updated_at' => Yii::t('app', 'Время обновления'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRubric()
    {
        return $this->hasOne(Rubric::className(), ['id' => 'rubric_id']);
    }
}
