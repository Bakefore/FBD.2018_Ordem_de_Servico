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
		<div class="sessao" id="cadastrar-funcionario">
			<div class="linha">
				<div class="coluna col12">
					<h2>Cadastrar Funcionário</h2>
				</div>	
				<form action="" method="">
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
					<!--Linha 2-->
					<div class="coluna col4">
						<label for="input-funcionario-login">Login *</label>
						<input type="text" name="input-funcionario-login" id="input-funcionario-login" required>
					</div>
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
					<!--Linha 3-->
					<div class="coluna col4">
						<label for="input-funcionario-email">E-mail</label>
						<input type="email" name="input-funcionario-email" id="input-funcionario-email">
					</div>
					<div class="coluna col2">
						<label for="input-funcionario-telefone">Telefone</label>
						<input type="text" name="input-funcionario-telefone" id="input-funcionario-telefone">
					</div>
					<div class="coluna col2">
						<label for="input-funcionario-celular">Celular *</label>
						<input type="text" name="input-funcionario-celular" id="input-funcionario-celular" required>
					</div>
					<div class="coluna col2">
						<label for="input-funcionario-cep">CEP *</label>
						<input maxlength="9" onblur="editarVariaveisGlobais(this.value, 'input-funcionario-rua', 'input-funcionario-bairro', 'input-funcionario-cidade', 'select-funcionario-uf');" type="text" name="input-funcionario-cep" id="input-funcionario-cep" required>
					</div>
					<div class="coluna col2">
						<label for="select-funcionario-uf">UF *</label>
						<select name="select-funcionario-uf" id="select-funcionario-uf" required></select>
					</div>
					<!--Linha 4-->
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
					<div class="div-centralizada">
						<input type="submit" value="Cadastrar Funcionário" class="botao-cadastro">
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
	    	inserirEstados('select-funcionario-uf');
	    </script>   	 
	</body>
</html>

				