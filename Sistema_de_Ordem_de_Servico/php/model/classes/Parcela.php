<?php  
	class Parcela{
		private $codigo;
		private $dataVencimento;
		private $quantidadeTotal;
		private $ativo;
		private $valor;
		private $parcelaAtual;

		public function __construct($codigo, $dataVencimento, $quantidadeTotal, $valor, $parcelaAtual){
			$this->codigo = $codigo;
			$this->dataVencimento = $dataVencimento;
			$this->quantidadeTotal = $quantidadeTotal;
			$this->ativo = true;
			$this->valor = $valor;
			$this->parcelaAtual = $parcelaAtual;
		}

		public function getCodigo(){
			return $this->codigo;
		}

		public function setCodigo($codigo){
			$this->codigo = $codigo;
		}

		public function getDataVencimento(){
			return $this->dataVencimento;
		}

		public function setDataVencimento($dataVencimento){
			$this->dataVencimento = $dataVencimento;
		}

		public function getQuantidadeTotal(){
			return $this->quantidadeTotal;
		}

		public function setQuantidadeTotal($quantidadeTotal){
			$this->quantidadeTotal = $quantidadeTotal;
		}

		public function getAtivo():bool{
			return $this->ativo;
		}

		public function setAtivo($ativo){
			$this->ativo = $ativo;
		}

		public function getValor():float{
			return $this->valor;
		}

		public function setValor($valor){
			$this->valor = $valor;
		}

		public function getParcelaAtual(){
			return $this->parcelaAtual;
		}

		public function setParcelaAtual($parcelaAtual){
			$this->parcelaAtual = $parcelaAtual;
		}
	}
?>