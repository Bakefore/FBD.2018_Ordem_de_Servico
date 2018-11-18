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

		public function setLogin($login){
			$this->login = $login;	
		}

		public function getSenha(){
			return $this->senha;
		}

		public function setSenha($senha){
			$this->senha = $senha;	
		}

		public function getAcesso(){
			return $this->acesso;
		}

		public function setAcesso($acesso){
			$this->acesso = $acesso;	
		}
	}
?>