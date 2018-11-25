<?php  
	require_once("../config/config.php");

	//Adiciona o produto ao carirnho de compras
	array_push($_SESSION['carrinho'], $_GET['id']);
?>
<script type="text/javascript">
	//Volta para a página anterior
	window.history.back();
</script>