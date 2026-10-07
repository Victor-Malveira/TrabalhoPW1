<?php
    require_once "../DTOs/EmpresaDTO.php";
    require_once "../modelos/Empresa.php";
    require_once "../servicos/EmpresaServico.php";
    class EmpresaControlador{

        public function salvar($empresaDTO){
            //converter para modelo
            $empresa = new Empresa();
            $empresa->setNome($empresaDTO->nome);
            $empresa->setEmail($empresaDTO->email);
            $empresa->setSenha($empresaDTO->senha);
            $empresa->setTelefone($empresaDTO->telefone);
            //invocar o serviço
            $empresaServico = new EmpresaServico();
            try{
                $empresaServico->salvar($empresa);
            }catch(PDOException $erro){
                throw $erro;
            }catch(Exception $erro){
                throw $erro;
            }
        }

        public function autenticar($empresaDTO){
            //converter para modelo
            $empresa = new Empresa();
            $empresa->setEmail($empresaDTO->email);
            $empresa->setSenha($empresaDTO->senha);
            $empresaServico = new EmpresaServico();
            try{
                $empresa = 
                    $empresaServico->autenticar($empresa);
                return $empresa;              
            }catch(Exception $erro){
                throw $erro;
            }
        }

        public function buscar($pesquisa){
            $empresaServico = new EmpresaServico();
            return $empresaServico->buscar($pesquisa);
        }

        public function editar($empresaDTO){
            $empresa = new Empresa();
            $empresa->setId($empresaDTO->id);
            $empresa->setNome($empresaDTO->nome);
            $empresa->setEmail($empresaDTO->email);
            $empresa->setTelefone($empresaDTO->telefone);
            $empresaServico = new EmpresaServico();
            $empresaServico->editar($empresa);
        }

        public function buscarPeloId($id){
            $empresaServico = new EmpresaServico();
            return $empresaServico->buscarPeloId($id);
        }

        public function excluir($id){
            $empresaServico = new EmpresaServico();
            $empresaServico->excluir($id);
        }
    }
?>