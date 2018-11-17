<?php
	function verificarMenuEmpresa(){
		if (true) {//editar condição para verificar acesso do usuário
			echo "<li onclick=encaminharPagina('pesquisar_empresa.php')>Empresa</li>";
			//<a href='pesquisar_empresa.php' id='link-empresa'>Empresa</a>
		}
	}

	function verificarMenuAcesso(){
		if (true) {//editar condição para verificar acesso do usuário
			echo "<li onclick=encaminharPagina('pesquisar_acesso.php')>Acesso</li>";
		}
	}

	function verficarMenuFuncionario(){
		if (true) {//editar condição para verificar acesso do usuário
			echo "<li onclick=encaminharPagina('pesquisar_funcionario.php')>Funcionário</li>";
		}
	}

	function verficarMenuCliente(){
		if (true) {//editar condição para verificar acesso do usuário
			echo "<li onclick=encaminharPagina('pesquisar_cliente.php')>Cliente</li>";
		}
	}

	function verficarMenuServico(){
		if (true) {//editar condição para verificar acesso do usuário
			echo "<li onclick=encaminharPagina('pesquisar_servico.php')>Serviço</li>";
		}
	}

	function verficarMenuProduto(){
		if (true) {//editar condição para verificar acesso do usuário
			echo "<li onclick=encaminharPagina('pesquisar_produto.php')>Produto</li>";
		}
	}

	function verficarMenuOrdemDeServico(){
		if (true) {//editar condição para verificar acesso do usuário
			echo "<li onclick=encaminharPagina('pesquisar_ordem_servico.php')>Ordem de Serviço</li>";
		}
	}

	function verficarMenuFinanceiro(){
		if (true) {//editar condição para verificar acesso do usuário
			echo "<li>Finanças</li>";
		}
	}	
?>