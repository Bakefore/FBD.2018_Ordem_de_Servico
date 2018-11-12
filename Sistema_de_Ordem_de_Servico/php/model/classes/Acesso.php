<?php  
	class Acesso{
		private $nome;		
		private $cadastrarEmpresa;
		private $pesquisarEmpresa;
		private $editarEmpresa;
		private $excluirEmpresa;
		private $criarAcesso;
		private $pesquisarAcesso;
		private $editarAcesso;
		private $excluirAcesso;
		private $cadastrarFuncionario;
		private $pesquisarFuncionario;
		private $editarFuncionario;
		private $excluirFuncionario;
		private $cadastrarCliente;
		private $pesquisarCliente;
		private $editarCliente;
		private $excluirCliente;
		private $cadastrarServico;
		private $pesquisarServico;
		private $editarServico;
		private $excluirServico;
		private $cadastrarProduto;
		private $pesquisarProduto;
		private $editarProduto;
		private $excluirProduto;
		private $criarOrdemDeServico;
		private $pesquisarOrdemDeServico;
		private $editarOrdemDeServico;
		private $excluirOrdemDeServico;
		private $exibirFinanceiro;
		private $editarFinanceiro;

		public function __construct($nome, $cadastrarEmpresa = false, $pesquisarEmpresa = false, $editarEmpresa = false, 
			$excluirEmpresa = false, $criarAcesso = false, $pesquisarAcesso = false, $editarAcesso = false, $excluirAcesso = false,
			$cadastrarFuncionario = false, $pesquisarFuncionario = false, $editarFuncionario = false, $excluirFuncionario = false,
			$cadastrarCliente = false, $pesquisarCliente = false, $editarCliente = false, $excluirCliente = false, $cadastrarServico = false,
			$pesquisarServico = false, $editarServico = false, $excluirServico = false, $cadastrarProduto = false, $pesquisarProduto = false,
			$editarProduto = false, $excluirProduto = false, $criarOrdemDeServico = false, $pesquisarOrdemDeServico = false,
			$editarOrdemDeServico = false, $excluirOrdemDeServico = false, $exibirFinanceiro = false, $editarFinanceiro = false){

			$this->nome = $nome;
			$this->cadastrarEmpresa = $cadastrarEmpresa;
			$this->pesquisarEmpresa = $pesquisarEmpresa;
			$this->editarEmpresa = $editarEmpresa;
			$this->excluirEmpresa = $excluirEmpresa;
			$this->criarAcesso = $criarAcesso;
			$this->pesquisarAcesso = $pesquisarAcesso;
			$this->editarAcesso = $editarAcesso;
			$this->excluirAcesso = $excluirAcesso;
			$this->cadastrarFuncionario = $cadastrarFuncionario;
			$this->pesquisarFuncionario = $pesquisarFuncionario;
			$this->editarFuncionario = $editarFuncionario;
			$this->excluirFuncionario = $excluirFuncionario;
			$this->cadastrarCliente = $cadastrarCliente;
			$this->pesquisarCliente = $pesquisarCliente;
			$this->editarCliente = $editarCliente;
			$this->excluirCliente = $excluirCliente;
			$this->cadastrarServico = $cadastrarServico;
			$this->pesquisarServico = $pesquisarServico;
			$this->editarServico = $editarServico;
			$this->excluirServico = $excluirServico;
			$this->cadastrarProduto = $cadastrarProduto;
			$this->pesquisarProduto = $pesquisarProduto;
			$this->editarProduto = $editarProduto;
			$this->excluirProduto = $excluirProduto;
			$this->criarOrdemDeServico = $criarOrdemDeServico;
			$this->pesquisarOrdemDeServico = $pesquisarOrdemDeServico;
			$this->editarOrdemDeServico = $editarOrdemDeServico;
			$this->excluirOrdemDeServico = $excluirOrdemDeServico;
			$this->exibirFinanceiro = $exibirFinanceiro;
			$this->editarFinanceiro = $editarFinanceiro;
		}

		public function getNome(){
			return $this->nome;
		}

		public function getCadastrarEmpresa(){
			return $this->cadastrarEmpresa;
		}

		public function getPesquisarEmpresa(){
			return $this->pesquisarEmpresa;
		}

		public function getEditarEmpresa(){
			return $this->editarEmpresa;
		}

		public function getExcluirEmpresa(){
			return $this->excluirEmpresa;
		}

		public function getCriarAcesso(){
			return $this->criarAcesso;
		}

		public function getPesquisarAcesso(){
			return $this->pesquisarAcesso;
		}

		public function getEditarAcesso(){
			return $this->editarAcesso;
		}

		public function getExcluirAcesso(){
			return $this->excluirAcesso;
		}

		public function getCadastrarFuncionario(){
			return $this->cadastrarFuncionario;
		}

		public function getPesquisarFuncionario(){
			return $this->pesquisarFuncionario;
		}

		public function getEditarFuncionario(){
			return $this->editarFuncionario;
		}

		public function getExcluirFuncionario(){
			return $this->excluirFuncionario;
		}

		public function getCadastrarCliente(){
			return $this->cadastrarCliente;
		}

		public function getPesquisarCliente(){
			return $this->pesquisarCliente;
		}

		public function getEditarCliente(){
			return $this->editarCliente;
		}

		public function getExcluirCliente(){
			return $this->excluirCliente;
		}

		public function getCadastrarServico(){
			return $this->cadastrarServico;
		}

		public function getPesquisarServico(){
			return $this->pesquisarServico;
		}

		public function getEditarServico(){
			return $this->editarServico;
		}

		public function getExcluirServico(){
			return $this->excluirServico;
		}

		public function getCadastrarProduto(){
			return $this->cadastrarProduto;
		}

		public function getPesquisarProduto(){
			return $this->pesquisarProduto;
		}

		public function getEditarProduto(){
			return $this->editarProduto;
		}

		public function getExcluirProduto(){
			return $this->excluirProduto;
		}

		public function getCriarOrdemDeServico(){
			return $this->criarOrdemDeServico;
		}

		public function getPesquisarOrdemDeServico(){
			return $this->pesquisarOrdemDeServico;
		}

		public function getEditarOrdemDeServico(){
			return $this->editarOrdemDeServico;
		}

		public function getExcluirOrdemDeServico(){
			return $this->excluirOrdemDeServico;
		}

		public function getExibirFinanceiro(){
			return $this->exibirFinanceiro;
		}

		public function getEditarFinanceiro(){
			return $this->editarFinanceiro;
		}
	}
?>