<?php  
	require_once("../config/config.php");
	require_once("../autoload/autoloadModel.php");
	require_once("../autoload/autoloadView.php");
	require_once("../autoload/autoloadDAO.php");
	use excessao\EntidadeJaCadastradaException;

	verificarPermissao('cadastrarProduto');

	function cadastrarProduto(){
		if((isset($_POST['input-produto-nome'])) && (isset($_POST['select-produto-tipo'])) && (isset($_POST['input-produto-marca'])) 
			&& (isset($_POST['input-produto-validade'])) && (isset($_POST['select-produto-empresa'])) 
			&& (isset($_POST['select-produto-fornecedor'])) && (isset($_POST['input-produto-custo-compra'])) 
			&& (isset($_POST['input-produto-preco'])) && (isset($_POST['input-produto-codigo'])) 
			&& (isset($_POST['select-produto-status'])) && (isset($_POST['input-produto-varejo'])) 
			&& (isset($_POST['input-produto-quantidade'])) && (isset($_POST['input-produto-atacado'])) 
			&& (isset($_POST['textarea-produto-descricao']))){//(isset($_POST['input-produto-modelo']))

			$modelo = null;
			if(isset($_POST['input-produto-modelo'])){
				$modelo = $_POST['input-produto-modelo'];
			}
			
			$produto = new Produto($_POST['input-produto-nome'], $_POST['select-produto-tipo'], $_POST['input-produto-marca'], 
				$modelo, $_POST['input-produto-validade'], $_POST['select-produto-fornecedor'], 
				$_POST['select-produto-empresa'], $_POST['input-produto-custo-compra'], $_POST['input-produto-preco'], 
				$_POST['input-produto-codigo'], $_POST['input-produto-quantidade'], $_POST['select-produto-status'], 
				$_POST['input-produto-varejo'], $_POST['input-produto-atacado'], $_POST['textarea-produto-descricao']);

			try {
				$produtoDAO = new ProdutoDAO($produto);
				$operacao = $produtoDAO->cadastrar();

				if($operacao == false){
					throw new EntidadeJaCadastradaException("Já existe um produto cadastrado!", 1);					
				}

				Mensagem::exibirMensagem("Produto cadastrado com sucesso!");
			} catch (EntidadeJaCadastradaException $e) {
				Mensagem::exibirMensagem($e->getMessage());
			}
		}
	}

	cadastrarProduto();
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

	    <!--  -->
	    <script type="text/javascript">
	    	//Para Marcar o checkbox de pesquisa que estiver relacionado
	    	function marcarCheckbox(idPesquisar, idIntercalador){
	    		var pesquisar = document.getElementById(idPesquisar);
	    		var intercalador = document.getElementById(idIntercalador);	    		

	    		if(intercalador.checked == false){
	    			pesquisar.checked = true;	
	    		}
	    	}

	    	//Para desmarcar os checkbox de editar e excluir que estiverem relacionados com o checkbox de pesquisa que foi desselecionado
	    	function desmarcarEditarExcluir(idPesquisar, idEditar, idExcluir){
	    		var pesquisar = document.getElementById(idPesquisar);
	    		var editar = document.getElementById(idEditar);
	    		var excluir = document.getElementById(idExcluir);

	    		if(pesquisar.checked == true){
	    			editar.checked = false;
	    			excluir.checked = false;
	    		}
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
		<div class="sessao" id="cadastrar-produto">
			<div class="linha">
				<div class="coluna col12">
					<h2>Cadastrar Produto</h2>
				</div>	
				<form action="" method="post">
					<div class="coluna col12">
						<div class="coluna col4 sem-padding-left">
							<label for="input-produto-nome">Nome *</label>
							<input type="text" name="input-produto-nome" id="input-produto-nome" required>
						</div>
						<div class="coluna col2">
							<label for="select-produto-tipo">Tipo de Produto *</label>
							<select name="select-produto-tipo" id="select-produto-tipo" required>
								<option value="alimenticio">Alimentício</option>
								<option value="movel">Móvel</option>
								<option value="eletronico">Eletrônico</option>
								<option value="veiculo">Veículo</option>
							</select>
						</div>
						<div class="coluna col2">
							<label for="input-produto-marca">Marca *</label>
							<input type="text" name="input-produto-marca" id="input-produto-marca" required>
						</div>
						<div class="coluna col2">
							<label for="input-produto-modelo">Modelo</label>
							<input type="text" name="input-produto-modelo" id="input-produto-modelo">
						</div>
						<div class="coluna col2 sem-padding-right">
							<label for="input-produto-validade">Data de Validade *</label>
							<input type="date" name="input-produto-validade" id="input-produto-validade" required>
						</div>
					</div>

					<div class="coluna col12">
						<div class="coluna col4 sem-padding-left">
							<label for="select-produto-empresa">Empresa *</label>
							<select name="select-produto-empresa" id="select-produto-empresa" onclick="alterarFornecedores()" required></select>
						</div>
						<div class="coluna col4">
							<label for="select-produto-fornecedor">Fornecedor *</label>
							<select name="select-produto-fornecedor" id="select-produto-fornecedor" required></select>		
						</div>					
						<div class="coluna col2">
							<label for="input-produto-custo-compra">Custo de Compra *</label>
							<input type="text" name="input-produto-custo-compra" id="input-produto-custo-compra" required>
						</div>
						<div class="coluna col2 sem-padding-right">
							<label for="input-produto-preco">Preço de Venda *</label>
							<input type="text" name="input-produto-preco" id="input-produto-preco" required>
						</div>
					</div>

					<div class="coluna col12">
						<div class="coluna col4 sem-padding-left">
							<label for="input-produto-codigo">Código de Barras *</label>
							<input type="text" name="input-produto-codigo" id="input-produto-codigo">										
						</div>
						<div class="coluna col2"><!--sem-padding-left-->
							<label for="select-produto-status">Status *</label>
							<select name="select-produto-status" id="select-produto-status" required>
								<option value="Ativo">Ativo</option>
								<option value="Inativo">Inativo</option>
							</select>
						</div>	
						<div class="coluna col2"><!--sem-padding-right-->
							<label for="input-produto-varejo">Varejo</label>
							<input type="text" name="input-produto-varejo" id="input-produto-varejo" required>
						</div>	
						<div class="coluna col2">
							<label for="input-produto-quantidade">Quantidade Inicial *</label>
							<input type="number" name="input-produto-quantidade" id="input-produto-quantidade">						
						</div>
						<div class="coluna col2 sem-padding-right">
							<label for="input-produto-atacado">Atacado</label>
							<input type="text" name="input-produto-atacado" id="input-produto-atacado" required>
						</div>
					</div>

					<div class="coluna col6">
						<label for="textarea-produto-descricao">Descrição *</label>
						<textarea class="descricao-servico" id="textarea-produto-descricao" name="textarea-produto-descricao" required></textarea>
					</div>
					<div class="coluna col12">
						<div class="div-centralizada">
							<input type="submit" value="Cadastrar Produto" class="botao-cadastro">
						</div>
					</div>
				</form>
				<div class="coluna col12">
					<div class="div-centralizada">
						<input type="submit" value="Voltar ao Menu Principal" class="botao-cadastro" onclick="voltarParaMenuPrincipal()">
					</div>
				</div>
			</div>
		</div>				

		<div class="footer">
			<div class="linha">
				<footer>
					<div class="coluna col12">
						<span>&copy; 2018 - PietroTelino | Todos os direitos reservados</span>
					</div>
				</footer>
			</div>
		</div>	

		<!-- Preenchendo campos de UF -->
	    <script src="../../common/js/preencher_uf.js"></script>

	    <script type="text/javascript">
	    	inserirEstados('select-empresa-uf');
	    </script>   	 
	</body>
</html>
<?php  
	//Editar esta condição para que fique da seguinte forma: caso o usuário logado for um superadmin, todas as empresas serão exibidas no combobox, mas caso não seja, deve aparecer apenas a empresa pelo qual aquele funcionário foi cadastrado
	if($_SESSION['acesso']['nome'] == 'superadmin'){		//Caso for um superadmin, mostra todas as empresas possíveis
		$sql = new Sql();
		$empresas = $sql->select("select * from empresa", array());
		foreach ($empresas as $empresa) {				
			foreach ($empresa as $campo => $valor) {
				if($campo == 'razaoSocial'){
					echo "
					<script>
						var option = document.createElement('option');
						option.text = '$valor';
						option.value = '$valor';
						document.getElementById('select-produto-empresa').appendChild(option);
					</script>";
				}				
			}
		}		
	}
	else{
		$empresa = $_SESSION['empresa']['razaoSocial'];
		echo "
		<script>
			var option = document.createElement('option');
			option.text = '$empresa';
			option.value = '$empresa';
			document.getElementById('select-produto-empresa').appendChild(option);
		</script>";
	}		

	//Preenche os fornecedores que estão cadastrados no sistema, caso entre como um superadmin, preenche com todos os fornecedores possíveis, caso seja um funcionário de uma empresa, irá mostrar apenas os fornecedores daquela empresa
	if($_SESSION['acesso']['nome'] == 'superadmin'){		//Caso for um superadmin, mostra todas as empresas possíveis
		$sql = new Sql();
		$fornecedores = $sql->select("select * from fornecedor", array());
		foreach ($fornecedores as $fornecedor) {				
			foreach ($fornecedor as $campo => $valor) {
				if($campo == 'razaoSocial'){
					echo "
					<script>
						var option = document.createElement('option');
						option.text = '$valor';
						option.value = '$valor';
						document.getElementById('select-produto-fornecedor').appendChild(option);
					</script>";
				}				
			}
		}		
	}
	else{
		$sql = new Sql();
		$fornecedores = $sql->select("select * from fornecedor where idEmpresa = :idEmpresa", array(
			":idEmpresa"=>$_SESSION['empresa']['idEmpresa']
		));
		foreach ($fornecedores as $fornecedor) {				
			foreach ($fornecedor as $campo => $valor) {
				if($campo == 'razaoSocial'){
					echo "
					<script>
						var option = document.createElement('option');
						option.text = '$valor';
						option.value = '$valor';
						document.getElementById('select-produto-fornecedor').appendChild(option);
					</script>";
				}				
			}
		}	
	}		
?>