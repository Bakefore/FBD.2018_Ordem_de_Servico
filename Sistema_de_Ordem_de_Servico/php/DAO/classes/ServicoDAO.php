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
				$sql->query("insert into servico (nome, tipo, descricao, valor, idEmpresa) values (:nome, :tipo, :descricao, :valor, :idEmpresa)", array(
					":nome"=>$this->servico->getNome(), 
					":tipo"=>$this->servico->getTipo(), 
					":descricao"=>$this->servico->getDescricao(), 
					":valor"=>$this->servico->getValor(), 
					":idEmpresa"=>$_SESSION['empresa']['idEmpresa']
				));	
				return true;//Retorna true caso tenha cadastrado
			}
			
			return false;//Retorna false caso não tenha cadastrado			
		}
	}
?>