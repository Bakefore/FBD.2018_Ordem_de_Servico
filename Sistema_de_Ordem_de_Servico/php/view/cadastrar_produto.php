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
		<!-- Menu Superior -->
		<div class="header">
			<div class="linha">
				<header>
					<div class="coluna col3 logo">
						<h1>Adônis</h1>
					</div>	    			
					<div class="coluna col9">
						<ul class="menu">
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
				</header>
			</div>
		</div>

		<!-- Conteúdo do Sistema -->
		<div class="sessao" id="cadastrar-produto">
			<div class="linha">
				<div class="coluna col12">
					<h2>Cadastrar Produto</h2>
				</div>	
				<form action="" method="">
					<div class="coluna col4">
						<label for="input-produto-nome">Nome *</label>
						<input type="text" name="input-produto-nome" id="input-produto-nome" required>
					</div>
					<div class="coluna col2">
						<label for="select-produto-tipo">Tipo de Produto *</label>
						<select name="select-produto-tipo" id="select-produto-tipo" required>
							<option value="alimenticio">Alimentício</option>
							<option value="movel">Móvel</option>
							<option value="eletronico">Eletrônico</option>
							<option value="veiculo">Veículo</option>
						</select>
					</div>
					<div class="coluna col2">
						<label for="input-produto-marca">Marca *</label>
						<input type="text" name="input-produto-marca" id="input-produto-marca" required>
					</div>
					<div class="coluna col2">
						<label for="input-produto-modelo">Modelo</label>
						<input type="text" name="input-produto-modelo" id="input-produto-modelo">
					</div>
					<div class="coluna col2">
						<label for="input-produto-validade">Data de Validade *</label>
						<input type="date" name="input-produto-validade" id="input-produto-validade" required>
					</div>
					<div class="coluna col4">
						<label for="select-produto-fornecedor">Fornecedor *</label>
						<select name="select-produto-fornecedor" id="select-produto-fornecedor" required></select>		
					</div>
					<div class="coluna col4">
						<label for="select-produto-empresa">Empresa *</label>
						<select name="select-produto-empresa" id="select-produto-empresa" required></select>
					</div>
					<div class="coluna col2">
						<label for="input-produto-custo-compra">Custo de Compra *</label>
						<input type="text" name="input-produto-custo-compra" id="input-produto-custo-compra" required>
					</div>
					<div class="coluna col2">
						<label for="input-produto-preco">Preço de Venda *</label>
						<input type="text" name="input-produto-preco" id="input-produto-preco" required>
					</div>
					<div class="coluna col4">
						<label for="input-produto-codigo">Código de Barras *</label>
						<input type="text" name="input-produto-codigo" id="input-produto-codigo">	

						<div class="coluna col2 sem-padding-left">
							<label for="select-produto-status">Status *</label>
							<select name="select-produto-status" id="select-produto-status" required>
								<option value="ativo">Ativo</option>
								<option value="inativo">Inativo</option>
							</select>
						</div>	
						<div class="coluna col2 sem-padding-right">
							<label for="input-produto-varejo">Varejo</label>
							<input type="text" name="input-produto-varejo" id="input-produto-varejo" required>
						</div>				
					</div>
					<div class="coluna col2">
						<label for="input-produto-quantidade">Quantidade Inicial *</label>
						<input type="text" name="input-produto-quantidade" id="input-produto-quantidade">

						<label for="input-produto-atacado">Atacado</label>
						<input type="text" name="input-produto-atacado" id="input-produto-atacado" required>
					</div>
					
					<div class="coluna col6">
						<label for="textarea-produto-descricao">Descrição *</label>
						<textarea class="descricao-servico" id="textarea-produto-descricao" required></textarea>
					</div>
					<div class="div-centralizada">
						<input type="submit" value="Cadastrar Produto" class="botao-cadastro">
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