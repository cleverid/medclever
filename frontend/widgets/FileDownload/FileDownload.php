<?php
/**
 * Created by PhpStorm.
 * User: eugen
 * Date: 28.12.14
 * Time: 0:13
 */

namespace frontend\widgets\FileDownload;


use common\models\Post;
use common\models\Rubric;
use yii\web\View;

class FileDownload extends \yii\base\Widget {

    /** @var File */
    public $file;

    public function run() {
        $this->registrScript();

        return $this->render('view', ['file' => $this->file]);
    }

    private function registrScript() {
        $script = <<<JS
            $(document).on('click', ".file-item__link", function(e){
                var self = this;
                $.ajax({
                    url: "/publish-download-inc/" + $(this).data('id'),
                    type: "GET",
                    success: function(){
                        window.location.href = $(self).attr("href");
                    }
                });

                e.stopPropagation();
                return false;
            });
JS;

        $this->view->registerJs($script, View::POS_READY, __CLASS__);
    }

}