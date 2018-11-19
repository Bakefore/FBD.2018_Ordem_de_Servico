<?php  
	if((isset($_SESSION['login']))){
		//Caso o usuário já esteja logado, continua na mesma página
		if($_SESSION['acesso']['pesquisarFuncionario']){
			//Continua na página caso tenha permissão para utilizar
		}
		else{
			//Caso o usuário não tenha permissão, é redirecionado para a página principal
			header("Location: principal.php?erro=1");	
		}
	}
	else{
		//Caso não tenha dado inserido no login, o usuário é reencaminhado para fazer o login
		header("Location: ../../index.php?erro=1");	
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
		<div class="sessao" id="cadastrar-cliente">
			<div class="linha">
				<div class="coluna col12">
					<h2>Funcionário</h2>
				</div>	
				<form action="" method="">
					<!--Linha 1-->						
					<div class="coluna col8">
						<input type="text" name="input-cliente-nome" id="input-cliente-nome" placeholder="Pesquisar" required>
					</div>							
					<div class="coluna col2">
						<input type="submit" value="Buscar" class="botao-cadastro">
					</div>					
				</form>
				<div class="coluna col2">
					<input type="submit" value="Cadastrar" class="botao-cadastro" onclick="encaminharPagina('cadastrar_funcionario.php')">
				</div>
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