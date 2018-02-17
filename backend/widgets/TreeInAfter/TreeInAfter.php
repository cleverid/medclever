<?php
/**
 * User: Eugeny Shaposhnikov
 * Date: 02.02.15
 * Time: 11:31
 */

namespace backend\widgets\TreeInAfter;

use common\models\Rubric;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/**
 * Class TreeInAfter
 * @package backend\widgets\TreeInAfter
 */
class TreeInAfter extends \yii\widgets\InputWidget {

    /**
     * @var Rubric
     */
    public $root;
    /** @var Rubric */
    public $model;
    public $idName = 'id';
    public $parentAttr = 'parent_id';
    public $afterAttr = 'after_id';
    public $parentEmpty = '- Верхний уровень -';
    public $afterEmpty = '- Первым -';
    public $urlUpdate = 'tree';

    public function init() {
        parent::init();

        $this->registrScript();
    }


    public function run() {
        echo Html::beginTag('div', ['id' => $this->getId()]);
        $urlUpdate = Url::toRoute($this->urlUpdate);
        echo Html::activeDropDownList(
            $this->model, $this->parentAttr,
            ArrayHelper::map($this->root->children()->all(), 'id', function ($i) {
                return str_repeat('. ', $i->depth - 1) . $i->name;
            }),
            [
                'class' => 'form-control',
                'prompt' => $this->parentEmpty,
                'onchange' => 'updateTree("'.$urlUpdate.'", $(this).val(), "'.$this->getId().'")',
            ]
        );

        $this->setBefore();

        $parent = $this->getParent();
        echo Html::activeLabel($this->model, $this->afterAttr);
        echo Html::activeDropDownList(
            $this->model, $this->afterAttr,
            ArrayHelper::map($parent?$parent->children(1)->all() : [], 'id', function ($i) {
                return $i->name;
            }),
            [
                'class' => 'form-control',
                'prompt' => $this->afterEmpty,
            ]
        );
        echo Html::endTag('div');
    }

    private function registrScript() {
        $script = <<<EOL
        function updateTree(url, id, idWidget) {
            var paramName = '{$this->idName}',
                data = {};

            data[paramName] = id;
            data['idWidget'] = idWidget;

            jQuery.ajax({
                url: url,
                type: 'GET',
                data: data,
                success: function(res) {
                    var selector = "#" + idWidget;
                    $(selector).html($(selector, '<div>' + res + '</div>').html());
                }
            });
        }
EOL;

        $this->getView()->registerJs($script, View::POS_END);
    }

    /**
     * @return Rubric
     */
    private function getParent() {
        /** @var Rubric $parent */
        $parent = Rubric::findOne($this->model->parent_id);
        if (!$parent) {
            $parent = Rubric::getRoot();
            return $parent;
        }

        return $parent;
    }

    private function setBefore() {
        /** @var Rubric $next */
        $next = $this->model->prev()->one();
        if ($next) {
            $this->model->{$this->afterAttr} = $next->id;
        }
    }

}