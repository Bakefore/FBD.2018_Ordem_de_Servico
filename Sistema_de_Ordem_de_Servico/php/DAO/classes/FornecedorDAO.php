<?php  
	require_once("../autoload/autoloadModel.php");
	class FornecedorDAO{
		private $fornecedor;
		private $idEndereco;

		public function __construct($fornecedor, $idEndereco){
			$this->fornecedor = $fornecedor;
			$this->idEndereco = $idEndereco;
		}

		public function getfornecedor(){
			return $this->fornecedor;
		}

		public function getIdEndereco(){
			return $this->idEndereco;
		}

		public function cadastrar(){
			$sql = new Sql();

			$resultadoFornecedor = $sql->select("select * from fornecedor where razaoSocial = :razaoSocial and nomeFantasia = :nomeFantasia and cnpj = :cnpj", array(
				":razaoSocial"=>$this->fornecedor->getRazaoSocial(),
				":nomeFantasia"=>$this->fornecedor->getNomeFantasia(),
				":cnpj"=>$this->fornecedor->getCNPJ()
			));

			if($resultadoFornecedor == null){
				$sql->query("insert into fornecedor (razaoSocial, nomeFantasia, cnpj, idEndereco, idEmpresa) values (:razaoSocial, :nomeFantasia, :cnpj, :idEndereco, :idEmpresa)", array(

					":razaoSocial"=>$this->fornecedor->getRazaoSocial(), 
					":nomeFantasia"=>$this->fornecedor->getNomeFantasia(), 
					":cnpj"=>$this->fornecedor->getCNPJ(), 
					":idEndereco"=>$this->getIdEndereco(),
					":idEmpresa"=>
				));	
				return true;//Retorna true caso tenha cadastrado
			}
			
			return false;//Retorna false caso não tenha cadastrado			
		}
	}
?>