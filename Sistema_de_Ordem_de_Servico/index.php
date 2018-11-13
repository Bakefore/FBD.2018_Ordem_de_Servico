<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Sistema de Ordem de Serviço - Login</title>

		<!--Normalize-->
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />

		<!--Fontes-->
   		<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet" />

   		<!--Viewport-->
	    <meta name="viewport" content="width=device-width,initial-scale=1" />

	    <!--CSS da página-->
	    <link rel="stylesheet" type="text/css" href="common/css/pagina_de_login.css" />

	    <!--Ícone superior da página-->
	    <link rel="icon" type="image/x-icon" href="common/img/icon/codigo.ico" />
	</head>
	<body>
		<div class="sessao">
			<div class="linha">
				<div class="coluna col12">
					<h2>Realizar Login</h2>
				</div>
				<form action="php/view/principal.php" method="post">										
					<div class="coluna col12">
						<label for="input-login">Login</label>
						<input type="text" name="input-login" id="input-login" required>
					</div>
					<div class="coluna col12">
						<label for="input-senha">Senha</label>
						<input type="password" name="input-senha" id="input-senha" required>
					</div>					
					<div class="coluna col12">
						<input type="submit" value="Entrar" class="botao-cadastro">
					</div>
				</form>
			</div>
		</div>
	</body>
</html>
<?php  
	/*Área de Testes*/
	//Funcionário está pegando
	//Cliente está pegando
	//CPFinvalidoException está pegando
	//CNPJinvalidoException está pegando
	//A classe Mensagem está pegando
	//A classe Sql está funcionando
	
	/*require_once("php/config/config.php");
	require_once("php/autoload/autoloadModel.php");//autoloadView
	require_once("php/autoload/autoloadView.php");*/

	


?>