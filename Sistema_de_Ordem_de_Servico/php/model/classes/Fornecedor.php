<?php  
	class Fornecedor extends Empresa{
		private $empresa;

		public function __construct($razaoSocial, $nomeFantasia, $cnpj, $endereco, $contatosArray = array(), $empresa){
			super($razaoSocial, $nomeFantasia, $cnpj, $endereco, $contatosArray);
			$this->empresa = $empresa;
		}

		public function getEmpresa(){
			return $this->empresa;
		}
	}
?>