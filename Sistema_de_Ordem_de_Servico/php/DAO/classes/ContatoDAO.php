<?php  
	require_once("../autoload/autoloadModel.php");
	
	class ContatoDAO{
		private $tabela;
		private $contato;
		private $idReferenciado; //id da entidade que tem o determinado contato

		public function __construct($contato, $tabela, $idReferenciado){
			$this->contato = $contato;
			$this->tabela = $tabela;
			$this->idReferenciado = $idReferenciado;
		}

		public function getTabela(){
			return $this->tabela;
		}

		public function getContato(){
			return $this->contato;
		}

		public function cadastrar(){
			$sql = new Sql();

			$resultadoContato = $sql->select("select * from $this->tabela where descricao = :descricao and tipo = :tipo and idReferenciado = :idReferenciado", array(
				":descricao"=>$this->contato->getDescricao(),
				":tipo"=>$this->contato->getTipo(),
				":idReferenciado"=>$this->idReferenciado
			));

			if($resultadoContato == null){
				$sql->query("insert into $this->tabela (descricao, tipo, idReferenciado) values (:descricao, :tipo, :idReferenciado)", array(
					":descricao"=>$this->contato->getDescricao(), 
					":tipo"=>$this->contato->getTipo(),
					":idReferenciado"=>$this->idReferenciado
				));	
				return true;//Retorna true caso tenha cadastrado
			}
			
			return false;//Retorna false caso não tenha cadastrado	
		}

		public function editar($idContato, $nomeTabela){
			$sql = new Sql();

			$sql->query("update $nomeTabela set descricao = :descricao, tipo = :tipo where idContato = :idContato", array(
				":descricao"=>$this->contato->getDescricao(),
				":tipo"=>$this->contato->getTipo(), 
				":idContato"=>$idContato
			));	
		}
	}
?>