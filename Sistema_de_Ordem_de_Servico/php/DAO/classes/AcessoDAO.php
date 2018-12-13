<?php  
	require_once("../autoload/autoloadModel.php");
	class AcessoDAO{
		private $acesso;

		public function __construct($acesso){
			$this->acesso = $acesso;
		} 

		public function getAcesso(){
			return $this->acesso;
		}

		public function cadastrar(){
			$sql = new Sql();

			//Procura um acesso com o mesmo nome para saber se pode inserir
			$resultadoAcesso = $sql->select("select * from acesso where nome = :nome", array(
				":nome"=>$this->acesso->getNome()
			));

			//Caso não exista nenhum acesso com este nome, poderá cadastrar o acesso
			if($resultadoAcesso == null){
				$sql->query("insert into acesso (nome, cadastrarEmpresa, editarEmpresa, pesquisarEmpresa, excluirEmpresa, cadastrarFuncionario, editarFuncionario, pesquisarFuncionario, excluirFuncionario, criarAcesso,    editarAcesso, pesquisarAcesso, excluirAcesso, cadastrarCliente, editarCliente, pesquisarCliente,     excluirCliente, adicionarServico, editarServico, pesquisarServico, excluirServico, cadastrarFornecedor, pesquisarFornecedor, editarFornecedor, excluirFornecedor, cadastrarProduto, 	    editarProduto, pesquisarProduto, excluirProduto, criarOrdemDeServico, editarOrdemDeServico, 	    pesquisarOrdemDeServico, excluirOrdemDeServico, exibirFinanceiro, editarFinanceiro) values (:nome, :cadastrarEmpresa, :editarEmpresa, :pesquisarEmpresa, :excluirEmpresa, :cadastrarFuncionario, :editarFuncionario, :pesquisarFuncionario, :excluirFuncionario, :criarAcesso, :editarAcesso, :pesquisarAcesso, :excluirAcesso, :cadastrarCliente, :editarCliente, :pesquisarCliente, :excluirCliente, :adicionarServico, :editarServico, :pesquisarServico, :excluirServico, :cadastrarFornecedor, :pesquisarFornecedor, :editarFornecedor, :excluirFornecedor, :cadastrarProduto, :editarProduto, :pesquisarProduto, :excluirProduto, :criarOrdemDeServico, :editarOrdemDeServico, :pesquisarOrdemDeServico, :excluirOrdemDeServico, :exibirFinanceiro, :editarFinanceiro)", array(

					":nome"=>$this->acesso->getNome(), 
					":cadastrarEmpresa"=>$this->acesso->getCadastrarEmpresa(), 
					":editarEmpresa"=>$this->acesso->getEditarEmpresa(), 
					":pesquisarEmpresa"=>$this->acesso->getPesquisarEmpresa(), 
					":excluirEmpresa"=>$this->acesso->getExcluirEmpresa(), 
					":cadastrarFuncionario"=>$this->acesso->getCadastrarFuncionario(), 
					":editarFuncionario"=>$this->acesso->getEditarFuncionario(), 
					":pesquisarFuncionario"=>$this->acesso->getPesquisarFuncionario(), 
					":excluirFuncionario"=>$this->acesso->getExcluirFuncionario(), 
					":criarAcesso"=>$this->acesso->getCriarAcesso(), 
					":editarAcesso"=>$this->acesso->getEditarAcesso(), 
					":pesquisarAcesso"=>$this->acesso->getPesquisarAcesso(), 
					":excluirAcesso"=>$this->acesso->getExcluirAcesso(), 
					":cadastrarCliente"=>$this->acesso->getCadastrarCliente(), 
					":editarCliente"=>$this->acesso->getEditarCliente(), 
					":pesquisarCliente"=>$this->acesso->getPesquisarCliente(), 
					":excluirCliente"=>$this->acesso->getExcluirCliente(), 
					":adicionarServico"=>$this->acesso->getCadastrarServico(), 
					":editarServico"=>$this->acesso->getEditarServico(), 
					":pesquisarServico"=>$this->acesso->getPesquisarServico(), 
					":excluirServico"=>$this->acesso->getExcluirServico(),
					":cadastrarFornecedor"=>$this->acesso->getCadastrarFornecedor(), 
					":pesquisarFornecedor"=>$this->acesso->getPesquisarFornecedor(), 
					":editarFornecedor"=>$this->acesso->getEditarFornecedor(), 
					":excluirFornecedor"=>$this->acesso->getExcluirFornecedor(),
					":cadastrarProduto"=>$this->acesso->getCadastrarProduto(), 
					":editarProduto"=>$this->acesso->getEditarProduto(), 
					":pesquisarProduto"=>$this->acesso->getPesquisarProduto(), 
					":excluirProduto"=>$this->acesso->getExcluirProduto(), 
					":criarOrdemDeServico"=>$this->acesso->getCriarOrdemDeServico(), 
					":editarOrdemDeServico"=>$this->acesso->getEditarOrdemDeServico(), 
					":pesquisarOrdemDeServico"=>$this->acesso->getPesquisarOrdemDeServico(), 
					":excluirOrdemDeServico"=>$this->acesso->getExcluirOrdemDeServico(), 
					":exibirFinanceiro"=>$this->acesso->getExibirFinanceiro(), 
					":editarFinanceiro"=>$this->acesso->getEditarFinanceiro()
				));	
				return true;//Retorna true caso tenha cadastrado
			}

			return false;//Retorna false caso não tenha cadastrado
		}

		public function editar($idAcesso){
			$sql = new Sql();

			//Caso não exista nenhum acesso com este nome, poderá cadastrar o acesso			
			$sql->query("update acesso set nome = :nome, cadastrarEmpresa = :cadastrarEmpresa, editarEmpresa = :editarEmpresa, pesquisarEmpresa = :pesquisarEmpresa, excluirEmpresa = :excluirEmpresa, cadastrarFuncionario = :cadastrarFuncionario, editarFuncionario = :editarFuncionario, pesquisarFuncionario = :pesquisarFuncionario, excluirFuncionario = :excluirFuncionario, criarAcesso = :criarAcesso, editarAcesso = :editarAcesso, pesquisarAcesso = :pesquisarAcesso, excluirAcesso = :excluirAcesso, cadastrarCliente = :cadastrarCliente, editarCliente = :editarCliente, pesquisarCliente = :pesquisarCliente, excluirCliente = :excluirCliente, adicionarServico = :adicionarServico, editarServico = :editarServico, pesquisarServico = :pesquisarServico, excluirServico = :excluirServico, cadastrarFornecedor = :cadastrarFornecedor, pesquisarFornecedor = :pesquisarFornecedor, editarFornecedor = :editarFornecedor, excluirFornecedor = :excluirFornecedor, cadastrarProduto = :cadastrarProduto, editarProduto = :editarProduto, pesquisarProduto = :pesquisarProduto, excluirProduto = :excluirProduto, criarOrdemDeServico = :criarOrdemDeServico, editarOrdemDeServico = :editarOrdemDeServico, pesquisarOrdemDeServico = :pesquisarOrdemDeServico, excluirOrdemDeServico = :excluirOrdemDeServico, exibirFinanceiro = :exibirFinanceiro, editarFinanceiro = :editarFinanceiro where idAcesso = :idAcesso", array(

				":nome"=>$this->acesso->getNome(), 
				":cadastrarEmpresa"=>$this->acesso->getCadastrarEmpresa(), 
				":editarEmpresa"=>$this->acesso->getEditarEmpresa(), 
				":pesquisarEmpresa"=>$this->acesso->getPesquisarEmpresa(), 
				":excluirEmpresa"=>$this->acesso->getExcluirEmpresa(), 
				":cadastrarFuncionario"=>$this->acesso->getCadastrarFuncionario(), 
				":editarFuncionario"=>$this->acesso->getEditarFuncionario(), 
				":pesquisarFuncionario"=>$this->acesso->getPesquisarFuncionario(), 
				":excluirFuncionario"=>$this->acesso->getExcluirFuncionario(), 
				":criarAcesso"=>$this->acesso->getCriarAcesso(), 
				":editarAcesso"=>$this->acesso->getEditarAcesso(), 
				":pesquisarAcesso"=>$this->acesso->getPesquisarAcesso(), 
				":excluirAcesso"=>$this->acesso->getExcluirAcesso(), 
				":cadastrarCliente"=>$this->acesso->getCadastrarCliente(), 
				":editarCliente"=>$this->acesso->getEditarCliente(), 
				":pesquisarCliente"=>$this->acesso->getPesquisarCliente(), 
				":excluirCliente"=>$this->acesso->getExcluirCliente(), 
				":adicionarServico"=>$this->acesso->getCadastrarServico(), 
				":editarServico"=>$this->acesso->getEditarServico(), 
				":pesquisarServico"=>$this->acesso->getPesquisarServico(), 
				":excluirServico"=>$this->acesso->getExcluirServico(),
				":cadastrarFornecedor"=>$this->acesso->getCadastrarFornecedor(), 
				":pesquisarFornecedor"=>$this->acesso->getPesquisarFornecedor(), 
				":editarFornecedor"=>$this->acesso->getEditarFornecedor(), 
				":excluirFornecedor"=>$this->acesso->getExcluirFornecedor(),
				":cadastrarProduto"=>$this->acesso->getCadastrarProduto(), 
				":editarProduto"=>$this->acesso->getEditarProduto(), 
				":pesquisarProduto"=>$this->acesso->getPesquisarProduto(), 
				":excluirProduto"=>$this->acesso->getExcluirProduto(), 
				":criarOrdemDeServico"=>$this->acesso->getCriarOrdemDeServico(), 
				":editarOrdemDeServico"=>$this->acesso->getEditarOrdemDeServico(), 
				":pesquisarOrdemDeServico"=>$this->acesso->getPesquisarOrdemDeServico(), 
				":excluirOrdemDeServico"=>$this->acesso->getExcluirOrdemDeServico(), 
				":exibirFinanceiro"=>$this->acesso->getExibirFinanceiro(), 
				":editarFinanceiro"=>$this->acesso->getEditarFinanceiro(),
				":idAcesso"=>$idAcesso
			));					
		}
	}
?>