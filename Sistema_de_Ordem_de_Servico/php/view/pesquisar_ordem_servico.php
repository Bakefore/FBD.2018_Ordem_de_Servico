<?php  
	require_once("../config/config.php");
	require_once("../autoload/autoloadModel.php");
	require_once("../autoload/autoloadView.php");
	require_once("../autoload/autoloadDAO.php");

	verificarPermissao('pesquisarOrdemDeServico');

	function pesquisar(){
		if(isset($_POST['input-ordem-de-servico'])){
			echo "
			<div class='coluna col12 centralizado'>
				<div class='coluna col2 sem-padding-left linhaTabela'>
					<strong>Data de Solicitação</strong>						
				</div>
				<div class='coluna col2 linhaTabela'>
					<strong>Forma de Pagamento</strong>
				</div>
				<div class='coluna col2 linhaTabela'>
					<strong>Valor Total</strong>
				</div>
				<div class='coluna col2 linhaTabela'>
					<strong>Cliente</strong>
				</div>
				<div class='coluna col2 linhaTabela'>
					<strong>Atendente</strong>
				</div>	
				<div class='coluna col2 linhaTabela sem-padding-right'>				
				</div>
			</div>";

			$sql = new Sql();
			$resultadoItemProduto = $sql->select("select * from ordemDeServico where dataDeSolicitacao like :busca or descricao like :busca or dataDeExecucao like :busca or formaDePagamento like :busca or desconto like :busca or quantidadeParcelas like :busca or valorFinal like :busca or tipo like :busca", array(
				":busca"=>"%".$_POST['input-ordem-de-servico']."%"
			));
			$impaPar = 'linhaTabelaPar';//linhaTabelaImpar - essa variável deve controlar o background de ímpar para par e assim fazer com que cores diferentes sejam utilizadas durante a listagem de produtos
			foreach ($resultadoItemProduto as $itemProduto) {				
				foreach ($itemProduto as $campo => $valor) {						
					if($campo == 'dataDeSolicitacao'){								
						echo "<div class='coluna col12 centralizado $impaPar'>";
						$valor = date('d/m/Y',  strtotime($valor));	//Converte a data para o formato brasileiro
						echo "<div class='coluna col2 sem-padding-left linhaTabela'>$valor</div>";

						if($impaPar == "linhaTabelaImpar"){
							$impaPar = "linhaTabelaPar";
						}
						else{
							$impaPar = "linhaTabelaImpar";
						}
					}

					if($campo == 'formaDePagamento'){
						echo "<div class='coluna col2 linhaTabela'>$valor</div>";
					}

					if($campo == 'valorFinal'){
						echo "<div class='coluna col2 linhaTabela'>$valor</div>";
					}

					if($campo == 'idCliente'){
						$resultadoCliente = $sql->select("select * from cliente where idCliente = :idCliente", array(
							":idCliente"=>$valor
						));
						$valor = $resultadoCliente[0]['nome'];
						echo "<div class='coluna col2 linhaTabela'>$valor</div>";
					}
					
					if($campo == 'idFuncionarioAtendente'){
						$resultadoAtendente = $sql->select("select * from funcionario where idFuncionario = :idFuncionario", array(
							":idFuncionario"=>$valor
						));
						$valor = $resultadoAtendente[0]['nome'];
						echo "<div class='coluna col2 linhaTabela'>$valor</div>";

						echo "<div class='coluna col1'>
								<input type='button' class='botao-cadastro' value='Editar'>
							</div>";

						echo "<div class='coluna col1 sem-padding-right'>
								<input type='button' class='botao-cadastro' value='Excluir'>
							</div>";
								
						echo "</div>";						
					}	
				}
			}
		}
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

	    <!--Ícone superior da página-->
	    <link rel="icon" type="image/x-icon" href="../../common/img/icon/codigo.ico" />	   

	    <!--JQuery-->
		<script src="../../common/js/jquery/jquery-3.2.1.min.js"></script> 

		<!--Configurações Gerais-->
		<script src="../../common/js/configuracoes.js"></script>

		<!-- Adicionando ViaCEP -->
	    <script src="../../common/js/buscar_cep.js"></script>

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
		<div class="sessao" id="pesquisar-ordem-de-servico">
			<div class="linha">
				<div class="coluna col12">
					<h2>Ordem de Serviço</h2>
				</div>	
				<form action="" method="post">
					<!--Linha 1-->						
					<div class="coluna col8">
						<input type="text" name="input-ordem-de-servico" id="input-ordem-de-servico" placeholder="Pesquisar" required>
					</div>							
					<div class="coluna col2">
						<input type="submit" value="Buscar" class="botao-cadastro">
					</div>					
				</form>
				<div class="coluna col2">
					<input type="submit" value="Criar" class="botao-cadastro" onclick="encaminharPagina('criar_ordem_servico.php')">
				</div>
				<?php  					
					pesquisar();					
				?>
			</div>
		</div>			

		<div class="footer"><!--absolute-bottom-->
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