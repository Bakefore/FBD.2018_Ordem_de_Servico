<?php  
	require_once("../config/config.php");
	require_once("../autoload/autoloadModel.php");
	require_once("../autoload/autoloadView.php");
	require_once("../autoload/autoloadDAO.php");

	verificarPermissao('criarOrdemDeServico');

	//Verifica se o ID foi passado e cria uma sessão para representar o ID
	if(isset($_POST['id'])){
		$_SESSION['idParaSerEditado'] = $_POST['id'];
	}

	//mostra todos os dados atuais da entidade
	if(isset($_SESSION['idParaSerEditado'])){
		$sql = new Sql();

		$resultadoOrdemDeServico = $sql->select("select * from ordemDeServico where idOrdemDeServico = :idOrdemDeServico", array(
			":idOrdemDeServico"=>$_SESSION['idParaSerEditado']
		));

		$resultadoEmpresa = $sql->select("select * from empresa where idEmpresa = :idEmpresa", array(
			":idEmpresa"=>$resultadoOrdemDeServico[0]['idEmpresa']
		));
		
		$resultadoAtendente = $sql->select("select * from funcionario where idFuncionario = :idFuncionario", array(
			":idFuncionario"=>$resultadoOrdemDeServico[0]['idFuncionarioAtendente']
		));

		$resultadoTecnicoResponsavel = $sql->select("select * from funcionario where idFuncionario = :idFuncionario", array(
			":idFuncionario"=>$resultadoOrdemDeServico[0]['idFuncionarioTecnico']
		));

		$resultadoCliente = $sql->select("select * from cliente where idCliente = :idCliente", array(
			":idCliente"=>$resultadoOrdemDeServico[0]['idCliente']
		));

		$funcionarioAtendente = $resultadoAtendente[0]['nome'];
		$desconto = $resultadoOrdemDeServico[0]['desconto'];
		$parcelas = $resultadoOrdemDeServico[0]['quantidadeParcelas'];		
		$valorTotal = $resultadoOrdemDeServico[0]['valorFinal'];
		$valorParcela = $valorTotal / $parcelas;
		$descricao = $resultadoOrdemDeServico[0]['descricao'];
		$dataSolicitacao = $resultadoOrdemDeServico[0]['dataDeSolicitacao'];
		$dataExecucao = $resultadoOrdemDeServico[0]['dataDeExecucao'];
	}

	//Função que verifica se tem a quantidade de produtos que foi desejada pelo usuário
	function definirQauntidadeProdutos($quantidadeEmEstoque, $quantidadeSelecionada){
		if($quantidadeSelecionada <= $quantidadeEmEstoque){
			return $quantidadeSelecionada;
		}
		return $quantidadeEmEstoque;
	}

	function editarOrdemDeServico(){
		if((isset($_POST['select-os-empresa'])) && (isset($_POST['input-os-data-solicitacao'])) && (isset($_POST['input-os-atendente'])) 
			&& (isset($_POST['select-os-tipo'])) && (isset($_POST['select-os-cliente'])) && (isset($_POST['select-os-tecnico'])) 
			&& (isset($_POST['input-os-data-data-execucao'])) && (isset($_POST['select-os-forma-pagamento'])) 
			&& (isset($_POST['input-os-desconto'])) && (isset($_POST['input-os-valor-parcela'])) && (isset($_POST['input-os-quantidade-parcelas'])) 
			&& (isset($_POST['input-os-valor-total'])) && (isset($_POST['textarea-os-descricao']))){

			//Verifica os serviços selecionados
			$sql = new Sql();
			$quantidadeServico = $sql->select("select count(idServico) from servico", array());
			$servicosSelecionados = array();

			for ($i=0; $i < $quantidadeServico[0]['count(idServico)']; $i++) { 	
				//Define o name do servico que será passado por post
				$caminho = 'servico-'.$i;
				if(isset($_POST[$caminho])){
					array_push($servicosSelecionados, $_POST[$caminho]);	
				}
			}

			$ordemDeServico = new OrdemDeServico($servicosSelecionados, array(), $_POST['select-os-empresa'], $_POST['input-os-data-solicitacao'], 
				$_POST['input-os-atendente'], $_POST['select-os-tipo'], $_POST['select-os-cliente'], $_POST['select-os-tecnico'], 
				$_POST['input-os-data-data-execucao'], $_POST['select-os-forma-pagamento'], $_POST['input-os-desconto'], 
				$_POST['input-os-quantidade-parcelas'], $_POST['textarea-os-descricao'], $_POST['input-os-valor-parcela'], 
				$_POST['input-os-valor-total']);

			$ordemDeServico->setStatus($_POST['select-os-status']);

			//Verifica se a Ordem de Serviço vai ser posta como finalizada
			$sql = new Sql();

			$resultado = $sql->select("select * from ordemDeServico where idOrdemDeServico = :idOrdemDeServico", array(
				":idOrdemDeServico"=>$_SESSION['idParaSerEditado']
			));			

			$ordemDeServicoDAO = new OrdemDeServicoDAO($ordemDeServico);
			$ordemDeServicoDAO->editar($_SESSION['idParaSerEditado']);
			
			Mensagem::exibirMensagem("Ordem de Serviço editada com Sucesso!");

			//Retira os produtos do carrinho para não atrapalhar na próxima venda
			for ($i=0; $i < count($_SESSION['carrinho']); $i++) { 
				unset($_SESSION['carrinho'][$i]);
			}
		}
	}

	editarOrdemDeServico();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Sistema de Ordem de Serviço</title>

		<!--Normalize-->
		<link rel="stylesheet" type="text/css" href="../../css/normalize.css" />

		<!--Fontes-->
   		<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet" />

   		<!--Viewport-->
	    <meta name="viewport" content="width=device-width,initial-scale=1" />

	    <!--CSS da página-->
	    <link rel="stylesheet" type="text/css" href="../../common/css/estilo.css" />

	    <!--Ícone superior da página-->
	    <link rel="icon" type="image/x-icon" href="../../common/img/icon/codigo.ico" />	   

	    <!--JQuery-->
		<script src="../../common/js/jquery/jquery-3.2.1.min.js"></script> 

		<!--Configurações Gerais-->
		<script src="../../common/js/configuracoes.js"></script>

		<!-- Adicionando ViaCEP -->
	    <script src="../../common/js/buscar_cep.js"></script>

	    <!--  -->
	    <script type="text/javascript">
	    	function removerProdutoDoCarrinho(idProduto){
	    		window.location.href = "../controller/carrinho.php?deletar=" + idProduto;
	    	}
	    </script>
	</head>
	<body>
		<!--Menu Drop-down-->
		<div id="menu-dropdown" onblur="tirarDropdown()">			
			<ul>
				<?php  
					//faz a requisição da página que contém o menu superior do sistema
					require_once("menu.php");

					verificarMenuEmpresa();
					verificarMenuAcesso();
					verficarMenuFuncionario();
					verficarMenuCliente();	
					verficarMenuServico();	
					verificarMenuFornecedor();
					verficarMenuProduto();								
					verficarMenuOrdemDeServico();
					verficarMenuFinanceiro();
				?>
			</ul>			
		</div>
		
		<!-- Menu Superior -->
		<div class="header">
			<div class="linha">
				<header>
					<div class="coluna col3 logo">
						<h1>Adônis</h1>
					</div>	    			
					<div class="coluna col9">
						<ul class="menu" id="menu-superior">
							<?php  
								//faz a requisição da página que contém o menu superior do sistema
								require_once("menu.php");	

								verificarMenuEmpresa();
								verificarMenuAcesso();
								verficarMenuFuncionario();
								verficarMenuCliente();	
								verficarMenuServico();	
								verificarMenuFornecedor();
								verficarMenuProduto();								
								verficarMenuOrdemDeServico();
								verficarMenuFinanceiro();
							?>                  
						</ul>				
						<label onclick="mudarMenuDropdown()" id="botao-menu">&equiv;</label>			    				
					</div>
				</header>
			</div>
		</div>

		<!-- Conteúdo do Sistema -->
		<div class="sessao" id="criar-ordem-servico">
			<div class="linha">				
				<div class="coluna col12">
					<h2>Editar Ordem de Serviço</h2>
				</div>
				<form action="" method="post">
					<div class="coluna col12 sem-padding-right sem-padding-left">
						<div class="coluna col12">
							<h3>Serviços</h3>
						</div>
						<?php  
							$sql = new Sql();
							$servicos = $sql->select("select * from servico", array());
							$ordem = 0;
							foreach ($servicos as $servico) {				
								foreach ($servico as $campo => $valor) {									
									if($campo == 'nome'){
										echo "
										<div class='div-criar-acesso'>						
										    <input type='checkbox' value='$valor' name='servico-$ordem' id='servico-$ordem' />
										    <label for='servico-$ordem'>$valor</label>
										</div>";		
										$ordem++;								
									}											
								}								
							}	
						?>			
					</div>
					<div class="coluna col12 sem-padding-right sem-padding-left">
						<div class="coluna col12">
							<h3>Produtos</h3>
						</div>											
						<?php  
							for ($i=0; $i < count($_SESSION['carrinho']); $i++) { 
								$sql = new Sql();
								$produto = $sql->select("select * from itemproduto where idItemProduto = :idItemProduto", array(
									":idItemProduto"=>intval($_SESSION['carrinho'][$i]['id'])
								));								

								if ($produto[0]['quantidadeEstoque'] < $_SESSION['carrinho'][$i]['quantidade']) {
									$_SESSION['carrinho'][$i]['quantidade'] = $produto[0]['quantidadeEstoque'];
									//Faz a subtração dos produtos que tem no estoque com os que já foram vendidos para verificar quantos produtos podem ser vendidos
									$calculoDeQuantidade = $produto[0]['quantidadeEstoque'] - $produto[0]['quantidadeVenda'];
									Mensagem::exibirMensagem("O produto ".$produto[0]['nome']." só tem ".$calculoDeQuantidade." unidades!");
								}

								//Faz a subtração dos produtos que tem no estoque com os que já foram vendidos para verificar quantos produtos podem ser vendidos
								$calculoDeQuantidade = $produto[0]['quantidadeEstoque'] - $produto[0]['quantidadeVenda'];
								//Verifica se tem a quantidade de produtos que foi desejada pelo usuário
								$quantidadeProduto = definirQauntidadeProdutos($calculoDeQuantidade, $_SESSION['carrinho'][$i]['quantidade']);
								$_SESSION['carrinho'][$i]['quantidade'] = $quantidadeProduto;
								$produtoID = $_SESSION['carrinho'][$i]['id'];
								$nomeItemProduto = $produto[0]['nome'];
								$marcaItemProduto = $produto[0]['marca'];
								$precoItemProduto = $produto[0]['precoVenda'];

								echo "
								<div class='coluna col2'>
									<div class='coluna col2 rotulo-produto sem-padding-right sem-padding-left'>
										<p>Nome: $nomeItemProduto</p>
									</div>
									<div class='coluna col2 rotulo-produto sem-padding-right sem-padding-left'>
										<p>Marca: $marcaItemProduto</p>
									</div>
									<div class='coluna col2 rotulo-produto sem-padding-right sem-padding-left'>
										<p>Preço: $precoItemProduto</p>
									</div>
									<div class='coluna col2 rotulo-produto sem-padding-right sem-padding-left'>
										<p>Quantidade: $quantidadeProduto</p>
									</div>
									<div class='coluna col2 rotulo-produto sem-padding-right sem-padding-left'>
										<input type='button' value='Remover' class='botao-cadastro' onclick='removerProdutoDoCarrinho($produtoID)'>
									</div>
								</div>";
							}
							
						?>
						<div class="coluna col12">
							<div class="div-centralizada">
								<input type="button" value="Adicionar produto ao carrinho" class="botao-cadastro" onclick="encaminharPagina('pesquisar_produto.php')">
							</div>
						</div>
					</div>					
					<div class="coluna col4">
						<label for="select-os-empresa">Empresa *</label>
						<select name="select-os-empresa" id="select-os-empresa" required></select>
					</div>
					<div class="coluna col2">
						<label for="input-os-data-solicitacao">Data de Solitação *</label>
						<input type="date" name="input-os-data-solicitacao" id="input-os-data-solicitacao" required value="<?php if(isset($dataSolicitacao)){echo $dataSolicitacao;} ?>">
					</div>
					<div class="coluna col4">
						<label for="input-os-atendente">Atendente *</label>
						<input type="text" name="input-os-atendente" id="input-os-atendente" readonly="readonly" value="<?php if(isset($funcionarioAtendente)){echo $funcionarioAtendente;} ?>">
					</div>
					<div class="coluna col2">
						<label for="select-os-tipo">Tipo *</label>
						<select name="select-os-tipo" id="select-os-tipo" required>
							<option value="venda">Venda</option>
							<option value="suporte">Suporte</option>
						</select>
					</div>
					<div class="coluna col4">
						<label for="select-os-cliente">Cliente *</label>
						<select name="select-os-cliente" id="select-os-cliente" required></select>
					</div>
					<div class="coluna col4">
						<label for="select-os-tecnico">Técnico Responsável *</label>
						<select name="select-os-tecnico" id="select-os-tecnico" required></select>
					</div>
					<div class="coluna col2">
						<label for="input-os-data-data-execucao">Data de Execução *</label>
						<input type="date" name="input-os-data-data-execucao" id="input-os-data-data-execucao" required value="<?php if(isset($dataExecucao)){echo $dataExecucao;} ?>">
					</div>
					<div class="coluna col2">
						<label for="select-os-forma-pagamento">Pagamento *</label>
						<select name="select-os-forma-pagamento" id="select-os-forma-pagamento" required>
							<option value="À Vista">À Vista</option>
							<option value="À Prazo">À Prazo</option>
						</select>
					</div>
					<div class="coluna col2">
						<label for="input-os-desconto">Desconto *</label>
						<input type="text" name="input-os-desconto" id="input-os-desconto" onblur="calcularValorTotal()" required value="<?php if(isset($desconto)){echo $desconto;} ?>">

						<label for="input-os-valor-parcela">Valor da Parcela *</label>
						<input type="text" name="input-os-valor-parcela" id="input-os-valor-parcela" onblur="calcularValorTotal()" required value="<?php if(isset($valorParcela)){echo $valorParcela;} ?>">
					</div>
					<div class="coluna col2">
						<label for="input-os-quantidade-parcelas">Parcelas *</label>
						<input type="number" name="input-os-quantidade-parcelas" id="input-os-quantidade-parcelas" onblur="calcularValorTotal()" required value="<?php if(isset($parcelas)){echo $parcelas;} ?>">

						<label for="input-os-valor-total">Valor Total</label>
						<input type="text" name="input-os-valor-total" id="input-os-valor-total" readonly="readonly" value="<?php if(isset($valorTotal)){echo $valorTotal;} ?>">
					</div>
					<div class="coluna col8">
						<label for="textarea-os-descricao">Descrição *</label>
						<textarea class="descricao-servico" id="textarea-os-descricao" name="textarea-os-descricao" required><?php if(isset($descricao)){echo $descricao;} ?></textarea>
					</div>
					<div class="coluna col2">
						<label for="select-os-status">Status *</label>
						<select name="select-os-status" id="select-os-status">
							<option value="0">Aberta</option>
							<option value="1">Finalizada</option>
						</select>
					</div>
					<div class="coluna col12">
						<div class="div-centralizada">
							<input type="submit" value="Editar Ordem de Serviço" class="botao-cadastro">
						</div>
					</div>
				</form>
				<div class="coluna col12">
					<div class="div-centralizada">
						<input type="submit" value="Voltar ao Menu Principal" class="botao-cadastro" onclick="voltarParaMenuPrincipal()">
					</div>
				</div>
			</div>
		</div>				

		<div class="footer">
			<div class="linha">
				<footer>
					<div class="coluna col12">
						<span>&copy; 2018 - PietroTelino | Todos os direitos reservados</span>
					</div>
				</footer>
			</div>
		</div>	

		<!-- Preenchendo campos de UF -->
	    <script src="../../common/js/preencher_uf.js"></script>

	    <script type="text/javascript">
	    	function calcularValorTotal(){
	    		//Calcula o valor total da Ordem de Serviço de forma automática
	    		var valorParcela = parseFloat(document.getElementById('input-os-valor-parcela').value);
	    		var quantidade = parseFloat(document.getElementById('input-os-quantidade-parcelas').value);
	    		var desconto = parseFloat(document.getElementById('input-os-desconto').value);
	    		var valorTotal = (valorParcela * quantidade) - desconto;
	    		document.getElementById('input-os-valor-total').value = valorTotal;		
	    	}

	    	inserirEstados('select-empresa-uf');	    	
	    </script>   	 
	</body>
</html>
<?php  
	//Editar esta condição para que fique da seguinte forma: caso o usuário logado for um superadmin, todas as empresas serão exibidas no combobox, mas caso não seja, deve aparecer apenas a empresa pelo qual aquele funcionário foi cadastrado
	if($_SESSION['acesso']['nome'] == 'superadmin'){		//Caso for um superadmin, mostra todas as empresas possíveis
		$sql = new Sql();
		$empresas = $sql->select("select * from empresa", array());
		foreach ($empresas as $empresa) {				
			foreach ($empresa as $campo => $valor) {
				if($campo == 'razaoSocial'){
					echo "
					<script>
						var option = document.createElement('option');
						option.text = '$valor';
						option.value = '$valor';
						document.getElementById('select-os-empresa').appendChild(option);
					</script>";
				}				
			}
		}		
	}
	else{
		$empresa = $_SESSION['empresa']['razaoSocial'];
		echo "
		<script>
			var option = document.createElement('option');
			option.text = '$empresa';
			option.value = '$empresa';
			document.getElementById('select-os-empresa').appendChild(option);
		</script>";
	}

	//Deve executar uma função que vai listar todos os clientes cadastrados no sistema		
	$sql = new Sql();
	$empresas = $sql->select("select * from cliente", array());
	foreach ($empresas as $empresa) {				
		foreach ($empresa as $campo => $valor) {
			if($campo == 'nome'){
				echo "
				<script>
					var option = document.createElement('option');
					option.text = '$valor';
					option.value = '$valor';
					document.getElementById('select-os-cliente').appendChild(option);
				</script>";
			}				
		}
	}	

	//Deve executar uma função que vai listar todos os funcionários cadastrados no sistema		
	$sql = new Sql();
	$empresas = $sql->select("select * from funcionario", array());
	foreach ($empresas as $empresa) {				
		foreach ($empresa as $campo => $valor) {
			if($campo == 'nome'){
				echo "
				<script>
					var option = document.createElement('option');
					option.text = '$valor';
					option.value = '$valor';
					document.getElementById('select-os-tecnico').appendChild(option);
				</script>";
			}				
		}
	}		
?>
<script type="text/javascript">
	document.getElementById('select-os-empresa').value = '<?php if(isset($resultadoEmpresa[0]['razaoSocial'])){echo $resultadoEmpresa[0]['razaoSocial'];} ?>';
	document.getElementById('select-os-tipo').value = '<?php if(isset($resultadoOrdemDeServico[0]['tipo'])){echo $resultadoOrdemDeServico[0]['tipo'];} ?>';
	document.getElementById('select-os-cliente').value = '<?php if(isset($resultadoCliente[0]['nome'])){echo $resultadoCliente[0]['nome'];} ?>';
	document.getElementById('select-os-tecnico').value = '<?php if(isset($resultadoTecnicoResponsavel[0]['nome'])){echo $resultadoTecnicoResponsavel[0]['nome'];} ?>';
	document.getElementById('select-os-forma-pagamento').value = '<?php if(isset($resultadoOrdemDeServico[0]['formaDePagamento'])){echo $resultadoOrdemDeServico[0]['formaDePagamento'];} ?>';
	document.getElementById('select-os-status').value = '<?php if(isset($resultadoOrdemDeServico[0]['finalizada'])){echo $resultadoOrdemDeServico[0]['finalizada'];} ?>';
</script>