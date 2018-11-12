<?php  
	require_once("php/controller/cadastro.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Sistema de Ordem de Serviço</title>

		<!--Normalize-->
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />

		<!--Fontes-->
   		<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet" />

   		<!--Viewport-->
	    <meta name="viewport" content="width=device-width,initial-scale=1" />

	    <!--CSS da página-->
	    <link rel="stylesheet" type="text/css" href="common/css/estilo.css" />

	    <!--Ícone superior da página-->
	    <link rel="icon" type="image/x-icon" href="common/img/icon/codigo.ico" />	   

	    <!--Navegação one page suave com JQuery-->
		<script src="common/js/jquery/jquery-3.2.1.min.js"></script> 
		<script src="common/js/navegar_suave.js"></script>

		<!-- Adicionando ViaCEP -->
	    <script src="common/js/buscar_cep.js"></script>

	    <!--  -->
	    <script type="text/javascript">
	    	//Calculando last-child do menu
	    	function ajustarUltimoElementoMenu(idLink){
	    		var larguraInicial = parseFloat($('#'+idLink).css("width"));
		    	var reajuste = ((larguraInicial+20.906) - 220);
		    	$("li:last-child ul").css("left", reajuste);
	    	}

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
								require_once("php/view/menu.php");

								$idMenuLastChild = "";

								//Verifica por meio de estruturas condicionais, qual é o menu que está por último, para então modificar o código CSS do sub-menu do mesmo, por meio de JavaScript
								if(verificarMenuEmpresa()){
									$idMenuLastChild = "link-empresa";
								}

								if(verificarMenuAcesso()){
									$idMenuLastChild = "link-acesso";	
								}

								if(verficarMenuFuncionario()){
									$idMenuLastChild = "link-funcionario";	
								}

								if(verficarMenuCliente()){
									$idMenuLastChild = "link-cliente";
								}	

								if(verficarMenuServico()){
									$idMenuLastChild = "link-servico";
								}	

								if(verficarMenuProduto()){
									$idMenuLastChild = "link-produto";
								}
								
								if(verficarMenuOrdemDeServico()){
									$idMenuLastChild = "link-ordem-de-servico";
								}

								if(verficarMenuFinanceiro()){
									$idMenuLastChild = "link-financeiro";	
								}		

							?>                  
						</ul>							    				
					</div>
				</header>
			</div>
		</div>

		<!-- Conteúdo do Sistema -->
		<?php
			if (true) { //Verifcar o acesso do usuário, para então fazer a chamada da página
				require_once("php/view/cadastrar_empresa.php");
			}

			if (true) { //Verifcar o acesso do usuário, para então fazer a chamada da página
				require_once("php/view/criar_acesso.php");
			}

			if (true) { //Verifcar o acesso do usuário, para então fazer a chamada da página
				require_once("php/view/cadastrar_funcionario.php");
			}
			
			if (true) { //Verifcar o acesso do usuário, para então fazer a chamada da página
				require_once("php/view/cadastrar_cliente.php");
			}
			
			if (true) { //Verifcar o acesso do usuário, para então fazer a chamada da página
				require_once("php/view/cadastrar_servico.php");
			}
			
			if (true) { //Verifcar o acesso do usuário, para então fazer a chamada da página
				require_once("php/view/cadastrar_produto.php");
			}

			if (true) { //Verifcar o acesso do usuário, para então fazer a chamada da página
				require_once("php/view/criar_ordem_servico.php");
			}
		?>		

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
	    <script src="common/js/preencher_uf.js"></script>   	  

	    <!-- Inverte a posição do sub-menu que vier por último de acordo com o menu principal -->
	    <script type="text/javascript">
	    	ajustarUltimoElementoMenu("<?php echo $idMenuLastChild; ?>");
	    </script> 
	</body>
</html>