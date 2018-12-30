<?php  
	require_once("../config/config.php");
	require_once("../autoload/autoloadModel.php");
	require_once("../autoload/autoloadView.php");
	require_once("../autoload/autoloadDAO.php");	
	use excessao\CNPJinvalidoException;	
	use excessao\EntidadeJaCadastradaException;

	verificarPermissao('editarEmpresa');	
	
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

		$resultadoEmpresa = $sql->select("select * from empresa where idEmpresa = :idEmpresa", array(
			":idEmpresa"=>$_SESSION['idParaSerEditado']
		));

		$resultadoEndereco = $sql->select("select * from endereco where idEndereco = :idEndereco", array(
			":idEndereco"=>$resultadoEmpresa[0]['idEndereco']
		));

		$resultadoCidade = $sql->select("select * from cidade where idCidade = :idCidade", array(
			":idCidade"=>$resultadoEndereco[0]['idCidade']
		));

		$resultadoEstado = $sql->select("select * from estado where idEstado = :idEstado", array(
			":idEstado"=>$resultadoCidade[0]['idEstado']
		));

		$razaoSocial = $resultadoEmpresa[0]['razaoSocial'];
		$nomeFantasia = $resultadoEmpresa[0]['nomeFantasia'];
		$cnpj = preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/','$1.$2.$3/$4-$5',$resultadoEmpresa[0]['cnpj']);
		$bairro = $resultadoEndereco[0]['bairro'];
		$rua = 	$resultadoEndereco[0]['rua'];
		$numero = $resultadoEndereco[0]['numero'];
		$complemento = $resultadoEndereco[0]['complemento'];
		$cidade = $resultadoCidade[0]['nome'];
		$estado = $resultadoEstado[0]['uf'];
	}	

	function editarEmpresa(){
		if((isset($_POST['input-empresa-razao-social'])) && (isset($_POST['input-empresa-nome-fantasia'])) 
			&& (isset($_POST['input-empresa-cnpj'])) && (isset($_POST['input-empresa-cep'])) 
			&& (isset($_POST['select-empresa-uf'])) && (isset($_POST['input-empresa-cidade'])) 
			&& (isset($_POST['input-empresa-bairro'])) && (isset($_POST['input-empresa-rua'])) 
			&& (isset($_POST['input-empresa-numero']))){

			$endereco = new Endereco($_POST['input-empresa-cep'], $_POST['select-empresa-uf'], $_POST['input-empresa-cidade'], 
				$_POST['input-empresa-bairro'], $_POST['input-empresa-rua'], $_POST['input-empresa-numero'], 
				(isset($_POST['input-empresa-complemento']))?$_POST['input-empresa-complemento']:"");

			$empresa = new Empresa($_POST['input-empresa-razao-social'], $_POST['input-empresa-nome-fantasia'], $_POST['input-empresa-cnpj'], 
				$endereco, null);			

			try {
				if(!Validador::validarCNPJ($empresa->getCNPJ())){
					throw new CNPJinvalidoException("O CNPJ inserido não é válido", 1);				
				}

				$enderecoDAO = new EnderecoDAO($endereco);
				$enderecoDAO->cadastrar();
				$empresaDAO = new EmpresaDAO($empresa, $enderecoDAO->getId());
				$empresaDAO->editar($_SESSION['idParaSerEditado']);		

				//criar DAO para contato e atualizar de forma dinâmica
				foreach ($_SESSION['contatosSelecionados'] as $contato) {
					$campoTipo = $contato['idCampoTipo'];
					$campoDescricao = $contato['idCampoDescricao'];

					if((isset($_POST[$campoTipo])) && (isset($_POST[$campoDescricao]))){
						$novoContato = new Contato($_POST[$campoTipo], $_POST[$campoDescricao]);
						$contatoDAO = new ContatoDAO($novoContato, 'contatoEmpresa', $_SESSION['idParaSerEditado']);
						$contatoDAO->editar($contato['idContato'], 'contatoEmpresa');	
					}
				}

				//Retira os contatos da lista de contatos selecionados
				for ($i=0; $i < count($_SESSION['contatosSelecionados']); $i++) { 
					$_SESSION['contatosSelecionados'][$i] = null;
				}
				//fim da edição de contatos		

				Mensagem::exibirMensagem("A Empresa foi editada com sucesso!");
			} catch (CNPJinvalidoException $e) {
				Mensagem::exibirMensagem($e->getMessage());
			}		
		}
	}

	
	editarEmpresa();
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
	    		var tabela = 'contatoEmpresa';									
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
		<div class="sessao" id="cadastrar-empresa">
			<div class="linha">
				<div class="coluna col12">
					<h2>Editar Empresa</h2>
				</div>
				<form action="" method="post">
					<!--Linha 1-->					
					<div class="coluna col4">
						<label for="input-empresa-razao-social">Razão Social *</label>
						<input type="text" name="input-empresa-razao-social" id="input-empresa-razao-social" required value="<?php if(isset($razaoSocial)){echo $razaoSocial;} ?>">
					</div>
					<div class="coluna col2">
						<label for="input-empresa-nome-fantasia">Nome Fantasia</label>
						<input type="text" name="input-empresa-nome-fantasia" id="input-empresa-nome-fantasia" value="<?php if(isset($nomeFantasia)){echo $nomeFantasia;} ?>">
					</div>
					<div class="coluna col2">
						<label for="input-empresa-cnpj">CNPJ *</label>
						<input type="text" name="input-empresa-cnpj" id="input-empresa-cnpj" required value="<?php if(isset($cnpj)){echo $cnpj;} ?>">
					</div>										
					<div class="coluna col2">
						<label for="input-empresa-cep">CEP</label>
						<input maxlength="9" onblur="editarVariaveisGlobais(this.value, 'input-empresa-rua', 'input-empresa-bairro', 'input-empresa-cidade', 'select-empresa-uf');" type="text" name="input-empresa-cep" id="input-empresa-cep">
					</div>
					<div class="coluna col2">
						<label for="select-empresa-uf">UF *</label>
						<select name="select-empresa-uf" id="select-empresa-uf" required></select>
					</div>
					<!--Linha 2-->
					<div class="coluna col2">
						<label for="input-empresa-cidade">Cidade *</label>
						<input type="text" name="input-empresa-cidade" id="input-empresa-cidade" required value="<?php if(isset($cidade)){echo $cidade;} ?>">
					</div>
					<div class="coluna col2">
						<label for="input-empresa-bairro">Bairro *</label>
						<input type="text" name="input-empresa-bairro" id="input-empresa-bairro" required value="<?php if(isset($bairro)){echo $bairro;} ?>">
					</div>
					<div class="coluna col4">
						<label for="input-empresa-rua">Rua *</label>
						<input type="text" name="input-empresa-rua" id="input-empresa-rua" required value="<?php if(isset($rua)){echo $rua;} ?>">
					</div>
					<div class="coluna col2">
						<label for="input-empresa-numero">Número *</label>
						<input type="text" name="input-empresa-numero" id="input-empresa-numero" required value="<?php if(isset($numero)){echo $numero;} ?>">
					</div>
					<div class="coluna col2">
						<label for="input-empresa-complemento">Complemento</label>
						<input type="text" name="input-empresa-complemento" id="input-empresa-complemento" value="<?php if(isset($complemento)){echo $complemento;} ?>">
					</div>					
					
					<!--Lista os contatos que estão relacionados ao cadastro-->
					<div class="coluna col12">
						<h3>Contatos</h3>
					</div>
					<?php  
						$sql = new Sql();
						$contatos = $sql->select("select * from contatoEmpresa where idReferenciado = :idReferenciado", array(
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
							<input type="submit" value="Editar Empresa" class="botao-cadastro">
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
	    	inserirEstados('select-empresa-uf');
	    	document.getElementById('select-empresa-uf').value = '<?php if(isset($estado)){echo $estado;}; ?>';
	    </script>  
	</body>
</html>

