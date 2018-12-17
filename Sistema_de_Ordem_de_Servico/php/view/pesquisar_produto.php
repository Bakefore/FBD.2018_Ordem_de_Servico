<?php  
	require_once("../config/config.php");
	require_once("../autoload/autoloadModel.php");
	require_once("../autoload/autoloadView.php");
	require_once("../autoload/autoloadDAO.php");

	verificarPermissao('pesquisarProduto');

	function pesquisar(){
		if(isset($_GET['input-pesquisar-produto'])){
			echo "
			<div class='coluna col12 centralizado'>
				<div class='coluna col2 sem-padding-left linhaTabela'>
					<strong>Nome</strong>						
				</div>
				<div class='coluna col2 linhaTabela'>
					<strong>Marca</strong>
				</div>
				<div class='coluna col2 linhaTabela'>
					<strong>Data de Validade</strong>
				</div>								
				<div class='coluna col1 linhaTabela'>
					<strong>Quantidade</strong>
				</div>
				<div class='coluna col2 linhaTabela'>
					<strong>Preço</strong>
				</div>				
				<div class='coluna col3 linhaTabela sem-padding-right'>				
				</div>
			</div>";

			$sql = new Sql();
			$resultadoItemProduto = $sql->select("select * from itemproduto where nome like :busca or marca like :busca or modelo like :busca or desconto like :busca or dataCompra like :busca or dataValidade like :busca or codigoDeBarra like :busca or quantidadeEstoque like :busca or valorCompra like :busca or porcentagemAtacado like :busca or porcentagemVarejo like :busca", array(
				":busca"=>"%".$_GET['input-pesquisar-produto']."%"
			));
			$impaPar = 'linhaTabelaPar';//linhaTabelaImpar - essa variável deve controlar o background de ímpar para par e assim fazer com que cores diferentes sejam utilizadas durante a listagem de produtos
			
			$valorPesquisa = $_GET['input-pesquisar-produto'];

			foreach ($resultadoItemProduto as $itemProduto) {				
				foreach ($itemProduto as $campo => $valor) {		
					$idItemProduto = $itemProduto['idItemProduto'];
					
					if($campo == 'nome'){								
						echo "<div class='coluna col12 centralizado $impaPar'>";
						echo "<div class='coluna col2 sem-padding-left linhaTabela'>$valor</div>";

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
						$valor = $itemProduto['quantidadeEstoque'] - $itemProduto['quantidadeVenda'];
						echo "<div class='coluna col1 linhaTabela'>$valor</div>";						
					}
					if($campo == 'precoVenda'){
						echo "<div class='coluna col2 linhaTabela'>$valor</div>";

						echo "<div class='coluna col1'>
								<input type='button' class='botao-cadastro' onclick='adicionarAoCarrinho($idItemProduto)' value='Carrinho'>
							</div>";

						echo "<div class='coluna col1'>
								<input type='button' class='botao-cadastro' onclick='editarEntidade($idItemProduto)' value='Editar'>
							</div>";

						echo "<div class='coluna col1 sem-padding-right'>
								<input type='button' class='botao-cadastro' onclick='excluirEntidade($idItemProduto)' value='Excluir'>
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

		<!--Normalize
		<link rel="stylesheet" type="text/css" href="../../css/normalize.css" />-->

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

	    <script type="text/javascript">
	    	function adicionarAoCarrinho(idProduto){
	    		var quantidade = prompt("Digite a Quantidade a ser inserida");
	    		if(verificarNumero(quantidade)){
	    			quantidade = parseInt(quantidade);
	    			alert("Item adicionado ao carrinho!");
	    			window.location.href = "../controller/carrinho.php?id=" + idProduto + "&quantidade="+quantidade;
	    		}
	    		else{
	    			alert("Insira um valor numérico para quantidade!");
	    		}				
			}
			
			function verificarNumero(n) {
			    return !isNaN(parseFloat(n)) && isFinite(n);
			}

			function excluirEntidade(id){	
				var tabela = 'itemproduto';
				if(confirm("Deseja realmente excluir?")){					
					window.location.href = "../controller/excluirEntidade.php?id=" + id + "&tabela=" + tabela;
				}
			}

			function editarEntidade(id){
				var tabela = 'itemproduto';									
				window.location.href = "../controller/editarEntidade.php?id=" + id + "&tabela=" + tabela;				
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
		<div class="sessao" id="pesquisar-produto">
			<div class="linha">
				<div class="coluna col12">
					<h2>Produto</h2>
				</div>	
				<form action="" method="get">
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