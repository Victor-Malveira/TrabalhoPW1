<?php
require_once "../DAOs/CandidatoDAO.php";
require_once "../conexao/Conexao.php";

class CandidatoServico{

    public function salvar($candidato){
        $conn = Conexao::criar();
        $candidatoDAO = new CandidatoDAO();
        $candidatoDAO->salvar($candidato, $conn);
    }

    public function autenticar($candidato){
        $conn = Conexao::criar();
        $candidatoDAO = new CandidatoDAO();

        $candidatoAutenticado =
            $candidatoDAO->buscarPeloEmail($candidato, $conn);

        if($candidatoAutenticado != null){
            if(password_verify(
                $candidato->getSenha(),
                $candidatoAutenticado->getSenha()
            )){
                return $candidatoAutenticado;
            }
        }

        throw new Exception("E-mail ou senha não conferem");
    }

    public function buscar($pesquisa){
        $conn = Conexao::criar();
        $candidatoDAO = new CandidatoDAO();

        return $candidatoDAO->buscar($pesquisa, $conn);
    }

    public function editar($candidato){
        $conn = Conexao::criar();
        $candidatoDAO = new CandidatoDAO();

        $candidatoDAO->editar($candidato, $conn);
    }

    public function buscarPeloId($id){
        $conn = Conexao::criar();
        $candidatoDAO = new CandidatoDAO();

        return $candidatoDAO->buscarPeloId($id, $conn);
    }

    public function excluir($id){
        $conn = Conexao::criar();
        $candidatoDAO = new CandidatoDAO();

        $candidatoDAO->excluir($id, $conn);
    }
}
?>