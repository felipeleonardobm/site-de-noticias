<?php
session_start();
require '../vendor/autoload.php';
require '../src/routes.php';

use \src\models\User;
use \src\models\Post;
use \src\models\Rating;
use \core\Database;

$n = $_REQUEST["n"];

$user = User::select('id')
    ->where('user', $_SESSION['user'])
    ->execute();

$noticia = Post::select()
        ->where('id', $n)
        ->execute();

$dataBase = Database::getInstance();

$rating = $dataBase->query("SELECT * FROM ratings WHERE (id_user = ".$user[0]['id']." AND id_post = ".$n.")");
$rating = $rating->fetchAll(PDO::FETCH_ASSOC);

if($rating) {
    if($rating[0]['rating']) {
        $dataBase->query("DELETE FROM ratings WHERE (id_user = ".$user[0]['id']." AND id_post = ".$n.")");

        Post::update()
            ->where('id', $n)
            ->set([
                'rating' => $noticia[0]['rating'] - 1
            ])->execute();

        echo 'like desativado';
    } else {
        $dataBase->query("UPDATE ratings SET rating = 1 WHERE (id_user = ".$user[0]['id']." AND id_post = ".$n.")");
        
        Post::update()->
        where('id', $noticia[0]['id'])
        ->set([
            'rating' => $noticia[0]['rating'] + 2
        ])->execute();

        echo 'dislike desativado e like ativado';
    }

} else {
    Rating::insert([
        'id_user' => $user[0]['id'],
        'id_post' => $noticia[0]['id'],
        'rating' => 1
    ])
    ->execute();

    Post::update()->
        where('id', $noticia[0]['id'])
        ->set([
            'rating' => $noticia[0]['rating'] + 1
        ])->execute();

    echo 'like ativado';
}
?>