<?php  
	require_once("../autoload/autoloadModel.php");
	class EmpresaDAO{
		private $empresa;
		private $idEndereco;

		public function __construct($empresa, $idEndereco){
			$this->empresa = $empresa;
			$this->idEndereco = $idEndereco;
		}

		public function getEmpresa(){
			return $this->empresa;
		}

		public function getIdEndereco(){
			return $this->idEndereco;
		}

		public function cadastrar(){
			$sql = new Sql();

			$resultadoEmpresa = $sql->select("select * from empresa where razaoSocial = :razaoSocial and nomeFantasia = :nomeFantasia and cnpj = :cnpj", array(
				":razaoSocial"=>$this->empresa->getRazaoSocial(),
				":nomeFantasia"=>$this->empresa->getNomeFantasia(),
				":cnpj"=>$this->empresa->getCNPJ()
			));

			if($resultadoEmpresa == null){
				$sql->query("insert into empresa (razaoSocial, nomeFantasia, cnpj, idEndereco) values (:razaoSocial, :nomeFantasia, :cnpj, :idEndereco)", array(

					":razaoSocial"=>$this->empresa->getRazaoSocial(), 
					":nomeFantasia"=>$this->empresa->getNomeFantasia(), 
					":cnpj"=>$this->empresa->getCNPJ(), 
					":idEndereco"=>$this->getIdEndereco()
				));	
				return true;//Retorna true caso tenha cadastrado
			}
			
			return false;//Retorna false caso não tenha cadastrado			
		}

		public function editar($idEmpresa){
			$sql = new Sql();

			$sql->query("update empresa set razaoSocial = :razaoSocial, nomeFantasia = :nomeFantasia, cnpj = :cnpj, idEndereco = :idEndereco where idEmpresa = :idEmpresa", array(
				":razaoSocial"=>$this->empresa->getRazaoSocial(),
				":nomeFantasia"=>$this->empresa->getNomeFantasia(), 
				":cnpj"=>$this->empresa->getCNPJ(),
				":idEmpresa"=>$idEmpresa,
				":idEndereco"=>$this->getIdEndereco()
			));	
		}
	}
?>