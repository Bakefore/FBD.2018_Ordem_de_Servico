<?php
	function verificarMenuEmpresa(){
		if ($_SESSION['acesso']['pesquisarEmpresa']) {//editar condição para verificar acesso do usuário
			echo "<li onclick=encaminharPagina('pesquisar_empresa.php')>Empresa</li>";
			//<a href='pesquisar_empresa.php' id='link-empresa'>Empresa</a>
		}
	}

	function verificarMenuAcesso(){
		if ($_SESSION['acesso']['pesquisarAcesso']) {//editar condição para verificar acesso do usuário
			echo "<li onclick=encaminharPagina('pesquisar_acesso.php')>Acesso</li>";
		}
	}

	function verficarMenuFuncionario(){
		if ($_SESSION['acesso']['pesquisarFuncionario']) {//editar condição para verificar acesso do usuário
			echo "<li onclick=encaminharPagina('pesquisar_funcionario.php')>Funcionário</li>";
		}
	}

	function verficarMenuCliente(){
		if ($_SESSION['acesso']['pesquisarCliente']) {//editar condição para verificar acesso do usuário
			echo "<li onclick=encaminharPagina('pesquisar_cliente.php')>Cliente</li>";
		}
	}

	function verficarMenuServico(){
		if ($_SESSION['acesso']['pesquisarServico']) {//editar condição para verificar acesso do usuário
			echo "<li onclick=encaminharPagina('pesquisar_servico.php')>Serviço</li>";
		}
	}

	function verificarMenuFornecedor(){
		if ($_SESSION['acesso']['pesquisarFornecedor']) {//editar condição para verificar acesso do usuário
			echo "<li onclick=encaminharPagina('pesquisar_fornecedor.php')>Fornecedor</li>";
			//<a href='pesquisar_empresa.php' id='link-empresa'>Empresa</a>
		}
	}

	function verficarMenuProduto(){
		if ($_SESSION['acesso']['pesquisarProduto']) {//editar condição para verificar acesso do usuário
			echo "<li onclick=encaminharPagina('pesquisar_produto.php')>Produto</li>";
		}
	}

	function verficarMenuOrdemDeServico(){
		if ($_SESSION['acesso']['pesquisarOrdemDeServico']) {//editar condição para verificar acesso do usuário
			echo "<li onclick=encaminharPagina('pesquisar_ordem_servico.php')>Ordem de Serviço</li>";
		}
	}

	function verficarMenuFinanceiro(){
		if ($_SESSION['acesso']['exibirFinanceiro']) {//editar condição para verificar acesso do usuário
			echo "<li onclick=encaminharPagina('exibir_financas.php')>Finanças</li>";
		}
	}	
?>