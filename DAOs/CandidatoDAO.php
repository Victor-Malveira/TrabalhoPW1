<?php
require_once "../modelos/Candidato.php";

class CandidatoDAO{

    public function salvar($candidato, $conn){
        $sql = "INSERT INTO Candidato
                (nome, email, senha, telefone, formatoCurriculo)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $candidato->getNome());
        $stmt->bindValue(2, $candidato->getEmail());
        $stmt->bindValue(3, password_hash($candidato->getSenha(), PASSWORD_DEFAULT));
        $stmt->bindValue(4, $candidato->getTelefone());
        $stmt->bindValue(5, $candidato->getFormatoCurriculo());
        $stmt->execute();
    }

    public function buscarPeloEmail($candidato, $conn){
        $sql = "SELECT * FROM Candidato WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $candidato->getEmail());
        $stmt->execute();

        $candidatoBase = $stmt->fetch(PDO::FETCH_OBJ);

        if($candidatoBase){
            $candidatoModelo = new Candidato();

            $candidatoModelo->setId($candidatoBase->id);
            $candidatoModelo->setNome($candidatoBase->nome);
            $candidatoModelo->setEmail($candidatoBase->email);
            $candidatoModelo->setSenha($candidatoBase->senha);
            $candidatoModelo->setTelefone($candidatoBase->telefone);
            $candidatoModelo->setFormatoCurriculo($candidatoBase->formatoCurriculo);

            return $candidatoModelo;
        }

        return null;
    }

    public function buscar($pesquisa, $conn){
        $sql = "SELECT * FROM Candidato
                WHERE nome LIKE ? OR email LIKE ?";

        $stmt = $conn->prepare($sql);

        $pesquisa = "%" . $pesquisa . "%";

        $stmt->bindValue(1, $pesquisa);
        $stmt->bindValue(2, $pesquisa);
        $stmt->execute();

        $candidatosBase = $stmt->fetchAll(PDO::FETCH_OBJ);

        $candidatos = [];

        foreach($candidatosBase as $candidatoBase){
            $candidato = new Candidato();

            $candidato->setId($candidatoBase->id);
            $candidato->setNome($candidatoBase->nome);
            $candidato->setEmail($candidatoBase->email);
            $candidato->setSenha($candidatoBase->senha);
            $candidato->setTelefone($candidatoBase->telefone);
            $candidato->setFormatoCurriculo($candidatoBase->formatoCurriculo);

            $candidatos[] = $candidato;
        }

        return $candidatos;
    }

    public function editar($candidato, $conn){
        $sql = "UPDATE Candidato
                SET nome = ?, email = ?, telefone = ?, formatoCurriculo = ?
                WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $candidato->getNome());
        $stmt->bindValue(2, $candidato->getEmail());
        $stmt->bindValue(3, $candidato->getTelefone());
        $stmt->bindValue(4, $candidato->getFormatoCurriculo());
        $stmt->bindValue(5, $candidato->getId());
        $stmt->execute();
    }

    public function buscarPeloId($id, $conn){
        $sql = "SELECT * FROM Candidato WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        $candidatoBase = $stmt->fetch(PDO::FETCH_OBJ);

        if($candidatoBase){
            $candidato = new Candidato();

            $candidato->setId($candidatoBase->id);
            $candidato->setNome($candidatoBase->nome);
            $candidato->setEmail($candidatoBase->email);
            $candidato->setSenha($candidatoBase->senha);
            $candidato->setTelefone($candidatoBase->telefone);
            $candidato->setFormatoCurriculo($candidatoBase->formatoCurriculo);

            return $candidato;
        }

        return null;
    }

    public function excluir($id, $conn){
        $sql = "DELETE FROM Candidato WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }
}
?>