<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;
use app\models\Post;

/**
 * Description of PostController
 *
 * @author Юра
 */
class PostController extends AppController {
    
    public function actionIndex() {
       // $posts = Post::find()->select('id, title, intro')->orderBy('id DESC')->all();
        $query = Post::find()->select('id, title, intro')->orderBy('id DESC');
        $pages = new \yii\data\Pagination(['totalCount' => $query->count(),
            'pageSize' => 3, 'pageSizeParam' => false, 'forcePageParam' => false]);
        
        $posts = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('index', compact('posts', 'pages'));
    }
    
    public function actionView() { 
        $id = \Yii::$app->request->get('id');
        $post = Post::findOne($id);
        if (empty($post)) throw new \yii\web\HttpException(404, 'Такой страницы нет...');
        return $this->render('view', compact('post')); 
        
    }
    
    public function actionTest() {
        return $this->render('test'); 
        
    }
}
