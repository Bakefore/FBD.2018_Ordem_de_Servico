<?php  
	require_once("../config/config.php");
	require_once("../autoload/autoloadModel.php");
	require_once("../autoload/autoloadView.php");
	require_once("../autoload/autoloadDAO.php");

	verificarPermissao('exibirFinanceiro');

	function setarIcone($valor){
		//Define o ícone com um X caso a parcela não tenha sido paga
		if($valor == 0){
			return "&#10004";
		}
		return "&#10008";
	}

	function pesquisar(){
		if((isset($_GET['input-parcela']))){
			echo "
			<div class='coluna col12 centralizado'>
				<div class='coluna col2 sem-padding-left linhaTabela'>
					<strong>Cliente</strong>						
				</div>
				<div class='coluna col2 linhaTabela'>
					<strong>Data de Vencimento</strong>
				</div>
				<div class='coluna col2 linhaTabela'>
					<strong>Status</strong>
				</div>
				<div class='coluna col2 linhaTabela'>
					<strong>Valor</strong>
				</div>
				<div class='coluna col2 linhaTabela'>
					<strong>Número da Parcela</strong>
				</div>	
				<div class='coluna col2 linhaTabela sem-padding-right'>				
				</div>
			</div>";



			$sql = new Sql();
			$resultadoParcelas = $sql->select("select * from parcela where codigo like :busca or dataVencimento like :busca or quantidadeTotal like :busca or ativo like :busca or valor like :busca or parcelaAtual like :busca", array(
				":busca"=>"%".$_GET['input-parcela']."%"
			));
			$impaPar = 'linhaTabelaPar';//linhaTabelaImpar - essa variável deve controlar o background de ímpar para par e assim fazer com que cores diferentes sejam utilizadas durante a listagem de produtos
			foreach ($resultadoParcelas as $parcelas) {				
				foreach ($parcelas as $campo => $valor) {	
					$idParcela = $parcelas['idParcela'];					
					if($campo == 'codigo'){								
						$resultadoCliente = $sql->select("select nome from cliente where idCliente = :idCliente", array(
							":idCliente"=>$parcelas['idCliente']
						));

						echo "<div class='coluna col12 centralizado $impaPar'>";
						$valor = $resultadoCliente[0]['nome'];
						echo "<div class='coluna col2 sem-padding-left linhaTabela'>$valor</div>";

						if($impaPar == "linhaTabelaImpar"){
							$impaPar = "linhaTabelaPar";
						}
						else{
							$impaPar = "linhaTabelaImpar";
						}
					}

					if($campo == 'dataVencimento'){
						$valor = date('d/m/Y',  strtotime($valor));
						echo "<div class='coluna col2 linhaTabela'>$valor</div>";
					}

					if($campo == 'ativo'){
						$valor = setarIcone($valor);
						echo "<div class='coluna col2 linhaTabela'>$valor</div>";
					}

					if($campo == 'valor'){
						echo "<div class='coluna col2 linhaTabela'>$valor</div>";
					}
					
					if($campo == 'parcelaAtual'){
						echo "<div class='coluna col2 linhaTabela'>$valor</div>";

						echo "<div class='coluna col1'>
								<input type='button' class='botao-cadastro' value='Editar'>
							</div>";

						echo "<div class='coluna col1 sem-padding-right'>
								<input type='button' class='botao-cadastro' onclick='excluirEntidade($idParcela)' value='Excluir'>
							</div>";
								
						echo "</div>";						
					}	
				}
			}
		}
	}
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
	    	function excluirEntidade(id){	
				var tabela = 'parcela';
				if(confirm("Deseja realmente excluir?")){					
					window.location.href = "../controller/excluirEntidade.php?id=" + id + "&tabela=" + tabela;
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
		<div class="sessao" id="pesquisar-parcelas">
			<div class="linha">
				<div class="coluna col12">
					<h2>Financeiro</h2>
				</div>	
				<form action="" method="get">
					<!--Linha 1-->						
					<div class="coluna col10">
						<input type="text" name="input-parcela" id="input-parcela" placeholder="Pesquisar" required>
					</div>	
					<!--
					<div class="coluna col2">
						<select name="select-filtro-status" id="select-filtro-status" required>
							<option value="Todos">Todos</option>
							<option value="À Receber">À Receber</option>
							<option value="Pago">Pago</option>
						</select>
					</div>	
					-->							
					<div class="coluna col2">
						<input type="submit" value="Buscar" class="botao-cadastro">
					</div>					
				</form>				
				<?php  					
					pesquisar();					
				?>
			</div>
		</div>			

		<div class="footer"><!--absolute-bottom-->
			<div class="linha">
				<footer>
					<div class="coluna col12">
						<span>&copy; 2018 - PietroTelino | Todos os direitos reservados</span>
					</div>
				</footer>
			</div>
		</div>	
	</body>
</html>