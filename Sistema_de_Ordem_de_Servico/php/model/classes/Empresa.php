<?php  
	class Empresa{
		private $razaoSocial;
		private $nomeFantasia;
		private $cnpj;
		private $contatosArray;
		private $endereco;

		public function __construct($razaoSocial, $nomeFantasia, $cnpj, $endereco, $contatosArray = array()){
			$this->razaoSocial = $razaoSocial;
			$this->nomeFantasia = $nomeFantasia;
			$this->cnpj = $cnpj;
			$this->contatosArray = $contatosArray;
			$this->endereco = $endereco;
		}

		public function getRazaoSocial(){
			return $this->razaoSocial;		
		}

		public function getNomeFantasia(){
			return $this->nomeFantasia;		
		}

		public function getCNPJ(){
			return $this->cnpj;		
		}

		public function getContatosArray(){
			return $this->contatosArray;		
		}

		public function getEndereco(){
			return $this->endereco;		
		}
	}
?>