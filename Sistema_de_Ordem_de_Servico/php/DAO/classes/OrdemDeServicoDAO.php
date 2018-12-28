<?php  
	class OrdemDeServicoDAO{
		private $ordemDeServico;
		private $idOrdemDeServico;
		private $idCliente;

		public function __construct($ordemDeServico){
			$this->ordemDeServico = $ordemDeServico;			
		}

		public function getOrdemDeServico(){
			return $this->ordemDeServico;	
		}

		public function getIdOrdemDeServico(){
			return $this->idOrdemDeServico;
		}

		public function getIdCliente(){
			return $this->idCliente;
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
			$this->idOrdemDeServico = $ordemDeServico[0]['max(idOrdemDeServico)'];	//Define o id de ordem de serviço para ser usado na criação das parcelas
			$this->idCliente = $resultadoCliente[0]['idCliente'];	//Define o id de cliente para ser usado na criação de parcelas
			
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

				$resultadoItemPordutoAtual = $sql->select("select * from itemproduto where idItemProduto = :idItemProduto", array(
					":idItemProduto"=>$produto[0]['idItemProduto']
				));

				$sql->query("update itemproduto set quantidadeVenda = :quantidadeVenda where idItemProduto = :idItemProduto", array( 
					":quantidadeVenda"=>$_SESSION['carrinho'][$i]['quantidade'] + $resultadoItemPordutoAtual[0]['quantidadeVenda'],
					":idItemProduto"=>$produto[0]['idItemProduto']
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

		public function editar($idOrdemDeServico){
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

			$sql->query("update ordemDeServico set dataDeSolicitacao = :dataDeSolicitacao, descricao = :descricao, dataDeExecucao = :dataDeExecucao, formaDePagamento = :formaDePagamento, desconto = :desconto, quantidadeParcelas = :quantidadeParcelas, valorFinal = :valorFinal, tipo = :tipo, finalizada = :finalizada, idEmpresa = :idEmpresa, idCliente = :idCliente, idFuncionarioAtendente = :idFuncionarioAtendente, idFuncionarioTecnico = :idFuncionarioTecnico where idOrdemDeServico = :idOrdemDeServico", array(
 
				":dataDeSolicitacao"=>$this->ordemDeServico->getDataSolicitacao(), 
				":descricao"=>$this->ordemDeServico->getDescricao(), 
				":dataDeExecucao"=>$this->ordemDeServico->getDataExecucao(), 
				":formaDePagamento"=>$this->ordemDeServico->getFormaPagamento(), 
				":desconto"=>$this->ordemDeServico->getDesconto(), 
				":quantidadeParcelas"=>$this->ordemDeServico->getNumeroParcelas(), 
				":valorFinal"=>$this->ordemDeServico->getValorTotal(), 
				":tipo"=>$this->ordemDeServico->getTipo(), 
				":finalizada"=>$this->ordemDeServico->getStatus(),
				":idEmpresa"=>$resultadoEmpresa[0]['idEmpresa'], 
				":idCliente"=>$resultadoCliente[0]['idCliente'], 
				":idFuncionarioAtendente"=>$resultadoAtendente[0]['idFuncionario'], 
				":idFuncionarioTecnico"=>$resultadoTecnico[0]['idFuncionario'],
				":idOrdemDeServico"=>$idOrdemDeServico
			));	
			
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
					":idOrdemDeServico"=>$idOrdemDeServico
				));	

				$resultadoItemPordutoAtual = $sql->select("select * from itemproduto where idItemProduto = :idItemProduto", array(
					":idItemProduto"=>$produto[0]['idItemProduto']
				));

				$sql->query("update itemproduto set quantidadeVenda = :quantidadeVenda where idItemProduto = :idItemProduto", array( 
					":quantidadeVenda"=>$_SESSION['carrinho'][$i]['quantidade'] + $resultadoItemPordutoAtual[0]['quantidadeVenda'],
					":idItemProduto"=>$produto[0]['idItemProduto']
				));	
			}

			//Insere na base de dados servicoordemdeservico todos os serviços que foram selecionados
			foreach ($this->ordemDeServico->getServicosArray() as $servico) {
				$servico = $sql->select("select * from servico where nome = :nome", array(
					":nome"=>$servico
				));

				$sql->query("insert into servicoordemdeservico (idServico, idOrdemDeServico) values (:idServico, :idOrdemDeServico)", array( 
					":idServico"=>$servico[0]['idServico'], 
					":idOrdemDeServico"=>$idOrdemDeServico
				));	
			}

			//Verifica se a ordem de serviço está sendo finalizada, caso esteja, cria as parcelas
			if($this->ordemDeServico->getStatus()){
				//Cria as parcelas para inserir no banco de dados
				$parcelasArray = array();
				$codigoParcela = $sql->select("select max(codigo) from parcela", array());	//Pega o maior código das parcelas

				//define o código da parcela como 1 caso seja o primeiro código a ser inserido, caso não seja o primeiro, incrementa o código da parcela
				if($codigoParcela == null){
					$codigoParcela = 1;				
				}
				else{
					$codigoParcela = $codigoParcela[0]['max(codigo)'] + 1;	
				}
				
				for ($i=0; $i < $this->ordemDeServico->getNumeroParcelas(); $i++) { 
					//cria as datas de vencimento com base no dia em que a ordem de serviço será executada somando meses igual a quantidade de parcelas que foram escolhidas
					$soma = 1+$i;
					$dataVencimento = date('Y-m-d', strtotime("+$soma month",strtotime($this->ordemDeServico->getDataExecucao()))); 

					$parcela = new Parcela($codigoParcela, $dataVencimento, $this->ordemDeServico->getNumeroParcelas(), $this->ordemDeServico->getValorParcela(), $soma);
					array_push($parcelasArray, $parcela);
				}	

				$parcelaDAO = new ParcelaDAO($parcelasArray, $this->getIdOrdemDeServico(), $resultadoCliente[0]['idCliente']);
				$parcelaDAO->cadastrar();
			}
		}
	}
?>