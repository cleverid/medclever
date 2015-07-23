<?php
/**
 * Created by PhpStorm.
 * User: eugen
 * Date: 23.07.15
 * Time: 19:55
 */

namespace common\components\BBCode;

use himiklab\thumbnail\EasyThumbnailImage;
use JBBCode\CodeDefinition;
use JBBCode\ElementNode;
use yii\helpers\Html;
use yii\helpers\Url;

class GalleryCodeDefinition extends CodeDefinition {

    public function __construct()
    {
        $this->parseContent = true;
        $this->useOption = true;
        $this->setTagName('gallery');
        $this->nestLimit = -1;

    }

    public function asHtml(ElementNode $el) {
        $result = "";

        $path = $el->getAsText();
        $demesions =  $el->getAttribute()[$this->tagName];
        $demesionsSplit = explode('x', $demesions);
        $width = $demesionsSplit[0];
        if(isset($demesionsSplit[1])) {
            $height = $demesionsSplit[1];
        } else {
            $height = $width;
        }

        $result .= "<div class='gallery'>".PHP_EOL;

        $files = $this->getImageFromDir(\Yii::getAlias('@webroot').$path);
        foreach($files as $file) {
            $urlImage = $path.$file;
            $result .= $this->renderItemFromImage($urlImage, $width, $height);
        }

        $result .= "</div>";

        return $result;
    }

    /**
     * @param $pathDir
     * @return array
     */
    private function getImageFromDir($pathDir) {
        $listImages = [];

        if ($handle = opendir($pathDir)) {
            while (false !== ($entry = readdir($handle))) {
                // what start from dotted close. Etc . .. .hidefile
                if(preg_match('/^\..*/', $entry)) continue;

                $listImages[] = $entry;
            }
            closedir($handle);
        }

        return $listImages;
    }

    /**
     * @param $imageUrl
     * @return string
     */
    private function renderItemFromImage($imageUrl, $width, $height) {
        $result = '';

        $imagePath = \Yii::getAlias('@webroot').$imageUrl;
        $imageCacheUrl = EasyThumbnailImage::thumbnailFileUrl(
            $imagePath,
            $width,
            $height,
            EasyThumbnailImage::THUMBNAIL_INSET,
            []
        );

        list($_width, $_height, $type, $attr) = getimagesize($imagePath);
        $result .= "<a class='gallery-item' data-size='{$_width}x{$_height}' href='$imageUrl'>".PHP_EOL;
        $result .= "<img src='$imageCacheUrl' />".PHP_EOL;
        $result .= "</a>".PHP_EOL;

        return $result;
    }

}