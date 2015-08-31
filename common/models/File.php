<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "file".
 *
 * @property integer $id
 * @property string $title
 * @property string $name
 * @property integer $size
 * @property string $description
 * @property string $meta_title
 * @property string $meta_description
 * @property integer $views
 * @property integer $downloads
 * @property integer $sort
 * @property integer $active
 * @property string $published_at
 * @property string $created_at
 * @property string $updated_at
 */
class File extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'value' => new Expression("NOW()"),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'size'], 'required'],
            [['size', 'views', 'downloads', 'sort', 'active'], 'integer'],
            [['published_at', 'created_at', 'updated_at'], 'safe'],
            [['title', 'name', 'description', 'meta_title', 'meta_description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Заголовок для файла'),
            'name' => Yii::t('app', 'Имя файла'),
            'size' => Yii::t('app', 'Размер файла в байтах'),
            'description' => Yii::t('app', 'Описание'),
            'meta_title' => Yii::t('app', 'SEO заголовок (title)'),
            'meta_description' => Yii::t('app', 'SEO описание (meta description)'),
            'views' => Yii::t('app', 'Количество просмотров'),
            'downloads' => Yii::t('app', 'Количество скачиваний'),
            'sort' => Yii::t('app', 'Сортировка'),
            'active' => Yii::t('app', 'Активность'),
            'published_at' => Yii::t('app', 'Время публикации'),
            'created_at' => Yii::t('app', 'Время создания'),
            'updated_at' => Yii::t('app', 'Время обновления'),
        ];
    }

    /**
     * @inheritdoc
     * @return FileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FileQuery(get_called_class());
    }
}
