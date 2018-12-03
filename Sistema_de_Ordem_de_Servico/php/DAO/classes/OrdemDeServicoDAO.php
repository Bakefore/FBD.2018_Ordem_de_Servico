<?php  
	class OrdemDeServicoDAO{
		private $ordemDeServico;

		public function __construct($ordemDeServico){
			$this->ordemDeServico = $ordemDeServico;			
		}

		public function getOrdemDeServico(){
			return $this->ordemDeServico;	
		}

		public function cadastrar(){
			$sql = new Sql();			

			$resultadoEmpresa = $sql->select("select * from empresa where razaoSocial = :razaoSocial", array(
				":razaoSocial"=>$this->ordemDeServico->getEmpresa()
			));

			$resultadoCliente = $sql->select("select * from cliente where nome = :nome", array(
				":nome"=>$this->ordemDeServico->getCliente()
			));

			$resultadoAtendente = $sql->select("select * from funcionario where nome = :nome", array(
				":nome"=>$this->ordemDeServico->getAtendente()
			));

			$resultadoTecnico = $sql->select("select * from funcionario where nome = :nome", array(
				":nome"=>$this->ordemDeServico->getTecnicoResponsavel()
			));			

			$sql->query("insert into ordemDeServico (dataDeSolicitacao, descricao, dataDeExecucao, formaDePagamento, desconto, quantidadeParcelas, valorFinal, tipo, idEmpresa, idCliente, idFuncionarioAtendente, idFuncionarioTecnico) values (:dataDeSolicitacao, :descricao, :dataDeExecucao, :formaDePagamento, :desconto, :quantidadeParcelas, :valorFinal, :tipo, :idEmpresa, :idCliente, :idFuncionarioAtendente, :idFuncionarioTecnico)", array(
 
				":dataDeSolicitacao"=>$this->ordemDeServico->getDataSolicitacao(), 
				":descricao"=>$this->ordemDeServico->getDescricao(), 
				":dataDeExecucao"=>$this->ordemDeServico->getDataExecucao(), 
				":formaDePagamento"=>$this->ordemDeServico->getFormaPagamento(), 
				":desconto"=>$this->ordemDeServico->getDesconto(), 
				":quantidadeParcelas"=>$this->ordemDeServico->getNumeroParcelas(), 
				":valorFinal"=>$this->ordemDeServico->getValorTotal(), 
				":tipo"=>$this->ordemDeServico->getTipo(), 
				":idEmpresa"=>$resultadoEmpresa[0]['idEmpresa'], 
				":idCliente"=>$resultadoCliente[0]['idCliente'], 
				":idFuncionarioAtendente"=>$resultadoAtendente[0]['idFuncionario'], 
				":idFuncionarioTecnico"=>$resultadoTecnico[0]['idFuncionario']
			));	
			//SELECT MAX(ID) FROM tabela  

			$ordemDeServico = $sql->select("select max(idOrdemDeServico) from ordemDeServico", array());
			
			for($i=0; $i < count($_SESSION['carrinho']); $i++){
				$produto = $sql->select("select * from itemproduto where idItemProduto = :idItemProduto", array(
					":idItemProduto"=>intval($_SESSION['carrinho'][$i]['id'])
				));

				$sql->query("insert into itemProdutoVenda (nome, marca, modelo, dataValidade, codigoDeBarra, quantidade, precoVenda, idItemProduto, idOrdemDeServico) values (:nome, :marca, :modelo, :dataValidade, :codigoDeBarra, :quantidade, :precoVenda, :idItemProduto, :idOrdemDeServico)", array(
 
					":nome"=>$produto[0]['nome'], 
					":marca"=>$produto[0]['marca'], 
					":modelo"=>$produto[0]['modelo'], 
					":dataValidade"=>$produto[0]['dataValidade'], 
					":codigoDeBarra"=>$produto[0]['codigoDeBarra'], 
					":quantidade"=>$_SESSION['carrinho'][$i]['quantidade'], 
					":precoVenda"=>$produto[0]['precoVenda'],    
					":idItemProduto"=>$produto[0]['idItemProduto'], 
					":idOrdemDeServico"=>$ordemDeServico[0]['max(idOrdemDeServico)']
				));	
			}

			//Insere na base de dados servicoordemdeservico todos os serviços que foram selecionados
			foreach ($this->ordemDeServico->getServicosArray() as $servico) {
				$servico = $sql->select("select * from servico where nome = :nome", array(
					":nome"=>$servico
				));

				$sql->query("insert into servicoordemdeservico (idServico, idOrdemDeServico) values (:idServico, :idOrdemDeServico)", array( 
					":idServico"=>$servico[0]['idServico'], 
					":idOrdemDeServico"=>$ordemDeServico[0]['max(idOrdemDeServico)']
				));	
			}

			return true;//Retorna true caso tenha cadastrado
		}
	}
?>