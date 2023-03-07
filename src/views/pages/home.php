<?php $render('header'); 
use \src\models\Post;
use \core\Database;
use \src\Models\Category;

$dataBase = Database::getInstance();
$noticiasPrincipaisQuery = $dataBase->query("SELECT * FROM posts ORDER BY rating DESC LIMIT 3");
$noticiasPrincipais = $noticiasPrincipaisQuery->fetchAll(PDO::FETCH_ASSOC);

$categories = Category::select()->execute();
?>

<!DOCTYPE HTML>
<html>
<head>

</head>
<body>
<h1 class="text-color1"> Notícias principais </h1>
<div class="noticias">
    <div class="flex-container">
    <?php foreach ($noticiasPrincipais as $noticia):
        $categoria = $dataBase->query("SELECT * FROM categorys WHERE id = " . $noticia['category']);
        $categoria = $categoria->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="noticia">
        <p>Categoria: <?=$categoria[0]['name']?></p>
        <a class="link-noticia  text-color2" href="<?=$base.'/post/'.$noticia['id']?>"><?=$noticia['title']?></a>
        <p>Criada em: <?=$noticia['created']?></p>
    </div>
    <?php endforeach ?>
    </div>
</div>
<div>
<h1 class="text-color1"> Últimas notícias </h1>
<div class="flex-container">
    <?php foreach($categories as $category): ?>
    <div class="noticias">
        <h2 class="text-color1"><?=$category['name']?></h2>
        <?php 
        
        $noticiasCategoriaQuery = $dataBase->query("SELECT * FROM posts WHERE category = ".$category['id']." ORDER BY updated DESC LIMIT 3");
        $noticiasCategoria = $noticiasCategoriaQuery->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($noticiasCategoria as $noticia): 
            $categoria = $dataBase->query("SELECT * FROM categorys WHERE id = " . $noticia['category']);
            $categoria = $categoria->fetchAll(PDO::FETCH_ASSOC);
        ?>
            <div class="noticia text-color2">
                <p>Categoria: <?=$categoria[0]['name']?></p>
                <a class="link-noticia text-color2" href="<?=$base.'/post/'.$noticia['id']?>"><?=$noticia['title']?></a>
                <p>Criada em: <?=$noticia['created']?></p>
            </div>
        <?php endforeach ?>
    </div>
    <?php endforeach ?>
</div>
</div>
</body>
</html>