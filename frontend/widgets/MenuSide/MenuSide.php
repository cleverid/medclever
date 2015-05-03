<?php
/**
 * Created by PhpStorm.
 * User: eugen
 * Date: 28.12.14
 * Time: 0:13
 */

namespace frontend\widgets\MenuSide;


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
     * @return Rubric|null
     */
    private function getSelectedItem() {
        if($this->rubricsSeled !== null) {
            return $this->rubricsSeled;
        }

        $rubricSelected = null;
        foreach($this->rubrics as $rubric) {
            if($rubric->isActiveByUrl(\Yii::$app->request->url)) {
                $rubricSelected = $rubric;
            }
        }

        return $this->rubricsSeled = $rubricSelected;
    }

    /**
     * @return Rubric[]
     */
    private function getTreePath(){
        if($this->rubricsSelectPath !== null) {
            return $this->rubricsSelectPath;
        }

        if($selected = $this->getSelectedItem()) {
            $this->rubricsSelectPath = $selected->parents()->all();
            array_unshift($this->rubricsSelectPath, $selected);
        }

        return $this->rubricsSelectPath;
    }

}