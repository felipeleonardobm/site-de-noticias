<?php $render('header'); ?>

<html>
<head>
    <link rel="stylesheet" href="./css/style.css"> <!-- Adicionar CSS -->
</head>
    <div class="login">
        <h1>Edição de categoria</h1>
        <?php
            if(isset($_SESSION["category"])){
                echo $_SESSION["category"];
                unset($_SESSION["category"]);
            }
        ?>
        <form method="POST" action="<?=$base?>/editCategory/<?=$category[0]['id']?>">
            <label>Nome da categoria<input type="text" name="name" value="<?=$category[0]['name']?>"/></label></br></br>
            <label><input type="submit" name="edicao"/></label>
        </form>
    </div>
</html>