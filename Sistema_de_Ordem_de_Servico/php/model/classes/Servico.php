<?php   
	class Servico{
		private $nome;
		private $valor;
		private $empresa;
		private $tipo;
		private $descricao; 

		public function __construct($nome, $valor, $empresa, $tipo, $descricao){
			$this->nome = $nome;
			$this->valor = $valor;
			$this->empresa = $empresa;
			$this->tipo = $tipo;
			$this->descricao = $descricao;
		}

		public function getNome(){
			return $this->nome;
		}

		public function setNome($nome){
			$this->nome = $nome;
		}

		public function getValor(){
			return $this->valor;
		}

		public function setValor($valor){
			$this->valor = $valor;
		}

		public function getEmpresa(){
			return $this->empresa;
		}

		public function setEmpresa($empresa){
			$this->empresa = $empresa;
		}

		public function getTipo(){
			return $this->tipo;
		}

		public function setTipo($tipo){
			$this->tipo = $tipo;
		}

		public function getDescricao(){
			return $this->descricao;
		}

		public function setDescricao($descricao){
			$this->descricao = $descricao;
		}
	}
?>