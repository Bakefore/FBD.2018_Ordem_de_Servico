<?php  
	class Endereco{
		
		private $cep;
		private $uf;
		private $cidade;
		private $bairro;
		private $rua;
		private $numero;
		private $complemento;

		public function __construct($cep, $uf, $cidade, $bairro, $rua, $numero, $complemento = ""){
			$this->cep = $cep;
			$this->uf = $uf;
			$this->cidade = $cidade;
			$this->bairro = $bairro;
			$this->rua = $rua;
			$this->numero = $numero;
			$this->complemento = $complemento;
		}

		public function getCep(){
			return $this->cep;
		}

		public function getUf(){
			return $this->uf;
		}

		public function getCidade(){
			return $this->cidade;
		}

		public function getBairro(){
			return $this->bairro;
		}

		public function getRua(){
			return $this->rua;
		}

		public function getNumero(){
			return $this->numero;
		}

		public function getComplemento(){
			return $this->complemento;
		}
	}
?>