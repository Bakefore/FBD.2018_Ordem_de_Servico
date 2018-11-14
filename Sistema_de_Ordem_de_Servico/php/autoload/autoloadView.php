<?php  
	spl_autoload_register(function($nomeClasse){
		$caminhoInicial = "..".DIRECTORY_SEPARATOR."view".DIRECTORY_SEPARATOR."classes";
		$arquivo = $caminhoInicial.DIRECTORY_SEPARATOR.$nomeClasse.".php";		
		if(file_exists($arquivo)){
			require_once($arquivo);
		}
	});
?>