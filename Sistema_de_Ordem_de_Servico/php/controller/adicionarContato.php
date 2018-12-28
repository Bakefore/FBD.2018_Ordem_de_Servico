<?php  
	require_once("../autoload/autoloadModel.php");

	//configura o nome da página para enviar o formulário
	$pagina = "adicionar_".$_GET['tabela'].".php";
?>
<!--Preenche o formulário com o ID da entidade e o nome da tabela-->
<form name="formulario" action="../view/<?php echo $pagina; ?>" method="post">
	<input type="number" name="id" value="<?php echo $_GET['id']; ?>">
	<input type="text" name="tabela" value="<?php echo $_GET['tabela']; ?>">
</form>
<!--Faz o envio do formulário por post para a página que foi configurada acima-->
<script type="text/javascript">
	document.formulario.submit();
</script>