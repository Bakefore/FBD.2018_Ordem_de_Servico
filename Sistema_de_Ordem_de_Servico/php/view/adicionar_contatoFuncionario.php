<?php  
	require_once("../config/config.php");
	require_once("../autoload/autoloadModel.php");
	require_once("../autoload/autoloadView.php");
	require_once("../autoload/autoloadDAO.php");	
	use excessao\EntidadeJaCadastradaException;

	verificarPermissao('editarFuncionario');

	if(isset($_POST['id'])){
		$_SESSION['idReferenciado'] = $_POST['id'];
	}

	if(isset($_POST['tabela'])){
		$_SESSION['nomeTabela'] = $_POST['tabela'];
	}	
	
	function adicionarContato(){
		if((isset($_POST['input-descricao-contato'])) && (isset($_POST['select-tipo-contato']))){
			$contatoEmpresa = new Contato($_POST['select-tipo-contato'], $_POST['input-descricao-contato']);			

			try {

				$contatoDAO = new ContatoDAO($contatoEmpresa, $_SESSION['nomeTabela'], $_SESSION['idReferenciado']);
				$operacao = $contatoDAO->cadastrar();

				if($operacao == false){
					throw new EntidadeJaCadastradaException("O contato já está cadastrado!", 1);	
				}

				Mensagem::exibirMensagem("O contato do Funcionário foi cadastrado com sucesso!");
			} catch (EntidadeJaCadastradaException $e2){
				Mensagem::exibirMensagem($e2->getMessage());
			}	
		}
	}
	adicionarContato();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Sistema de Ordem de Serviço</title>

		<!--Normalize-->
		<link rel="stylesheet" type="text/css" href="../../css/normalize.css" />

		<!--Fontes-->
   		<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet" />

   		<!--Viewport-->
	    <meta name="viewport" content="width=device-width,initial-scale=1" />

	    <!--CSS da página-->
	    <link rel="stylesheet" type="text/css" href="../../common/css/estilo.css" />

	    <!--Ícone superior da página-->
	    <link rel="icon" type="image/x-icon" href="../../common/img/icon/codigo.ico" />	   

	    <!--JQuery-->
		<script src="../../common/js/jquery/jquery-3.2.1.min.js"></script> 

		<!--Configurações Gerais-->
		<script src="../../common/js/configuracoes.js"></script>

		<!-- Adicionando ViaCEP -->
	    <script src="../../common/js/buscar_cep.js"></script>

	    <script type="text/javascript">
	    	function voltar(){
	    		window.location.href = "editar_empresa.php";	
	    	}
	    </script>
	</head>
	<body>
		<!--Menu Drop-down-->
		<div id="menu-dropdown" onblur="tirarDropdown()">			
			<ul>
				<?php  
					//faz a requisição da página que contém o menu superior do sistema
					require_once("menu.php");

					verificarMenuEmpresa();
					verificarMenuAcesso();
					verficarMenuFuncionario();
					verficarMenuCliente();	
					verficarMenuServico();	
					verificarMenuFornecedor();
					verficarMenuProduto();								
					verficarMenuOrdemDeServico();
					verficarMenuFinanceiro();
				?>
			</ul>			
		</div>
		
		<!-- Menu Superior -->
		<div class="header">
			<div class="linha">
				<header>
					<div class="coluna col3 logo">
						<h1>Adônis</h1>
					</div>	    			
					<div class="coluna col9">
						<ul class="menu" id="menu-superior">
							<?php  
								//faz a requisição da página que contém o menu superior do sistema
								require_once("menu.php");	

								verificarMenuEmpresa();
								verificarMenuAcesso();
								verficarMenuFuncionario();
								verficarMenuCliente();	
								verficarMenuServico();	
								verificarMenuFornecedor();
								verficarMenuProduto();								
								verficarMenuOrdemDeServico();
								verficarMenuFinanceiro();
							?>                  
						</ul>
						<label onclick="mudarMenuDropdown()" id="botao-menu">&equiv;</label>							    				
					</div>
				</header>
			</div>
		</div>

		<!-- Conteúdo do Sistema -->
		<div class="sessao" id="cadastrar-empresa">
			<div class="linha">
				<div class="coluna col12">
					<h2>Adicionar Contato para Funcionário</h2>
				</div>
				<form action="" method="post">
					<!--Linha 1-->					
					<div class="coluna col4">
						<label for="input-descricao-contato">Descrição *</label>
						<input type="text" name="input-descricao-contato" id="input-descricao-contato" required>
					</div>
					<div class="coluna col2">
						<label for="select-tipo-contato">Tipo</label>
						<select name="select-tipo-contato" id="select-tipo-contato" required>
							<option value="email">E-mail</option>
							<option value="telefone">Telefone</option>
						</select>
					</div>
					<div class="coluna col12">
						<div class="div-centralizada">
							<input type="submit" value="Adicionar Contato" class="botao-cadastro">
						</div>
					</div>
				</form>				
				<div class="coluna col12">
					<div class="div-centralizada">
						<input type="submit" value="Voltar" class="botao-cadastro" onclick="voltar()">
					</div>
				</div>				
			</div>
		</div>		

		<div class="footer absolute-bottom">
			<div class="linha">
				<footer>
					<div class="coluna col12">
						<span>&copy; 2018 - PietroTelino | Todos os direitos reservados</span>
					</div>
				</footer>
			</div>
		</div>	
	</body>
</html>
