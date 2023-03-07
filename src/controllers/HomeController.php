<?php
namespace src\controllers;

use \core\Controller;
use src\models\Category;
use src\models\Post;

class HomeController extends Controller {

    public function index() {
        $this->render('home', ['nome' => 'Bonieky']);
    }

    public function login() {
        $this->render('login');
    }

    public function cadastrar() {
        $this->render('cadastrar');
    }

    public function logout() {

        $_SESSION['loggedin'] = false;
        $_SESSION['login'] = "Até a próxima!";
        $_SESSION['admin'] =  false;
        unset($_SESSION['user']);
        $this->redirect('/login');
        
    }

    public function newCategory() {
        $this->render('newCategory');
    }

    public function listCategories() {
        $this->render('listCategories');
    }

    public function editCategory($args) {

        $verify = Category::select()->where('id', $args['id'])->execute();

        if (count($verify) > 0)
            $this->render('editCategory', [
                'category' => $verify
            ]);
        
        $this->render('/'); 
    }

    public function newPost() {
        $this->render('newPost');
    }

    public function listPosts() {
        $this->render('listPosts');
    }

    public function editPost($args) {

        $verify = Post::select()->where('id', $args['id'])->execute();

        if (count($verify) > 0)
            $this->render('editPost', [
                'post' => $verify
            ]);
        
        $this->render('/'); 
    }

    public function viewPosts($args) {
        $verify = Category::select()->where('id', $args['id'])->execute();

        if (count($verify) > 0) {
            $this->render('posts', [
                'category' => $args
            ]);
        }
    }

    public function post($args) {
        $this->render('post', [
            'post' => $args
        ]);
    }
}