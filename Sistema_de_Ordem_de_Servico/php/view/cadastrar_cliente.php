<?php  
	require_once("../config/config.php");
	require_once("../autoload/autoloadModel.php");
	require_once("../autoload/autoloadView.php");
	require_once("../autoload/autoloadDAO.php");	
	use excessao\CPFinvalidoException;
	use excessao\EntidadeJaCadastradaException;
	
	verificarPermissao('cadastrarCliente');

	function cadastrarcliente(){
		if((isset($_POST['input-cliente-nome'])) && (isset($_POST['input-cliente-cpf'])) && (isset($_POST['input-cliente-nascimento'])) 
			&& (isset($_POST['select-cliente-sexo'])) && (isset($_POST['select-cliente-empresa'])) && (isset($_POST['input-cliente-cep'])) 
			&& (isset($_POST['select-cliente-uf'])) && (isset($_POST['input-cliente-cidade'])) && (isset($_POST['input-cliente-bairro'])) 
			&& (isset($_POST['input-cliente-rua'])) && (isset($_POST['input-cliente-numero'])) && (isset($_POST['input-cliente-complemento']))){

			$endereco = new Endereco($_POST['input-cliente-cep'], $_POST['select-cliente-uf'], $_POST['input-cliente-cidade'], 
				$_POST['input-cliente-bairro'], $_POST['input-cliente-rua'], $_POST['input-cliente-numero'], 
				(isset($_POST['input-cliente-complemento']))?$_POST['input-cliente-complemento']:"");

			$cliente = new Cliente($_POST['input-cliente-nome'], $_POST['input-cliente-cpf'], $_POST['input-cliente-nascimento'], 
				$_POST['select-cliente-sexo'], null, $endereco, $_POST['select-cliente-empresa']); 

			try {
				if(!Validador::validarCPF($cliente->getCPF())){
					throw new CPFinvalidoException("O CPF inserido não é válido", 1);								
				}

				$enderecoDAO = new EnderecoDAO($endereco);
				$enderecoDAO->cadastrar();
				$clienteDAO = new ClienteDAO($cliente, $enderecoDAO->getId());
				$operacao = $clienteDAO->cadastrar();

				if($operacao == false){
					throw new EntidadeJaCadastradaException("O cliente já está cadastrado!", 2);					
				}

				Mensagem::exibirMensagem("O Cliente foi cadastrado com sucesso!");
			} catch (CPFinvalidoException $e) {
				Mensagem::exibirMensagem($e->getMessage());
			} catch (EntidadeJaCadastradaException $e2){
				Mensagem::exibirMensagem($e2->getMessage());
			}			
		}
	}
	cadastrarcliente();
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
		<div class="sessao" id="cadastrar-cliente">
			<div class="linha">
				<div class="coluna col12">
					<h2>Cadastrar Cliente</h2>
				</div>	
				<form action="" method="post">
					<!--Linha 1-->					
					<div class="coluna col4 formulario">
						<label for="input-cliente-nome">Nome *</label>
						<input type="text" name="input-cliente-nome" id="input-cliente-nome" required>
					</div>					
					<div class="coluna col2 formulario">
						<label for="input-cliente-cpf">CPF *</label>
						<input type="text" name="input-cliente-cpf" id="input-cliente-cpf" required>
					</div>
					<div class="coluna col2 formulario">
						<label for="input-cliente-nascimento">Nascimento *</label>
						<input type="date" name="input-cliente-nascimento" id="input-cliente-nascimento" required>
					</div>
					<div class="coluna col2 formulario">
						<label for="select-cliente-sexo">Sexo *</label>
						<select name="select-cliente-sexo" id="select-cliente-sexo" required>
							<option value="M">Masculino</option>
							<option value="F">Feminino</option>
						</select>
					</div>
					<div class="coluna col2 formulario">
						<label for="select-cliente-empresa">Empresa *</label>
						<select name="select-cliente-empresa" id="select-cliente-empresa" required></select>
						<!--Criar Função para modificar os acessos dispníveis de acordo com a empresa que foi selecionada-->
					</div>					
					<!--Linha 2-->					
					<div class="coluna col2 formulario">
						<label for="input-cliente-cep">CEP *</label>
						<input maxlength="9" onblur="editarVariaveisGlobais(this.value, 'input-cliente-rua', 'input-cliente-bairro', 'input-cliente-cidade', 'select-cliente-uf');" type="text" name="input-cliente-cep" id="input-cliente-cep" required>
					</div>
					<div class="coluna col2 formulario">
						<label for="select-cliente-uf">UF *</label>
						<select name="select-cliente-uf" id="select-cliente-uf" required></select>
					</div>					
					<div class="coluna col2 formulario">
						<label for="input-cliente-cidade">Cidade *</label>
						<input type="text" name="input-cliente-cidade" id="input-cliente-cidade" required>
					</div>
					<div class="coluna col2 formulario">
						<label for="input-cliente-bairro">Bairro *</label>
						<input type="text" name="input-cliente-bairro" id="input-cliente-bairro" required>
					</div>
					<div class="coluna col4 formulario">
						<label for="input-cliente-rua">Rua *</label>
						<input type="text" name="input-cliente-rua" id="input-cliente-rua" required>
					</div>
					<!--Linha 3-->
					<div class="coluna col2 formulario">
						<label for="input-cliente-numero">Número *</label>
						<input type="text" name="input-cliente-numero" id="input-cliente-numero" required>
					</div>
					<div class="coluna col2 formulario">
						<label for="input-cliente-complemento">Complemento</label>
						<input type="text" name="input-cliente-complemento" id="input-cliente-complemento">
					</div>
					<div class="coluna col12">
						<div class="div-centralizada">
							<input type="submit" value="Cadastrar Cliente" class="botao-cadastro">
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
	    	inserirEstados('select-cliente-uf');
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
						document.getElementById('select-cliente-empresa').appendChild(option);
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
			document.getElementById('select-cliente-empresa').appendChild(option);
		</script>";
	}
?>