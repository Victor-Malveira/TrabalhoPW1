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
    <form>
        <input type="hidden" name="id" id="id" value="<?= $empresa->getId(); ?>">
        <label>Nome:</label>
        <input type="text" name="nome" id="nome" value="<?= $empresa->getNome(); ?>">
        <br><br>
        <label>E-mail:</label>
        <input type="text" name="email" id="email" value="<?= $empresa->getEmail(); ?>">
        <br><br>
        <label>Telefone:</label>
        <input type="text" name="telefone" id="telefone" value="<?= $empresa->getTelefone(); ?>">
        <br><br>
        <button type="button" onclick="editarEmpresa()">
            Salvar alterações
        </button>
    </form>
    <br>
    <a href="gestao.php">Voltar</a>

<script src="../scripts/empresa.js"></script>
</body>
</html>