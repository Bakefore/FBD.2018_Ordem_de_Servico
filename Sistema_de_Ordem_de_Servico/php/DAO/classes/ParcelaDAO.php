<?php  
	class ParcelaDAO{
		private $parcelasArray;
		private $idOrdemDeServico;
		private $idCliente;

		public function __construct($parcelasArray = array(), $idOrdemDeServico, $idCliente){
			$this->parcelasArray = $parcelasArray;
			$this->idOrdemDeServico = $idOrdemDeServico;
			$this->idCliente = $idCliente;
		}

		public function getParcelasArray(){
			return $this->parcelasArray;
		}

		public function cadastrar(){
			$sql = new Sql();

			foreach ($this->parcelasArray as $parcela) {
				$sql->query("insert into parcela (codigo, dataVencimento, quantidadeTotal, ativo, valor, parcelaAtual, idOrdemDeServico, idCliente) values (:codigo, :dataVencimento, :quantidadeTotal, :ativo, :valor, :parcelaAtual, :idOrdemDeServico, :idCliente)", array(
 
					":codigo"=>$parcela->getCodigo(), 
					":dataVencimento"=>$parcela->getDataVencimento(),
					":quantidadeTotal"=>$parcela->getQuantidadeTotal(), 
					":ativo"=>$parcela->getAtivo(), 
					":valor"=>$parcela->getValor(), 
					":parcelaAtual"=>$parcela->getParcelaAtual(), 
					":idOrdemDeServico"=>$this->idOrdemDeServico, 
					":idCliente"=>$this->idCliente
				));
			}
			return true;//Retorna true caso tenha cadastrado
		}
	}
?>