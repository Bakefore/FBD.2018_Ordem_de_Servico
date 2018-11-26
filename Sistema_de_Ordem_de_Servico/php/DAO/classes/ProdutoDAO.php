<?php   
	class ProdutoDAO{
		private $produto;

		public function __construct($produto){
			$this->produto = $produto;
		}

		public function getProduto(){
			return $this->produto;
		}

		public function cadastrar(){
			$sql = new Sql();

			$resultadoProduto = $sql->select("select * from produto where nome = :nome and tipo = :tipo", array(
				":nome"=>$this->produto->getNome(),
				":tipo"=>$this->produto->getTipo()
			));			

			if($resultadoProduto == null){
				$sql->query("insert into produto (nome, tipo, descricao) values (:nome, :tipo, :descricao)", array(
					":nome"=>$this->produto->getNome(), 
					":tipo"=>$this->produto->getTipo(),
					":descricao"=>$this->produto->getDescricao()
				));	
			}
			
			$resultadoItemProduto = $sql->select("select * from itemproduto where nome = :nome and marca = :marca and modelo = :modelo and dataValidade = :dataValidade", array(
				":nome"=>$this->produto->getNome(),
				":marca"=>$this->produto->getMarca(),
				":modelo"=>$this->produto->getModelo(),
				":dataValidade"=>$this->produto->getValidade()
			));			
			
			if($resultadoItemProduto == null){
				$resultadoProduto = $sql->select("select * from produto where nome = :nome and tipo = :tipo", array(
					":nome"=>$this->produto->getNome(),
					":tipo"=>$this->produto->getTipo()
				));

				$resultadoFornecedor = $sql->select("select * from fornecedor where razaoSocial = :razaoSocial", array(
					":razaoSocial"=>$this->produto->getFornecedor()
				));

				$sql->query("insert into itemproduto (nome, marca, modelo, promocao, desconto, dataValidade, codigoDeBarra, quantidadeEstoque, ativo, valorCompra, precoVenda, porcentagemAtacado, porcentagemVarejo, idProduto, idFornecedor) values (:nome, :marca, :modelo, :promocao, :desconto, :dataValidade, :codigoDeBarra, :quantidadeEstoque, :ativo, :valorCompra, :precoVenda, :porcentagemAtacado, :porcentagemVarejo, :idProduto, :idFornecedor)", array(

					":nome"=>$this->produto->getNome(), 
					":marca"=>$this->produto->getMarca(), 
					":modelo"=>$this->produto->getModelo(), 
					":promocao"=>false, 
					":desconto"=>null, 
					":dataValidade"=>$this->produto->getValidade(), 
					":codigoDeBarra"=>$this->produto->getCodigoBarras(), 
					":quantidadeEstoque"=>$this->produto->getQuantidade(), 
					":ativo"=>$this->produto->getStatus(), 
					":valorCompra"=>$this->produto->getCustoCompra(), 
					":precoVenda"=>$this->produto->getPrecoVenda(),
					":porcentagemAtacado"=>$this->produto->getPorcentagemVarejo(), 
					":porcentagemVarejo"=>$this->produto->getPorcentagemAtacado(),
					":idProduto"=>$resultadoProduto[0]['idProduto'], 
					":idFornecedor"=>$resultadoFornecedor[0]['idFornecedor']
				));	
				return true;//Retorna true caso tenha cadastrado
			}
			
			return false;//Retorna false caso não tenha cadastrado			
		}
	}
?>