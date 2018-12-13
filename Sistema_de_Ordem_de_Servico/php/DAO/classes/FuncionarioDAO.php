<?php  
	require_once("../autoload/autoloadModel.php");
	require_once("../autoload/autoloadView.php");
	class FuncionarioDAO{
		private $funcionario;
		private $idEndereco;

		public function __construct($funcionario, $idEndereco){
			$this->funcionario = $funcionario;
			$this->idEndereco = $idEndereco;
		}

		public function getFuncionario(){
			return $this->funcionario;
		}

		public function getIdEndereco(){
			return $this->idEndereco;
		}

		public function cadastrar(){
			$sql = new Sql();

			$resultadoFuncionario = $sql->select("select * from funcionario where login = :login", array(
				":login"=>$this->funcionario->getLogin()
			));

			if($resultadoFuncionario == null){
				$reultadoAcesso = $sql->select("select * from acesso where nome = :nome", array(
					":nome"=>$this->funcionario->getAcesso()					
				));

				$resultadoEmpresa = $sql->select("select * from empresa where razaoSocial = :razaoSocial", array(
					":razaoSocial"=>$this->funcionario->getEmpresa()					
				));

				$sql->query("insert into funcionario (sexo, nome, cpf, dataNascimento, login, senha, idAcesso, idEndereco, idEmpresa) values (:sexo, :nome, :cpf, :dataNascimento, :login, :senha, :idAcesso, :idEndereco, :idEmpresa)", array(

					":sexo"=>$this->funcionario->getSexo(), 
					":nome"=>$this->funcionario->getNome(), 
					":cpf"=>$this->funcionario->getCPF(), 
					":dataNascimento"=>$this->funcionario->getNascimento(), 
					":login"=>$this->funcionario->getLogin(), 
					":senha"=>$this->funcionario->getSenha(), 
					":idAcesso"=>$reultadoAcesso[0]['idAcesso'], 
					":idEndereco"=>$this->getIdEndereco(), 
					":idEmpresa"=>$resultadoEmpresa[0]['idEmpresa']
				));	
				return true;//Retorna true caso tenha cadastrado
			}
			return false;//Retorna false caso não tenha cadastrado	
		}

		public function editar($idFuncionario){
			$sql = new Sql();

			$reultadoAcesso = $sql->select("select * from acesso where nome = :nome", array(
				":nome"=>$this->funcionario->getAcesso()					
			));

			$resultadoEmpresa = $sql->select("select * from empresa where razaoSocial = :razaoSocial", array(
				":razaoSocial"=>$this->funcionario->getEmpresa()					
			));

			$sql->query("update funcionario set sexo = :sexo, nome = :nome, cpf = :cpf, dataNascimento = :dataNascimento, login = :login, senha = :senha, idAcesso = :idAcesso, idEndereco = :idEndereco, idEmpresa = :idEmpresa where idFuncionario = :idFuncionario", array(

				":sexo"=>$this->funcionario->getSexo(), 
				":nome"=>$this->funcionario->getNome(), 
				":cpf"=>$this->funcionario->getCPF(), 
				":dataNascimento"=>$this->funcionario->getNascimento(), 
				":login"=>$this->funcionario->getLogin(), 
				":senha"=>$this->funcionario->getSenha(), 
				":idAcesso"=>$reultadoAcesso[0]['idAcesso'], 
				":idEndereco"=>$this->getIdEndereco(), 
				":idEmpresa"=>$resultadoEmpresa[0]['idEmpresa'],
				"idFuncionario"=>$idFuncionario
			));	
		}
	}
?>