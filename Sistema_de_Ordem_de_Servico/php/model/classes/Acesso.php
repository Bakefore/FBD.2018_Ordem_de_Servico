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
		private $cadastrarFornecedor;
		private $pesquisarFornecedor;
		private $editarFornecedor;
		private $excluirFornecedor;
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
			$pesquisarServico = false, $editarServico = false, $excluirServico = false, $cadastrarFornecedor = false, $pesquisarFornecedor = false,
			$editarFornecedor = false, $excluirFornecedor = false, $cadastrarProduto = false, $pesquisarProduto = false,
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
			$this->cadastrarFornecedor = $cadastrarFornecedor;
			$this->pesquisarFornecedor = $pesquisarFornecedor;
			$this->editarFornecedor = $editarFornecedor;
			$this->excluirFornecedor = $excluirFornecedor;
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

		public function setNome($nome){
			$this->nome = $nome;
		}

		public function getCadastrarEmpresa(){
			return $this->cadastrarEmpresa;
		}

		public function setCadastrarEmpresa($cadastrarEmpresa){
			$this->cadastrarEmpresa = $cadastrarEmpresa;
		}

		public function getPesquisarEmpresa(){
			return $this->pesquisarEmpresa;
		}

		public function setPesquisarEmpresa($pesquisarEmpresa){
			$this->pesquisarEmpresa = $pesquisarEmpresa;
		}

		public function getEditarEmpresa(){
			return $this->editarEmpresa;
		}

		public function setEditarEmpresa($editarEmpresa){
			$this->editarEmpresa = $editarEmpresa;
		}

		public function getExcluirEmpresa(){
			return $this->excluirEmpresa;
		}

		public function setExcluirEmpresa($excluirEmpresa){
			$this->excluirEmpresa = $excluirEmpresa;
		}

		public function getCriarAcesso(){
			return $this->criarAcesso;
		}

		public function setCriarAcesso($criarAcesso){
			$this->criarAcesso = $criarAcesso;	
		}

		public function getPesquisarAcesso(){
			return $this->pesquisarAcesso;
		}

		public function setPesquisarAcesso($pesquisarAcesso){
			$this->pesquisarAcesso = $pesquisarAcesso;
		}

		public function getEditarAcesso(){
			return $this->editarAcesso;
		}

		public function setEditarAcesso($editarAcesso){
			$this->editarAcesso = $editarAcesso;
		}

		public function getExcluirAcesso(){
			return $this->excluirAcesso;
		}

		public function setExcluirAcesso($excluirAcesso){
			$this->excluirAcesso = $excluirAcesso;
		}

		public function getCadastrarFuncionario(){
			return $this->cadastrarFuncionario;
		}

		public function setCadastrarFuncionario($cadastrarFuncionario){
			$this->cadastrarFuncionario = $cadastrarFuncionario;
		}

		public function getPesquisarFuncionario(){
			return $this->pesquisarFuncionario;
		}

		public function setPesquisarFuncionario($pesquisarFuncionario){
			$this->pesquisarFuncionario = $pesquisarFuncionario;
		}

		public function getEditarFuncionario(){
			return $this->editarFuncionario;
		}

		public function setEditarFuncionario($editarFuncionario){
			$this->editarFuncionario = $editarFuncionario;
		}

		public function getExcluirFuncionario(){
			return $this->excluirFuncionario;
		}

		public function setExcluirFuncionario($excluirFuncionario){
			$this->excluirFuncionario = $excluirFuncionario;
		}

		public function getCadastrarCliente(){
			return $this->cadastrarCliente;
		}

		public function setCadastrarCliente($cadastrarCliente){
			$this->cadastrarCliente = $cadastrarCliente;
		}

		public function getPesquisarCliente(){
			return $this->pesquisarCliente;
		}

		public function setPesquisarCliente($pesquisarCliente){
			$this->pesquisarCliente = $pesquisarCliente;
		}

		public function getEditarCliente(){
			return $this->editarCliente;
		}

		public function setEditarCliente($editarCliente){
			$this->editarCliente = $editarCliente;
		}

		public function getExcluirCliente(){
			return $this->excluirCliente;
		}

		public function setExcluirCliente($excluirCliente){
			$this->excluirCliente = $excluirCliente;
		}

		public function getCadastrarServico(){
			return $this->cadastrarServico;
		}

		public function setCadastrarServico($cadastrarServico){
			$this->cadastrarServico = $cadastrarServico;
		}

		public function getPesquisarServico(){
			return $this->pesquisarServico;
		}

		public function setPesquisarServico($pesquisarServico){
			$this->pesquisarServico = $pesquisarServico;
		}

		public function getEditarServico(){
			return $this->editarServico;
		}

		public function setEditarServico($editarServico){
			$this->editarServico = $editarServico;
		}

		public function getExcluirServico(){
			return $this->excluirServico;
		}

		public function setExcluirServico($excluirServico){
			$this->excluirServico = $excluirServico;
		}

		public function getCadastrarFornecedor(){
			return $this->cadastrarFornecedor;
		}

		public function setCadastrarFornecedor($cadastrarFornecedor){
			$this->cadastrarFornecedor = $cadastrarFornecedor;
		}

		public function getPesquisarFornecedor(){
			return $this->pesquisarFornecedor;
		}

		public function setPesquisarFornecedor($pesquisarFornecedor){
			$this->pesquisarFornecedor = $pesquisarFornecedor;
		}

		public function getEditarFornecedor(){
			return $this->editarFornecedor;
		}

		public function setEditarFornecedor($editarFornecedor){
			$this->editarFornecedor = $editarFornecedor;
		}

		public function getExcluirFornecedor(){
			return $this->excluirFornecedor;
		}

		public function setExcluirFornecedor($excluirFornecedor){
			$this->excluirFornecedor = $excluirFornecedor;
		}

		public function getCadastrarProduto(){
			return $this->cadastrarProduto;
		}

		public function setCadastrarProduto($cadastrarProduto){
			$this->cadastrarProduto = $cadastrarProduto;
		}

		public function getPesquisarProduto(){
			return $this->pesquisarProduto;
		}

		public function setPesquisarProduto($pesquisarProduto){
			$this->pesquisarProduto = $pesquisarProduto;
		}

		public function getEditarProduto(){
			return $this->editarProduto;
		}

		public function setEditarProduto($editarProduto){
			$this->editarProduto = $editarProduto;
		}

		public function getExcluirProduto(){
			return $this->excluirProduto;
		}

		public function setExcluirProduto($excluirProduto){
			$this->excluirProduto = $excluirProduto;
		}

		public function getCriarOrdemDeServico(){
			return $this->criarOrdemDeServico;
		}

		public function setCriarOrdemDeServico($criarOrdemDeServico){
			$this->criarOrdemDeServico = $criarOrdemDeServico;
		}

		public function getPesquisarOrdemDeServico(){
			return $this->pesquisarOrdemDeServico;
		}

		public function setPesquisarOrdemDeServico($pesquisarOrdemDeServico){
			$this->pesquisarOrdemDeServico = $pesquisarOrdemDeServico;
		}

		public function getEditarOrdemDeServico(){
			return $this->editarOrdemDeServico;
		}

		public function setEditarOrdemDeServico($editarOrdemDeServico){
			$this->editarOrdemDeServico = $editarOrdemDeServico;
		}

		public function getExcluirOrdemDeServico(){
			return $this->excluirOrdemDeServico;
		}

		public function setExcluirOrdemDeServico($excluirOrdemDeServico){
			$this->excluirOrdemDeServico = $excluirOrdemDeServico;
		}

		public function getExibirFinanceiro(){
			return $this->exibirFinanceiro;
		}

		public function setExibirFinanceiro($exibirFinanceiro){
			$this->exibirFinanceiro = $exibirFinanceiro;
		}

		public function getEditarFinanceiro(){
			return $this->editarFinanceiro;
		}

		public function setEditarFinanceiro($editarFinanceiro){
			$this->editarFinanceiro = $editarFinanceiro;
		}
	}
?>