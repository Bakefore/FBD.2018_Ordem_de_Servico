<?php  
	require_once("../config/config.php");
	require_once("../autoload/autoloadModel.php");
	require_once("../autoload/autoloadView.php");
	require_once("../autoload/autoloadDAO.php");	
	use excessao\CNPJinvalidoException;
	use excessao\CPFinvalidoException;

	//Verifica os dados passados para então fazer o cadastro de uma Empresa
	function cadastrarEmpresa(){
		if((isset($_POST['input-empresa-razao-social'])) && (isset($_POST['input-empresa-nome-fantasia'])) 
			&& (isset($_POST['input-empresa-cnpj'])) && (isset($_POST['input-empresa-email'])) && (isset($_POST['input-empresa-celular'])) 
			&& (isset($_POST['input-empresa-cep'])) && (isset($_POST['select-empresa-uf'])) && (isset($_POST['input-empresa-cidade'])) 
			&& (isset($_POST['input-empresa-bairro'])) && (isset($_POST['input-empresa-rua'])) && (isset($_POST['input-empresa-numero']))){

			$contatosArray = array(
				"email"=>$email = $_POST['input-empresa-email'],
				"celular"=>$email = $_POST['input-empresa-email']
			);

			if(isset($_POST['input-empresa-telefone'])){
				$contatosArray['telefone'] = $_POST['input-empresa-telefone'];
			}

			$endereco = new Endereco($_POST['input-empresa-cep'], $_POST['select-empresa-uf'], $_POST['input-empresa-cidade'], 
				$_POST['input-empresa-bairro'], $_POST['input-empresa-rua'], $_POST['input-empresa-numero'], 
				(isset($_POST['input-empresa-complemento']))?$_POST['input-empresa-complemento']:"");

			$empresa = new Empresa($_POST['input-empresa-razao-social'], $_POST['input-empresa-nome-fantasia'], $_POST['input-empresa-cnpj'], 
				$endereco, $contatosArray);			

			try {
				if(!Validador::validarCNPJ($empresa->getCNPJ())){
					throw new CNPJinvalidoException("O CNPJ inserido não é válido", 1);										
				}

				$enderecoDAO = new EnderecoDAO($endereco);
				$enderecoDAO->cadastrar();
				$empresaDAO = new EmpresaDAO($empresa, $enderecoDAO->getId());
				$operacao = $empresaDAO->cadastrar();

				if($operacao == false){
					throw new EntidadeJaCadastradaException("A empresa já está cadastrada!", 2);					
				}

				Mensagem::exibirMensagem("A Empresa foi cadastrada com sucesso!");
			} catch (CNPJinvalidoException $e) {
				Mensagem::exibirMensagem($e->getMessage());
			} catch (EntidadeJaCadastradaException $e2){
				Mensagem::exibirMensagem($e2->getMessage());
			}			
		}
	}	

	cadastrarEmpresa();
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
					<h2>Cadastrar Empresa</h2>
				</div>
				<form action="" method="post">
					<!--Linha 1-->					
					<div class="coluna col4">
						<label for="input-empresa-razao-social">Razão Social *</label>
						<input type="text" name="input-empresa-razao-social" id="input-empresa-razao-social" required>
					</div>
					<div class="coluna col4">
						<label for="input-empresa-nome-fantasia">Nome Fantasia</label>
						<input type="text" name="input-empresa-nome-fantasia" id="input-empresa-nome-fantasia">
					</div>
					<div class="coluna col4">
						<label for="input-empresa-cnpj">CNPJ *</label>
						<input type="text" name="input-empresa-cnpj" id="input-empresa-cnpj" required>
					</div>
					<!--Linha 2-->
					<div class="coluna col4">
						<label for="input-empresa-email">E-mail</label>
						<input type="email" name="input-empresa-email" id="input-empresa-email">
					</div>
					<div class="coluna col2">
						<label for="input-empresa-telefone">Telefone</label>
						<input type="text" name="input-empresa-telefone" id="input-empresa-telefone">
					</div>
					<div class="coluna col2">
						<label for="input-empresa-celular">Celular *</label>
						<input type="text" name="input-empresa-celular" id="input-empresa-celular" required>
					</div>
					<div class="coluna col2">
						<label for="input-empresa-cep">CEP *</label>
						<input maxlength="9" onblur="editarVariaveisGlobais(this.value, 'input-empresa-rua', 'input-empresa-bairro', 'input-empresa-cidade', 'select-empresa-uf');" type="text" name="input-empresa-cep" id="input-empresa-cep" required>
					</div>
					<div class="coluna col2">
						<label for="select-empresa-uf">UF *</label>
						<select name="select-empresa-uf" id="select-empresa-uf" required></select>
					</div>
					<!--Linha 3-->
					<div class="coluna col2">
						<label for="input-empresa-cidade">Cidade *</label>
						<input type="text" name="input-empresa-cidade" id="input-empresa-cidade" required>
					</div>
					<div class="coluna col2">
						<label for="input-empresa-bairro">Bairro *</label>
						<input type="text" name="input-empresa-bairro" id="input-empresa-bairro" required>
					</div>
					<div class="coluna col4">
						<label for="input-empresa-rua">Rua *</label>
						<input type="text" name="input-empresa-rua" id="input-empresa-rua" required>
					</div>
					<div class="coluna col2">
						<label for="input-empresa-numero">Número *</label>
						<input type="text" name="input-empresa-numero" id="input-empresa-numero" required>
					</div>
					<div class="coluna col2">
						<label for="input-empresa-complemento">Complemento</label>
						<input type="text" name="input-empresa-complemento" id="input-empresa-complemento">
					</div>
					<div class="div-centralizada">
						<input type="submit" value="Cadastrar Empresa" class="botao-cadastro">
					</div>
				</form>
				<div class="div-centralizada">
					<input type="submit" value="Voltar ao Menu Principal" class="botao-cadastro" onclick="voltarParaMenuPrincipal()">
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

				