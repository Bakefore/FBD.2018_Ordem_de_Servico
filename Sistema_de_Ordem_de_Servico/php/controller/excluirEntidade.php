<?php  
	require_once("../config/config.php");
	require_once("../autoload/autoloadModel.php");
	require_once("../autoload/autoloadView.php");
	require_once("../autoload/autoloadDAO.php");

	$sql = new Sql();
	$nomeTabela = $_GET['tabela'];
	//Edita o nome da variável para que ela se encaixe em todas as situações
	$idTabela = 'id'.ucfirst($nomeTabela);	

	//Muda a query de acordo com os dados que foram enviados pelo usuário, depois executa e exclui o objeto
	$sql->query("delete from $nomeTabela where $idTabela = :id", array(
		":id"=>$_GET['id']
	));
?>
<script type="text/javascript">
	//Volta para a página anterior
	window.history.back();
</script>