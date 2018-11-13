<?php  
	require_once("php/config/config.php");
	require_once("php/autoload/autoloadModel.php");
	require_once("php/autoload/autoloadView.php");
	require_once("php/autoload/autoloadDAO.php");	
	use excessao\CNPJinvalidoException;
	use excessao\CPFinvalidoException;

	//Verifica os dados passados para então fazer o cadastro de uma Empresa
	function cadastrarEmpresa(){
		if((isset($_POST['input-empresa-razao-social'])) && (isset($_POST['input-empresa-nome-fantasia'])) 
			&& (isset($_POST['input-empresa-cnpj'])) && (isset($_POST['input-empresa-email'])) && (isset($_POST['input-empresa-celular'])) 
			&& (isset($_POST['input-empresa-cep'])) && (isset($_POST['select-empresa-uf'])) && (isset($_POST['input-empresa-cidade'])) 
			&& (isset($_POST['input-empresa-bairro'])) && (isset($_POST['input-empresa-rua'])) && (isset($_POST['input-empresa-numero']))){

			$contatosArray = array(
				"email"=>$email = $_POST['input-empresa-email'],
				"celular"=>$email = $_POST['input-empresa-email']
			);

			if(isset($_POST['input-empresa-telefone'])){
				$contatosArray['telefone'] = $_POST['input-empresa-telefone'];
			}

			$endereco = new Endereco($_POST['input-empresa-cep'], $_POST['select-empresa-uf'], $_POST['input-empresa-cidade'], 
				$_POST['input-empresa-bairro'], $_POST['input-empresa-rua'], $_POST['input-empresa-numero'], 
				(isset($_POST['input-empresa-complemento']))?$_POST['input-empresa-complemento']:"");

			$empresa = new Empresa($_POST['input-empresa-razao-social'], $_POST['input-empresa-nome-fantasia'], $_POST['input-empresa-cnpj'], 
				$endereco, $contatosArray);			

			try {
				if(!Validador::validarCNPJ($empresa->getCNPJ())){
					throw new CNPJinvalidoException("O CNPJ inserido não é válido", 1);												
				}

				$enderecoDAO = new EnderecoDAO($endereco);
				$enderecoDAO->cadastrar();
				
				Mensagem::exibirMensagem("A Empresa foi cadastrada com sucesso!");
			} catch (CNPJinvalidoException $e) {
				Mensagem::exibirMensagem($e->getMessage());
			}			
		}
	}	

	cadastrarEmpresa();
?>