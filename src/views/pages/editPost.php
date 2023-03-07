<?php $render('header'); 
use \src\models\Category;
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="./css/style.css"> <!-- Adicionar CSS -->

    <script src="./scripts/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: '#mytextarea'
      });
    </script>
</head>
    <div class="login">
        <h1>Edição de notícia</h1>
        <?php
            if(isset($_SESSION["post"])){
                echo $_SESSION["post"];
                unset($_SESSION["post"]);
            }

            $postCategory = Category::select('name')->where('id', $post[0]['category'])->execute();
            $categories = Category::select()->execute();
        ?>
        <form method="POST" action="<?=$base?>/editPost/<?=$post[0]['id']?>">
            <label>Categoria da notícia<select name="category">
                <?php foreach($categories as $category): ?>
                    <?php
                        if($category['id'] == $post[0]['category']):?>
                            <option value="<?=$category['id']?>" selected><?=$category['name']?></option>
                        <?php else:?>
                            <option value="<?=$category['id']?>"><?=$category['name']?></option>
                        <?php endif; ?>
                <?php endforeach ?>
            </select></label></br></br>
            <label>Título da notícia<input type="text" name="title" value="<?=$post[0]['title']?>"/></label></br></br>
            <label>Conteúdo<textarea id="mytextarea" name="content"><?= $post[0]['content'];?></textarea></label></br></br>
            <label><input type="submit" name="cadastro"/></label>
        </form>
    </div>
</html>