<?php
namespace src\controllers;

use \core\Controller;
use \src\models\Post;
use \src\models\User;
use \src\models\Rating;

class PostController extends Controller {

    public function newPost() {
        $title = filter_input(INPUT_POST, 'title');
        $content = filter_input(INPUT_POST, 'content');
        $category = filter_input(INPUT_POST, 'category');
        $created_by = User::select('id')->where('user', $_SESSION['user'])->execute();

        if($title && $content && $category){
            Post::insert([
                'title' => $title,
                'content' => $content,
                'category' => $category,
                'created_by' => $created_by[0]['id'],
                'created' => date("Y-m-d H:i:s"),
                'updated' => date("Y-m-d H:i:s"),
                'rating' => 0
            ])->execute();
            $_SESSION['post'] = 'Notícia cadastrada com sucesso!';
            $this->redirect('/newPost');
        }

        $_SESSION['post'] = 'Favor preencher todos os campos.';
        $this->redirect('/newPost');
    }

    public function editPost($args) {
        $verify = Post::select()->find($args['id']);
        $categoryEdit = filter_input(INPUT_POST, 'category');
        $titleEdit = filter_input(INPUT_POST, 'title');
        $contentEdit = filter_input(INPUT_POST, 'content');
        $updatedEdit = date("Y-m-d H:i:s");

        if(count($verify) > 0){
            Post::update()->
                set('category', $categoryEdit)->
                set('title', $titleEdit)->
                set('content', $contentEdit)->
                set('updated', $updatedEdit)->
                where('id',$args['id'])
                ->execute();
        }

        $this->redirect('/listPosts');
    }

    public function deletePost($args) {
        Rating::delete()
            ->where('id_post', $args['id'])
            ->execute();

        Post::delete()
            ->where('id', $args['id'])
            ->execute();
        $this->redirect('/listPosts');
    }

}