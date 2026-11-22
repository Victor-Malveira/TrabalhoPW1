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
        <input type="hidden" name="id" value="<?= $empresa- id="id">getId(); ?>">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?= $empresa- id="nome">getNome(); ?>">
        <br><br>
        <label>E-mail:</label>
        <input type="text" name="email" value="<?= $empresa- id="email">getEmail(); ?>">
        <br><br>
        <label>Telefone:</label>
        <input type="text" name="telefone" value="<?= $empresa- id="telefone">getTelefone(); ?>">
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