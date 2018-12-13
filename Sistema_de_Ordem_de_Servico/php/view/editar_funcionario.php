<?php   
	require_once("../config/config.php");
	require_once("../autoload/autoloadModel.php");
	require_once("../autoload/autoloadView.php");
	require_once("../autoload/autoloadDAO.php");
	use excessao\CPFinvalidoException;
	use excessao\EntidadeJaCadastradaException;
	use excessao\SenhasDiferentesException;

	verificarPermissao('cadastrarFuncionario');

	//Verifica se o ID foi passado e cria uma sessão para representar o ID
	if(isset($_POST['id'])){
		$_SESSION['idParaSerEditado'] = $_POST['id'];
	}

	//mostra todos os dados atuais da entidade
	if(isset($_SESSION['idParaSerEditado'])){
		$sql = new Sql();

		$resultadoFuncionario = $sql->select("select * from funcionario where idFuncionario = :idFuncionario", array(
			":idFuncionario"=>$_SESSION['idParaSerEditado']
		));

		$resultadoEmpresa = $sql->select("select * from empresa where idEmpresa = :idEmpresa", array(
			":idEmpresa"=>$resultadoFuncionario[0]['idEmpresa']
		));

		$resultadoEndereco = $sql->select("select * from endereco where idEndereco = :idEndereco", array(
			":idEndereco"=>$resultadoFuncionario[0]['idEndereco']
		));

		$resultadoCidade = $sql->select("select * from cidade where idCidade = :idCidade", array(
			":idCidade"=>$resultadoEndereco[0]['idCidade']
		));

		$resultadoEstado = $sql->select("select * from estado where idEstado = :idEstado", array(
			":idEstado"=>$resultadoCidade[0]['idEstado']
		));

		$resultadoAcesso = $sql->select("select * from acesso where idAcesso = :idAcesso", array(
			":idAcesso"=>$resultadoFuncionario[0]['idAcesso']
		));

		$sexo = $resultadoFuncionario[0]['sexo'];
		$nome = $resultadoFuncionario[0]['nome'];
		$cpf = preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "$1.$2.$3-$4", $resultadoFuncionario[0]['cpf']);
		$dataNascimento = $resultadoFuncionario[0]['dataNascimento'];
		$login = $resultadoFuncionario[0]['login'];
		$senha = $resultadoFuncionario[0]['senha'];
		$bairro = $resultadoEndereco[0]['bairro'];
		$rua = 	$resultadoEndereco[0]['rua'];
		$numero = $resultadoEndereco[0]['numero'];
		$complemento = $resultadoEndereco[0]['complemento'];
		$cidade = $resultadoCidade[0]['nome'];
		$estado = $resultadoEstado[0]['uf'];
	}

	function editarFuncionario(){
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
				$funcionarioDAO->editar($_SESSION['idParaSerEditado']);

				Mensagem::exibirMensagem("Funcionário editado com sucesso!");
			} catch (CPFinvalidoException $e) {
				Mensagem::exibirMensagem($e->getMessage());
			} catch (SenhasDiferentesException $e2) {
				Mensagem::exibirMensagem($e2->getMessage());
			}
		}
	}

	editarFuncionario();
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
		<div class="sessao" id="cadastrar-funcionario">
			<div class="linha">
				<div class="coluna col12">
					<h2>Editar Funcionário</h2>
				</div>	
				<form action="" method="post">
					<!--Linha 1-->					
					<div class="coluna col4">
						<label for="input-funcionario-nome">Nome *</label>
						<input type="text" name="input-funcionario-nome" id="input-funcionario-nome" required value="<?php if(isset($nome)){echo $nome;} ?>">
					</div>					
					<div class="coluna col4">
						<label for="input-funcionario-cpf">CPF *</label>
						<input type="text" name="input-funcionario-cpf" id="input-funcionario-cpf" required value="<?php if(isset($cpf)){echo $cpf;} ?>">
					</div>
					<div class="coluna col2">
						<label for="input-funcionario-nascimento">Nascimento *</label>
						<input type="date" name="input-funcionario-nascimento" id="input-funcionario-nascimento" required value="<?php if(isset($dataNascimento)){echo $dataNascimento;} ?>">
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
						<input type="text" name="input-funcionario-login" id="input-funcionario-login" required value="<?php if(isset($login)){echo $login;} ?>">
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
						<label for="input-funcionario-cep">CEP</label>
						<input maxlength="9" onblur="editarVariaveisGlobais(this.value, 'input-funcionario-rua', 'input-funcionario-bairro', 'input-funcionario-cidade', 'select-funcionario-uf');" type="text" name="input-funcionario-cep" id="input-funcionario-cep">
					</div>
					<div class="coluna col2">
						<label for="select-funcionario-uf">UF *</label>
						<select name="select-funcionario-uf" id="select-funcionario-uf" required></select>
					</div>
					<!--Linha 3-->	
					<div class="coluna col2">
						<label for="input-funcionario-cidade">Cidade *</label>
						<input type="text" name="input-funcionario-cidade" id="input-funcionario-cidade" required value="<?php if(isset($cidade)){echo $cidade;} ?>">
					</div>
					<div class="coluna col2">
						<label for="input-funcionario-bairro">Bairro *</label>
						<input type="text" name="input-funcionario-bairro" id="input-funcionario-bairro" required value="<?php if(isset($bairro)){echo $bairro;} ?>">
					</div>
					<div class="coluna col4">
						<label for="input-funcionario-rua">Rua *</label>
						<input type="text" name="input-funcionario-rua" id="input-funcionario-rua" required value="<?php if(isset($rua)){echo $rua;} ?>">
					</div>
					<div class="coluna col2">
						<label for="input-funcionario-numero">Número *</label>
						<input type="text" name="input-funcionario-numero" id="input-funcionario-numero" required value="<?php if(isset($numero)){echo $numero;} ?>">
					</div>
					<div class="coluna col2">
						<label for="input-funcionario-complemento">Complemento</label>
						<input type="text" name="input-funcionario-complemento" id="input-funcionario-complemento" value="<?php if(isset($complemento)){echo $complemento;} ?>">
					</div>					
					<div class="coluna col12">
						<div class="div-centralizada">
							<input type="submit" value="Editar Funcionário" class="botao-cadastro">
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
	    	document.getElementById('select-funcionario-sexo').value = '<?php if(isset($sexo)){echo $sexo;} ?>';
	    	document.getElementById('select-funcionario-uf').value = '<?php if(isset($estado)){echo $estado;} ?>';	
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
						document.getElementById('select-funcionario-empresa').appendChild(option);
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
			document.getElementById('select-funcionario-empresa').appendChild(option);
		</script>";
	}

	//Pega todos os acesos existentes no banco de dados
	//Passa apenas os acessos que não forem superadmin, de forma que não seja possível criar um usuário superadmin
	$sql = new Sql();
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
<script type="text/javascript">
	document.getElementById('select-funcionario-empresa').value = '<?php if(isset($resultadoEmpresa[0]['razaoSocial'])){echo $resultadoEmpresa[0]['razaoSocial'];} ?>';
	document.getElementById('select-funcionario-acesso').value = '<?php if(isset($resultadoAcesso[0]['nome'])){echo $resultadoAcesso[0]['nome'];} ?>';
</script>