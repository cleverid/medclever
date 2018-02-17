<?php

namespace frontend\controllers;

use common\models\Post;

class PostController extends Controller
{
    public function actionView($url)
    {
        /** @var Post $post */
        $post = Post::find()->active()->where(['url' => $url])->one();
        if(!$post) {
            $this->pageNotFound();
        }

        !$post->isViewed() && $post->viewsRegistrJSIncrimenter($this->getView());
        $this->setSeo($post);

        return $this->render('view', [
            'model' => $post
        ]);
    }

    public function actionCountup($id) {
        /** @var Post $post */
        $post = Post::findOne($id);
        if(!$post->isViewed()) {
            $post->viewsCountUp();
            $post->setViewed(1);
        }
    }

}
