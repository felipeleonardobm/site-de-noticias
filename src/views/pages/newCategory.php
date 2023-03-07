<?php $render('header'); ?>

<html>
<head>
    <link rel="stylesheet" href="./css/style.css"> <!-- Adicionar CSS -->
</head>
    <div class="login">
        <h1>Cadastro de categoria</h1>
        <?php
            if(isset($_SESSION["category"])){
                echo $_SESSION["category"];
                unset($_SESSION["category"]);
            }
        ?>
        <form method="POST" action="<?=$base?>/newCategory">
            <label>Nome da categoria<input type="text" name="name"/></label></br></br>
            <label><input type="submit" name="cadastro"/></label>
        </form>
    </div>
</html>