
<?php
require_once "../modelos/Avaliacao.php";
require_once "../controladores/AvaliacaoControlador.php";
require_once "../controladores/EmpresaControlador.php";


if (!isset($_GET['id'])) {
    header("Location: busca.php");
    exit;
}

$empresaId = $_GET['id'];

$controlador = new AvaliacaoControlador();
$avaliacoes = $controlador->buscarPorEmpresa($empresaId);

$empresaControlador = new EmpresaControlador();
$empresa = $empresaControlador->buscarPeloId($empresaId);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Avaliações da Empresa</title>
</head>
<body>

    <h1 style="font-size: 36px;">
        <?= htmlspecialchars($empresa->getNome()); ?>
    </h1>

    <h2>Avaliações da empresa</h2>

    <a href="busca.php">Voltar para a busca</a>

    <?php if (count($avaliacoes) > 0) { ?>

        <?php foreach ($avaliacoes as $avaliacao) { ?>

            <hr>

            <h3>Nota: <?= $avaliacao->getNota(); ?>/5</h3>

            <p>
                <strong>Comentário:</strong>
                <?= htmlspecialchars($avaliacao->getComentario()); ?>
            </p>

            <p>
                <strong>Possui rampa:</strong>
                <?= $avaliacao->getPossuiRampa() ? "Sim" : "Não"; ?>
            </p>

            <p>
                <strong>Possui banheiro adaptado:</strong>
                <?= $avaliacao->getPossuiBanheiroAdaptado() ? "Sim" : "Não"; ?>
            </p>

            <p>
                <strong>Possui sinalização em Braille:</strong>
                <?= $avaliacao->getPossuiSinalizacaoBraile() ? "Sim" : "Não"; ?>
            </p>

            <p>
                <strong>Possui acessibilidade digital:</strong>
                <?= $avaliacao->getPossuiAcessibilidadeDigital() ? "Sim" : "Não"; ?>
            </p>

            <p>
                <strong>Data da avaliação:</strong>
                <?= $avaliacao->getDataAvaliacao(); ?>
            </p>

        <?php } ?>

    <?php } else { ?>

        <p>Essa empresa ainda não possui avaliações.</p>

    <?php } ?>

</body>
</html>
