<?php
class Avaliacao{

    private $id;
    private $empresaId;
    private $candidatoId;
    private $nota;
    private $comentario;
    private $possuiRampa;
    private $possuiBanheiroAdaptado;
    private $possuiSinalizacaoBraile;
    private $possuiAcessibilidadeDigital;
    private $dataAvaliacao;

    public function getId(){ 
        return $this->id; }
    public function setId($id){ 
        $this->id = $id; }

    public function getEmpresaId(){ 
        return $this->empresaId; }
    public function setEmpresaId($empresaId){ 
        $this->empresaId = $empresaId; }

    public function getCandidatoId(){ 
        return $this->candidatoId; }
    public function setCandidatoId($candidatoId){ 
        $this->candidatoId = $candidatoId; }

    public function getNota(){ 
        return $this->nota; }
    public function setNota($nota){ 
        $this->nota = $nota; }

    public function getComentario(){ 
        return $this->comentario; }
    public function setComentario($comentario){ 
        $this->comentario = $comentario; }

    public function getPossuiRampa(){ 
        return $this->possuiRampa; }
    public function setPossuiRampa($valor){ 
        $this->possuiRampa = $valor; }

    public function getPossuiBanheiroAdaptado(){ 
        return $this->possuiBanheiroAdaptado; }
    public function setPossuiBanheiroAdaptado($valor){ 
        $this->possuiBanheiroAdaptado = $valor; }

    public function getPossuiSinalizacaoBraile(){ 
        return $this->possuiSinalizacaoBraile; }
    public function setPossuiSinalizacaoBraile($valor){ 
        $this->possuiSinalizacaoBraile = $valor; }

    public function getPossuiAcessibilidadeDigital(){ 
        return $this->possuiAcessibilidadeDigital; }
    public function setPossuiAcessibilidadeDigital($valor){ 
        $this->possuiAcessibilidadeDigital = $valor; }

    public function getDataAvaliacao(){ 
        return $this->dataAvaliacao; }
    public function setDataAvaliacao($dataAvaliacao){ 
        $this->dataAvaliacao = $dataAvaliacao; }
}
?>