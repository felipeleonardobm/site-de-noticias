<?php $render('header'); 
use \src\models\Category;

$categories = Category::select()->execute();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="./css/style.css"> <!-- Adicionar CSS -->

    <script type="text/javascript" src="./scripts/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinyMCE.init({
        selector: ".tinymce"
    });
    </script>

</head>
    <div class="login">
        <h1>Cadastro de notícia</h1>
        <?php
            if(isset($_SESSION["post"])){
                echo $_SESSION["post"];
                unset($_SESSION["post"]);
            }
        ?>
        <form method="POST" action="<?=$base?>/newPost">
            <label>Categoria da notícia<select name="category">
                <?php foreach($categories as $category): ?>
                    <option value="<?=$category['id']?>"><?=$category['name']?></option>
                <?php endforeach ?>
            </select></label></br></br>
            <label>Título da notícia<input type="text" name="title"/></label></br></br>
            <label>Conteúdo</br><textarea class="tinymce" name="content" cols="50" rows="15">Conteúdo da notícia</textarea></label></br></br>
            <label><input type="submit" name="cadastro"/></label>
        </form>
    </div>
</html>