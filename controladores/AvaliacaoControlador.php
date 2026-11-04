<?php
require_once "../DTOs/AvaliacaoDTO.php";
require_once "../modelos/Avaliacao.php";
require_once "../servicos/AvaliacaoServico.php";

class AvaliacaoControlador{

    public function salvar($avaliacaoDTO){
        $avaliacao = new Avaliacao();

        $avaliacao->setEmpresaId($avaliacaoDTO->empresaId);
        $avaliacao->setCandidatoId($avaliacaoDTO->candidatoId);
        $avaliacao->setNota($avaliacaoDTO->nota);
        $avaliacao->setComentario($avaliacaoDTO->comentario);
        $avaliacao->setPossuiRampa($avaliacaoDTO->possuiRampa);
        $avaliacao->setPossuiBanheiroAdaptado($avaliacaoDTO->possuiBanheiroAdaptado);
        $avaliacao->setPossuiSinalizacaoBraile($avaliacaoDTO->possuiSinalizacaoBraile);
        $avaliacao->setPossuiAcessibilidadeDigital($avaliacaoDTO->possuiAcessibilidadeDigital);
        $avaliacao->setDataAvaliacao($avaliacaoDTO->dataAvaliacao);

        $avaliacaoServico = new AvaliacaoServico();
        $avaliacaoServico->salvar($avaliacao);
    }

    public function buscarPorEmpresa($empresaId){
        $avaliacaoServico = new AvaliacaoServico();

        return $avaliacaoServico->buscarPorEmpresa($empresaId);
    }

    public function buscarPeloId($id){
        $avaliacaoServico = new AvaliacaoServico();

        return $avaliacaoServico->buscarPeloId($id);
    }

    public function editar($avaliacaoDTO){
        $avaliacao = new Avaliacao();

        $avaliacao->setId($avaliacaoDTO->id);
        $avaliacao->setNota($avaliacaoDTO->nota);
        $avaliacao->setComentario($avaliacaoDTO->comentario);
        $avaliacao->setPossuiRampa($avaliacaoDTO->possuiRampa);
        $avaliacao->setPossuiBanheiroAdaptado($avaliacaoDTO->possuiBanheiroAdaptado);
        $avaliacao->setPossuiSinalizacaoBraile($avaliacaoDTO->possuiSinalizacaoBraile);
        $avaliacao->setPossuiAcessibilidadeDigital($avaliacaoDTO->possuiAcessibilidadeDigital);

        $avaliacaoServico = new AvaliacaoServico();
        $avaliacaoServico->editar($avaliacao);
    }

    public function excluir($id){
        $avaliacaoServico = new AvaliacaoServico();
        $avaliacaoServico->excluir($id);
    }
}
?>