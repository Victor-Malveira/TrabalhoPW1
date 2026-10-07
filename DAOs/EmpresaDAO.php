<?php
    require_once "../modelos/Empresa.php";

    class EmpresaDAO{

        public function salvar($empresa,$conn){
            try{
                $sql = "INSERT INTO Empresa(nome,email,senha,telefone) VALUES 
                    (?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(1,$empresa->getNome());
                $stmt->bindValue(2,$empresa->getEmail());
                $stmt->bindValue(3,password_hash($empresa->getSenha(),PASSWORD_DEFAULT));
                $stmt->bindValue(4,$empresa->getTelefone());
                $stmt->execute();
            }catch(PDOException $erro){
                throw $erro;
            }catch(Exception $erro){
                throw $erro;
            }
        }

        public function buscarPeloEmail($empresa,$conn){
            $sql = "SELECT * FROM Empresa WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1,$empresa->getEmail());
            $stmt->execute();
            $empresaBase = $stmt->fetch(PDO::FETCH_OBJ);
            var_dump($empresaBase);
            if($empresaBase){
                //converter esse objeto para o modelo
                $empresaModelo = new Empresa();
                $empresaModelo->setId($empresaBase->id);
                $empresaModelo->setNome($empresaBase->nome);
                $empresaModelo->setEmail($empresaBase->email);
                $empresaModelo->setSenha($empresaBase->senha);
                $empresaModelo->setTelefone($empresaBase->telefone);
                return $empresaModelo;
            }else{
                return null;
            }            
        }

        public function buscar($pesquisa, $conn){
            $sql = "SELECT * FROM Empresa 
                    WHERE nome LIKE ? OR email LIKE ?";

            $stmt = $conn->prepare($sql);

            $pesquisa = "%" . $pesquisa . "%";

            $stmt->bindValue(1, $pesquisa);
            $stmt->bindValue(2, $pesquisa);

            $stmt->execute();

            $empresasBase = $stmt->fetchAll(PDO::FETCH_OBJ);

            $empresas = [];

            foreach($empresasBase as $empresaBase){
                $empresa = new Empresa();

                $empresa->setId($empresaBase->id);
                $empresa->setNome($empresaBase->nome);
                $empresa->setEmail($empresaBase->email);
                $empresa->setSenha($empresaBase->senha);
                $empresa->setTelefone($empresaBase->telefone);

                $empresas[] = $empresa;
            }

            return $empresas;
        }
        public function editar($empresa, $conn){
            $sql = "UPDATE Empresa 
                    SET nome = ?, email = ?, telefone = ?
                    WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $empresa->getNome());
            $stmt->bindValue(2, $empresa->getEmail());
            $stmt->bindValue(3, $empresa->getTelefone());
            $stmt->bindValue(4, $empresa->getId());
            $stmt->execute();
        }

        public function buscarPeloId($id, $conn){
            $sql = "SELECT * FROM Empresa WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $empresaBase = $stmt->fetch(PDO::FETCH_OBJ);
            if($empresaBase){
                $empresa = new Empresa();
                $empresa->setId($empresaBase->id);
                $empresa->setNome($empresaBase->nome);
                $empresa->setEmail($empresaBase->email);
                $empresa->setSenha($empresaBase->senha);
                $empresa->setTelefone($empresaBase->telefone);
                return $empresa;
            }else{
                return null;

            }
        }
        public function excluir($id, $conn){
            $sql = "DELETE FROM Empresa WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $id);
            $stmt->execute();
        }
    }

?>