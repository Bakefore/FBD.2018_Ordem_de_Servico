<?php  
	require_once("../config/config.php");
	require_once("../autoload/autoloadModel.php");
	require_once("../autoload/autoloadView.php");
	require_once("../autoload/autoloadDAO.php");

	verificarPermissao('criarOrdemDeServico');
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
	    	function removerProdutoDoCarrinho(idProduto){
	    		window.location.href = "../controller/carrinho.php?deletar=" + idProduto;
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
		<div class="sessao" id="criar-ordem-servico">
			<div class="linha">				
				<div class="coluna col12">
					<h2>Criar Ordem de Serviço</h2>
				</div>
				<form action="" method="post">
					<div class="coluna col12 sem-padding-right sem-padding-left">
						<div class="coluna col12">
							<h3>Serviços</h3>
						</div>
						<?php  
							$sql = new Sql();
							$servicos = $sql->select("select * from servico", array());
							foreach ($servicos as $servico) {				
								foreach ($servico as $campo => $valor) {
									if($campo == 'nome'){
										echo "
										<div class='div-criar-acesso'>						
										    <input type='checkbox' value='$valor' name='$valor' id='$valor' />
										    <label for='$valor'>$valor</label>
										</div>";
									}				
								}
							}	
						?>			
					</div>
					<div class="coluna col12 sem-padding-right sem-padding-left">
						<div class="coluna col12">
							<h3>Produtos</h3>
						</div>											
						<?php  
							//Listar todos os produtos que foram adicionados ao carrinho
							foreach ($_SESSION['carrinho'] as $valor) {
								$sql = new Sql();
								$produto = $sql->select("select * from itemproduto where idItemProduto = :idItemProduto", array(
									":idItemProduto"=>intval($valor['id'])
								));
								$nomeItemProduto = $produto[0]['nome'];
								$marcaItemProduto = $produto[0]['marca'];
								$precoItemProduto = $produto[0]['precoVenda'];
								echo "
								<div class='coluna col2'>
									<div class='coluna col2 rotulo-produto sem-padding-right sem-padding-left'>
										<p>Nome: $nomeItemProduto</p>
									</div>
									<div class='coluna col2 rotulo-produto sem-padding-right sem-padding-left'>
										<p>Marca: $marcaItemProduto</p>
									</div>
									<div class='coluna col2 rotulo-produto sem-padding-right sem-padding-left'>
										<p>Preço: $precoItemProduto</p>
									</div>
									<div class='coluna col2 rotulo-produto sem-padding-right sem-padding-left'>
										<p>Quantidade: $valor[quantidade]</p>
									</div>
									<div class='coluna col2 rotulo-produto sem-padding-right sem-padding-left'>
										<input type='button' value='Remover' class='botao-cadastro' onclick='removerProdutoDoCarrinho($valor[id])'>
									</div>
								</div>";
							}
						?>
						<div class="coluna col12">
							<div class="div-centralizada">
								<input type="button" value="Adicionar produto ao carrinho" class="botao-cadastro" onclick="encaminharPagina('pesquisar_produto.php')">
							</div>
						</div>
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
					<div class="coluna col12">
						<div class="div-centralizada">
							<input type="submit" value="Criar Ordem de Serviço" class="botao-cadastro">
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