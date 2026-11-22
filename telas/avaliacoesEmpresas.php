<?php
require_once __DIR__ . '/../controladores/EmpresaControlador.php';
if(!isset($_GET['id'])){header('Location: busca.php');exit;}
$empresaId=(int)$_GET['id'];
$empresa=(new EmpresaControlador())->buscarPeloId($empresaId);
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head><meta charset="UTF-8">
    <title>Avaliações da empresa</title>
</head>
<body>
    <h1><?= htmlspecialchars($empresa->getNome()) ?></h1>
    <h2>Avaliações da empresa</h2>
    <a href="busca.php">Voltar para a busca</a>
    <div id="listaAvaliacoes" data-empresa-id="<?= $empresaId ?>"></div>
    <script src="../scripts/avaliacao.js"></script>
</body>
</html>