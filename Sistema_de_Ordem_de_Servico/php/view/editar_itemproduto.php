<?php  
	require_once("../config/config.php");
	require_once("../autoload/autoloadModel.php");
	require_once("../autoload/autoloadView.php");
	require_once("../autoload/autoloadDAO.php");
	use excessao\ValorNaoNumericoException;

	verificarPermissao('cadastrarProduto');

	//Verifica se o ID foi passado e cria uma sessão para representar o ID
	if(isset($_POST['id'])){
		$_SESSION['idParaSerEditado'] = $_POST['id'];
	}

	//mostra todos os dados atuais da entidade
	if(isset($_SESSION['idParaSerEditado'])){
		$sql = new Sql();

		$resultadoItemProduto = $sql->select("select * from itemproduto where idItemProduto = :idItemProduto", array(
			":idItemProduto"=>$_SESSION['idParaSerEditado']
		));

		$resultadoProduto = $sql->select("select * from produto where idProduto = :idProduto", array(
			":idProduto"=>$resultadoItemProduto[0]['idProduto']
		));

		$resultadoFornecedor = $sql->select("select * from fornecedor where idFornecedor = :idFornecedor", array(
			":idFornecedor"=>$resultadoItemProduto[0]['idFornecedor']
		));

		$resultadoEmpresa = $sql->select("select * from empresa where idEmpresa = :idEmpresa", array(
			":idEmpresa"=>$resultadoItemProduto[0]['idEmpresa']
		));
		
		$nome = $resultadoProduto[0]['nome'];
		$tipo = $resultadoProduto[0]['tipo'];
		$descricao = $resultadoProduto[0]['descricao'];
		$marca = $resultadoItemProduto[0]['marca'];
		$modelo = $resultadoItemProduto[0]['modelo'];
		$promocao = $resultadoItemProduto[0]['promocao'];
		$desconto = $resultadoItemProduto[0]['desconto'];//adicionar na tela de update
		$dataCompra = date('Y-m-d',  strtotime($resultadoItemProduto[0]['dataCompra']));
		$dataValidade = $resultadoItemProduto[0]['dataValidade'];
		$codigoDeBarras = $resultadoItemProduto[0]['codigoDeBarra'];
		$quantidadeEstoque = $resultadoItemProduto[0]['quantidadeEstoque'];
		$quantidadeVendida = $resultadoItemProduto[0]['quantidadeVenda'];
		$quantidadeTotal = $quantidadeEstoque - $quantidadeVendida;
		$ativo = $resultadoItemProduto[0]['ativo'];
		$valorCompra = $resultadoItemProduto[0]['valorCompra'];
		$precoVenda = $resultadoItemProduto[0]['precoVenda'];
		$porcentagemAtacado = $resultadoItemProduto[0]['porcentagemAtacado'];
		$porcentagemVarejo = $resultadoItemProduto[0]['porcentagemVarejo'];
	}

	function editarProduto(){
		if((isset($_POST['input-produto-nome'])) && (isset($_POST['select-produto-tipo'])) && (isset($_POST['input-produto-marca'])) 
			&& (isset($_POST['input-produto-validade'])) && (isset($_POST['select-produto-empresa'])) 
			&& (isset($_POST['select-produto-fornecedor'])) && (isset($_POST['input-produto-custo-compra'])) 
			&& (isset($_POST['input-produto-preco'])) && (isset($_POST['input-produto-codigo'])) 
			&& (isset($_POST['select-produto-status'])) && (isset($_POST['input-produto-varejo'])) 
			&& (isset($_POST['input-produto-quantidade'])) && (isset($_POST['input-produto-atacado'])) 
			&& (isset($_POST['textarea-produto-descricao'])) && (isset($_POST['select-produto-promocao'])) 
			&& (isset($_POST['input-produto-desconto'])) && (isset($_POST['input-produto-datacompra']))){//(isset($_POST['input-produto-modelo']))

			$modelo = null;
			if(isset($_POST['input-produto-modelo'])){
				$modelo = $_POST['input-produto-modelo'];
			}
			
			$produto = new Produto($_POST['input-produto-nome'], $_POST['select-produto-tipo'], $_POST['input-produto-marca'], 
				$modelo, $_POST['input-produto-validade'], $_POST['select-produto-fornecedor'], 
				$_POST['select-produto-empresa'], $_POST['input-produto-custo-compra'], $_POST['input-produto-preco'], 
				$_POST['input-produto-codigo'], $_POST['input-produto-quantidade'], $_POST['select-produto-status'], 
				$_POST['input-produto-varejo'], $_POST['input-produto-atacado'], $_POST['textarea-produto-descricao']);

			$produto->setPromocao($_POST['select-produto-promocao']);
			$produto->setDesconto($_POST['input-produto-desconto']);
			$produto->setDataCompra($_POST['input-produto-datacompra']);			

			try {
				if((!is_numeric($_POST['input-produto-custo-compra'])) || (!is_numeric($_POST['input-produto-desconto'])) || 
					(!is_numeric($_POST['input-produto-preco']))){
					throw new ValorNaoNumericoException("Insira um valor numérico nos campos: custo de compra, preço de venda e desconto!", 2);					
				}	

				$produtoDAO = new ProdutoDAO($produto);
				$produtoDAO->editar($_SESSION['idParaSerEditado']);

				Mensagem::exibirMensagem("Produto editado com sucesso!");
			} catch (ValorNaoNumericoException $e2) {
				Mensagem::exibirMensagem($e2->getMessage());
			}
			
		}
	}

	editarProduto();
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
					<h2>Editar Produto</h2>
				</div>	
				<form action="" method="post">
					
						<div class="coluna col4  formulario">
							<label for="input-produto-nome">Nome *</label>
							<input type="text" name="input-produto-nome" id="input-produto-nome" required value="<?php if(isset($nome)){echo $nome;} ?>">
						</div>
						<div class="coluna col2 formulario">
							<label for="select-produto-tipo">Tipo de Produto *</label>
							<select name="select-produto-tipo" id="select-produto-tipo" required>
								<option value="alimenticio">Alimentício</option>
								<option value="brinquedo">Brinquedo</option>
								<option value="eletronico">Eletrônico</option>
								<option value="movel">Móvel</option>								
								<option value="veiculo">Veículo</option>
							</select>
						</div>
						<div class="coluna col2 formulario">
							<label for="input-produto-marca">Marca *</label>
							<input type="text" name="input-produto-marca" id="input-produto-marca" required value="<?php if(isset($marca)){echo $marca;} ?>">
						</div>
						<div class="coluna col2 formulario">
							<label for="input-produto-modelo">Modelo</label>
							<input type="text" name="input-produto-modelo" id="input-produto-modelo" value="<?php if(isset($modelo)){echo $modelo;} ?>">
						</div>
						<div class="coluna col2  formulario">
							<label for="input-produto-validade">Data de Validade *</label>
							<input type="date" name="input-produto-validade" id="input-produto-validade" required value="<?php if(isset($dataValidade)){echo $dataValidade;} ?>">
						</div>
					

					
						<div class="coluna col4 formulario">
							<label for="select-produto-empresa">Empresa *</label>
							<select name="select-produto-empresa" id="select-produto-empresa" onclick="alterarFornecedores()" required></select>
						</div>
						<div class="coluna col4 formulario">
							<label for="select-produto-fornecedor">Fornecedor *</label>
							<select name="select-produto-fornecedor" id="select-produto-fornecedor" required></select>		
						</div>					
						<div class="coluna col2 formulario">
							<label for="input-produto-custo-compra">Custo de Compra *</label>
							<input type="text" name="input-produto-custo-compra" id="input-produto-custo-compra" required value="<?php if(isset($valorCompra)){echo $valorCompra;} ?>">
						</div>
						<div class="coluna col2 formulario">
							<label for="input-produto-preco">Preço de Venda *</label>
							<input type="text" name="input-produto-preco" id="input-produto-preco" required value="<?php if(isset($precoVenda)){echo $precoVenda;} ?>">
						</div>
					

					
						<div class="coluna col4 formulario">
							<label for="input-produto-codigo">Código de Barras *</label>
							<input type="text" name="input-produto-codigo" id="input-produto-codigo" required value="<?php if(isset($codigoDeBarras)){echo $codigoDeBarras;} ?>">										
						</div>
						<div class="coluna col2 formulario"><!--sem-padding-left-->
							<label for="select-produto-status">Status *</label>
							<select name="select-produto-status" id="select-produto-status" required>
								<option value="Ativo">Ativo</option>
								<option value="Inativo">Inativo</option>
							</select>
						</div>	
						<div class="coluna col2 formulario"><!--sem-padding-right-->
							<label for="input-produto-varejo">Varejo *</label>
							<input type="text" name="input-produto-varejo" id="input-produto-varejo" required value="<?php if(isset($porcentagemVarejo)){echo $porcentagemVarejo;} ?>">
						</div>	
						<div class="coluna col2 formulario">
							<label for="input-produto-quantidade">Quantidade Estoque *</label>
							<input type="number" name="input-produto-quantidade" id="input-produto-quantidade" required value="<?php if(isset($quantidadeTotal)){echo $quantidadeTotal;} ?>">						
						</div>
						<div class="coluna col2 formulario">
							<label for="input-produto-atacado">Atacado *</label>
							<input type="text" name="input-produto-atacado" id="input-produto-atacado" required value="<?php if(isset($porcentagemAtacado)){echo $porcentagemAtacado;} ?>">
						</div>
					
					
					<div class="coluna col12 sem-padding-right sem-padding-left">						
						<div class="coluna col2">
							<label for="select-produto-promocao">Promoção *</label>
							<select name="select-produto-promocao" id="select-produto-promocao" required>
								<option value="0">Não</option>
								<option value="1">Sim</option>								
							</select>

							<label for="input-produto-desconto">Desconto *</label>
							<input type="text" name="input-produto-desconto" id="input-produto-desconto" required value="<?php if(isset($desconto)){echo $desconto;} ?>">
						</div>						
						<div class="coluna col6">
							<label for="textarea-produto-descricao">Descrição *</label>
							<textarea class="descricao-servico" id="textarea-produto-descricao" name="textarea-produto-descricao" required><?php if(isset($descricao)){echo $descricao;} ?></textarea>
						</div>
						<div class="coluna col2">
							<label for="input-produto-datacompra">Data de Compra *</label>
							<input type="date" name="input-produto-datacompra" id="input-produto-datacompra" required value="<?php if(isset($dataCompra)){echo $dataCompra;} ?>">
						</div>	
					</div>

					<div class="coluna col12">
						<div class="div-centralizada">
							<input type="submit" value="Editar Produto" class="botao-cadastro">
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

	    <script type="text/javascript">
	    	document.getElementById('select-produto-tipo').value = '<?php if(isset($tipo)){echo $tipo;} ?>';	    	
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
<script type="text/javascript">
	document.getElementById('select-produto-fornecedor').value = '<?php if(isset($resultadoFornecedor[0]['razaoSocial'])){echo $resultadoFornecedor[0]['razaoSocial'];} ?>';
	document.getElementById('select-produto-promocao').value = '<?php if(isset($promocao)){echo $promocao;} ?>';
	document.getElementById('select-produto-empresa').value = '<?php if(isset($resultadoEmpresa[0]['razaoSocial'])){echo $resultadoEmpresa[0]['razaoSocial'];} ?>';
</script>