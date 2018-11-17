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
		<div class="sessao" id="criar-ordem-servico">
			<div class="linha">				
				<div class="coluna col12">
					<h2>Criar Ordem de Serviço</h2>
				</div>
				<form action="" method="">
					<div class="coluna col12 sem-padding-right sem-padding-left">
						<div class="coluna col12">
							<h3>Serviços</h3>
						</div>
						<!--Exemplo de Como os produtos devem ser inseridos por php-->						
						<div class="div-criar-acesso">						
						    <input type="checkbox" value="0" name="input-os-servico-1" id="input-os-servico-1" />
						    <label for="input-os-servico-1">Cadastrar Serviço</label>
						</div>			
					</div>
					<div class="coluna col12 sem-padding-right sem-padding-left">
						<div class="coluna col12">
							<h3>Produtos</h3>
						</div>
						<!--Exemplo de Como os produtos devem ser inseridos por php-->						
						<!--div class="coluna col2">
							<label for="input-os-data-solicitacao">Data de Solitação *</label>
							<input type="date" name="input-os-data-solicitacao" id="input-os-data-solicitacao" required>
						</div-->
					</div>					
					<div class="coluna col4">
						<label for="select-os-empresa">Empresa *</label>
						<select name="select-os-empresa" id="select-os-empresa" required></select>
					</div>
					<div class="coluna col2">
						<label for="input-os-data-solicitacao">Data de Solitação *</label>
						<input type="date" name="input-os-data-solicitacao" id="input-os-data-solicitacao" required>
					</div>
					<div class="coluna col4">
						<label for="select-os-atendente">Atendente *</label>
						<select name="select-os-atendente" id="select-os-atendente" required></select>
					</div>
					<div class="coluna col2">
						<label for="select-os-tipo">Tipo *</label>
						<select name="select-os-tipo" id="select-os-tipo" required>
							<option value="venda">Venda</option>
							<option value="suporte">Suporte</option>
						</select>
					</div>
					<div class="coluna col4">
						<label for="select-os-cliente">Cliente *</label>
						<select name="select-os-cliente" id="select-os-cliente" required></select>
					</div>
					<div class="coluna col4">
						<label for="select-os-tecnico">Técnico Responsável *</label>
						<select name="select-os-tecnico" id="select-os-tecnico" required></select>
					</div>
					<div class="coluna col2">
						<label for="input-os-data-data-execucao">Data de Execução *</label>
						<input type="date" name="input-os-data-data-execucao" id="input-os-data-data-execucao" required>
					</div>
					<div class="coluna col2">
						<label for="select-os-forma-pagamento">Pagamento *</label>
						<select name="select-os-forma-pagamento" id="select-os-forma-pagamento" required>
							<option value="a vista">À Vista</option>
							<option value="a prazo">À Prazo</option>
						</select>
					</div>
					<div class="coluna col2">
						<label for="input-os-desconto">Desconto</label>
						<input type="text" name="input-os-desconto" id="input-os-desconto" required>

						<label for="input-os-valor-parcela">Valor da Parcela</label>
						<input type="text" name="input-os-valor-parcela" id="input-os-valor-parcela" required>
					</div>
					<div class="coluna col2">
						<label for="input-os-quantidade-parcelas">Parcelas</label>
						<input type="number" name="input-os-quantidade-parcelas" id="input-os-quantidade-parcelas" required>

						<label for="input-os-valor-total">Valor Total</label>
						<input type="text" name="input-os-valor-total" id="input-os-valor-total" required>
					</div>
					<div class="coluna col8">
						<label for="textarea-os-descricao">Descrição</label>
						<textarea class="descricao-servico" id="textarea-os-descricao" required></textarea>
					</div>
					<div class="div-centralizada">
						<input type="submit" value="Criar Ordem de Serviço" class="botao-cadastro">
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