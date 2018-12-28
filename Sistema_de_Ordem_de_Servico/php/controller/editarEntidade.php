<?php  
	require_once("../autoload/autoloadModel.php");

	//configura o nome da página para enviar o formulário
	$pagina = "editar_".$_GET['tabela'].".php";

	//caso se trate de uma ordem de serviço
	if($_GET['tabela'] == 'ordemDeServico'){
		//verifica se a ordem de serviço está finalizada
		$sql = new Sql();

		$resultadoOrdemDeServico = $sql->select("select * from ordemDeServico where idOrdemDeServico = :idOrdemDeServico", array(
			":idOrdemDeServico"=>$_GET['id']
		));

		if($resultadoOrdemDeServico[0]['finalizada']){
			header("Location: ../view/pesquisar_ordem_servico.php?erro=1");
		}
	}

	//Verifica se é uma parcela, para então marcar a mesma como paga
	else if($_GET['tabela'] == 'parcela'){
		$sql = new Sql();

		$resultadoParcela = $sql->select("select * from parcela where idParcela = :idParcela", array(
			":idParcela"=>$_GET['id']
		));

		if($resultadoParcela[0]['ativo']){
			$sql->query("update parcela set ativo = :ativo where idParcela = :idParcela", array(
				":ativo"=>false,
				":idParcela"=>$_GET['id']
			));
			header("Location: ../view/exibir_financas.php?operacao=1");
		}
		else{
			header("Location: ../view/exibir_financas.php?operacao=2");
		}
		
	}
	
?>
<!--Preenche o formulário com o ID da entidade e o nome da tabela-->
<form name="formulario" action="../view/<?php echo $pagina ?>" method="post">
	<input type="number" name="id" value="<?php echo $_GET['id'] ?>">
	<input type="text" name="tabela" value="<?php echo $_GET['tabela'] ?>">
</form>
<!--Faz o envio do formulário por post para a página que foi configurada acima-->
<script type="text/javascript">
	document.formulario.submit();
</script>