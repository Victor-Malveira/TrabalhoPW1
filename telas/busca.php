<?php
require_once __DIR__ . '/../modelos/Candidato.php';
session_start();
$logado=isset($_SESSION['candidato']);
?>
<!DOCTYPE html><html lang="pt-br"><head><meta charset="UTF-8"><title>Buscar empresas</title></head><body>
<h1>Buscar empresas</h1>
<form><input type="text" id="pesquisa" placeholder="Nome ou e-mail">
<button type="button" onclick="buscarEmpresa()">Buscar</button></form>
<p id="mensagem"></p><div id="resultadosEmpresas"></div>
<a href="homeCandidato.php">Voltar</a>
<script>const candidatoLogado=<?= $logado?'true':'false' ?>;</script>
<script src="../scripts/empresa.js"></script><script src="../scripts/avaliacao.js"></script>
</body></html>