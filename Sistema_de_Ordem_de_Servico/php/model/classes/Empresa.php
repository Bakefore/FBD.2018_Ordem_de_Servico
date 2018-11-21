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

			$cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);	//Deixa apenas os caracteres numéricos

			$this->cnpj = $cnpj;
			$this->contatosArray = $contatosArray;
			$this->endereco = $endereco;
		}

		public function super($razaoSocial, $nomeFantasia, $cnpj, $endereco, $contatosArray = array()){
			$this->setRazaoSocial($razaoSocial);		
			$this->setNomeFantasia($nomeFantasia);
			$this->setCNPJ($cnpj);
			$this->setContatosArray($contatosArray);
			$this->setEndereco($endereco);
		}

		public function getRazaoSocial(){
			return $this->razaoSocial;		
		}

		public function setRazaoSocial($razaoSocial){
			$this->razaoSocial = $razaoSocial;
		}

		public function getNomeFantasia(){
			return $this->nomeFantasia;		
		}

		public function setNomeFantasia($nomeFantasia){
			$this->nomeFantasia = $nomeFantasia;
		}

		public function getCNPJ(){
			return $this->cnpj;		
		}

		public function setCNPJ($cnpj){
			$this->cnpj = $cnpj;
		}

		public function getContatosArray(){
			return $this->contatosArray;		
		}

		public function setContatosArray($contatosArray){
			$this->contatosArray = $contatosArray;
		}

		public function getEndereco(){
			return $this->endereco;		
		}

		public function setEndereco($endereco){
			$this->endereco = $endereco;
		}
	}
?>