<?php

namespace frontend\controllers;

use common\models\Post;

class PostController extends Controller
{
    public function actionView($url)
    {
        $post = Post::find()->active()->where(['url' => $url])->one();

        $this->setSeo($post);

        return $this->render('view', [
            'model' => $post
        ]);
    }

}
