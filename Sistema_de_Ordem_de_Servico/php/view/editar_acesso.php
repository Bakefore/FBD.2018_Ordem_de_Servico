<?php  
	require_once("../config/config.php");
	require_once("../autoload/autoloadModel.php");
	require_once("../autoload/autoloadView.php");
	require_once("../autoload/autoloadDAO.php");
	use excessao\EntidadeJaCadastradaException;

	verificarPermissao('criarAcesso');

	//Verifica se o ID foi passado e cria uma sessão para representar o ID
	if(isset($_POST['id'])){
		$_SESSION['idParaSerEditado'] = $_POST['id'];
	}

	//mostra todos os dados atuais da entidade
	if(isset($_SESSION['idParaSerEditado'])){
		$sql = new Sql();

		$resultadoAcesso = $sql->select("select * from acesso where idAcesso = :idAcesso", array(
			":idAcesso"=>$_SESSION['idParaSerEditado']
		));
		
		$nome = $resultadoAcesso[0]['nome'];	
	}

	//Verifica os dados passados para então fazer a criação de um acesso	
	function editarAcesso(){
		if(isset($_POST['input-acesso-nome'])){
			$acesso = new Acesso($_POST['input-acesso-nome']);			
			$acesso->setCadastrarEmpresa(isset($_POST['input-empresa-cadastar-empresa']))?true:false;			
			$acesso->setPesquisarEmpresa(isset($_POST['input-empresa-pesquisar-empresa']))?true:false;						
			$acesso->setEditarEmpresa(isset($_POST['input-empresa-editar-empresa']))?true:false;					
			$acesso->setExcluirEmpresa(isset($_POST['input-empresa-excluir-empresa']))?true:false;	
			$acesso->setCriarAcesso(isset($_POST['input-acesso-criar-acesso']))?true:false;					
			$acesso->setPesquisarAcesso(isset($_POST['input-acesso-pesquisar-acesso']))?true:false;						
			$acesso->setEditarAcesso(isset($_POST['input-acesso-editar-acesso']))?true:false;					
			$acesso->setExcluirAcesso(isset($_POST['input-acesso-excluir-acesso']))?true:false;						
			$acesso->setCadastrarFuncionario(isset($_POST['input-funcionario-cadastrar-funcionario']))?true:false;			
			$acesso->setPesquisarFuncionario(isset($_POST['input-funcionario-pesquisar-funcionario']))?true:false;			
			$acesso->setEditarFuncionario(isset($_POST['input-funcionario-editar-funcionario']))?true:false;				
			$acesso->setExcluirFuncionario(isset($_POST['input-funcionario-excluir-funcionario']))?true:false;				
			$acesso->setCadastrarCliente(isset($_POST['input-cliente-cadastrar-cliente']))?true:false;				
			$acesso->setPesquisarCliente(isset($_POST['input-cliente-pesquisar-cliente']))?true:false;						
			$acesso->setEditarCliente(isset($_POST['input-cliente-editar-cliente']))?true:false;						
			$acesso->setExcluirCliente(isset($_POST['input-cliente-excluir-cliente']))?true:false;						
			$acesso->setCadastrarServico(isset($_POST['input-servico-cadastrar-servico']))?true:false;						
			$acesso->setPesquisarServico(isset($_POST['input-servico-pesquisar-servico']))?true:false;						
			$acesso->setEditarServico(isset($_POST['input-servico-editar-servico']))?true:false;						
			$acesso->setExcluirServico(isset($_POST['input-servico-excluir-servico']))?true:false;
			$acesso->setCadastrarFornecedor(isset($_POST['input-fornecedor-cadastrar-fornecedor']))?true:false;
			$acesso->setPesquisarFornecedor(isset($_POST['input-fornecedor-pesquisar-fornecedor']))?true:false;
			$acesso->setEditarFornecedor(isset($_POST['input-fornecedor-editar-fornecedor']))?true:false;
			$acesso->setExcluirFornecedor(isset($_POST['input-fornecedor-excluir-fornecedor']))?true:false;
			$acesso->setCadastrarProduto(isset($_POST['input-produto-cadastrar-produto']))?true:false;						
			$acesso->setPesquisarProduto(isset($_POST['input-produto-pesquisar-produto']))?true:false;						
			$acesso->setEditarProduto(isset($_POST['input-produto-editar-produto']))?true:false;						
			$acesso->setExcluirProduto(isset($_POST['input-produto-excluir-produto']))?true:false;						
			$acesso->setCriarOrdemDeServico(isset($_POST['input-os-criar-os']))?true:false;						
			$acesso->setPesquisarOrdemDeServico(isset($_POST['input-os-pesquisar-os']))?true:false;						
			$acesso->setEditarOrdemDeServico(isset($_POST['input-os-editar-os']))?true:false;						
			$acesso->setExcluirOrdemDeServico(isset($_POST['input-os-excluir-os']))?true:false;						
			$acesso->setExibirFinanceiro(isset($_POST['input-exibir-financas']))?true:false;						
			$acesso->setEditarFinanceiro(isset($_POST['input-editar-financas']))?true:false;			

			
			$acessoDAO = new AcessoDAO($acesso);					
			$acessoDAO->editar($_SESSION['idParaSerEditado']);

			Mensagem::exibirMensagem("O acesso foi atualizado com sucesso!");
			
		}
	}

	editarAcesso();	
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
		<div class="sessao" id="criar-acesso">
			<div class="linha">
				<div class="coluna col12">
					<h2>Editar Acesso</h2>
				</div>				
				<form action="" method="post">
					<div class="coluna col12">
						<label for="input-acesso-nome">Nome *</label>
						</br>
						<input class="input-titulo-nome" type="text" name="input-acesso-nome" id="input-acesso-nome" required value="<?php if(isset($nome)){echo $nome;} ?>">
					</div>
					<div class="div-criar-acesso">						
					    <input type="checkbox" value="cadastar-empresa" name="input-empresa-cadastar-empresa" id="input-empresa-cadastar-empresa" <?php if($resultadoAcesso[0]['cadastrarEmpresa']){echo "checked";} ?> />
					    <label for="input-empresa-cadastar-empresa">Cadastrar Empresa</label>
						</br></br>
					    <input type="checkbox" value="pesquisar-empresa" name="input-empresa-pesquisar-empresa" id="input-empresa-pesquisar-empresa" <?php if($resultadoAcesso[0]['pesquisarEmpresa']){echo "checked";} ?>/>
					    <label for="input-empresa-pesquisar-empresa" onclick="desmarcarEditarExcluir('input-empresa-pesquisar-empresa', 'input-empresa-editar-empresa', 'input-empresa-excluir-empresa')">Pesquisar Empresa</label>		
					    </br></br>
					    <input type="checkbox" value="editar-empresa" name="input-empresa-editar-empresa" id="input-empresa-editar-empresa" <?php if($resultadoAcesso[0]['editarEmpresa']){echo "checked";} ?>/>
					    <label for="input-empresa-editar-empresa" onclick="marcarCheckbox('input-empresa-pesquisar-empresa', 'input-empresa-editar-empresa')">Editar Empresa</label>
					    </br></br>
					    <input type="checkbox" value="excluir-empresa" name="input-empresa-excluir-empresa" id="input-empresa-excluir-empresa" <?php if($resultadoAcesso[0]['excluirEmpresa']){echo "checked";} ?>/>
					    <label for="input-empresa-excluir-empresa" onclick="marcarCheckbox('input-empresa-pesquisar-empresa', 'input-empresa-excluir-empresa')">Excluir Empresa</label>				
					</div>
					<div class="div-criar-acesso">						
					   	<input type="checkbox" value="criar-acesso" name="input-acesso-criar-acesso" id="input-acesso-criar-acesso" <?php if($resultadoAcesso[0]['criarAcesso']){echo "checked";} ?>/>
					    <label for="input-acesso-criar-acesso">Criar Acesso</label>
						</br></br>
					    <input type="checkbox" value="pesquisar-acesso" name="input-acesso-pesquisar-acesso" id="input-acesso-pesquisar-acesso" <?php if($resultadoAcesso[0]['pesquisarAcesso']){echo "checked";} ?>/>
					    <label for="input-acesso-pesquisar-acesso" onclick="desmarcarEditarExcluir('input-acesso-pesquisar-acesso', 'input-acesso-editar-acesso', 'input-acesso-excluir-acesso')">Pesquisar Acesso</label>		
					    </br></br>
					    <input type="checkbox" value="editar-acesso" name="input-acesso-editar-acesso" id="input-acesso-editar-acesso" <?php if($resultadoAcesso[0]['editarAcesso']){echo "checked";} ?>/>
					    <label for="input-acesso-editar-acesso" onclick="marcarCheckbox('input-acesso-pesquisar-acesso', 'input-acesso-editar-acesso')">Editar Acesso</label>		
					    </br></br>
					    <input type="checkbox" value="excluir-acesso" name="input-acesso-excluir-acesso" id="input-acesso-excluir-acesso" <?php if($resultadoAcesso[0]['excluirAcesso']){echo "checked";} ?>/>
					    <label for="input-acesso-excluir-acesso" onclick="marcarCheckbox('input-acesso-pesquisar-acesso', 'input-acesso-excluir-acesso')">Excluir Acesso</label>					
					</div>
					<div class="div-criar-acesso">						
					    <input type="checkbox" value="cadastrar-funcionario" name="input-funcionario-cadastrar-funcionario" id="input-funcionario-cadastrar-funcionario" <?php if($resultadoAcesso[0]['cadastrarFuncionario']){echo "checked";} ?>/>
					    <label for="input-funcionario-cadastrar-funcionario">Cadastrar Funcionário</label>
						</br></br>
					    <input type="checkbox" value="pesquisar-funcionario" name="input-funcionario-pesquisar-funcionario" id="input-funcionario-pesquisar-funcionario" <?php if($resultadoAcesso[0]['pesquisarFuncionario']){echo "checked";} ?>/>
					    <label for="input-funcionario-pesquisar-funcionario" onclick="desmarcarEditarExcluir('input-funcionario-pesquisar-funcionario', 'input-funcionario-editar-funcionario', 'input-funcionario-excluir-funcionario')">Pesquisar Funcionário</label>		
					    </br></br>
					    <input type="checkbox" value="editar-funcionario" name="input-funcionario-editar-funcionario" id="input-funcionario-editar-funcionario" <?php if($resultadoAcesso[0]['editarFuncionario']){echo "checked";} ?>/>
					    <label for="input-funcionario-editar-funcionario" onclick="marcarCheckbox('input-funcionario-pesquisar-funcionario', 'input-funcionario-editar-funcionario')">Editar Funcionário</label>		
					    </br></br>
					    <input type="checkbox" value="excluir-funcionario" name="input-funcionario-excluir-funcionario" id="input-funcionario-excluir-funcionario" <?php if($resultadoAcesso[0]['excluirFuncionario']){echo "checked";} ?>/>
					    <label for="input-funcionario-excluir-funcionario" onclick="marcarCheckbox('input-funcionario-pesquisar-funcionario', 'input-funcionario-excluir-funcionario')">Excluir Funcionário</label>						
					</div>
					<div class="div-criar-acesso">						
					    <input type="checkbox" value="cadastrar-cliente" name="input-cliente-cadastrar-cliente" id="input-cliente-cadastrar-cliente" <?php if($resultadoAcesso[0]['cadastrarCliente']){echo "checked";} ?>/>
					    <label for="input-cliente-cadastrar-cliente">Cadastrar Cliente</label>
						</br></br>
					    <input type="checkbox" value="pesquisar-cliente" name="input-cliente-pesquisar-cliente" id="input-cliente-pesquisar-cliente" <?php if($resultadoAcesso[0]['pesquisarCliente']){echo "checked";} ?>/>
					    <label for="input-cliente-pesquisar-cliente" onclick="desmarcarEditarExcluir('input-cliente-pesquisar-cliente', 'input-cliente-editar-cliente', 'input-cliente-excluir-cliente')">Pesquisar Cliente</label>		
					    </br></br>
					    <input type="checkbox" value="editar-cliente" name="input-cliente-editar-cliente" id="input-cliente-editar-cliente" <?php if($resultadoAcesso[0]['editarCliente']){echo "checked";} ?>/>
					    <label for="input-cliente-editar-cliente" onclick="marcarCheckbox('input-cliente-pesquisar-cliente', 'input-cliente-editar-cliente')">Editar Cliente</label>		
					    </br></br>
					    <input type="checkbox" value="excluir-cliente" name="input-cliente-excluir-cliente" id="input-cliente-excluir-cliente" <?php if($resultadoAcesso[0]['excluirCliente']){echo "checked";} ?>/>
					    <label for="input-cliente-excluir-cliente" onclick="marcarCheckbox('input-cliente-pesquisar-cliente', 'input-cliente-excluir-cliente')">Excluir Cliente</label>						
					</div>
					<div class="div-criar-acesso">						
					    <input type="checkbox" value="cadastrar-servico" name="input-servico-cadastrar-servico" id="input-servico-cadastrar-servico" <?php if($resultadoAcesso[0]['adicionarServico']){echo "checked";} ?>/>
					    <label for="input-servico-cadastrar-servico">Cadastrar Serviço</label>
						</br></br>
					    <input type="checkbox" value="pesquisar-servico" name="input-servico-pesquisar-servico" id="input-servico-pesquisar-servico" <?php if($resultadoAcesso[0]['pesquisarServico']){echo "checked";} ?>/>
					    <label for="input-servico-pesquisar-servico" onclick="desmarcarEditarExcluir('input-servico-pesquisar-servico', 'input-servico-editar-servico', 'input-servico-excluir-servico')">Pesquisar Serviço</label>		
					    </br></br>
					    <input type="checkbox" value="editar-servico" name="input-servico-editar-servico" id="input-servico-editar-servico" <?php if($resultadoAcesso[0]['editarServico']){echo "checked";} ?>/>
					    <label for="input-servico-editar-servico" onclick="marcarCheckbox('input-servico-pesquisar-servico', 'input-servico-editar-servico')">Editar Serviço</label>		
					    </br></br>
					    <input type="checkbox" value="excluir-servico" name="input-servico-excluir-servico" id="input-servico-excluir-servico" <?php if($resultadoAcesso[0]['excluirServico']){echo "checked";} ?>/>
					    <label for="input-servico-excluir-servico" onclick="marcarCheckbox('input-servico-pesquisar-servico', 'input-servico-excluir-servico')">Excluir Serviço</label>				
					</div>




					<div class="div-criar-acesso">						
					    <input type="checkbox" value="cadastrar-fornecedor" name="input-fornecedor-cadastrar-fornecedor" id="input-fornecedor-cadastrar-fornecedor" <?php if($resultadoAcesso[0]['cadastrarFornecedor']){echo "checked";} ?>/>
					    <label for="input-fornecedor-cadastrar-fornecedor">Cadastrar Fornecedor</label>
						</br></br>
					    <input type="checkbox" value="pesquisar-fornecedor" name="input-fornecedor-pesquisar-fornecedor" id="input-fornecedor-pesquisar-fornecedor" <?php if($resultadoAcesso[0]['pesquisarFornecedor']){echo "checked";} ?>/>
					    <label for="input-fornecedor-pesquisar-fornecedor" onclick="desmarcarEditarExcluir('input-fornecedor-pesquisar-fornecedor', 'input-fornecedor-editar-fornecedor', 'input-fornecedor-excluir-fornecedor')">Pesquisar Fornecedor</label>		
					    </br></br>
					    <input type="checkbox" value="editar-fornecedor" name="input-fornecedor-editar-fornecedor" id="input-fornecedor-editar-fornecedor" <?php if($resultadoAcesso[0]['editarFornecedor']){echo "checked";} ?>/>
					    <label for="input-fornecedor-editar-fornecedor" onclick="marcarCheckbox('input-fornecedor-pesquisar-fornecedor', 'input-fornecedor-editar-fornecedor')">Editar Fornecedor</label>		
					    </br></br>
					    <input type="checkbox" value="excluir-fornecedor" name="input-fornecedor-excluir-fornecedor" id="input-fornecedor-excluir-fornecedor" <?php if($resultadoAcesso[0]['excluirFornecedor']){echo "checked";} ?>/>
					    <label for="input-fornecedor-excluir-fornecedor" onclick="marcarCheckbox('input-fornecedor-pesquisar-fornecedor', 'input-fornecedor-excluir-fornecedor')">Excluir Fornecedor</label>				
					</div>





					<div class="div-criar-acesso">						
					    <input type="checkbox" value="cadastrar-produto" name="input-produto-cadastrar-produto" id="input-produto-cadastrar-produto" <?php if($resultadoAcesso[0]['cadastrarProduto']){echo "checked";} ?>/>
					    <label for="input-produto-cadastrar-produto">Cadastrar Produto</label>
						</br></br>
					    <input type="checkbox" value="pesquisar-produto" name="input-produto-pesquisar-produto" id="input-produto-pesquisar-produto" <?php if($resultadoAcesso[0]['pesquisarProduto']){echo "checked";} ?>/>
					    <label for="input-produto-pesquisar-produto" onclick="desmarcarEditarExcluir('input-produto-pesquisar-produto', 'input-produto-editar-produto', 'input-produto-excluir-produto')">Pesquisar Produto</label>		
					    </br></br>
					    <input type="checkbox" value="editar-produto" name="input-produto-editar-produto" id="input-produto-editar-produto" <?php if($resultadoAcesso[0]['editarProduto']){echo "checked";} ?>/>
					    <label for="input-produto-editar-produto" onclick="marcarCheckbox('input-produto-pesquisar-produto', 'input-produto-editar-produto')">Editar Produto</label>		
					    </br></br>
					    <input type="checkbox" value="excluir-produto" name="input-produto-excluir-produto" id="input-produto-excluir-produto" <?php if($resultadoAcesso[0]['excluirProduto']){echo "checked";} ?>/>
					    <label for="input-produto-excluir-produto" onclick="marcarCheckbox('input-produto-pesquisar-produto', 'input-produto-excluir-produto')">Excluir Produto</label>				
					</div>
					<div class="div-criar-acesso">						
					    <input type="checkbox" value="criar-os" name="input-os-criar-os" id="input-os-criar-os" <?php if($resultadoAcesso[0]['criarOrdemDeServico']){echo "checked";} ?>/>
					    <label for="input-os-criar-os">Criar Ordem de Serviço</label>
						</br></br>
					    <input type="checkbox" value="pesquisar-os" name="input-os-pesquisar-os" id="input-os-pesquisar-os" <?php if($resultadoAcesso[0]['pesquisarOrdemDeServico']){echo "checked";} ?>/>
					    <label for="input-os-pesquisar-os" onclick="desmarcarEditarExcluir('input-os-pesquisar-os', 'input-os-editar-os', 'input-os-excluir-os')">Pesquisar Ordem de Serviço</label>		
					    </br></br>
					    <input type="checkbox" value="editar-os" name="input-os-editar-os" id="input-os-editar-os" <?php if($resultadoAcesso[0]['editarOrdemDeServico']){echo "checked";} ?>/>
					    <label for="input-os-editar-os" onclick="marcarCheckbox('input-os-pesquisar-os', 'input-os-editar-os')">Editar Ordem de Serviço</label>		
					    </br></br>
					    <input type="checkbox" value="excluir-os" name="input-os-excluir-os" id="input-os-excluir-os" <?php if($resultadoAcesso[0]['excluirOrdemDeServico']){echo "checked";} ?>/>
					    <label for="input-os-excluir-os" onclick="marcarCheckbox('input-os-pesquisar-os', 'input-os-excluir-os')">Excluir Ordem de Serviço</label>				
					</div>
					<div class="div-criar-acesso">						
					    <input type="checkbox" value="exibir-financas" name="input-exibir-financas" id="input-exibir-financas" <?php if($resultadoAcesso[0]['exibirFinanceiro']){echo "checked";} ?>/>
					    <label for="input-exibir-financas" onclick="desmarcarEditarExcluir('input-exibir-financas', 'input-editar-financas')">Exibir Finanças</label>
						</br></br>
						<input type="checkbox" value="editar-financas" name="input-editar-financas" id="input-editar-financas" <?php if($resultadoAcesso[0]['editarFinanceiro']){echo "checked";} ?>/>
					    <label for="input-editar-financas" onclick="marcarCheckbox('input-exibir-financas', 'input-editar-financas')">Editar Finanças</label>			    			
					</div>
					<div class="coluna col12">
						<div class="div-centralizada">
							<input type="submit" value="Editar Acesso" class="botao-cadastro">
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