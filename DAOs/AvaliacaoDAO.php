<?php
require_once "../modelos/Avaliacao.php";

class AvaliacaoDAO{

    public function salvar($avaliacao, $conn){
        $sql = "INSERT INTO Avaliacao
                (empresaId, candidatoId, nota, comentario,
                possuiRampa, possuiBanheiroAdaptado,
                possuiSinalizacaoBraile, possuiAcessibilidadeDigital,
                dataAvaliacao)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(1, $avaliacao->getEmpresaId());
        $stmt->bindValue(2, $avaliacao->getCandidatoId());
        $stmt->bindValue(3, $avaliacao->getNota());
        $stmt->bindValue(4, $avaliacao->getComentario());
        $stmt->bindValue(5, $avaliacao->getPossuiRampa(), PDO::PARAM_BOOL);
        $stmt->bindValue(6, $avaliacao->getPossuiBanheiroAdaptado(), PDO::PARAM_BOOL);
        $stmt->bindValue(7, $avaliacao->getPossuiSinalizacaoBraile(), PDO::PARAM_BOOL);
        $stmt->bindValue(8, $avaliacao->getPossuiAcessibilidadeDigital(), PDO::PARAM_BOOL);
        $stmt->bindValue(9, $avaliacao->getDataAvaliacao());

        $stmt->execute();
    }

    public function buscarPorEmpresa($empresaId, $conn){
        $sql = "SELECT * FROM Avaliacao WHERE empresaId = ? ORDER BY dataAvaliacao DESC";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $empresaId);
        $stmt->execute();

        $avaliacoesBase = $stmt->fetchAll(PDO::FETCH_OBJ);

        $avaliacoes = [];

        foreach($avaliacoesBase as $avaliacaoBase){
            $avaliacao = new Avaliacao();

            $avaliacao->setId($avaliacaoBase->id);
            $avaliacao->setEmpresaId($avaliacaoBase->empresaId);
            $avaliacao->setCandidatoId($avaliacaoBase->candidatoId);
            $avaliacao->setNota($avaliacaoBase->nota);
            $avaliacao->setComentario($avaliacaoBase->comentario);
            $avaliacao->setPossuiRampa($avaliacaoBase->possuiRampa);
            $avaliacao->setPossuiBanheiroAdaptado($avaliacaoBase->possuiBanheiroAdaptado);
            $avaliacao->setPossuiSinalizacaoBraile($avaliacaoBase->possuiSinalizacaoBraile);
            $avaliacao->setPossuiAcessibilidadeDigital($avaliacaoBase->possuiAcessibilidadeDigital);
            $avaliacao->setDataAvaliacao($avaliacaoBase->dataAvaliacao);

            $avaliacoes[] = $avaliacao;
        }

        return $avaliacoes;
    }

    public function buscarPeloId($id, $conn){
        $sql = "SELECT * FROM Avaliacao WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        $avaliacaoBase = $stmt->fetch(PDO::FETCH_OBJ);

        if($avaliacaoBase){
            $avaliacao = new Avaliacao();

            $avaliacao->setId($avaliacaoBase->id);
            $avaliacao->setEmpresaId($avaliacaoBase->empresaId);
            $avaliacao->setCandidatoId($avaliacaoBase->candidatoId);
            $avaliacao->setNota($avaliacaoBase->nota);
            $avaliacao->setComentario($avaliacaoBase->comentario);
            $avaliacao->setPossuiRampa($avaliacaoBase->possuiRampa);
            $avaliacao->setPossuiBanheiroAdaptado($avaliacaoBase->possuiBanheiroAdaptado);
            $avaliacao->setPossuiSinalizacaoBraile($avaliacaoBase->possuiSinalizacaoBraile);
            $avaliacao->setPossuiAcessibilidadeDigital($avaliacaoBase->possuiAcessibilidadeDigital);
            $avaliacao->setDataAvaliacao($avaliacaoBase->dataAvaliacao);

            return $avaliacao;
        }

        return null;
    }

    public function editar($avaliacao, $conn){
        $sql = "UPDATE Avaliacao SET
                nota = ?, comentario = ?, possuiRampa = ?,
                possuiBanheiroAdaptado = ?, possuiSinalizacaoBraile = ?,
                possuiAcessibilidadeDigital = ?
                WHERE id = ?";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(1, $avaliacao->getNota());
        $stmt->bindValue(2, $avaliacao->getComentario());
        $stmt->bindValue(3, $avaliacao->getPossuiRampa(), PDO::PARAM_BOOL);
        $stmt->bindValue(4, $avaliacao->getPossuiBanheiroAdaptado(), PDO::PARAM_BOOL);
        $stmt->bindValue(5, $avaliacao->getPossuiSinalizacaoBraile(), PDO::PARAM_BOOL);
        $stmt->bindValue(6, $avaliacao->getPossuiAcessibilidadeDigital(), PDO::PARAM_BOOL);
        $stmt->bindValue(7, $avaliacao->getId());

        $stmt->execute();
    }

    public function excluir($id, $conn){
        $sql = "DELETE FROM Avaliacao WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }
}
?>