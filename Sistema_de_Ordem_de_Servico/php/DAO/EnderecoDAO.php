<?php  
	require_once("../autoload/autoloadModel.php");
	require_once("../autoload/autoloadView.php");
	class EnderecoDAO{
		private $endereco;
		private $id;

		public function __construct($endereco){
			$this->endereco = $endereco;
		}

		public function getEndereco(){
			return $this->endereco;
		}

		public function getId(){
			return $this->id;
		}

		public function cadastrar(){
			//Estabelece uma nova conexão com o banco de dados
			$sql = new Sql();	

			//Procura pela UF para verificar se ela já foi inserida
			$resultadoUF = $sql->select("select * from estado where uf = :uf", array(
				":uf"=>$this->endereco->getUf()
			));

			//Insere a UF caso ela ainda não tenha sido inserida no banco de dados
			if($resultadoUF == null){
				$sql->query("insert into estado (uf) values (:uf)", array(
					":uf"=>$this->endereco->getUf()
				));	
			}			

			//Procura pela cidade para verificar se ela já foi inserida antes
			$resultadoCidade = $sql->select("select * from cidade where nome = :nome", array(
				":nome"=>$this->endereco->getCidade()
			));

			//Insere a cidade caso ela não esteja no banco de dados
			if($resultadoCidade == null){				
				$resultado = $sql->select("select * from estado where uf = :uf", array(
					":uf"=>$this->endereco->getUf()
				));

				$sql->query("insert into cidade (nome, idEstado) values (:nome, :idEstado)", array(					
					":nome"=>$this->endereco->getCidade(), 
					":idEstado"=>$resultado[0]['idEstado']
				));							
			}

			//Procura pelo endereço para veficar se ele já existe
			$resultaEndereco = $sql->select("select * from endereco where rua = :rua and numero = :numero and complemento = :complemento", array(
				":rua"=>$this->endereco->getRua(),
				":numero"=>$this->endereco->getNumero(),
				":complemento"=>$this->endereco->getComplemento()
			));

			//insere um endereço caso não exista
			if($resultaEndereco == null){
				$resultado = $sql->select("select * from cidade where nome = :nome", array(
					":nome"=>$this->endereco->getCidade()
				));

				$sql->query("insert into endereco (bairro, rua, numero, complemento, idCidade) values (:bairro, :rua, :numero, :complemento, :idCidade)", array(

					":bairro"=>$this->endereco->getBairro(), 
					":rua"=>$this->endereco->getRua(), 
					":numero"=>$this->endereco->getNumero(), 
					":complemento"=>$this->endereco->getComplemento(), 
					":idCidade"=>$resultado[0]['idCidade']
				));	
			}

			//Procura o id de cidade para reutilizar o mesmo
			$resultado = $sql->select("select * from cidade where nome = :nome", array(
				":nome"=>$this->endereco->getCidade()
			));

			//Verifica o ID do endereço que foi inserido na tela
			$resultadoIdEndereco = $sql->select("select * from endereco where bairro = :bairro and rua = :rua and numero = :numero and complemento = :complemento and idCidade = :idCidade", array(

				":bairro"=>$this->endereco->getBairro(), 
				":rua"=>$this->endereco->getRua(), 
				":numero"=>$this->endereco->getNumero(), 
				":complemento"=>$this->endereco->getComplemento(), 
				":idCidade"=>$resultado[0]['idCidade']
			));

			//Define o ID do endereço 
			$this->id = $resultadoIdEndereco[0]['idEndereco'];
		}
	}
?>