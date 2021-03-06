<?php
/**
 * Created by PhpStorm.
 * User: eugen
 * Date: 03.01.15
 * Time: 14:48
 */

namespace frontend\controllers;


use common\models\Post;
use common\models\Rubric;
use yii\data\ActiveDataProvider;

class RubricController extends Controller {

    /** @var  Rubric */
    private $rubricCurrent;

    /** View rubric */
    public function actionView($url) {
        $this->rubricCurrent = Rubric::find()
            ->where(array('url' => $url))
            // for rubric with short url
            ->orWhere(array('url' => '/'.$url))
            ->one();

        if(!$this->rubricCurrent) {
            $this->pageNotFound();
        }

        $this->setSeo($this->rubricCurrent);

        if(!$this->rubricCurrent->isLeaf()) {
            return $this->rubricSub();
        } else {
            return $this->rubricLeaf();
        }
    }

    /**
     * Show of subitem rubric
     * @return string
     */
    public function rubricSub() {
        $rubrics = $this->rubricCurrent
            ->children()->active()->all();

        return $this->render("list", [
            'model' => $this->rubricCurrent,
            'rubrics' => $rubrics,
        ]);
    }

    /**
     * Show of leaf rubric
     * @return string
     */
    public function rubricLeaf() {
        // TODO[eugen]: Implement pagination
        $posts = new ActiveDataProvider([
            'query' => Post::find()
                ->active()
                ->where(['rubric_id' => $this->rubricCurrent->id]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render("view", [
            'model' => $this->rubricCurrent,
            'posts' => $posts,
        ]);
    }

}