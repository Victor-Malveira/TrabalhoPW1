<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Buscar</title>
</head>

<body>

<h1>Busca de Empresas</h1>

<form action="../controladores/rota.php" method="GET">
    <input type="hidden" name="acao" value="buscarEmpresa">
    <input type="text" name="pesquisa" placeholder="Digite nome ou e-mail">
    <button type="submit">Buscar</button>

</form>

<br>

<?php

if(isset($empresas)){

    foreach($empresas as $empresa){

?>
    <div>
        <p><strong>Nome:</strong><?= $empresa->getNome(); ?></p>
        <p><strong>E-mail:</strong><?= $empresa->getEmail(); ?></p>
        <p><strong>Telefone:</strong><?= $empresa->getTelefone(); ?></p>
        <a href="/gestao/telas/editarEmpresa.php?id=<?= $empresa->getId(); ?>">Editar</a>
        <a href="../controladores/rota.php?acao=excluirEmpresa&id=<?= $empresa->getId(); ?>">Excluir</a>

    </div>

    <hr>

<?php

    }

}

?>

</body>
</html>