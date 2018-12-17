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

			$resultadoEmpresa = $sql->select("select * from empresa where razaoSocial = :razaoSocial", array(
				"razaoSocial"=>$this->produto->getEmpresa()
			));			

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
			
			$resultadoItemProduto = $sql->select("select * from itemproduto where nome = :nome and marca = :marca and modelo = :modelo and dataValidade = :dataValidade and idEmpresa = :idEmpresa", array(
				":nome"=>$this->produto->getNome(),
				":marca"=>$this->produto->getMarca(),
				":modelo"=>$this->produto->getModelo(),
				":dataValidade"=>$this->produto->getValidade(),
				":idEmpresa"=>$resultadoEmpresa[0]['idEmpresa']
			));			
			
			if($resultadoItemProduto == null){
				$resultadoProduto = $sql->select("select * from produto where nome = :nome and tipo = :tipo", array(
					":nome"=>$this->produto->getNome(),
					":tipo"=>$this->produto->getTipo()
				));

				$resultadoFornecedor = $sql->select("select * from fornecedor where razaoSocial = :razaoSocial", array(
					":razaoSocial"=>$this->produto->getFornecedor()
				));

				$sql->query("insert into itemproduto (nome, marca, modelo, promocao, desconto, dataValidade, codigoDeBarra, quantidadeEstoque, ativo, valorCompra, precoVenda, porcentagemAtacado, porcentagemVarejo, idProduto, idFornecedor, idEmpresa) values (:nome, :marca, :modelo, :promocao, :desconto, :dataValidade, :codigoDeBarra, :quantidadeEstoque, :ativo, :valorCompra, :precoVenda, :porcentagemAtacado, :porcentagemVarejo, :idProduto, :idFornecedor, :idEmpresa)", array(

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
					":idFornecedor"=>$resultadoFornecedor[0]['idFornecedor'],
					":idEmpresa"=>$resultadoEmpresa[0]['idEmpresa']
				));	
				return true;//Retorna true caso tenha cadastrado
			}
			
			return false;//Retorna false caso não tenha cadastrado			
		}

		public function editar($idItemProduto){
			$sql = new Sql();

			$resultadoEmpresa = $sql->select("select * from empresa where razaoSocial = :razaoSocial", array(
				"razaoSocial"=>$this->produto->getEmpresa()
			));	

			$resultadoItemProduto = $sql->select("select * from itemproduto where idItemProduto = :idItemProduto", array(
				":idItemProduto"=>$idItemProduto
			));

			$sql->query("update produto set nome = :nome, tipo = :tipo, descricao = :descricao where idProduto = :idProduto", array(
				":nome"=>$this->produto->getNome(), 
				":tipo"=>$this->produto->getTipo(),
				":descricao"=>$this->produto->getDescricao(),
				":idProduto"=>$resultadoItemProduto[0]['idProduto']
			));					
			
			$resultadoProduto = $sql->select("select * from produto where nome = :nome and tipo = :tipo", array(
				":nome"=>$this->produto->getNome(),
				":tipo"=>$this->produto->getTipo()
			));

			$resultadoFornecedor = $sql->select("select * from fornecedor where razaoSocial = :razaoSocial", array(
				":razaoSocial"=>$this->produto->getFornecedor()
			));

			$sql->query("update itemproduto set nome = :nome, marca = :marca, modelo = :modelo, promocao = :promocao, desconto = :desconto, dataCompra = :dataCompra, dataValidade = :dataValidade, codigoDeBarra = :codigoDeBarra, quantidadeEstoque = :quantidadeEstoque, ativo = :ativo, valorCompra = :valorCompra, precoVenda = :precoVenda, porcentagemAtacado = :porcentagemAtacado, porcentagemVarejo = :porcentagemVarejo, idProduto = :idProduto, idFornecedor = :idFornecedor, idEmpresa = :idEmpresa where idItemProduto = :idItemProduto", array(

				":nome"=>$this->produto->getNome(), 
				":marca"=>$this->produto->getMarca(), 
				":modelo"=>$this->produto->getModelo(), 
				":promocao"=>$this->produto->getPromocao(), 
				":desconto"=>$this->produto->getDesconto(), 
				":dataCompra"=>$this->produto->getDataCompra(),
				":dataValidade"=>$this->produto->getValidade(), 
				":codigoDeBarra"=>$this->produto->getCodigoBarras(), 
				":quantidadeEstoque"=>$this->produto->getQuantidade(), 
				":ativo"=>$this->produto->getStatus(), 
				":valorCompra"=>$this->produto->getCustoCompra(), 
				":precoVenda"=>$this->produto->getPrecoVenda(),
				":porcentagemAtacado"=>$this->produto->getPorcentagemVarejo(), 
				":porcentagemVarejo"=>$this->produto->getPorcentagemAtacado(),
				":idProduto"=>$resultadoProduto[0]['idProduto'], 
				":idFornecedor"=>$resultadoFornecedor[0]['idFornecedor'],
				":idItemProduto"=>$idItemProduto,
				":idEmpresa"=>$resultadoEmpresa[0]['idEmpresa']
			));			
		}
	}
?>