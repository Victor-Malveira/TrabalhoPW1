<?php
    require_once "../DTOs/CandidatoDTO.php";
    require_once "../DTOs/AvaliacaoDTO.php";
    require_once "CandidatoControlador.php";
    require_once "AvaliacaoControlador.php";
    require_once "../DTOs/EmpresaDTO.php";
    require_once "EmpresaControlador.php";
    $acao = $_GET['acao'];

    switch($acao){
        case "salvarEmpresa":
            $empresaDTO = new EmpresaDTO();
            $empresaDTO->nome = $_POST['nome'];
            $empresaDTO->email = $_POST['email'];
            $empresaDTO->senha = $_POST['senha'];
            $empresaDTO->telefone = $_POST['telefone'];
            $empresaControlador = new EmpresaControlador();
            try{
                $empresaControlador->salvar($empresaDTO);
                header("Location:../index.html");
            }catch(PDOException $erro){
                echo "Erro na base de dados " . $erro->getMessage();
            }catch(Exception $erro){
                echo "Erro inesperado";
            }
            break;
        case "autenticar":
            $empresaDTO = new empresaDTO();
            $empresaDTO->email = $_POST['email'];
            $empresaDTO->senha = $_POST['senha'];
            $empresaControlador = new empresaControlador();
            try{
                $empresa = $empresaControlador->autenticar($empresaDTO);
                session_start();
                $_SESSION['empresa'] = $empresa;
                header("Location:../telas/home.php");
            }catch(Exception $erro){
                echo "Deu erro";
                //redirecionar para a página de erro
            }
            break;
        case "buscarEmpresa":
            $pesquisa = $_GET['pesquisa'];
            $empresaControlador = new EmpresaControlador();
            $empresas = $empresaControlador->buscar($pesquisa);
            require_once "../telas/busca.php";
            break;
        case "editarEmpresa":
            $empresaDTO = new EmpresaDTO();
            $empresaDTO->id = $_POST['id'];
            $empresaDTO->nome = $_POST['nome'];
            $empresaDTO->email = $_POST['email'];
            $empresaDTO->telefone = $_POST['telefone'];
            $empresaControlador = new EmpresaControlador();
            try{
                $empresaControlador->editar($empresaDTO);
                header("Location: ../telas/busca.php");
            }catch(PDOException $erro){
                echo "Erro na base de dados: " . $erro->getMessage();
            }catch(Exception $erro){
                echo "Erro inesperado";
            }
            break;
        case "excluirEmpresa":
            $id = $_GET['id'];
            $empresaControlador = new EmpresaControlador();
            try{
                $empresaControlador->excluir($id);
                echo "<script>";
                echo "alert('Empresa excluída com sucesso!');";
                echo "window.location.href='../index.html';";
                echo "</script>";
            }catch(PDOException $erro){
                echo "Erro na base de dados: " . $erro->getMessage();
            }catch(Exception $erro){
                echo "Erro inesperado: " . $erro->getMessage();
            }
            break;
        case "salvarCandidato":
            $candidatoDTO = new CandidatoDTO();

            $candidatoDTO->nome = $_POST['nome'];
            $candidatoDTO->email = $_POST['email'];
            $candidatoDTO->senha = $_POST['senha'];
            $candidatoDTO->telefone = $_POST['telefone'];
            $candidatoDTO->formatoCurriculo = $_POST['formatoCurriculo'];

            $candidatoControlador = new CandidatoControlador();

            try{
                $candidatoControlador->salvar($candidatoDTO);
                header("Location: ../index.html");
            }catch(PDOException $erro){
                echo "Erro na base de dados: " . $erro->getMessage();
            }catch(Exception $erro){
                echo "Erro inesperado";
            }
            break;

        case "autenticarCandidato":
            $candidatoDTO = new CandidatoDTO();
            $candidatoDTO->email = $_POST['email'];
            $candidatoDTO->senha = $_POST['senha'];
            $candidatoControlador = new CandidatoControlador();
            try{
                $candidato = $candidatoControlador->autenticar($candidatoDTO);
                session_start();
                $_SESSION['candidato'] = $candidato;
                header("Location: ../telas/homeCandidato.php");
            }catch(Exception $erro){
                echo "E-mail ou senha não conferem";
            }
            break;
        case "buscarCandidato":
            $pesquisa = $_GET['pesquisa'];

            $candidatoControlador = new CandidatoControlador();
            $candidatos = $candidatoControlador->buscar($pesquisa);

            require_once "../telas/buscaCandidato.php";
            break;

        case "editarCandidato":
            $candidatoDTO = new CandidatoDTO();

            $candidatoDTO->id = $_POST['id'];
            $candidatoDTO->nome = $_POST['nome'];
            $candidatoDTO->email = $_POST['email'];
            $candidatoDTO->telefone = $_POST['telefone'];
            $candidatoDTO->formatoCurriculo = $_POST['formatoCurriculo'];

            $candidatoControlador = new CandidatoControlador();

            try{
                $candidatoControlador->editar($candidatoDTO);
                header("Location: ../telas/homeCandidato.php");
            }catch(PDOException $erro){
                echo "Erro na base de dados: " . $erro->getMessage();
            }catch(Exception $erro){
                echo "Erro inesperado";
            }
            break;
        case "excluirCandidato":
            $id = $_GET['id'];

            $candidatoControlador = new CandidatoControlador();

            try{
                $candidatoControlador->excluir($id);

                echo "<script>";
                echo "alert('Candidato excluído com sucesso!');";
                echo "window.location.href='../index.html';";
                echo "</script>";
            }catch(Exception $erro){
                echo "Erro ao excluir candidato: " . $erro->getMessage();
            }
            break;
        case "sairCandidato":
            session_start();
            unset($_SESSION['candidato']);
            header("Location: ../telas/autenticarCandidato.php");
            break;
        case "salvarAvaliacao":
            session_start();

            $avaliacaoDTO = new AvaliacaoDTO();

            $avaliacaoDTO->empresaId = $_POST['empresaId'];
            $avaliacaoDTO->candidatoId = $_SESSION['candidato']->getId();

            $avaliacaoDTO->nota = $_POST['nota'];
            $avaliacaoDTO->comentario = $_POST['comentario'];

            $avaliacaoDTO->possuiRampa = $_POST['possuiRampa'];
            $avaliacaoDTO->possuiBanheiroAdaptado = $_POST['possuiBanheiroAdaptado'];
            $avaliacaoDTO->possuiSinalizacaoBraile = $_POST['possuiSinalizacaoBraile'];
            $avaliacaoDTO->possuiAcessibilidadeDigital = $_POST['possuiAcessibilidadeDigital'];

            $avaliacaoDTO->dataAvaliacao = date('Y-m-d H:i:s');

            $avaliacaoControlador = new AvaliacaoControlador();

            try{
                $avaliacaoControlador->salvar($avaliacaoDTO);

                echo "<script>";
                echo "alert('Avaliação cadastrada com sucesso!');";
                echo "window.location.href='../telas/homeCandidato.php';";
                echo "</script>";
            }catch(PDOException $erro){
                echo "Erro na base de dados: " . $erro->getMessage();
            }catch(Exception $erro){
                echo "Erro inesperado";
            }
            break;

        case "buscarAvaliacoes":
            $empresaId = $_GET['empresaId'];

            $avaliacaoControlador = new AvaliacaoControlador();
            $avaliacoes = $avaliacaoControlador->buscarPorEmpresa($empresaId);

            require_once "../telas/avaliacoes.php";
            break;

        case "editarAvaliacao":
            $avaliacaoDTO = new AvaliacaoDTO();

            $avaliacaoDTO->id = $_POST['id'];
            $avaliacaoDTO->nota = $_POST['nota'];
            $avaliacaoDTO->comentario = $_POST['comentario'];

            $avaliacaoDTO->possuiRampa = $_POST['possuiRampa'];
            $avaliacaoDTO->possuiBanheiroAdaptado = $_POST['possuiBanheiroAdaptado'];
            $avaliacaoDTO->possuiSinalizacaoBraile = $_POST['possuiSinalizacaoBraile'];
            $avaliacaoDTO->possuiAcessibilidadeDigital = $_POST['possuiAcessibilidadeDigital'];

            $avaliacaoControlador = new AvaliacaoControlador();

            try{
                $avaliacaoControlador->editar($avaliacaoDTO);
                header("Location: ../telas/homeCandidato.php");
            }catch(Exception $erro){
                echo "Erro ao editar avaliação: " . $erro->getMessage();
            }
            break;

        case "excluirAvaliacao":
            $id = $_GET['id'];

            $avaliacaoControlador = new AvaliacaoControlador();

            try{
                $avaliacaoControlador->excluir($id);

                echo "<script>";
                echo "alert('Avaliação excluída com sucesso!');";
                echo "window.location.href='../index.html';";
                echo "</script>";
            }catch(Exception $erro){
                echo "Erro ao excluir avaliação: " . $erro->getMessage();
            }
            break;
        }

?>