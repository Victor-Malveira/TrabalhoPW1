<?php
    require_once "../DAOs/EmpresaDAO.php";
    require_once "../conexao/Conexao.php";
    class empresaServico{

        public function salvar($empresa){
            try{
                $conn = Conexao::criar();
                $empresaDAO = new EmpresaDAO(); 
                $empresaDAO->salvar($empresa,$conn);
            }catch(PDOException $erro){
                throw $erro;
            }catch(Exception $erro){
                throw $erro;
            }
        }

        public function autenticar($empresa){
            try{
                $conn = Conexao::criar();
                $empresaDAO = new EmpresaDAO();
                $empresaAutenticado = 
                    $empresaDAO->buscarPeloEmail($empresa,$conn);
                if($empresaAutenticado != null){
                    if(password_verify($empresa->getSenha(),
                        $empresaAutenticado->getSenha())){
                        return $empresaAutenticado;
                    } 
                } 
                throw new Exception("E-mail ou senha não conferem");                
            }catch(PDOException $erro){
                throw $erro;
            }
        }

        public function buscar($pesquisa){
            $conn = Conexao::criar();
            $empresaDAO = new EmpresaDAO();
            return $empresaDAO->buscar($pesquisa, $conn);
        }

        public function editar($empresa){
            $conn = Conexao::criar();
            $empresaDAO = new EmpresaDAO();
            $empresaDAO->editar($empresa, $conn);
        }

        public function buscarPeloId($id){
            $conn = Conexao::criar();
            $empresaDAO = new EmpresaDAO();
            return $empresaDAO->buscarPeloId($id, $conn);
        }

        public function excluir($id){
            $conn = Conexao::criar();
            $empresaDAO = new EmpresaDAO();
            $empresaDAO->excluir($id, $conn);
        }
    }

?>