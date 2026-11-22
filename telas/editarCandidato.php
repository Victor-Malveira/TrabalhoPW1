<?php
require_once "../controladores/CandidatoControlador.php";

$id = $_GET['id'];

$candidatoControlador = new CandidatoControlador();
$candidato = $candidatoControlador->buscarPeloId($id);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Candidato</title>
</head>
<body>
    <h1>Editar Candidato</h1>
    <form>
        <input type="hidden" name="id" id="id" value="<?= $candidato->getId(); ?>">
        Nome:<input type="text" name="nome" id="nome" value="<?= $candidato->getNome(); ?>">
        <br><br>
        Email:<input type="email" name="email" id="email" value="<?= $candidato->getEmail(); ?>">
        <br><br>
        Telefone:<input type="text" name="telefone" id="telefone" value="<?= $candidato->getTelefone(); ?>">
        <br><br>
        Formato do currículo:
        <select name="formatoCurriculo" id="formatoCurriculo">
            <option value="Texto" <?= $candidato->getFormatoCurriculo() == "Texto" ? "selected" : ""; ?>>Texto</option>

            <option value="Libras" <?= $candidato->getFormatoCurriculo() == "Libras" ? "selected" : ""; ?>>Vídeo em Libras</option>

            <option value="Audio" <?= $candidato->getFormatoCurriculo() == "Audio" ? "selected" : ""; ?>>Áudio</option>
        </select>
        <br><br>
        <button type="button" onclick="editarCandidato()">Salvar alterações</button>
    </form>
    <br>
    <a href="homeCandidato.php">Voltar</a>
<script src="../scripts/candidato.js"></script>
</body>
</html>
