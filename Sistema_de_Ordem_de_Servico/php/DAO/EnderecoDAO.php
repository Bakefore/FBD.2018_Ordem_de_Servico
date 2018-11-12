<?php  
	require_once("php/autoload/autoloadModel.php");
	class EnderecoDAO{
		private $endereco;

		public function __construct($endereco){
			$this->endereco = $endereco;
		}

		public function getEndereco(){
			return $this->endereco;
		}
	}
?>