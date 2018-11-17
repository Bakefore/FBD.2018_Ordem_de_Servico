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
		<div class="sessao" id="cadastrar-cliente">
			<div class="linha">
				<div class="coluna col12">
					<h2>Cadastrar Cliente</h2>
				</div>	
				<form action="" method="">
					<!--Linha 1-->					
					<div class="coluna col4">
						<label for="input-cliente-nome">Nome *</label>
						<input type="text" name="input-cliente-nome" id="input-cliente-nome" required>
					</div>					
					<div class="coluna col2">
						<label for="input-cliente-cpf">CPF *</label>
						<input type="text" name="input-cliente-cpf" id="input-cliente-cpf" required>
					</div>
					<div class="coluna col2">
						<label for="input-cliente-nascimento">Nascimento *</label>
						<input type="date" name="input-cliente-nascimento" id="input-cliente-nascimento" required>
					</div>
					<div class="coluna col2">
						<label for="select-cliente-sexo">Sexo *</label>
						<select name="select-cliente-sexo" id="select-cliente-sexo" required>
							<option value="M">Masculino</option>
							<option value="F">Feminino</option>
						</select>
					</div>
					<div class="coluna col2">
						<label for="select-cliente-empresa">Empresa *</label>
						<select name="select-cliente-empresa" id="select-cliente-empresa" required></select>
						<!--Criar Função para modificar os acessos dispníveis de acordo com a empresa que foi selecionada-->
					</div>					
					<!--Linha 2-->
					<div class="coluna col4">
						<label for="input-cliente-email">E-mail</label>
						<input type="email" name="input-cliente-email" id="input-cliente-email">
					</div>
					<div class="coluna col2">
						<label for="input-cliente-telefone">Telefone</label>
						<input type="text" name="input-cliente-telefone" id="input-cliente-telefone">
					</div>
					<div class="coluna col2">
						<label for="input-cliente-celular">Celular *</label>
						<input type="text" name="input-cliente-celular" id="input-cliente-celular" required>
					</div>
					<div class="coluna col2">
						<label for="input-cliente-cep">CEP *</label>
						<input maxlength="9" onblur="editarVariaveisGlobais(this.value, 'input-cliente-rua', 'input-cliente-bairro', 'input-cliente-cidade', 'select-cliente-uf');" type="text" name="input-cliente-cep" id="input-cliente-cep" required>
					</div>
					<div class="coluna col2">
						<label for="select-cliente-uf">UF *</label>
						<select name="select-cliente-uf" id="select-cliente-uf" required></select>
					</div>
					<!--Linha 3-->
					<div class="coluna col2">
						<label for="input-cliente-cidade">Cidade *</label>
						<input type="text" name="input-cliente-cidade" id="input-cliente-cidade" required>
					</div>
					<div class="coluna col2">
						<label for="input-cliente-bairro">Bairro *</label>
						<input type="text" name="input-cliente-bairro" id="input-cliente-bairro" required>
					</div>
					<div class="coluna col4">
						<label for="input-cliente-rua">Rua *</label>
						<input type="text" name="input-cliente-rua" id="input-cliente-rua" required>
					</div>
					<div class="coluna col2">
						<label for="input-cliente-numero">Número *</label>
						<input type="text" name="input-cliente-numero" id="input-cliente-numero" required>
					</div>
					<div class="coluna col2">
						<label for="input-cliente-complemento">Complemento</label>
						<input type="text" name="input-cliente-complemento" id="input-cliente-complemento">
					</div>
					<div class="div-centralizada">
						<input type="submit" value="Cadastrar Cliente" class="botao-cadastro">
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
	    	inserirEstados('select-cliente-uf');
	    </script>   	 
	</body>
</html>