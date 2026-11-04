<?php
require_once "../DTOs/CandidatoDTO.php";
require_once "../modelos/Candidato.php";
require_once "../servicos/CandidatoServico.php";

class CandidatoControlador{

    public function salvar($candidatoDTO){
        $candidato = new Candidato();

        $candidato->setNome($candidatoDTO->nome);
        $candidato->setEmail($candidatoDTO->email);
        $candidato->setSenha($candidatoDTO->senha);
        $candidato->setTelefone($candidatoDTO->telefone);
        $candidato->setFormatoCurriculo($candidatoDTO->formatoCurriculo);

        $candidatoServico = new CandidatoServico();
        $candidatoServico->salvar($candidato);
    }

    public function autenticar($candidatoDTO){
        $candidato = new Candidato();

        $candidato->setEmail($candidatoDTO->email);
        $candidato->setSenha($candidatoDTO->senha);

        $candidatoServico = new CandidatoServico();

        return $candidatoServico->autenticar($candidato);
    }

    public function buscar($pesquisa){
        $candidatoServico = new CandidatoServico();
        return $candidatoServico->buscar($pesquisa);
    }

    public function editar($candidatoDTO){
        $candidato = new Candidato();

        $candidato->setId($candidatoDTO->id);
        $candidato->setNome($candidatoDTO->nome);
        $candidato->setEmail($candidatoDTO->email);
        $candidato->setTelefone($candidatoDTO->telefone);
        $candidato->setFormatoCurriculo($candidatoDTO->formatoCurriculo);

        $candidatoServico = new CandidatoServico();
        $candidatoServico->editar($candidato);
    }

    public function buscarPeloId($id){
        $candidatoServico = new CandidatoServico();
        return $candidatoServico->buscarPeloId($id);
    }

    public function excluir($id){
        $candidatoServico = new CandidatoServico();
        $candidatoServico->excluir($id);
    }
}
?>