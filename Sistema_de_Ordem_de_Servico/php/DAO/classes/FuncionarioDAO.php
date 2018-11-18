<?php  
	require_once("../autoload/autoloadModel.php");
	class FuncionarioDAO{
		private $funcionario;

		public function __construct($funcionario){
			$this->funcionario = $funcionario;
		}

		public function getFuncionario(){
			return $this->funcionario;
		}

		public function cadastrar(){
			$sql = new Sql();
		}
	}
?>