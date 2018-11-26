<?php  
	require_once("../config/config.php");
	require_once("../autoload/autoloadModel.php");
	require_once("../autoload/autoloadView.php");
	require_once("../autoload/autoloadDAO.php");

	function adicionarAoCarrinho(){		
		if(isset($_GET['id'])){
			for ($i=0; $i < count($_SESSION['carrinho']); $i++) { 
				if($_SESSION['carrinho'][$i]['id'] == $_GET['id']){
					$_SESSION['carrinho'][$i]['quantidade'] += $_GET['quantidade'];
					return;
				}
			}
			//Adiciona o produto ao carirnho de compras
			array_push($_SESSION['carrinho'], array(
				"id"=>$_GET['id'], 
				"quantidade"=>$_GET['quantidade']
			));
		}
	}

	function removerDoCarrinho(){
		if(isset($_GET['deletar'])){
			for ($i=0; $i < count($_SESSION['carrinho']); $i++) { 
				if($_SESSION['carrinho'][$i]['id'] == $_GET['deletar']){
					unset($_SESSION['carrinho'][$i]);
					return;
				}
			}
		}
	}

	adicionarAoCarrinho();
	removerDoCarrinho();
?>
<script type="text/javascript">
	//Volta para a página anterior
	window.history.back();
</script>