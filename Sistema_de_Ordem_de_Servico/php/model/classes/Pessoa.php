<?php  
	abstract class Pessoa{
		private $nome;
		private $cpf;
		private $nasciemnto;
		private $sexo;
		private $contatosArray;
		private $endereco;
		private $empresa;

		public function __construct($nome, $cpf, $nasciemnto, $sexo, $contatosArray = array(), $endereco, $empresa){
			$this->nome = $nome;
			$this->cpf = $cpf;
			$this->nasciemnto = $nasciemnto;
			$this->sexo = $sexo;
			$this->contatosArray = $contatosArray;
			$this->endereco = $endereco;
			$this->empresa = $empresa;
		}

		//Super é um método desenvolvido para imitar o super do java para um caso de herança
		public function super($nome, $cpf, $nasciemnto, $sexo, $contatosArray = array(), $endereco, $empresa){
			$this->setNome($nome);
			$this->setCPF($cpf);
			$this->setNascimento($nasciemnto);
			$this->setSexo($sexo);
			$this->setContatosArray($contatosArray);
			$this->setEndereco($endereco);
			$this->setEmpresa($empresa);
		}

		public function getNome(){
			return $this->nome;
		}

		public function setNome($nome){
			$this->nome = $nome;		
		}

		public function getCPF(){
			return $this->cpf;
		}

		public function setCPF($cpf){
			$this->cpf = $cpf;		
		}

		public function getNascimento(){
			return $this->nasciemnto;
		}

		public function setNascimento($nasciemnto){
			$this->nasciemnto = $nasciemnto;		
		}

		public function getSexo(){
			return $this->sexo;
		}	

		public function setSexo($sexo){
			$this->sexo = $sexo;	
		}	

		public function getContatosArray(){
			return $this->contatosArray;
		}

		public function setContatosArray($contatosArray){
			$this->contatosArray = $contatosArray;
		}

		public function getEndereco(){
			return $this->endereco;
		}

		public function setEndereco($endereco){
			$this->endereco = $endereco;
		}

		public function getEmpresa(){
			return $this->empresa;
		}

		public function setEmpresa($empresa){
			$this->empresa = $empresa;
		}
	}
?>