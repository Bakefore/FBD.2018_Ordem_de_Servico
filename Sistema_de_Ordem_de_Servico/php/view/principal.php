<?php  
	require_once("../config/config.php");
	require_once("../autoload/autoloadModel.php");
	require_once("../autoload/autoloadView.php");

	if((isset($_POST['input-login'])) && (isset($_POST['input-senha']))){
		$sql = new Sql();
		$usuario = $sql->select("select * from funcionario where login = :login and senha = :senha", array(
			":login"=>$_POST['input-login'],
			":senha"=>$_POST['input-senha']
		));

		if($usuario == null){
			//Caso a senha e/ou o login esteja incorreto o usuário é reencaminhado para a página de login
			header("Location: ../../index.php?erro=2");
		}

		$acesso = $sql->select("select * from acesso where idAcesso = :idAcesso", array(
			":idAcesso"=>$usuario[0]['idAcesso']
		));

		$empresa = $sql->select("select * from empresa where idEmpresa = :idEmpresa", array(
			":idEmpresa"=>$usuario[0]['idEmpresa']
		));
		
		$_SESSION['login'] = $_POST['input-login'];	
		$_SESSION['empresa'] = $empresa[0];	
		$_SESSION['acesso'] = $acesso[0];
		$_SESSION['carrinho'] = array();
	}
	else if((isset($_SESSION['login']))){
		//Caso o usuário já esteja logado, continua na mesma página
		if(isset($_GET['erro'])){
			if($_GET['erro'] == 1){
				Mensagem::exibirMensagem("O usuário não tem permissão para acessar este conteúdo!");
			}
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