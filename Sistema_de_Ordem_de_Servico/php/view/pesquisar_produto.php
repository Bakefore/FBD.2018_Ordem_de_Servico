<?php  
	require_once("../config/config.php");
	require_once("../autoload/autoloadModel.php");
	require_once("../autoload/autoloadView.php");
	require_once("../autoload/autoloadDAO.php");

	verificarPermissao('pesquisarProduto');

	function pesquisarProduto(){
		if(isset($_POST['input-pesquisar-produto'])){
			Mensagem::exibirMensagem("Pesquisa teste!");
		}
	}

	pesquisarProduto();
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
		<div class="sessao" id="pesquisar-produto">
			<div class="linha">
				<div class="coluna col12">
					<h2>Produto</h2>
				</div>	
				<form action="" method="post">
					<!--Linha 1-->						
					<div class="coluna col8">
						<input type="text" name="input-pesquisar-produto" id="input-pesquisar-produto" placeholder="Pesquisar" required>
					</div>							
					<div class="coluna col2">
						<input type="submit" value="Buscar" class="botao-cadastro">
					</div>		
				</form>				
				<div class="coluna col2">
					<input type="submit" value="Cadastrar" class="botao-cadastro" onclick="encaminharPagina('cadastrar_produto.php')">
				</div>
				<!--Listar Abaixo todos os produtos que foram pesquisados    Nome | Data de Validade | Marca | Modelo | Quantidade-->
				<div class="coluna col12 centralizado">
					<div class="coluna col3 sem-padding-left linhaTabela">
						<strong>Nome</strong>						
					</div>
					<div class="coluna col2 linhaTabela">
						<strong>Marca</strong>
					</div>
					<div class="coluna col2 linhaTabela">
						<strong>Data de Validade</strong>
					</div>					
					<div class="coluna col2 linhaTabela">
						<strong>Quantidade</strong>
					</div>
					<div class="coluna col3 linhaTabela sem-padding-right">
						<!--strong>Ações</strong-->
					</div>
				</div>
				<!-- Exemplo de como deve ser feita a listagem de objetos
				<div class="coluna col12 centralizado linhaTabelaPar">
					<div class="coluna col3 sem-padding-left linhaTabela">Nome</div>
					<div class="coluna col2 linhaTabela">Marca</div>
					<div class="coluna col2 linhaTabela">Data de Validade</div>					
					<div class="coluna col2 sem-padding-right linhaTabela">Quantidade</div>
					<div class="coluna col1">
						<input type="button" class="botao-cadastro" value="Carrinho">
					</div>
					<div class="coluna col1">
						<input type="button" class="botao-cadastro" value="Editar">
					</div>
					<div class="coluna col1">
						<input type="button" class="botao-cadastro" value="Excluir">
					</div>
				</div>
				<div class="coluna col12 centralizado linhaTabelaImpar">
					<div class="coluna col3 sem-padding-left linhaTabela">Nome</div>
					<div class="coluna col2 linhaTabela">Marca</div>
					<div class="coluna col2 linhaTabela">Data de Validade</div>					
					<div class="coluna col2 sem-padding-right linhaTabela">Quantidade</div>
					<div class="coluna col1">
						<input type="button" class="botao-cadastro" value="Carrinho">
					</div>
					<div class="coluna col1">
						<input type="button" class="botao-cadastro" value="Editar">
					</div>
					<div class="coluna col1">
						<input type="button" class="botao-cadastro" value="Excluir">
					</div>
				</div>
				-->
				<?php  
					$sql = new Sql();
					$resultadoItemProduto = $sql->select("select * from itemproduto", array());
					$impaPar = 'linhaTabelaPar';//linhaTabelaImpar - essa variável deve controlar o background de ímpar para par e assim fazer com que cores diferentes sejam utilizadas durante a listagem de produtos
					foreach ($resultadoItemProduto as $itemProduto) {				
						foreach ($itemProduto as $campo => $valor) {							
							if($campo == 'nome'){								
								echo "<div class='coluna col12 centralizado $impaPar'>";
								echo "<div class='coluna col3 sem-padding-left linhaTabela'>$valor</div>";

								if($impaPar == "linhaTabelaImpar"){
									$impaPar = "linhaTabelaPar";
								}
								else{
									$impaPar = "linhaTabelaImpar";
								}
							}
							if($campo == 'marca'){
								echo "<div class='coluna col2 linhaTabela'>$valor</div>";
							}
							if($campo == 'dataValidade'){
								$valor = date('d/m/Y',  strtotime($valor));
								echo "<div class='coluna col2 linhaTabela'>$valor</div>";
							}
							if($campo == 'quantidadeEstoque'){
								echo "<div class='coluna col2 sem-padding-right linhaTabela'>$valor</div>";

								echo "<div class='coluna col1'>
										<input type='button' class='botao-cadastro' value='Carrinho'>
									</div>";

								echo "<div class='coluna col1'>
										<input type='button' class='botao-cadastro' value='Editar'>
									</div>";

								echo "<div class='coluna col1'>
										<input type='button' class='botao-cadastro' value='Excluir'>
									</div>";
										
								echo "</div>";
							}		
						}
					}
				?>
			</div>
		</div>			

		<div class="footer absolute-bottom">
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