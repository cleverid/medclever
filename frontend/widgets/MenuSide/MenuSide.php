<?php
/**
 * Created by PhpStorm.
 * User: eugen
 * Date: 28.12.14
 * Time: 0:13
 */

namespace frontend\widgets\MenuSide;


use common\models\Post;
use common\models\Rubric;

class MenuSide extends \yii\base\Widget {

    /** @var  Rubric[] */
    private $rubrics;
    /** @var  Rubric[] */
    private $rubricsSelectPath;
    /** @var  Rubric */
    private $rubricsSeled;

    public function init() {
        $this->rubrics = Rubric::getRoot()->children()->active()->all();
    }

    public function run() {

        $items = [];

        foreach($this->rubrics as $rubric) {
            $items[] = [
                "name" => $rubric->name,
                "url" => $rubric->getUrl(),
                "active" => $this->isActiveItem($rubric),
                "depth" => $rubric->depth - 1,
            ];
        }

        return $this->render('view', ['items' => $items]);
    }

    /**
     * @param Rubric $rubric
     * @return bool
     */
    private function isActiveItem(Rubric $rubric){
        foreach($this->getTreePath() as $_rubric) {
            if ($rubric->id == $_rubric->id) {
                return true;
            }
        }

        return false;
    }

    /**
     * Return selected item from menu
     * @return Rubric|null
     */
    private function getSelectedItem() {
        if($this->rubricsSeled !== null) {
            return $this->rubricsSeled;
        }

        $rubricSelected = null;

        $urlPage = \Yii::$app->request->url;
        if(preg_match("~^\/post~", $urlPage)) {
            foreach($this->rubrics as $rubric) {
                if($rubric->url == $urlPage) {
                    $rubricSelected = $rubric;
                }

                if(!$rubricSelected
                    && ($post = Post::findByUrlPage($urlPage))
                ) {
                    $rubricSelected = $post->getRubric()->one();
                }
            }
        } elseif(preg_match("~^\/publish~", $urlPage)) {
            foreach($this->rubrics as $rubric) {
                if($rubric->url == "/publishes") {
                    $rubricSelected = $rubric;
                }
            }
        } else {
            foreach($this->rubrics as $rubric) {
                if($rubric->isActiveByUrl($urlPage)) {
                    $rubricSelected = $rubric;
                }
            }
        }

        return $this->rubricsSeled = $rubricSelected;
    }

    /**
     * Return ap path to root from selected
     * @return Rubric[]
     */
    private function getTreePath(){
        if($this->rubricsSelectPath !== null) {
            return $this->rubricsSelectPath;
        }

        if($selected = $this->getSelectedItem()) {
            $this->rubricsSelectPath = $selected->parents()->all();
            array_unshift($this->rubricsSelectPath, $selected);
        } else {
            $this->rubricsSelectPath = array();
        }

        return $this->rubricsSelectPath;
    }

}