<?php
namespace src\controllers;

use \core\Controller;
use \src\models\User;

class UserController extends Controller {

    public function cadastrarAction() {

        $user = filter_input(INPUT_POST, "user");
        $password = password_hash(filter_input(INPUT_POST, "password"),PASSWORD_DEFAULT);

        if($user && $password) {
            $verify = User::select()->where("user",$user)->execute();

            if(count($verify) > 0) {
                $_SESSION['cadastro'] = "O nome de usuário ".$user." já está em uso!";
                $this->redirect('/cadastro');
            } else {
                User::insert([
                    'user' => $user,
                    'password' => $password
                ])->execute();
                
                $_SESSION['cadastro'] = "Usuário criado com sucesso! Realize seu login.";
                $this->redirect('/login');
            }
        }

        $_SESSION['cadastro'] = "Favor inserir usuário e senha para prosseguir.";
        $this->redirect('/cadastro');
    }

    public function loginAction() {
        
        $user = filter_input(INPUT_POST, "user");
        $password = filter_input(INPUT_POST, "password");

        if($user && $password) {
            $verify = User::select()->where("user", $user)->execute();

            if(count($verify) > 0) {
                
                if(password_verify($password, $verify[0]['password'])) {

                    $_SESSION['loggedin'] = true;
                    $_SESSION['user'] = $user;
                    $_SESSION['admin'] = $verify[0]['admin'] ?: false;

                    $this->redirect('/');
                
                } else {

                    $_SESSION['login'] = "Senha incorreta.";
                    $this->redirect('/login');
                }

            } else {
                
                $_SESSION['login'] = "O nome de usuário ".$user." não existe.";
                $this->redirect('/login');
            }
        }

        $_SESSION['login'] = "Favor inserir usuário e senha para prosseguir.";
        $this->redirect('/login');
    }
}