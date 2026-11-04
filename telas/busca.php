<?php
require_once "../modelos/Candidato.php";
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Buscar Empresas</title>
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
        <h2><?= htmlspecialchars($empresa->getNome()); ?></h2>
        <p>
            <strong>E-mail:</strong>
            <?= htmlspecialchars($empresa->getEmail()); ?>
        </p>

        <p>
            <strong>Telefone:</strong>
            <?= htmlspecialchars($empresa->getTelefone()); ?>
        </p>

        <h3>Avaliar empresa</h3>

        <?php if(isset($_SESSION['candidato'])){ ?>

            <form action="../controladores/rota.php?acao=salvarAvaliacao" method="POST">

                <input type="hidden" name="empresaId"
                       value="<?= $empresa->getId(); ?>">

                <label>Nota da empresa (1 a 5):</label>

                <select name="nota" required>
                    <option value="1">1 - Muito ruim</option>
                    <option value="2">2 - Ruim</option>
                    <option value="3">3 - Regular</option>
                    <option value="4">4 - Boa</option>
                    <option value="5">5 - Excelente</option>
                </select>

                <br><br>

                <label>Comentário:</label>
                <br>

                <textarea name="comentario" rows="4" cols="40"
                    placeholder="Conte sua experiência com a empresa"></textarea>

                <br><br>

                <strong>Acessibilidade da empresa:</strong>

                <br><br>

                <label>Possui rampa para cadeirantes?</label>

                <select name="possuiRampa">
                    <option value="1">Sim</option>
                    <option value="0">Não</option>
                </select>

                <br><br>

                <label>Possui banheiro adaptado?</label>

                <select name="possuiBanheiroAdaptado">
                    <option value="1">Sim</option>
                    <option value="0">Não</option>
                </select>

                <br><br>

                <label>Possui sinalização em Braille?</label>

                <select name="possuiSinalizacaoBraile">
                    <option value="1">Sim</option>
                    <option value="0">Não</option>
                </select>

                <br><br>

                <label>Possui acessibilidade digital?</label>

                <select name="possuiAcessibilidadeDigital">
                    <option value="1">Sim</option>
                    <option value="0">Não</option>
                </select>

                <br><br>

                <button type="submit">Enviar avaliação</button>

            </form><br>
            <a href="../telas/avaliacoesEmpresas.php?id=<?= $empresa->getId(); ?>">
                Ver avaliações
            </a><br>


        <?php }else{ ?>
            <p>
                <a href="autenticarCandidato.php">
                    Faça login como candidato para avaliar esta empresa.
                </a>
            </p>
        <?php } ?>
        <hr>
    </div>
<?php
    }
}
?>
<a href="homeCandidato.php">Sair</a>
</body>
</html>
