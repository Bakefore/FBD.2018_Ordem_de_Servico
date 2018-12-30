<?php  
	require_once("../config/config.php");
	require_once("../autoload/autoloadModel.php");
	require_once("../autoload/autoloadView.php");
	require_once("../autoload/autoloadDAO.php");
	use excessao\CNPJinvalidoException;	
	use excessao\EntidadeJaCadastradaException;	

	verificarPermissao('editarFornecedor');	

	//Verifica se o ID foi passado e cria uma sessão para representar o ID
	if(isset($_POST['id'])){
		$_SESSION['idParaSerEditado'] = $_POST['id'];
	}

	//$_SESSION['contatosSelecionados'] = null;
	if(!isset($_SESSION['contatosSelecionados'])){
		$_SESSION['contatosSelecionados'] = array();
	}

	//mostra todos os dados atuais da entidade
	if(isset($_SESSION['idParaSerEditado'])){
		$sql = new Sql();

		$resultadoFornecedor = $sql->select("select * from fornecedor where idFornecedor = :idFornecedor", array(
			":idFornecedor"=>$_SESSION['idParaSerEditado']
		));

		$resultadoEmpresa = $sql->select("select * from empresa where idEmpresa = :idEmpresa", array(
			":idEmpresa"=>$resultadoFornecedor[0]['idEmpresa']
		));

		$resultadoEndereco = $sql->select("select * from endereco where idEndereco = :idEndereco", array(
			":idEndereco"=>$resultadoFornecedor[0]['idEndereco']
		));

		$resultadoCidade = $sql->select("select * from cidade where idCidade = :idCidade", array(
			":idCidade"=>$resultadoEndereco[0]['idCidade']
		));

		$resultadoEstado = $sql->select("select * from estado where idEstado = :idEstado", array(
			":idEstado"=>$resultadoCidade[0]['idEstado']
		));

		$razaoSocial = $resultadoFornecedor[0]['razaoSocial'];
		$nomeFantasia = $resultadoFornecedor[0]['nomeFantasia'];
		$cnpj = preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/','$1.$2.$3/$4-$5',$resultadoFornecedor[0]['cnpj']);
		$bairro = $resultadoEndereco[0]['bairro'];
		$rua = 	$resultadoEndereco[0]['rua'];
		$numero = $resultadoEndereco[0]['numero'];
		$complemento = $resultadoEndereco[0]['complemento'];
		$cidade = $resultadoCidade[0]['nome'];
		$estado = $resultadoEstado[0]['uf'];
	}

	//Verifica os dados passados para então fazer o cadastro de uma Empresa
	function editarFornecedor(){
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
				$fornecedorDAO = new FornecedorDAO($fornecedor, $enderecoDAO->getId());
				$fornecedorDAO->editar($_SESSION['idParaSerEditado']);

				//criar DAO para contato e atualizar de forma dinâmica
				foreach ($_SESSION['contatosSelecionados'] as $contato) {
					$campoTipo = $contato['idCampoTipo'];
					$campoDescricao = $contato['idCampoDescricao'];

					if((isset($_POST[$campoTipo])) && (isset($_POST[$campoDescricao]))){
						$novoContato = new Contato($_POST[$campoTipo], $_POST[$campoDescricao]);
						$contatoDAO = new ContatoDAO($novoContato, 'contatoFornecedor', $_SESSION['idParaSerEditado']);
						$contatoDAO->editar($contato['idContato'], 'contatoFornecedor');	
					}
				}

				//Retira os contatos da lista de contatos selecionados
				for ($i=0; $i < count($_SESSION['contatosSelecionados']); $i++) { 
					$_SESSION['contatosSelecionados'][$i] = null;
				}
				//fim da edição de contatos

				Mensagem::exibirMensagem("O Fornecedor foi editado com sucesso!");
			} catch (CNPJinvalidoException $e) {
				Mensagem::exibirMensagem($e->getMessage());
			}			
		}
	}	

	editarFornecedor();
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
	    	function adicionarContato(id){
	    		var tabela = 'contatoFornecedor';									
				window.location.href = "../controller/adicionarContato.php?id=" + id + "&tabela=" + tabela;	
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
		<div class="sessao" id="cadastrar-fornecedor">
			<div class="linha">
				<div class="coluna col12">
					<h2>Editar Fornecedor</h2>
				</div>
				<form action="" method="post">
					<!--Linha 1-->					
					<div class="coluna col4">
						<label for="input-fornecedor-razao-social">Razão Social *</label>
						<input type="text" name="input-fornecedor-razao-social" id="input-fornecedor-razao-social" required value="<?php if(isset($razaoSocial)){echo $razaoSocial;} ?>">
					</div>
					<div class="coluna col2">
						<label for="input-fornecedor-nome-fantasia">Nome Fantasia *</label>
						<input type="text" name="input-fornecedor-nome-fantasia" id="input-fornecedor-nome-fantasia" required value="<?php if(isset($nomeFantasia)){echo $nomeFantasia;} ?>">
					</div>
					<div class="coluna col2">
						<label for="input-fornecedor-cnpj">CNPJ *</label>
						<input type="text" name="input-fornecedor-cnpj" id="input-fornecedor-cnpj" required value="<?php if(isset($cnpj)){echo $cnpj;} ?>">
					</div>
					<div class="coluna col4">
						<label for="select-fornecedor-empresa">Empresa *</label>
						<select name="select-fornecedor-empresa" id="select-fornecedor-empresa" required></select>
						<!--Criar Função para modificar os acessos dispníveis de acordo com a empresa que foi selecionada-->
					</div>										
					<div class="coluna col2">
						<label for="input-fornecedor-cep">CEP</label>
						<input maxlength="9" onblur="editarVariaveisGlobais(this.value, 'input-fornecedor-rua', 'input-fornecedor-bairro', 'input-fornecedor-cidade', 'select-fornecedor-uf');" type="text" name="input-fornecedor-cep" id="input-fornecedor-cep">
					</div>
					<div class="coluna col2">
						<label for="select-fornecedor-uf">UF *</label>
						<select name="select-fornecedor-uf" id="select-fornecedor-uf" required></select>
					</div>
					<!--Linha 2-->
					<div class="coluna col2">
						<label for="input-fornecedor-cidade">Cidade *</label>
						<input type="text" name="input-fornecedor-cidade" id="input-fornecedor-cidade" required value="<?php if(isset($cidade)){echo $cidade;} ?>"> 
					</div>
					<div class="coluna col2">
						<label for="input-fornecedor-bairro">Bairro *</label>
						<input type="text" name="input-fornecedor-bairro" id="input-fornecedor-bairro" required value="<?php if(isset($bairro)){echo $bairro;} ?>">
					</div>
					<div class="coluna col4">
						<label for="input-fornecedor-rua">Rua *</label>
						<input type="text" name="input-fornecedor-rua" id="input-fornecedor-rua" required value="<?php if(isset($rua)){echo $rua;} ?>">
					</div>
					<div class="coluna col2">
						<label for="input-fornecedor-numero">Número *</label>
						<input type="text" name="input-fornecedor-numero" id="input-fornecedor-numero" required value="<?php if(isset($numero)){echo $numero;} ?>">
					</div>
					<div class="coluna col2">
						<label for="input-fornecedor-complemento">Complemento</label>
						<input type="text" name="input-fornecedor-complemento" id="input-fornecedor-complemento" value="<?php if(isset($complemento)){echo $complemento;} ?>">
					</div>

					<!--Lista os contatos que estão relacionados ao cadastro-->
					<div class="coluna col12">
						<h3>Contatos</h3>
					</div>
					<?php  
						
						$sql = new Sql();
						$contatos = $sql->select("select * from contatoFornecedor where idReferenciado = :idReferenciado", array(
							":idReferenciado"=>$_SESSION['idParaSerEditado']
						));
						$ordem = 0;
						foreach ($contatos as $contato) {				
							foreach ($contato as $campo => $valor) {								
								if($campo == 'idContato'){
									$contato = array(
										"idContato"=>$valor,
										"idCampoDescricao"=>'contato-'.$ordem,
										"idCampoTipo"=>'select-tipo-'.$ordem
									);
									array_push($_SESSION['contatosSelecionados'], $contato);	
								}

								if($campo == 'descricao'){
									echo "
									<div class='div-criar-acesso'>			
										<label for='contato-$ordem'>Descrição *</label>			
									    <input type='text' value='$valor' name='contato-$ordem' id='contato-$ordem' required/>
									    <label for='select-tipo-$ordem'>Tipo *</label>
										<select name='select-tipo-$ordem' id='select-tipo-$ordem' required>
											<option value='email'>E-mail</option>
											<option value='telefone'>Telefone</option>
										</select>							    
									</div>";													
								}	

								if($campo == 'tipo'){
									echo "
									<script>									    	
								    	document.getElementById('select-tipo-$ordem').value = '$valor';
								    </script> ";		
									$ordem++;	
								}												
							}								
						}	
					?>

					<div class="coluna col12">
						<div class="div-centralizada">
							<input type="submit" value="Editar Fornecedor" class="botao-cadastro">
						</div>
					</div>
				</form>
				<div class="coluna col12">
					<div class="div-centralizada">
						<input type="submit" value="Adicionar Contato" class="botao-cadastro" onclick="adicionarContato(<?php echo $_SESSION['idParaSerEditado']; ?>)">
					</div>
				</div>
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
	    	document.getElementById('select-fornecedor-uf').value = '<?php if(isset($estado)){echo $estado;} ?>';	
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
		$empresa = $_SESSION['empresa']['razaoSocial'];
		echo "
		<script>
			var option = document.createElement('option');
			option.text = '$empresa';
			option.value = '$empresa';
			document.getElementById('select-fornecedor-empresa').appendChild(option);
		</script>";
	}
?>
<script type="text/javascript">
	document.getElementById('select-fornecedor-empresa').value = '<?php if(isset($resultadoEmpresa[0]['razaoSocial'])){echo $resultadoEmpresa[0]['razaoSocial'];} ?>';
</script>
				