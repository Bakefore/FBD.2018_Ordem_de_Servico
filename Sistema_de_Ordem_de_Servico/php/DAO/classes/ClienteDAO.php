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
				$resultadoEmpresa = $sql->select("select * from empresa where razaoSocial = :razaoSocial", array(
					":razaoSocial"=>$this->cliente->getEmpresa()
				));			

				$sql->query("insert into cliente (sexo, nome, cpf, dataNascimento, idEmpresa, idEndereco) values (:sexo, :nome, :cpf, :dataNascimento, :idEmpresa, :idEndereco)", array(
					":sexo"=>$this->cliente->getSexo(), 
					":nome"=>$this->cliente->getNome(), 
					":cpf"=>$this->cliente->getCPF(), 
					":dataNascimento"=>$this->cliente->getNascimento(), 
					":idEmpresa"=>$resultadoEmpresa[0]['idEmpresa'], 
					":idEndereco"=>$this->getIdEndereco()
				));	
				return true;//Retorna true caso tenha cadastrado
			}
			
			return false;//Retorna false caso não tenha cadastrado			
		}

		public function editar($idCliente){
			$sql = new Sql();

			$resultadoEmpresa = $sql->select("select * from empresa where razaoSocial = :razaoSocial", array(
				":razaoSocial"=>$this->cliente->getEmpresa()
			));			

			$sql->query("update cliente set sexo = :sexo, nome = :nome, cpf = :cpf, dataNascimento = :dataNascimento, idEmpresa = :idEmpresa, idEndereco = :idEndereco where idCliente = :idCliente", array(
				":sexo"=>$this->cliente->getSexo(), 
				":nome"=>$this->cliente->getNome(), 
				":cpf"=>$this->cliente->getCPF(), 
				":dataNascimento"=>$this->cliente->getNascimento(), 
				":idEmpresa"=>$resultadoEmpresa[0]['idEmpresa'], 
				":idEndereco"=>$this->getIdEndereco(),
				":idCliente"=>$idCliente
			));	
		}
	}
?>