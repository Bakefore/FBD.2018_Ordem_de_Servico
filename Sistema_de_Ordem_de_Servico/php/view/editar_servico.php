<?php  
	require_once("../config/config.php");
	require_once("../autoload/autoloadModel.php");
	require_once("../autoload/autoloadView.php");
	require_once("../autoload/autoloadDAO.php");
	use excessao\EntidadeJaCadastradaException;
	use excessao\ValorNaoNumericoException;

	verificarPermissao('adicionarServico');

	//Verifica se o ID foi passado e cria uma sessão para representar o ID
	if(isset($_POST['id'])){
		$_SESSION['idParaSerEditado'] = $_POST['id'];
	}

	//mostra todos os dados atuais da entidade
	if(isset($_SESSION['idParaSerEditado'])){
		$sql = new Sql();

		$resultadoServico = $sql->select("select * from servico where idServico = :idServico", array(
			":idServico"=>$_SESSION['idParaSerEditado']
		));

		$resultadoEmpresa = $sql->select("select * from empresa where idEmpresa = :idEmpresa", array(
			":idEmpresa"=>$resultadoServico[0]['idEmpresa']
		));

		$nome = $resultadoServico[0]['nome'];
		$tipo = $resultadoServico[0]['tipo'];
		$descricao = $resultadoServico[0]['descricao'];
		$valor = $resultadoServico[0]['valor'];
	}

	function editarServico(){
		if((isset($_POST['input-servico-nome'])) && (isset($_POST['select-servico-empresa'])) && (isset($_POST['input-servico-valor'])) 
			&& (isset($_POST['select-servico-tipo']))  && (isset($_POST['textarea-servico-descricao']))){

			$servico = new Servico($_POST['input-servico-nome'], $_POST['input-servico-valor'], $_POST['select-servico-empresa'], 
				$_POST['select-servico-tipo'], $_POST['textarea-servico-descricao']);

			try {
				if(!is_numeric($_POST['input-servico-valor'])){
					throw new ValorNaoNumericoException("Insira um valor numérico no campo valor!", 2);					
				}

				$servicoDAO = new ServicoDAO($servico);
				$servicoDAO->editar($_SESSION['idParaSerEditado']);

				Mensagem::exibirMensagem("O Serviço foi atualizado com sucesso!");
			} catch (ValorNaoNumericoException $e2) {
				Mensagem::exibirMensagem($e2->getMessage());
			}
		}
	}
	editarServico();
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
		<div class="sessao" id="cadastrar-servico">
			<div class="linha">
				<div class="coluna col12">
					<h2>Editar Serviço</h2>
				</div>	
				<form action="" method="post">
					<div class="coluna col4 formulario">
						<label for="input-servico-nome">Nome *</label>
						<input type="text" name="input-servico-nome" id="input-servico-nome" required value="<?php if(isset($nome)){echo $nome;} ?>">

						<label for="select-servico-empresa">Empresa *</label>
						<select name="select-servico-empresa" id="select-servico-empresa" required></select>		
					</div>
					<div class="coluna col2 formulario">
						<label for="input-servico-valor">Valor *</label>
						<input type="text" name="input-servico-valor" id="input-servico-valor" required value="<?php if(isset($valor)){echo $valor;} ?>">

						<label for="select-servico-tipo">Tipo de Serviço *</label>
						<select name="select-servico-tipo" id="select-servico-tipo" required>
							<option value="Técnico">Técnico</option>
						</select>
					</div>	
					<div class="coluna col6 formulario">
						<label for="textarea-servico-descricao">Descrição *</label>
						<textarea class="descricao-servico" id="textarea-servico-descricao" name="textarea-servico-descricao" required><?php if(isset($descricao)){echo $descricao;} ?></textarea>
					</div>	
					<div class="coluna col12">
						<div class="div-centralizada">
							<input type="submit" value="Editar Serviço" class="botao-cadastro">
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
						document.getElementById('select-servico-empresa').appendChild(option);
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
			document.getElementById('select-servico-empresa').appendChild(option);
		</script>";
	}
?>
<script type="text/javascript">
	document.getElementById('select-servico-empresa').value = '<?php if(isset($resultadoEmpresa[0]['razaoSocial'])){echo $resultadoEmpresa[0]['razaoSocial'];} ?>';
	document.getElementById('select-servico-tipo').value = '<?php if(isset($tipo)){echo $tipo;} ?>';
</script>