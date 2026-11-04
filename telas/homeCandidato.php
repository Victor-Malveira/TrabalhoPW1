<?php
require_once "../modelos/Candidato.php";

session_start();

if(!isset($_SESSION['candidato'])){
    header("Location: autenticarCandidato.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Área do Candidato</title>
</head>
<body>

    <h1>Área do Candidato</h1>
    <h2>
        Bem-vindo, <?= htmlspecialchars($_SESSION['candidato']->getNome()); ?>!
    </h2>
    <a href="busca.php">Buscar empresas e avaliar</a>
    <br><br>
    <a href="editarCandidato.php?id=<?= $_SESSION['candidato']->getId(); ?>">
        Editar meu perfil
    </a>
    <br><br>

    <a href="../controladores/rota.php?acao=sairCandidato">
        Sair
    </a>

</body>
</html>
