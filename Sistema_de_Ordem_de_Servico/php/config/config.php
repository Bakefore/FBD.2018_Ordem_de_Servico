<?php  
	session_start();

	function verificarPermissao($campo){
		if((isset($_SESSION['login']))){
			//Caso o usuário já esteja logado, continua na mesma página
			if($_SESSION['acesso'][$campo]){
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
	}
?>