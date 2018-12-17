<?php   
	class Produto{
		private $nome;
		private $tipo;
		private $marca;
		private $modelo;
		private $validade;
		private $fornecedor;
		private $empresa;
		private $custoCompra;
		private $precoVenda;
		private $codigoBarras;
		private $quantidade;
		private $status;
		private $porcentagemVarejo;
		private $porcentagemAtacado;
		private $descricao;
		//Só utilizados na edição de produtos
		private $promocao;
		private $desconto;
		private $dataCompra;

		public function __construct($nome, $tipo, $marca, $modelo, $validade, $fornecedor, $empresa, $custoCompra, $precoVenda, $codigoBarras, $quantidade, $status, $porcentagemVarejo, $porcentagemAtacado, $descricao){

			$this->nome = $nome;
			$this->tipo = $tipo;
			$this->marca = $marca;
			$this->modelo = $modelo;
			$this->validade = $validade;
			$this->fornecedor = $fornecedor;
			$this->empresa = $empresa;
			$this->custoCompra = $custoCompra;
			$this->precoVenda = $precoVenda;
			$this->codigoBarras = $codigoBarras;
			$this->quantidade = $quantidade;
			$this->setStatus($status);
			$this->porcentagemVarejo = $porcentagemVarejo;
			$this->porcentagemAtacado = $porcentagemAtacado;
			$this->descricao = $descricao;
		}

		public function getNome(){
			return $this->nome;
		}

		public function setNome($nome){
			$this->nome = $nome;
		}

		public function getTipo(){
			return $this->tipo;
		}

		public function setTipo($tipo){
			$this->tipo = $tipo;
		}

		public function getMarca(){
			return $this->marca;
		}

		public function set($marca){
			$this->marca = $marca;
		}

		public function getModelo(){
			return $this->modelo;
		}

		public function setModelo($modelo){
			$this->modelo = $modelo;
		}

		public function getValidade(){
			return $this->validade;
		}

		public function setValidade($validade){
			$this->validade = $validade;
		}

		public function getFornecedor(){
			return $this->fornecedor;
		}

		public function setFornecedor($fornecedor){
			$this->fornecedor = $fornecedor;
		}

		public function getEmpresa(){
			return $this->empresa;
		}

		public function setEmpresa($empresa){
			$this->empresa = $empresa;
		}

		public function getCustoCompra(){
			return $this->custoCompra;
		}

		public function setCustoCompra(){
			$this->custoCompra = $custoCompra;
		}

		public function getPrecoVenda(){
			return $this->precoVenda;
		}

		public function setPrecoVenda($precoVenda){
			$this->precoVenda = $precoVenda;
		}

		public function getCodigoBarras(){
			return $this->codigoBarras;
		}

		public function setCodigoBarras($codigoBarras){
			$this->codigoBarras = $codigoBarras;
		}

		public function getQuantidade(){
			return $this->quantidade;
		}

		public function setQuantidade($quantidade){
			$this->quantidade = $quantidade;
		}

		public function getStatus():bool{
			return $this->status;
		}

		public function setStatus($status){		
			if($status == 'Ativo'){
				$this->status = true;
			}
			else{
				$this->status = false;
			}
		}

		public function getPorcentagemVarejo(){
			return $this->porcentagemVarejo;
		}

		public function setPorcentagemVarejo($porcentagemVarejo){
			$this->porcentagemVarejo = $porcentagemVarejo;
		}

		public function getPorcentagemAtacado(){
			return $this->porcentagemAtacado;
		}

		public function setPorcentagemAtacado($porcentagemAtacado){
			$this->porcentagemAtacado = $porcentagemAtacado;
		}

		public function getDescricao(){
			return $this->descricao;
		}

		public function setDescricao($descricao){
			$this->descricao = $descricao;
		}	

		public function getPromocao():bool{
			return $this->promocao;
		}

		public function setPromocao($promocao){
			$this->promocao = $promocao;
		}

		public function getDesconto(){
			return $this->desconto;
		}

		public function setDesconto($desconto){
			$this->desconto = $desconto;
		}		

		public function getDataCompra(){
			return $this->dataCompra;
		}

		public function setDataCompra($dataCompra){
			$this->dataCompra = $dataCompra;
		}
	}
?>