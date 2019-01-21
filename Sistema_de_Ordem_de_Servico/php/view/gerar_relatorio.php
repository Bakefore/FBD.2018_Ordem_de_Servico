<?php  
	require_once("../config/config.php");
	require_once("../autoload/autoloadModel.php");
	require_once("../autoload/autoloadView.php");
	require_once("../autoload/autoloadDAO.php");

	verificarPermissao('exibirFinanceiro');

	if(!(isset($_SESSION['totalContasRecebidas'])) && (isset($_SESSION['totalContasAReceber']))){
		$_SESSION['totalContasRecebidas'] = 0;
		$_SESSION['totalContasAReceber'] = 0;	
	}	

	$_SESSION['totalContasRecebidas'] = 0;
	$_SESSION['totalContasAReceber'] = 0;	

	function setarValor($valor, $dataVencimento, $precoParcela){
		if((isset($_SESSION['totalContasRecebidas'])) && (isset($_SESSION['totalContasAReceber']))){
			//Define o ícone com um X caso a parcela não tenha sido paga
			if(strtotime($dataVencimento) < strtotime(date('Y-m-d'))){
				$_SESSION['totalContasAReceber'] += $precoParcela;
				return "Vencido";
			}
			else{
				if($valor == 0){
					$_SESSION['totalContasRecebidas'] += $precoParcela;
					return "Pago";
				}
				$_SESSION['totalContasAReceber'] += $precoParcela;
				return "À Receber";
			}
		}
	}

	function gerarRelatorio(){
		if((isset($_POST['input-periodo-inicio'])) && (isset($_POST['input-periodo-fim'])) && 
			(isset($_POST['select-filtro-status']))){			

			if($_POST['select-filtro-status'] == "Geral"){
				parcelasRecebidas();
				parcelasAbertas();
				parcelasVencidas();
			}
			else if($_POST['select-filtro-status'] == "Recebidas"){
				parcelasRecebidas();
			}
			else if($_POST['select-filtro-status'] == "Abertas"){
				parcelasAbertas();
			}
			else{
				parcelasVencidas();
			}

			echo "
			<div class='coluna col12 centralizado'>						
				<h2>Resumo</h2>				
			</div>
			<div class='coluna col12 centralizado'>					
				<h2>Total Recebido: R$ $_SESSION[totalContasRecebidas]</h2>							
			</div>
			<div class='coluna col12 centralizado'>									
				<h2>Total a Receber: R$ $_SESSION[totalContasAReceber]</h2>									
			</div>";

			$_SESSION['totalContasRecebidas'] = 0;
			$_SESSION['totalContasAReceber'] = 0;
			//Zera as contas
		}
	}

	function exibirRelatorio($titulo, $resultadoParcelas){
		echo "
		<div class='coluna col12'>
			<div class='div-centralizada'>
				<h2>$titulo</h2>
			</div>
		</div>";

		echo "
		<div class='coluna col12 centralizado'>
			<div class='coluna col4 sem-padding-left linhaTabela'>
				<strong>Cliente</strong>						
			</div>
			<div class='coluna col2 linhaTabela'>
				<strong>Data de Vencimento</strong>
			</div>
			<div class='coluna col2 linhaTabela'>
				<strong>Status</strong>
			</div>
			<div class='coluna col2 linhaTabela'>
				<strong>Valor</strong>
			</div>
			<div class='coluna col2 linhaTabela sem-padding-right'>
				<strong>Número da Parcela</strong>
			</div>	
		</div>";

		$sql = new Sql();

		$impaPar = 'linhaTabelaPar';//linhaTabelaImpar - essa variável deve controlar o background de ímpar para par e assim fazer com que cores diferentes sejam utilizadas durante a listagem de produtos
		foreach ($resultadoParcelas as $parcelas) {				
			foreach ($parcelas as $campo => $valor) {	
				$idParcela = $parcelas['idParcela'];	
				$dataVencimento = $parcelas['dataVencimento'];	
				$precoParcela = $parcelas['valor'];
				
				if($campo == 'codigo'){
					$resultadoCliente = $sql->select("select * from cliente where idCliente = :idCliente", array(
						":idCliente"=>$parcelas['idCliente']
					));

					echo "<div class='coluna col12 centralizado $impaPar'>";
					$cliente = $resultadoCliente[0]['nome'];
					echo "<div class='coluna col4 sem-padding-left linhaTabela'>$cliente</div>";

					if($impaPar == "linhaTabelaImpar"){
						$impaPar = "linhaTabelaPar";
					}
					else{
						$impaPar = "linhaTabelaImpar";
					}
				}				

				if($campo == 'dataVencimento'){
					$valor = date('d/m/Y',  strtotime($valor));
					echo "<div class='coluna col2 linhaTabela'>$valor</div>";
				}

				if($campo == 'ativo'){
					$valor = setarValor($valor, $dataVencimento, $precoParcela);
					echo "<div class='coluna col2 linhaTabela'>$valor</div>";
				}

				if($campo == 'valor'){
					echo "<div class='coluna col2 linhaTabela'>$valor</div>";
				}
				
				if($campo == 'parcelaAtual'){
					echo "<div class='coluna col2 linhaTabela sem-padding-right'>$valor</div>";
							
					echo "</div>";						
				}	
			}
		}
	}

	function parcelasRecebidas(){
		$sql = new Sql();
		$resultadoParcelas = $sql->select("select * from parcela where ativo = :status and dataVencimento <= :maiorData and dataVencimento >= :menorData", array(
			":status"=>0,
			":maiorData"=>$_POST['input-periodo-fim'],
			":menorData"=>$_POST['input-periodo-inicio']
		));
		exibirRelatorio("Contas Recebidas", $resultadoParcelas);
	}

	function parcelasAbertas(){
		$sql = new Sql();
		$resultadoParcelas = $sql->select("select * from parcela where ativo = :status and dataVencimento <= :maiorData and dataVencimento >= :menorData", array(
			":status"=>1,
			":maiorData"=>$_POST['input-periodo-fim'],
			":menorData"=>$_POST['input-periodo-inicio']
		));
		exibirRelatorio("Contas Abertas", $resultadoParcelas);
	}

	function parcelasVencidas(){	
		$sql = new Sql();
		$resultadoParcelas = $sql->select("select * from parcela where dataVencimento < :dataAtual and dataVencimento <= :maiorData and dataVencimento >= :menorData", array(

			":dataAtual"=>date('Y-m-d'),
			":maiorData"=>$_POST['input-periodo-fim'],
			":menorData"=>$_POST['input-periodo-inicio']			
		));
		exibirRelatorio("Contas Vencidas", $resultadoParcelas);
		
	}	
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
	     <link rel="stylesheet" type="text/css" href="../../common/css/impressao.css" />

	    <!--Ícone superior da página-->
	    <link rel="icon" type="image/x-icon" href="../../common/img/icon/codigo.ico" />	   

	    <!--JQuery-->
		<script src="../../common/js/jquery/jquery-3.2.1.min.js"></script> 

		<!--Configurações Gerais-->
		<script src="../../common/js/configuracoes.js"></script>

		<!-- Adicionando ViaCEP -->
	    <script src="../../common/js/buscar_cep.js"></script>

	    <script type="text/javascript">
	    	function excluirEntidade(id){	
				var tabela = 'parcela';
				if(confirm("Deseja realmente excluir?")){					
					window.location.href = "../controller/excluirEntidade.php?id=" + id + "&tabela=" + tabela;
				}
			}

			function editarEntidade(id){
				var tabela = 'parcela';									
				window.location.href = "../controller/editarEntidade.php?id=" + id + "&tabela=" + tabela;				
			}

			function imprimir(){
				window.print();
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
		<div class="sessao" id="pesquisar-parcelas">
			<div class="linha">
				<div class="coluna col12 nao-imprimir">
					<h2>Gerar Relatório</h2>
				</div>	
				<form action="" method="post">
					<!--Linha 1-->						
					<div class="coluna col2 nao-imprimir">
						<label for="input-periodo-inicio">Início *</label>
						<input type="date" name="input-periodo-inicio" id="input-periodo-inicio" placeholder="Pesquisar" required>
					</div>
					<div class="coluna col2 nao-imprimir">
						<label for="input-periodo-fim">Fim *</label>
						<input type="date" name="input-periodo-fim" id="input-periodo-fim" placeholder="Pesquisar" required>
					</div>					
					<div class="coluna col2 nao-imprimir">
						<label for="select-filtro-status">Status *</label>
						<select name="select-filtro-status" id="select-filtro-status" required>
							<option value="Geral">Geral</option>							
							<option value="Recebidas">Recebidas</option>
							<option value="Abertas">Abertas</option>
							<option value="Vencidas">Vencidas</option>
						</select>
					</div>										
					<div class="coluna col2 nao-imprimir">
						<br>
						<input type="submit" value="Gerar Relatório" class="botao-cadastro">
					</div>										
				</form>	
				<div class="coluna col2 nao-imprimir">		
					<br>			
					<input type="submit" value="Voltar ao Menu" class="botao-cadastro" onclick="voltarParaMenuPrincipal()">					
				</div>
				<div class="coluna col2 nao-imprimir">		
					<br>			
					<input type="submit" value="Imprimir" class="botao-cadastro" onclick="imprimir()">					
				</div>
				<?php gerarRelatorio(); ?>
			</div>
		</div>			

		<div class="footer nao-imprimir"><!--absolute-bottom-->
			<div class="linha">
				<footer>
					<div class="coluna col12">
						<span>&copy; 2018 - PietroTelino | Todos os direitos reservados</span>
					</div>
				</footer>
			</div>
		</div>	
	</body>
</html>