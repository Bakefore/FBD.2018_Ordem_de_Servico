<?php  
	require_once("../config/config.php");
	require_once("../autoload/autoloadModel.php");
	require_once("../autoload/autoloadView.php");
	require_once("../autoload/autoloadDAO.php");
	use excessao\CNPJinvalidoException;	
	use excessao\EntidadeJaCadastradaException;	

	verificarPermissao('cadastrarFornecedor');	

	//Verifica os dados passados para então fazer o cadastro de uma Empresa
	function cadastrarFornecedor(){
		if((isset($_POST['input-fornecedor-razao-social'])) && (isset($_POST['input-fornecedor-nome-fantasia'])) 
			&& (isset($_POST['input-fornecedor-cnpj'])) && (isset($_POST['select-fornecedor-empresa']))
			&& (isset($_POST['input-fornecedor-cep'])) && (isset($_POST['select-fornecedor-uf'])) 
			&& (isset($_POST['input-fornecedor-cidade'])) && (isset($_POST['input-fornecedor-bairro'])) 
			&& (isset($_POST['input-fornecedor-rua'])) && (isset($_POST['input-fornecedor-numero']))){

			$endereco = new Endereco($_POST['input-fornecedor-cep'], $_POST['select-fornecedor-uf'], $_POST['input-fornecedor-cidade'], 
				$_POST['input-fornecedor-bairro'], $_POST['input-fornecedor-rua'], $_POST['input-fornecedor-numero'], 
				(isset($_POST['input-fornecedor-complemento']))?$_POST['input-fornecedor-complemento']:"");

			$fornecedor = new Fornecedor($_POST['input-fornecedor-razao-social'], $_POST['input-fornecedor-nome-fantasia'], $_POST['input-fornecedor-cnpj'], 
				$endereco, null, $_POST['select-fornecedor-empresa']);			

			try {
				if(!Validador::validarCNPJ($fornecedor->getCNPJ())){
					throw new CNPJinvalidoException("O CNPJ inserido não é válido", 1);								
				}

				$enderecoDAO = new EnderecoDAO($endereco);
				$enderecoDAO->cadastrar();
				//$empresaDAO = new EmpresaDAO($empresa, $enderecoDAO->getId());
				//$operacao = $empresaDAO->cadastrar();

				if($operacao == false){
					throw new EntidadeJaCadastradaException("O Fornecedor já está cadastrado!", 2);					
				}

				Mensagem::exibirMensagem("O Fornecedor foi cadastrado com sucesso!");
			} catch (CNPJinvalidoException $e) {
				Mensagem::exibirMensagem($e->getMessage());
			} catch (EntidadeJaCadastradaException $e2){
				Mensagem::exibirMensagem($e2->getMessage());
			}			
		}
	}	

	cadastrarFornecedor();
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
		<div class="sessao" id="cadastrar-fornecedor">
			<div class="linha">
				<div class="coluna col12">
					<h2>Cadastrar Fornecedor</h2>
				</div>
				<form action="" method="post">
					<!--Linha 1-->					
					<div class="coluna col4">
						<label for="input-fornecedor-razao-social">Razão Social *</label>
						<input type="text" name="input-fornecedor-razao-social" id="input-fornecedor-razao-social" required>
					</div>
					<div class="coluna col2">
						<label for="input-fornecedor-nome-fantasia">Nome Fantasia</label>
						<input type="text" name="input-fornecedor-nome-fantasia" id="input-fornecedor-nome-fantasia">
					</div>
					<div class="coluna col2">
						<label for="input-fornecedor-cnpj">CNPJ *</label>
						<input type="text" name="input-fornecedor-cnpj" id="input-fornecedor-cnpj" required>
					</div>
					<div class="coluna col2">
						<label for="select-fornecedor-empresa">Empresa *</label>
						<select name="select-fornecedor-empresa" id="select-fornecedor-empresa" required></select>
						<!--Criar Função para modificar os acessos dispníveis de acordo com a empresa que foi selecionada-->
					</div>										
					<div class="coluna col2">
						<label for="input-fornecedor-cep">CEP *</label>
						<input maxlength="9" onblur="editarVariaveisGlobais(this.value, 'input-fornecedor-rua', 'input-fornecedor-bairro', 'input-fornecedor-cidade', 'select-fornecedor-uf');" type="text" name="input-fornecedor-cep" id="input-fornecedor-cep" required>
					</div>
					<div class="coluna col2">
						<label for="select-fornecedor-uf">UF *</label>
						<select name="select-fornecedor-uf" id="select-fornecedor-uf" required></select>
					</div>
					<!--Linha 2-->
					<div class="coluna col2">
						<label for="input-fornecedor-cidade">Cidade *</label>
						<input type="text" name="input-fornecedor-cidade" id="input-fornecedor-cidade" required>
					</div>
					<div class="coluna col2">
						<label for="input-fornecedor-bairro">Bairro *</label>
						<input type="text" name="input-fornecedor-bairro" id="input-fornecedor-bairro" required>
					</div>
					<div class="coluna col4">
						<label for="input-fornecedor-rua">Rua *</label>
						<input type="text" name="input-fornecedor-rua" id="input-fornecedor-rua" required>
					</div>
					<div class="coluna col2">
						<label for="input-fornecedor-numero">Número *</label>
						<input type="text" name="input-fornecedor-numero" id="input-fornecedor-numero" required>
					</div>
					<div class="coluna col2">
						<label for="input-fornecedor-complemento">Complemento</label>
						<input type="text" name="input-fornecedor-complemento" id="input-fornecedor-complemento">
					</div>
					<div class="coluna col12">
						<div class="div-centralizada">
							<input type="submit" value="Cadastrar fornecedor" class="botao-cadastro">
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
	    	inserirEstados('select-fornecedor-uf');
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
						document.getElementById('select-fornecedor-empresa').appendChild(option);
					</script>";
				}				
			}
		}		
	}
	else{
		echo "
		<script>
			var option = document.createElement('option');
			option.text = '$_SESSION[empresa][razaoSocial]';
			option.value = '$_SESSION[empresa][razaoSocial]';
			document.getElementById('select-funcionario-empresa').appendChild(option);
		</script>";
	}
?>

				