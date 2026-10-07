<?php
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
        }

?>