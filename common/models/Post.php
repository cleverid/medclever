<?php

namespace common\models;

use Yii;

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
class Post extends \yii\db\ActiveRecord
{
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
            [['content', 'content_short'], 'string'],
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
