<?php  
	class Funcionario extends Pessoa{
		private $login;
		private $senha;
		private $acesso;

		public function __construct($nome, $cpf, $nasciemnto, $sexo, $login, $senha, $empresa, $acesso, $contatosArray, $endereco){
			$this->super($nome, $cpf, $nasciemnto, $sexo, $contatosArray, $endereco, $empresa);
			$this->login = $login;
			$this->senha = $senha;
			$this->acesso = $acesso;
		}

		public function getLogin(){
			return $this->login;
		}

		public function getSenha(){
			return $this->senha;
		}

		public function getAcesso(){
			return $this->acesso;
		}
	}
?>