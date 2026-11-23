<?php
require_once "../DAOs/AvaliacaoDAO.php";
require_once "../conexao/Conexao.php";

class AvaliacaoServico{

    public function salvar($avaliacao){
        $conn = Conexao::criar();
        $avaliacaoDAO = new AvaliacaoDAO();

        $avaliacaoDAO->salvar($avaliacao, $conn);
    }

    public function buscarPorEmpresa($empresaId){
        $conn = Conexao::criar();
        $avaliacaoDAO = new AvaliacaoDAO();

        return $avaliacaoDAO->buscarPorEmpresa($empresaId, $conn);
    }

    public function buscarPeloId($id){
        $conn = Conexao::criar();
        $avaliacaoDAO = new AvaliacaoDAO();

        return $avaliacaoDAO->buscarPeloId($id, $conn);
    }

    public function editar($avaliacao, $autorId){
        $conn = Conexao::criar();
        $avaliacaoDAO = new AvaliacaoDAO();

        $avaliacaoDAO->editar($avaliacao, $autorId, $conn);
    }

    public function excluir($id, $autorId){
        $conn = Conexao::criar();
        $avaliacaoDAO = new AvaliacaoDAO();

        $avaliacaoDAO->excluir($id, $autorId, $conn);
    }
}
?>