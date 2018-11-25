<?php  
	class Fornecedor extends Empresa{
		private $empresa;

		public function __construct($razaoSocial, $nomeFantasia, $cnpj, $endereco, $contatosArray = array(), $empresa){
			$cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);	//Deixa apenas os caracteres numéricos
			$this->super($razaoSocial, $nomeFantasia, $cnpj, $endereco, $contatosArray);
			$this->empresa = $empresa;
		}

		public function getEmpresa(){
			return $this->empresa;
		}
	}
?>