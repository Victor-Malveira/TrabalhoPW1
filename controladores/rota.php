<?php

require_once __DIR__ . '/../DTOs/EmpresaDTO.php';
require_once __DIR__ . '/../DTOs/CandidatoDTO.php';
require_once __DIR__ . '/../DTOs/AvaliacaoDTO.php';
require_once __DIR__ . '/EmpresaControlador.php';
require_once __DIR__ . '/CandidatoControlador.php';
require_once __DIR__ . '/AvaliacaoControlador.php';
header('Content-Type: application/json; charset=utf-8');
$acao = $_GET['acao'] ?? '';
$dados = json_decode(file_get_contents('php://input'));
switch ($acao) {
    case "salvarEmpresa":
        if (trim($dados->nome ?? '') === '' || trim($dados->email ?? '') === '' ||     trim($dados->senha ?? '') === '' || trim($dados->telefone ?? '') === '') {
            http_response_code(400);
            echo json_encode(['sucesso'=>false, 'mensagem'=>'Preencha nome, e-mail, senha e telefone.'], JSON_UNESCAPED_UNICODE);
            break;
        }
        $dto = new EmpresaDTO();
        $dto->nome = $dados->nome ?? '';
        $dto->email = $dados->email ?? '';
        $dto->senha = $dados->senha ?? '';
        $dto->telefone = $dados->telefone ?? '';
        try {
            (new EmpresaControlador())->salvar($dto);
            http_response_code(201);
            echo json_encode(['sucesso'=>true,'mensagem'=>'Operação realizada com sucesso','redirecionar'=>'../index.html'], JSON_UNESCAPED_UNICODE);
        } catch (Throwable $erro) {
            http_response_code(400);
            echo json_encode(['sucesso'=>false,'mensagem'=>$erro->getMessage()], JSON_UNESCAPED_UNICODE);
        }
        break;
    case "autenticar":
        if (trim($dados->email ?? '') === '' || trim($dados->senha ?? '') === '') {
            http_response_code(400);
            echo json_encode(['sucesso'=>false, 'mensagem'=>'Preencha e-mail e senha.'], JSON_UNESCAPED_UNICODE);
            break;
        }
        $dto = new EmpresaDTO();
        $dto->email = $dados->email ?? '';
        $dto->senha = $dados->senha ?? '';
        try {
            $entidade=(new EmpresaControlador())->autenticar($dto);
            session_start();
            $_SESSION['empresa']=$entidade;
            http_response_code(200);
            echo json_encode(['sucesso'=>true,'mensagem'=>'Login realizado com sucesso','redirecionar'=>'../telas/home.php'], JSON_UNESCAPED_UNICODE);
        } catch (Throwable $erro) {
            http_response_code(400);
            echo json_encode(['sucesso'=>false,'mensagem'=>$erro->getMessage()], JSON_UNESCAPED_UNICODE);
        }
        break;
    case "editarEmpresa":
        $dto = new EmpresaDTO();
        $dto->id = $dados->id ?? 0;
        $dto->nome = $dados->nome ?? '';
        $dto->email = $dados->email ?? '';
        $dto->telefone = $dados->telefone ?? '';
        try {
            (new EmpresaControlador())->editar($dto);
            http_response_code(200);
            echo json_encode(['sucesso'=>true,'mensagem'=>'Operação realizada com sucesso','redirecionar'=>'../telas/busca.php'], JSON_UNESCAPED_UNICODE);
        } catch (Throwable $erro) {
            http_response_code(400);
            echo json_encode(['sucesso'=>false,'mensagem'=>$erro->getMessage()], JSON_UNESCAPED_UNICODE);
        }
        break;
    case "excluirEmpresa":
        $dto = new EmpresaDTO();
        $dto->id = $dados->id ?? 0;
        try {
            (new EmpresaControlador())->excluir($dto->id);
            http_response_code(200);
            echo json_encode(['sucesso'=>true,'mensagem'=>'Exclusão realizada com sucesso','redirecionar'=>'../index.html'], JSON_UNESCAPED_UNICODE);
        } catch (Throwable $erro) {
            http_response_code(400);
            echo json_encode(['sucesso'=>false,'mensagem'=>$erro->getMessage()], JSON_UNESCAPED_UNICODE);
        }
        break;
    case "sairEmpresa":
        session_start();
        unset($_SESSION['empresa']);
        http_response_code(200);
        echo json_encode(['sucesso'=>true,'mensagem'=>'Sessão encerrada','redirecionar'=>'../telas/autenticar.html'], JSON_UNESCAPED_UNICODE);
        break;
    case "salvarCandidato":
        if (trim($dados->nome ?? '') === '' || trim($dados->email ?? '') === '' || trim($dados->senha ?? '') === '') {
            http_response_code(400);
            echo json_encode(['sucesso'=>false,'mensagem'=>'Preencha nome, e-mail e senha.'], JSON_UNESCAPED_UNICODE);
            break;
        }
        if (!filter_var($dados->email, FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            echo json_encode(['sucesso'=>false,'mensagem'=>'Informe um e-mail válido.'], JSON_UNESCAPED_UNICODE);
            break;
        }
        $dto = new CandidatoDTO();
        $dto->nome = $dados->nome ?? '';
        $dto->email = $dados->email ?? '';
        $dto->senha = $dados->senha ?? '';
        $dto->telefone = $dados->telefone ?? '';
        $dto->formatoCurriculo = $dados->formatoCurriculo ?? '';
        try {
            (new CandidatoControlador())->salvar($dto);
            http_response_code(201);
            echo json_encode(['sucesso'=>true,'mensagem'=>'Operação realizada com sucesso','redirecionar'=>'../index.html'], JSON_UNESCAPED_UNICODE);
        } catch (Throwable $erro) {
            http_response_code(400);
            echo json_encode(['sucesso'=>false,'mensagem'=>$erro->getMessage()], JSON_UNESCAPED_UNICODE);
        }
        break;
    case "autenticarCandidato":
        if (trim($dados->email ?? '') === '' || trim($dados->senha ?? '') === '') {
            http_response_code(400);
            echo json_encode(['sucesso'=>false,'mensagem'=>'Preencha e-mail e senha.'], JSON_UNESCAPED_UNICODE);
            break;
        }
        if (!filter_var($dados->email, FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            echo json_encode(['sucesso'=>false,'mensagem'=>'Informe um e-mail válido.'], JSON_UNESCAPED_UNICODE);
            break;
        }
        $dto = new CandidatoDTO();
        $dto->email = $dados->email ?? '';
        $dto->senha = $dados->senha ?? '';
        try {
            $entidade=(new CandidatoControlador())->autenticar($dto);
            session_start();
            $_SESSION['candidato']=$entidade;
            http_response_code(200);
            echo json_encode(['sucesso'=>true,'mensagem'=>'Login realizado com sucesso','redirecionar'=>'../telas/homeCandidato.php'], JSON_UNESCAPED_UNICODE);
        } catch (Throwable $erro) {
            http_response_code(400);
            echo json_encode(['sucesso'=>false,'mensagem'=>$erro->getMessage()], JSON_UNESCAPED_UNICODE);
        }
        break;
    case "editarCandidato":
        $dto = new CandidatoDTO();
        $dto->id = $dados->id ?? 0;
        $dto->nome = $dados->nome ?? '';
        $dto->email = $dados->email ?? '';
        $dto->telefone = $dados->telefone ?? '';
        $dto->formatoCurriculo = $dados->formatoCurriculo ?? '';
        try {
            (new CandidatoControlador())->editar($dto);
            session_start();
            if (isset($_SESSION['candidato']) && $_SESSION['candidato']->getId() == $dto->id) {
                $_SESSION['candidato']->setNome($dto->nome);
                $_SESSION['candidato']->setEmail($dto->email);
                $_SESSION['candidato']->setTelefone($dto->telefone);
                $_SESSION['candidato']->setFormatoCurriculo($dto->formatoCurriculo);
            }
            http_response_code(200);
            echo json_encode(['sucesso'=>true,'mensagem'=>'Operação realizada com sucesso','redirecionar'=>'../telas/homeCandidato.php'], JSON_UNESCAPED_UNICODE);
        } catch (Throwable $erro) {
            http_response_code(400);
            echo json_encode(['sucesso'=>false,'mensagem'=>$erro->getMessage()], JSON_UNESCAPED_UNICODE);
        }
        break;
    case "excluirCandidato":
        $dto = new CandidatoDTO();
        $dto->id = $dados->id ?? 0;
        try {
            (new CandidatoControlador())->excluir($dto->id);
            http_response_code(200);
            echo json_encode(['sucesso'=>true,'mensagem'=>'Exclusão realizada com sucesso','redirecionar'=>'../index.html'], JSON_UNESCAPED_UNICODE);
        } catch (Throwable $erro) {
            http_response_code(400);
            echo json_encode(['sucesso'=>false,'mensagem'=>$erro->getMessage()], JSON_UNESCAPED_UNICODE);
        }
        break;
    case "sairCandidato":
        session_start();
        unset($_SESSION['candidato']);
        http_response_code(200);
        echo json_encode(['sucesso'=>true,'mensagem'=>'Sessão encerrada','redirecionar'=>'../telas/autenticarCandidato.php'], JSON_UNESCAPED_UNICODE);
        break;
    case "salvarAvaliacao":
        session_start();
        if(!isset($_SESSION['candidato'])) {
            http_response_code(401);
            echo json_encode(['sucesso'=>false,'mensagem'=>'Faça login como candidato.']);
            break;
        }
        $dto = new AvaliacaoDTO();
        $dto->empresaId = $dados->empresaId ?? 0;
        $dto->nota = $dados->nota ?? 0;
        $dto->comentario = $dados->comentario ?? '';
        $dto->possuiRampa = $dados->possuiRampa ?? 0;
        $dto->possuiBanheiroAdaptado = $dados->possuiBanheiroAdaptado ?? 0;
        $dto->possuiSinalizacaoBraile = $dados->possuiSinalizacaoBraile ?? 0;
        $dto->possuiAcessibilidadeDigital = $dados->possuiAcessibilidadeDigital ?? 0;
        $dto->candidatoId = $_SESSION['candidato']->getId();
        $dto->dataAvaliacao = date('Y-m-d H:i:s');
        try {
            (new AvaliacaoControlador())->salvar($dto);
            http_response_code(201);
            echo json_encode(['sucesso'=>true,'mensagem'=>'Operação realizada com sucesso','redirecionar'=>'../telas/homeCandidato.php'], JSON_UNESCAPED_UNICODE);
        } catch (Throwable $erro) {
            http_response_code(400);
            echo json_encode(['sucesso'=>false,'mensagem'=>$erro->getMessage()], JSON_UNESCAPED_UNICODE);
        }
        break;
    case "editarAvaliacao":
    case "excluirAvaliacao":
        session_start();
        if (!isset($_SESSION['candidato'])) {
            http_response_code(401);
            echo json_encode(['sucesso' => false, 'mensagem' => 'Faça login como candidato.'], JSON_UNESCAPED_UNICODE);
            break;
        }
        $id = (int)($dados->id ?? 0);
        if ($id <= 0) {
            http_response_code(400);
            echo json_encode(['sucesso' => false, 'mensagem' => 'ID inválido.'], JSON_UNESCAPED_UNICODE);
            break;
        }
        try {
            $controlador = new AvaliacaoControlador();
            $registro = $controlador->buscarPeloId($id);
            if (!$registro) {
                http_response_code(404);
                echo json_encode(['sucesso' => false, 'mensagem' => 'Avaliação não encontrada.'], JSON_UNESCAPED_UNICODE);
                break;
            }
            $autorId = (int)$_SESSION['candidato']->getId();
            if ((int)$registro->getCandidatoId() !== $autorId) {
                http_response_code(403);
                echo json_encode(['sucesso' => false, 'mensagem' => 'Somente o autor pode alterar esta avaliação.'], JSON_UNESCAPED_UNICODE);
                break;
            }
            if ($acao === "editarAvaliacao") {
                $nota = (int)($dados->nota ?? 0);
                if ($nota < 1 || $nota > 5) {
                    http_response_code(400);
                    echo json_encode(['sucesso' => false, 'mensagem' => 'A nota deve estar entre 1 e 5.'], JSON_UNESCAPED_UNICODE);
                    break;
                }
                $dto = new AvaliacaoDTO();
                $dto->id = $id;
                $dto->nota = $nota;
                $dto->comentario = $dados->comentario ?? '';
                $dto->possuiRampa = $dados->possuiRampa ?? 0;
                $dto->possuiBanheiroAdaptado = $dados->possuiBanheiroAdaptado ?? 0;
                $dto->possuiSinalizacaoBraile = $dados->possuiSinalizacaoBraile ?? 0;
                $dto->possuiAcessibilidadeDigital = $dados->possuiAcessibilidadeDigital ?? 0;
                $controlador->editar($dto, $autorId);
                echo json_encode(['sucesso' => true, 'mensagem' => 'Avaliação editada com sucesso.'], JSON_UNESCAPED_UNICODE);
            } else {
                $controlador->excluir($id, $autorId);
                echo json_encode(['sucesso' => true, 'mensagem' => 'Avaliação excluída com sucesso.'], JSON_UNESCAPED_UNICODE);
            }
        } catch (Throwable $erro) {
            http_response_code(400);
            echo json_encode(['sucesso' => false, 'mensagem' => $erro->getMessage()], JSON_UNESCAPED_UNICODE);
        }
        break;
    case "buscarEmpresa":
        try {
            $objetos=(new EmpresaControlador())->buscar($dados->pesquisa ?? '');
            $lista=[];
            foreach($objetos as $obj) {
                $lista[]=['id'=>$obj->getId(),'nome'=>$obj->getNome(),'email'=>$obj->getEmail(),'telefone'=>$obj->getTelefone()];
            }
            echo json_encode(['sucesso'=>true,'empresas'=>$lista],JSON_UNESCAPED_UNICODE);
        } catch (Throwable $erro) {
            http_response_code(400);
            echo json_encode(['sucesso'=>false,'mensagem'=>$erro->getMessage()], JSON_UNESCAPED_UNICODE);
        }
        break;
    case "buscarCandidato":
        try {
            $objetos=(new CandidatoControlador())->buscar($dados->pesquisa ?? '');
            $lista=[];
            foreach($objetos as $obj) {
                $lista[]=['id'=>$obj->getId(),'nome'=>$obj->getNome(),'email'=>$obj->getEmail(),'telefone'=>$obj->getTelefone(),'formatoCurriculo'=>$obj->getFormatoCurriculo()];
            }
            echo json_encode(['sucesso'=>true,'candidatos'=>$lista],JSON_UNESCAPED_UNICODE);
        } catch (Throwable $erro) {
            http_response_code(400);
            echo json_encode(['sucesso'=>false,'mensagem'=>$erro->getMessage()], JSON_UNESCAPED_UNICODE);
        }
        break;
    case "buscarAvaliacoes":
        try {
            session_start();
            $autorId = isset($_SESSION['candidato']) ? (int)$_SESSION['candidato']->getId() : 0;
            $objetos=(new AvaliacaoControlador())->buscarPorEmpresa($dados->empresaId ?? 0);
            $lista=[];
            foreach($objetos as $obj) {
                $lista[]=['id'=>$obj->getId(),'nota'=>$obj->getNota(),'comentario'=>$obj->getComentario(),'possuiRampa'=>$obj->getPossuiRampa(),'possuiBanheiroAdaptado'=>$obj->getPossuiBanheiroAdaptado(),'possuiSinalizacaoBraile'=>$obj->getPossuiSinalizacaoBraile(),'possuiAcessibilidadeDigital'=>$obj->getPossuiAcessibilidadeDigital(),'dataAvaliacao'=>$obj->getDataAvaliacao(), 'podeEditar'=>$autorId > 0 && (int)$obj->getCandidatoId() === $autorId];
            }
            echo json_encode(['sucesso'=>true,'autenticado'=>$autorId > 0,'avaliacoes'=>$lista],JSON_UNESCAPED_UNICODE);
        } catch (Throwable $erro) {
            http_response_code(400);
            echo json_encode(['sucesso'=>false,'mensagem'=>$erro->getMessage()], JSON_UNESCAPED_UNICODE);
        }
        break;
    default:
        http_response_code(404);
        echo json_encode(['sucesso'=>false,'mensagem'=>'Ação desconhecida']);
}
