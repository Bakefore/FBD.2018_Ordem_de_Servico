<?php  
	class ClienteDAO{
		private $cliente;
		private $idEndereco;

		public function __construct($cliente, $idEndereco){
			$this->cliente = $cliente;
			$this->idEndereco = $idEndereco;
		}

		public function getCliente(){
			return $this->cliente;
		}

		public function getIdEndereco(){
			return $this->idEndereco;
		}

		public function cadastrar(){
			$sql = new Sql();

			$resultadoCliente = $sql->select("select * from cliente where cpf = :cpf", array(
				":cpf"=>$this->cliente->getCPF()
			));

			if($resultadoCliente == null){
				$sql->query("insert into cliente (sexo, nome, cpf, dataNascimento, idEmpresa, idEndereco) values (:sexo, :nome, :cpf, :dataNascimento, :idEmpresa, :idEndereco)", array(
					":sexo"=>$this->cliente->getSexo(), 
					":nome"=>$this->cliente->getNome(), 
					":cpf"=>$this->cliente->getCPF(), 
					":dataNascimento"=>$this->cliente->getNascimento(), 
					":idEmpresa"=>$_SESSION['empresa']['idEmpresa'], 
					":idEndereco"=>$this->getIdEndereco()
				));	
				return true;//Retorna true caso tenha cadastrado
			}
			
			return false;//Retorna false caso não tenha cadastrado			
		}
	}
?>