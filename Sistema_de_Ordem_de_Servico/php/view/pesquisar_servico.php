<?php  
	require_once("../config/config.php");
	require_once("../autoload/autoloadModel.php");
	require_once("../autoload/autoloadView.php");
	require_once("../autoload/autoloadDAO.php");

	verificarPermissao('pesquisarServico');

	function pesquisar(){
		if(isset($_GET['input-pesquisar-servico'])){
			echo "
			<div class='coluna col12 centralizado'>
				<div class='coluna col2 sem-padding-left linhaTabela'>
					<strong>Nome</strong>						
				</div>
				<div class='coluna col2 linhaTabela'>
					<strong>Tipo</strong>
				</div>
				<div class='coluna col4 linhaTabela'>
					<strong>Descrição</strong>
				</div>					
				<div class='coluna col2 linhaTabela'>
					<strong>Valor</strong>
				</div>
				<div class='coluna col2 linhaTabela sem-padding-right'>				
				</div>
			</div>";

			$sql = new Sql();
			$resultadoServico = $sql->select("select * from servico where nome like :busca or tipo like :busca or descricao like :busca or valor like :busca", array(
				":busca"=>"%".$_GET['input-pesquisar-servico']."%"
			));
			$impaPar = 'linhaTabelaPar';//linhaTabelaImpar - essa variável deve controlar o background de ímpar para par e assim fazer com que cores diferentes sejam utilizadas durante a listagem de produtos
			foreach ($resultadoServico as $servico) {				
				foreach ($servico as $campo => $valor) {	
					$idServico = $servico['idServico'];						
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
					if($campo == 'tipo'){
						echo "<div class='coluna col2 linhaTabela'>$valor</div>";
					}
					if($campo == 'descricao'){
						echo "<div class='coluna col4 linhaTabela'>$valor</div>";
					}
					if($campo == 'valor'){
						echo "<div class='coluna col2 linhaTabela'>$valor</div>";

						echo "<div class='coluna col1'>
								<input type='button' class='botao-cadastro' onclick='editarEntidade($idServico)' value='&#9998;'>
							</div>";

						echo "<div class='coluna col1 sem-padding-right'>
								<input type='button' class='botao-cadastro' onclick='excluirEntidade($idServico)' value='&#10005;'>
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
				var tabela = 'servico';
				if(confirm("Deseja realmente excluir?")){					
					window.location.href = "../controller/excluirEntidade.php?id=" + id + "&tabela=" + tabela;
				}
			}

			function editarEntidade(id){
				var tabela = 'servico';									
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
		<div class="sessao" id="pesquisar-servico">
			<div class="linha">
				<div class="coluna col12">
					<h2>Serviço</h2>
				</div>	
				<form action="" method="get">
					<!--Linha 1-->						
					<div class="coluna col8">
						<input type="text" name="input-pesquisar-servico" id="input-pesquisar-servico" placeholder="Pesquisar" required>
					</div>							
					<div class="coluna col2">
						<input type="submit" value="Buscar" class="botao-cadastro">
					</div>					
				</form>
				<div class="coluna col2">
					<input type="submit" value="Criar" class="botao-cadastro" onclick="encaminharPagina('cadastrar_servico.php')">
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