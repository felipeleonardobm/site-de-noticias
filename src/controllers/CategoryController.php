<?php
namespace src\controllers;

use \core\Controller;
use \src\models\Category;
use \src\models\Post;
use \src\models\User;

class CategoryController extends Controller {

   public function newAction() {
        $name = filter_input(INPUT_POST, 'name');

        if($name){
            $verifyCategory = Category::select()->where('name', $name)->execute();
            $user_id = User::select('id')->where('user', $_SESSION['user'])->execute();

            if(!$_SESSION['admin']) {
                $_SESSION['category'] = "Você não tem permissão para cadastrar categorias.";
                $this->redirect('/newCategory');
            }

            if(count($verifyCategory) == 0) {
                Category::insert([
                    'name' => $name,
                    'user_id' => $user_id[0]['id']
                ])->execute();

                $_SESSION['category'] = "Categoria criada com sucesso!";
                $this->redirect('/newCategory');
            }

            $_SESSION['category'] = "Já existe uma categoria com este nome.";
            $this->redirect('/newCategory');

        }
   }

   public function editAction($args) {
        $verify = Category::select()->find($args['id']);
        $nameEdit = filter_input(INPUT_POST, 'name');

        if(count($verify) > 0){
            Category::update()->
                set('name', $nameEdit)->
                where('id',$args['id'])
                ->execute();
        }

        $this->redirect('/listCategories');
   }

    public function deleteAction($args) {
        $verify = Post::select()
            ->where('category', $args['id'])
        ->execute();

        if(count($verify) > 0) {
            $_SESSION['category'] = 'Só é possível deletar categorias que não possuem notícias.';
            $this->redirect('/listCategories');
        } else {
            Category::delete()
                ->where('id', $args['id'])
                ->execute();
            $this->redirect('/listCategories');
        }

   }

}