<?php $render('header'); 

use \src\models\Post;
use \src\models\User;
use \src\models\Category;

$dados = Post::select()->execute();

?>

<table style="color: RGB(204, 179, 141);" border="1" width="100%">
    <tr>
        <th>Título</th>
        <th>Categoria</th>
        <th>Criador</th>
        <th>Criado em</th>
        <th>Última atualização</th>
        <th>rating</th>
        <th>Ações</th>
    </tr>
    <?php foreach($dados as $dado): ?>
    <tr>
        <th><?=$dado['title'];?></th>
        <th><?php
        $categoria = Category::select('name')
            ->where('id', $dado['category'])
            ->execute();
        echo $categoria[0]['name'];?></th>
        <th><?php
        $criador = User::select('user')
            ->where('id',$dado['created_by'])
            ->execute();
        echo $criador[0]['user'];?></th>
        <th><?=$dado['created'];?></th>
        <th><?=$dado['updated'];?></th>
        <th><?=$dado['rating'];?></th>
        <th>
            <a href='<?=$base?>/editPost/<?=$dado['id']?>'>( Editar )</a>
            <a href='<?=$base?>/excluirPost/<?=$dado['id']?>' onclick="return confirm('Tem certeza que deseja excluir esta notícia? Esta ação não pode ser desfeita.')">( Excluir )</a>
        </th>
    </tr>
    <?php endforeach;?>
</table>