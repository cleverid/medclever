<?php
/**
 * Created by PhpStorm.
 * User: eugen
 * Date: 23.07.15
 * Time: 19:53
 */

namespace common\components\BBCode;


class BBCodeBehavior extends \bupy7\bbcode\BBCodeBehavior {
    /**
     * @inheritDoc
     */
    public function init() {
        parent::init();

        $this->codeDefinition[] = new GalleryCodeDefinition();
    }


}