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

    <form action="../controladores/rota.php?acao=editarCandidato" method="POST">

        <input type="hidden" name="id" value="<?= $candidato->getId(); ?>">

        Nome:
        <input type="text" name="nome" value="<?= $candidato->getNome(); ?>">
        <br><br>

        Email:
        <input type="email" name="email" value="<?= $candidato->getEmail(); ?>">
        <br><br>

        Telefone:
        <input type="text" name="telefone" value="<?= $candidato->getTelefone(); ?>">
        <br><br>

        Formato do currículo:
        <select name="formatoCurriculo">
            <option value="Texto" <?= $candidato->getFormatoCurriculo() == "Texto" ? "selected" : ""; ?>>Texto</option>

            <option value="Libras" <?= $candidato->getFormatoCurriculo() == "Libras" ? "selected" : ""; ?>>Vídeo em Libras</option>

            <option value="Audio" <?= $candidato->getFormatoCurriculo() == "Audio" ? "selected" : ""; ?>>Áudio</option>
        </select>

        <br><br>

        <button type="submit">Salvar alterações</button>

    </form>

    <br>
    <a href="homeCandidato.php">Voltar</a>

</body>
</html>
