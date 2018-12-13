<?php  
	class ServicoDAO{
		private $servico;

		public function __construct($servico){
			$this->servico = $servico;
		}

		public function getServico(){
			return $this->servico;	
		}

		public function cadastrar(){
			$sql = new Sql();

			$resultadoServico = $sql->select("select * from servico where nome = :nome", array(
				":nome"=>$this->servico->getNome()
			));

			if($resultadoServico == null){
				$resultadoEmpresa = $sql->select("select * from empresa where razaoSocial = :razaoSocial", array(
					":razaoSocial"=>$this->servico->getEmpresa()					
				));

				$sql->query("insert into servico (nome, tipo, descricao, valor, idEmpresa) values (:nome, :tipo, :descricao, :valor, :idEmpresa)", array(
					":nome"=>$this->servico->getNome(), 
					":tipo"=>$this->servico->getTipo(), 
					":descricao"=>$this->servico->getDescricao(), 
					":valor"=>$this->servico->getValor(), 
					":idEmpresa"=>$resultadoEmpresa[0]['idEmpresa']
				));	
				return true;//Retorna true caso tenha cadastrado
			}
			
			return false;//Retorna false caso não tenha cadastrado			
		}

		public function editar($idServico){
			$sql = new Sql();

			$resultadoEmpresa = $sql->select("select * from empresa where razaoSocial = :razaoSocial", array(
				":razaoSocial"=>$this->servico->getEmpresa()					
			));

			$sql->query("update servico set nome = :nome, tipo = :tipo, descricao = :descricao, valor = :valor, idEmpresa = :idEmpresa where idServico = :idServico", array(
				":nome"=>$this->servico->getNome(), 
				":tipo"=>$this->servico->getTipo(), 
				":descricao"=>$this->servico->getDescricao(), 
				":valor"=>$this->servico->getValor(), 
				":idEmpresa"=>$resultadoEmpresa[0]['idEmpresa'],
				":idServico"=>$idServico
			));			
		}
	}
?>