<?php $render('header'); 

use \src\models\Post;
use \src\models\Category;
use \src\models\User;
use \core\Database;

$noticia = Post::select()->
            where('id', $post['id'])
            ->execute();

$categoria = Category::select()->
    where('id', $noticia[0]['category'])
    ->execute();

if($_SESSION['user']) {
    $user = User::select('id')
        ->where('user', $_SESSION['user'])
        ->execute();

    $dataBase = Database::getInstance();

    $rating = $dataBase->query("SELECT * FROM ratings WHERE id_user = ".$user[0]['id']." AND id_post = ".$noticia[0]['id']."");
    $rating = $rating->fetchAll(PDO::FETCH_ASSOC);

    if($rating) {
        $isRated = $rating[0]['rating'];
    } else {
        $isRated = 2;
    }
} else {
    $isRated = 3;
}

?>

<html>

<head>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/> -->
    <link rel="stylesheet" href="../css/style.css"/>
    <script src="https://use.fontawesome.com/fe459689b4.js"></script>
</head>

<body>
    <div class="noticia-unica text-color2">
    <h1><?=$noticia[0]['title']?></h1>
    <p><?=$categoria[0]['name']?></p>
    <p><?=$noticia[0]['content']?></p>
    <p>Criada em: <?=$noticia[0]['created']?></p>
    <div class="flex-container" style="justify-content: center;">
    <button class="btn" id="like" onclick="like(<?= $noticia[0]['id']?>)">
        <i class="fa fa-thumbs-up fa-lg" aria-hidden="true"></i>
    </button>
    <button class="btn" id="dislike" onclick="dislike(<?= $noticia[0]['id']?>)">
        <i class="fa fa-thumbs-down fa-lg" aria-hidden="true"></i>
    </button>
    </div>
    </div>
</body>

<script>
    var btnLike = document.querySelector('#like');
    var btnDislike = document.querySelector('#dislike');
    <?php if($isRated):?> 
        var isRated = <?=$isRated?>;
    <?php endif ?>

    document.addEventListener("DOMContentLoaded", function(event) {
        // alert(isRated);
        if(isRated == 1) {
            btnLike.classList.toggle('green');
        } 
        if(isRated == 0) {
            btnDislike.classList.toggle('red');
        }
    });

    function like(args) {
        if(isRated == 3) {
            alert('Somente usuários logados podem avaliar notícias.');
        } else {
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // alert(this.responseText);
                }
            }
            xmlhttp.open("GET", "../like.php?n=" + args, true);
            xmlhttp.send();
            likeClick();
        }
    }

    function dislike(args) {
        if(isRated == 3) {
            alert('Somente usuários logados podem avaliar notícias.');
        } else {
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // alert(this.responseText);
                }
            }
            xmlhttp.open("GET", "../dislike.php?n=" + args, true);
            xmlhttp.send();
            dislikeClick();
        }
    }

    // btnLike.addEventListener('click', function() {
    function likeClick() {

        if (btnDislike.classList.contains('red')) {
        btnDislike.classList.remove('red');
        } 
        btnLike.classList.toggle('green');
    
    };

    // btnDislike.addEventListener('click', function() {
    function dislikeClick() {

        if (btnLike.classList.contains('green')) {
        btnLike.classList.remove('green');
        } 
        btnDislike.classList.toggle('red');
    
    };
</script>

</html>