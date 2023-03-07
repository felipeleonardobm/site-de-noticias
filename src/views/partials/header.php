<?php

Use \src\models\Category;

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="./css/style.css">
</head>

    <div class="navbar">
    <div class="navbar-separator">
    <a href="<?=$base?>/"><img id="logo" src="http://localhost/NOTICIAS/public/assets/logo.png" alt="logo"></a>
    <a class="link" href="<?=$base?>/">Homepage</a>
    <div class="dropdown">
        <button class="dropbtn">Categorias
        <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <?php 
            $categories = Category::select()->execute();
            foreach ($categories as $category): ?>
                <a href="<?=$base.'/posts/'.$category['id']?>"><?=$category['name']?></a>
            <?php endforeach ?>
            <?php if($_SESSION['admin']): ?>
                <hr/>
                <a href="<?=$base?>/newCategory">Criar categoria</a>
                <a href="<?=$base?>/listCategories">Editar categorias</a>
                <a href="<?=$base?>/newPost">Criar notícia</a>
                <a href="<?=$base?>/listPosts">Editar notícias</a>
            <?php endif ?>
        </div>
    </div>
    </div>
    <div>
    <?php if($_SESSION['loggedin']): ?>
        <div id="greetings"><?='Olá, '.$_SESSION['user'].'!';?></div>
        <a class="link" href="<?=$base?>/logout">Deslogar</a>
    <?php else: ?>
        <a href="<?=$base?>/login">Login</a>
        <a href="<?=$base?>/cadastro">Cadastrar</a>
    <?php endif ?>
    </div>
    </div>
</html>