<?php   
	require_once("../config/config.php");
	require_once("../autoload/autoloadModel.php");
	require_once("../autoload/autoloadView.php");
	require_once("../autoload/autoloadDAO.php");
	use excessao\CPFinvalidoException;
	use excessao\EntidadeJaCadastradaException;
	use excessao\SenhasDiferentesException;

	if((isset($_SESSION['login']))){
		//Caso o usuário já esteja logado, continua na mesma página
		if($_SESSION['acesso']['cadastrarFuncionario']){
			//Continua na página caso tenha permissão para utilizar
		}
		else{
			//Caso o usuário não tenha permissão, é redirecionado para a página principal
			header("Location: principal.php?erro=1");	
		}
	}
	else{
		//Caso não tenha dado inserido no login, o usuário é reencaminhado para fazer o login
		header("Location: ../../index.php?erro=1");	
	}

	function cadastrarFuncionario(){
		if((isset($_POST['input-funcionario-nome'])) && (isset($_POST['input-funcionario-cpf'])) 
			&& (isset($_POST['input-funcionario-nascimento'])) && (isset($_POST['select-funcionario-sexo'])) 
			&& (isset($_POST['input-funcionario-login'])) && (isset($_POST['password-funcionario-senha'])) 
			&& (isset($_POST['password-funcionario-confirmar-senha'])) && (isset($_POST['select-funcionario-empresa'])) 
			&& (isset($_POST['select-funcionario-acesso'])) && (isset($_POST['input-funcionario-cep'])) 
			&& (isset($_POST['select-funcionario-uf'])) && (isset($_POST['input-funcionario-cidade'])) 
			&& (isset($_POST['input-funcionario-bairro'])) && (isset($_POST['input-funcionario-rua'])) 
			&& (isset($_POST['input-funcionario-numero'])) && (isset($_POST['input-funcionario-complemento']))){

			$endereco = new Endereco($_POST['input-funcionario-cep'], $_POST['select-funcionario-uf'], 
				$_POST['input-funcionario-cidade'], $_POST['input-funcionario-bairro'], $_POST['input-funcionario-rua'], 
				$_POST['input-funcionario-numero'], (isset($_POST['input-funcionario-complemento']))?$_POST['input-funcionario-complemento']:"");

			$funcionario = new Funcionario($_POST['input-funcionario-nome'], $_POST['input-funcionario-cpf'], 
				$_POST['input-funcionario-nascimento'], $_POST['select-funcionario-sexo'], $_POST['input-funcionario-login'], 
				$_POST['password-funcionario-senha'], $_POST['select-funcionario-empresa'], $_POST['select-funcionario-acesso'], null, $endereco);


			try {
				if(!Validador::validarCPF($funcionario->getCPF())){
					throw new CPFinvalidoException("O CPF inserido não é válido", 3);								
				}

				if(($_POST['password-funcionario-confirmar-senha'] != $_POST['password-funcionario-senha'])){
					throw new SenhasDiferentesException("As senhas devem estar iguais!", 4);					
				}

				$enderecoDAO = new EnderecoDAO($endereco);
				$enderecoDAO->cadastrar();
				$funcionarioDAO = new FuncionarioDAO($funcionario, $enderecoDAO->getId());
				$operacao = $funcionarioDAO->cadastrar();

				if($operacao == false){
					throw new EntidadeJaCadastradaException("Já existe um funcionário com este login!", 5);					
				}

				Mensagem::exibirMensagem("Funcionário cadastrado com sucesso!");
			} catch (CPFinvalidoException $e) {
				Mensagem::exibirMensagem($e->getMessage());
			} catch (SenhasDiferentesException $e2) {
				Mensagem::exibirMensagem($e2->getMessage());
			} catch (EntidadeJaCadastradaException $e3) {
				Mensagem::exibirMensagem($e3->getMessage());
			}
		}
	}

	cadastrarFuncionario();
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
		<div class="sessao" id="cadastrar-funcionario">
			<div class="linha">
				<div class="coluna col12">
					<h2>Cadastrar Funcionário</h2>
				</div>	
				<form action="" method="post">
					<!--Linha 1-->					
					<div class="coluna col4">
						<label for="input-funcionario-nome">Nome *</label>
						<input type="text" name="input-funcionario-nome" id="input-funcionario-nome" required>
					</div>					
					<div class="coluna col4">
						<label for="input-funcionario-cpf">CPF *</label>
						<input type="text" name="input-funcionario-cpf" id="input-funcionario-cpf" required>
					</div>
					<div class="coluna col2">
						<label for="input-funcionario-nascimento">Nascimento *</label>
						<input type="date" name="input-funcionario-nascimento" id="input-funcionario-nascimento" required>
					</div>
					<div class="coluna col2">
						<label for="select-funcionario-sexo">Sexo *</label>
						<select name="select-funcionario-sexo" id="select-funcionario-sexo" required>
							<option value="M">Masculino</option>
							<option value="F">Feminino</option>
						</select>
					</div>					
					<div class="coluna col4">
						<label for="input-funcionario-login">Login *</label>
						<input type="text" name="input-funcionario-login" id="input-funcionario-login" required>
					</div>
					<!--Linha 2-->
					<div class="coluna col2">
						<label for="password-funcionario-senha">Senha *</label>
						<input type="password" name="password-funcionario-senha" id="password-funcionario-senha" required>
					</div>
					<div class="coluna col2">
						<label for="password-funcionario-confirmar-senha">Confirmar Senha *</label>
						<input type="password" name="password-funcionario-confirmar-senha" id="password-funcionario-confirmar-senha" required>
					</div>
					<div class="coluna col2">
						<label for="select-funcionario-empresa">Empresa *</label>
						<select name="select-funcionario-empresa" id="select-funcionario-empresa" required></select>
						<!--Criar Função para modificar os acessos dispníveis de acordo com a empresa que foi selecionada-->
					</div>
					<div class="coluna col2">
						<label for="select-funcionario-acesso">Acesso *</label>
						<select name="select-funcionario-acesso" id="select-funcionario-acesso" required></select>
					</div>									
					<div class="coluna col2">
						<label for="input-funcionario-cep">CEP *</label>
						<input maxlength="9" onblur="editarVariaveisGlobais(this.value, 'input-funcionario-rua', 'input-funcionario-bairro', 'input-funcionario-cidade', 'select-funcionario-uf');" type="text" name="input-funcionario-cep" id="input-funcionario-cep" required>
					</div>
					<div class="coluna col2">
						<label for="select-funcionario-uf">UF *</label>
						<select name="select-funcionario-uf" id="select-funcionario-uf" required></select>
					</div>
					<!--Linha 3-->	
					<div class="coluna col2">
						<label for="input-funcionario-cidade">Cidade *</label>
						<input type="text" name="input-funcionario-cidade" id="input-funcionario-cidade" required>
					</div>
					<div class="coluna col2">
						<label for="input-funcionario-bairro">Bairro *</label>
						<input type="text" name="input-funcionario-bairro" id="input-funcionario-bairro" required>
					</div>
					<div class="coluna col4">
						<label for="input-funcionario-rua">Rua *</label>
						<input type="text" name="input-funcionario-rua" id="input-funcionario-rua" required>
					</div>
					<div class="coluna col2">
						<label for="input-funcionario-numero">Número *</label>
						<input type="text" name="input-funcionario-numero" id="input-funcionario-numero" required>
					</div>
					<div class="coluna col2">
						<label for="input-funcionario-complemento">Complemento</label>
						<input type="text" name="input-funcionario-complemento" id="input-funcionario-complemento">
					</div>					
					<div class="coluna col12">
						<div class="div-centralizada">
							<input type="submit" value="Cadastrar Funcionário" class="botao-cadastro">
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
	    	inserirEstados('select-funcionario-uf');
	    </script>   	 
	</body>
</html>
<?php   
	//Editar esta condição para que fique da seguinte forma: caso o usuário logado for um superadmin, todas as empresas serão exibidas no combobox, mas caso não seja, deve aparecer apenas a empresa pelo qual aquele funcionário foi cadastrado
	if(true){		//Este TRUE simula um usuário superadmin
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
						document.getElementById('select-funcionario-empresa').appendChild(option);
					</script>";
				}				
			}
		}		
	}

	//Pega todos os acesos existentes no banco de dados
	//Passa apenas os acessos que não forem superadmin, de forma que não seja possível criar um usuário superadmin
	$acessos = $sql->select("select * from acesso", array());
	foreach ($acessos as $acesso) {
		foreach ($acesso as $campo => $valor) {
			if(($campo == "nome") && ($valor != 'superadmin')){
				echo "
				<script>
					var option = document.createElement('option');
					option.text = '$valor';
					option.value = '$valor';
					document.getElementById('select-funcionario-acesso').appendChild(option);
				</script>";
			}
		}
	}
?>				