<?php $render('header'); 

use \core\Database;

$dataBase = Database::getInstance();

$noticias = $dataBase->query("SELECT * FROM posts WHERE category = ".$category['id']." ORDER BY rating DESC LIMIT 3");
$noticias = $noticias->fetchAll(PDO::FETCH_ASSOC);

$category = $dataBase->query("SELECT * FROM categorys WHERE id = ".$category['id']);
$category = $category->fetchAll(PDO::FETCH_ASSOC);
?>

<html>
<head>
    <link rel="stylesheet" href="../css/style.css"/>
</head>
<div>
    <h1 class="text-color1" >Principais notícias sobre <?=$category[0]['name']?></h1>
    <?php foreach($noticias as $noticia): ?>
    <div class="noticia text-color2" >
        <a class="link-noticia text-color2" href="<?=$base.'/post/'.$noticia['id']?>"><?=$noticia['title']?></a>
        <p>Criada em: <?=$noticia['created']?></p>
    </div>
    <?php endforeach ?>
</div>