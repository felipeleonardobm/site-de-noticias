<?php $render('header'); 

use \src\models\Category;
use \src\models\User;

$dados = Category::select()->execute();

?>
<h3>
    <?php if(isset($_SESSION["category"])){
        echo $_SESSION["category"];
        unset($_SESSION["category"]);
    }?>
</h3>
<table style="color: RGB(204, 179, 141);" border="1" width="100%">
    <tr>
        <th>Nome</th>
        <th>Criador</th>
        <th>Ações</th>
    </tr>
    <?php foreach($dados as $dado): ?>
    <tr>
        <th><?=$dado['name'];?></th>
        <th><?php
        $nome = User::select('user')
            ->where('id', $dado['user_id'])
            ->execute();
        echo $nome[0]['user'];?></th>
        <th>
            <a href='<?=$base?>/editCategory/<?=$dado['id']?>'>( Editar )</a>
            <a href='<?=$base?>/excluirCategoria/<?=$dado['id']?>' onclick="return confirm('Tem certeza?')">( Excluir )</a>
        </th>
    </tr>
    <?php endforeach;?>
</table>