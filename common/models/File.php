<?php

namespace common\models;

use frontend\models\interfaces\ISEO;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\StringHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "file".
 *
 * @property integer $id
 * @property string $title
 * @property string $name
 * @property integer $size
 * @property string $description
 * @property string $description_short
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
class File extends \yii\db\ActiveRecord implements ISEO
{

    /**
     * @var UploadedFile
     */
    public $fileObject;
    /** @var string  */
    private $folderName = "published_files";

    /**
     * @return int
     */
    public function getDBIncriment() {
        $shema = Yii::$app->db->createCommand("SHOW TABLE STATUS WHERE name='{$this->tableName()}'")
            ->queryOne();

        return (int)$shema['Auto_increment'];
    }

    /**
     * @param int $precision
     * @return string
     */
    public function getSizeHuman($precision = 1) {
        $size = $this->size;
        $units = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
        $step = 1024;
        $i = 0;
        while (($size / $step) > 0.9) {
            $size = $size / $step;
            $i++;
        }

        return round($size, $precision)." ".$units[$i];
    }

    /**
     * @return string
     */
    public function getDescription() {
        if(strlen(trim(strip_tags($this->description))) > 0) {
            return $this->description;
        } else {
            return $this->description_short;
        }
    }

    /**
     * Url страницы модели
     * @return string
     */
    public function getUrl() {
        return "/publish/".$this->id;
    }

    /**
     * Url адрес для сохранения
     * @return string
     */
    public function getUrlForDownload() {
        $url = "/{$this->folderName}/".$this->name;

        return $url;
    }

    /**
     * Возращает сео заголовок для страницы (title)
     * @return string
     */
    public function getSeoTitle() {
        if(strlen(trim(strip_tags($this->meta_title))) > 0) {
            return $this->meta_title;
        } else {
            return $this->title;
        }
    }

    /**
     * Возращает сео описание для страницы (meta description)
     * @return string
     */
    public function getSeoDescription() {
        if(strlen(trim(strip_tags($this->meta_description))) > 0) {
            return $this->meta_description;
        } else {
            return StringHelper::truncateWords($this->description, 30, '');
        }
    }

    /**
     * @return bool
     */
    public function upload() {
        if ($this->fileObject) {
            $prefix = $this->isNewRecord
                ?$this->getDBIncriment()
                :$this->id;

            $name = $prefix
                . "-" .$this->fileObject->baseName
                . "." .$this->fileObject->extension;
            $path = Yii::getAlias("@webroot") . "/{$this->folderName}/";

            $this->name = $name;
            $this->size = $this->fileObject->size;
            return $this->fileObject->saveAs($path . $name);
        } else {
            return false;
        }
    }

    // ========================================================================

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
            [['fileObject'], 'file', 'skipOnEmpty' => true],
            [['fileObject'], 'required', 'on' => "create"],
            [['active', 'published_at', 'created_at', 'updated_at'], 'safe'],
            [['title', 'name', 'description', 'meta_title', 'meta_description'], 'string', 'max' => 255],
            [['description_short'], 'string']
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
            'description_short' => Yii::t('app', 'Короткое описание'),
            'meta_title' => Yii::t('app', 'SEO заголовок (title)'),
            'meta_description' => Yii::t('app', 'SEO описание (meta description)'),
            'views' => Yii::t('app', 'Количество просмотров'),
            'downloads' => Yii::t('app', 'Количество скачиваний'),
            'sort' => Yii::t('app', 'Сортировка'),
            'active' => Yii::t('app', 'Активность'),
            'published_at' => Yii::t('app', 'Время публикации'),
            'created_at' => Yii::t('app', 'Время создания'),
            'updated_at' => Yii::t('app', 'Время обновления'),
            'fileObject' => Yii::t('app', 'Файл'),
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
