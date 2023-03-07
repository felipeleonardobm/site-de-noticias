<?php $render('header'); ?>

<html>
<head>
    <link rel="stylesheet" href="./css/style.css"> <!-- Adicionar CSS -->
</head>
    <div class="login flex-container">
        <h1 style="text-align: center;color: #563444;">Cadastro</h1>
        <?php
            if(isset($_SESSION["cadastro"])){
                echo $_SESSION["cadastro"];
                unset($_SESSION["cadastro"]);
            }
        ?>
        <form style="display: flex; flex-direction: column; align-items: center;" method="POST" action="<?=$base?>/cadastro">
            <label style="display: flex; flex-direction: column; align-items: center;" >Usuário<input type="text" name="user"/></label></br></br>
            <label style="display: flex; flex-direction: column; align-items: center;" >Senha<input type="password" name="password"/></label></br></br>
            <label><input class="login-btn" type="submit" name="cadastro"/></label>
        </form>
    </div>
</html>