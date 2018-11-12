<?php  
	require_once("php/autoload/autoloadModel.php");
	class EmpresaDAO{
		private $empresa;

		public function __construct($empresa){
			$this->empresa = $empresa;
		}

		public function getEmpresa(){
			return $this->empresa;
		}

		public function cadastrar(){
			$sql = new Sql();
			$sql->query("");
		}
	}
?>