<?php
require_once "../controladores/EmpresaControlador.php";
$id = $_GET['id'];
$empresaControlador = new EmpresaControlador();
$empresa = $empresaControlador->buscarPeloId($id);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Empresa</title>
</head>
<body>
    <h1>Editar Empresa</h1>
    <form action="../controladores/rota.php?acao=editarEmpresa" method="POST">

        <input type="hidden" name="id" value="<?= $empresa->getId(); ?>">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?= $empresa->getNome(); ?>">
        <br><br>
        <label>E-mail:</label>
        <input type="text" name="email" value="<?= $empresa->getEmail(); ?>">
        <br><br>
        <label>Telefone:</label>
        <input type="text" name="telefone" value="<?= $empresa->getTelefone(); ?>">
        <br><br>

        <button type="submit">
            Salvar alterações
        </button>

    </form>
    <br>
    <a href="gestao.php">Voltar</a>

</body>
</html>