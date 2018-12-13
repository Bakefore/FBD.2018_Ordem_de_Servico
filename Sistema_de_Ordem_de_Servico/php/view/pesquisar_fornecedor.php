<?php  
	require_once("../config/config.php");
	require_once("../autoload/autoloadModel.php");
	require_once("../autoload/autoloadView.php");
	require_once("../autoload/autoloadDAO.php");

	verificarPermissao('pesquisarFornecedor');

	function pesquisar(){
		if(isset($_GET['input-pesquisar-fornecedor'])){
			echo "
			<div class='coluna col12 centralizado'>
				<div class='coluna col4 sem-padding-left linhaTabela'>
					<strong>Razão Social</strong>						
				</div>
				<div class='coluna col3 linhaTabela'>
					<strong>Nome Fantasia</strong>
				</div>
				<div class='coluna col3 linhaTabela'>
					<strong>CNPJ</strong>
				</div>	
				<div class='coluna col2 linhaTabela sem-padding-right'>				
				</div>
			</div>";

			$sql = new Sql();
			$resultadoFornecedor = $sql->select("select * from fornecedor where razaoSocial like :busca or nomeFantasia like :busca or cnpj like :busca", array(
				":busca"=>"%".$_GET['input-pesquisar-fornecedor']."%"
			));
			$impaPar = 'linhaTabelaPar';//linhaTabelaImpar - essa variável deve controlar o background de ímpar para par e assim fazer com que cores diferentes sejam utilizadas durante a listagem de produtos
			foreach ($resultadoFornecedor as $fornecedor) {				
				foreach ($fornecedor as $campo => $valor) {		
					$idFornecedor = $fornecedor['idFornecedor'];					
					if($campo == 'razaoSocial'){								
						echo "<div class='coluna col12 centralizado $impaPar'>";
						echo "<div class='coluna col4 sem-padding-left linhaTabela'>$valor</div>";

						if($impaPar == "linhaTabelaImpar"){
							$impaPar = "linhaTabelaPar";
						}
						else{
							$impaPar = "linhaTabelaImpar";
						}
					}
					if($campo == 'nomeFantasia'){						
						echo "<div class='coluna col3 linhaTabela'>$valor</div>";
					}
					if($campo == 'cnpj'){
						$valor = preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/','$1.$2.$3/$4-$5',$valor); //formatando o CNPJ
						echo "<div class='coluna col3 linhaTabela'>$valor</div>";

						echo "<div class='coluna col1'>
								<input type='button' class='botao-cadastro' onclick='editarEntidade($idFornecedor)' value='Editar'>
							</div>";

						echo "<div class='coluna col1 sem-padding-right'>
								<input type='button' class='botao-cadastro' onclick='excluirEntidade($idFornecedor)' value='Excluir'>
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

	    <script type="text/javascript">
	    	function excluirEntidade(id){	
				var tabela = 'fornecedor';
				if(confirm("Deseja realmente excluir?")){					
					window.location.href = "../controller/excluirEntidade.php?id=" + id + "&tabela=" + tabela;
				}
			}

			function editarEntidade(id){
				var tabela = 'fornecedor';									
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
		<div class="sessao" id="pesquisar-fornecedor">
			<div class="linha">
				<div class="coluna col12">
					<h2>Fornecedor</h2>
				</div>	
				<form action="" method="get">
					<!--Linha 1-->						
					<div class="coluna col8">
						<input type="text" name="input-pesquisar-fornecedor" id="input-pesquisar-fornecedor" placeholder="Pesquisar" required>
					</div>							
					<div class="coluna col2">
						<input type="submit" value="Buscar" class="botao-cadastro">
					</div>					
				</form>
				<div class="coluna col2">
					<input type="submit" value="Cadastrar" class="botao-cadastro" onclick="encaminharPagina('cadastrar_fornecedor.php')">
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