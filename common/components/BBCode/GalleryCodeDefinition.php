<?php
/**
 * Created by PhpStorm.
 * User: eugen
 * Date: 23.07.15
 * Time: 19:55
 */

namespace common\components\BBCode;

use JBBCode\CodeDefinition;
use JBBCode\ElementNode;

class GalleryCodeDefinition extends CodeDefinition {

    public function __construct()
    {
        $this->parseContent = true;
        $this->useOption = true;
        $this->setTagName('gallery');
        $this->nestLimit = -1;

    }

    public function asHtml(ElementNode $el) {
        $demesions =  $el->getAttribute()[$this->tagName];
        $path = $el->getAsText();
        return '<span style="color: red;">'.$path.'_'.$demesions.'</span>';
    }

}