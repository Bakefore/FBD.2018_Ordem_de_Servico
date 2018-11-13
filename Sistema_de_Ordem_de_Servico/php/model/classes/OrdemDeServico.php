<?php  
	class OrdemDeServico{

		private $servicosArray;
		private $produtosArray;
		private $empresa;
		private $dataSolicitacao;
		private $atendente;
		private $tipo;
		private $cliente;
		private $tecnicoResponsavel;
		private $dataExecucao;
		private $formaPagamento;
		private $desconto;
		private $numeroParcelas;
		private $descricao;
		private $valorParcela;
		private $valorTotal;

		public function __construct($servicosArray = array(), $produtosArray = array(), $empresa, $dataSolicitacao, $atendente, $tipo, $cliente, $tecnicoResponsavel, $dataExecucao, $formaPagamento, $desconto, $numeroParcelas, $descricao, $valorParcela, $valorTotal){

			$this->servicosArray = $servicosArray;
			$this->produtosArray = $produtosArray;
			$this->empresa = $empresa;
			$this->dataSolicitacao = $dataSolicitacao;
			$this->atendente = $atendente;			
			$this->tipo = $tipo;
			$this->cliente = $cliente;
			$this->tecnicoResponsavel = $tecnicoResponsavel;
			$this->dataExecucao = $dataExecucao;
			$this->formaPagamento = $formaPagamento;
			$this->desconto = $desconto;
			$this->numeroParcelas = $numeroParcelas;
			$this->descricao = $descricao;
			$this->valorParcela = $valorParcela;
			$this->valorTotal = $valorTotal;
		}

		public function getServicosArray(){
			return $this->servicosArray;
		}

		public function setServicosArray($servicosArray){
			$this->servicosArray = $servicosArray;
		}

		public function getProdutosArray(){
			return $this->produtosArray;
		}

		public function setProdutosArray($produtosArray){
			$this->produtosArray = $produtosArray;
		}

		public function getEmpresa(){
			return $this->empresa;
		}

		public function setEmpresa($empresa){
			$this->empresa = $empresa;
		}

		public function getDataSolicitacao(){
			return $this->dataSolicitacao;
		}

		public function setDataSolicitacao($dataSolicitacao){
			$this->dataSolicitacao = $dataSolicitacao;
		}

		public function getAtendente(){
			return $this->atendente;
		}

		public function setAtendente($atendente){
			$this->atendente = $atendente;
		}

		public function getTipo(){
			return $this->tipo;
		}

		public function setTipo($tipo){
			$this->tipo = $tipo;
		}

		public function getCliente(){
			return $this->cliente;
		}

		public function setCliente($cliente){
			$this->cliente = $cliente;
		}

		public function getTecnicoResponsavel(){
			return $this->tecnicoResponsavel;
		}

		public function setTecnicoResponsavel($tecnicoResponsavel){
			$this->tecnicoResponsavel = $tecnicoResponsavel;
		}

		public function getDataExecucao(){
			return $this->dataExecucao;
		}

		public function setDataExecucao($dataExecucao){
			$this->dataExecucao = $dataExecucao;
		}

		public function getFormaPagamento(){
			return $this->formaPagamento;
		}

		public function setFormaPagamento($formaPagamento){
			$this->formaPagamento = $formaPagamento;
		}

		public function getDesconto(){
			return $this->desconto;
		}

		public function setDesconto($desconto){
			$this->desconto = $desconto;
		}

		public function getNumeroParcelas(){
			return $this->numeroParcelas;
		}

		public function setNumeroParcelas(){
			$this->numeroParcelas = $numeroParcelas;
		}

		public function getDescricao(){
			return $this->descricao;
		}

		public function setDescricao($descricao){
			$this->descricao = $descricao;
		}

		public function getValorParcela(){
			return $this->valorParcela;
		}

		public function setValorParcela($valorParcela){
			$this->valorParcela = $valorParcela;
		}

		public function getValorTotal(){
			return $this->valorTotal;
		}

		public function setValorTotal($valorParcela){
			$this->valorTotal = $valorTotal;
		}
	}
?>