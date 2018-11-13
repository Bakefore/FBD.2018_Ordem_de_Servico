<?php  
	require_once("php/autoload/autoloadModel.php");
	require_once("php/autoload/autoloadView.php");
	class EnderecoDAO{
		private $endereco;

		public function __construct($endereco){
			$this->endereco = $endereco;
		}

		public function getEndereco(){
			return $this->endereco;
		}

		public function cadastrar(){
			$sql = new Sql();			
			$sql->query("insert into estado (uf) values (:uf)", array(
				":uf"=>$this->endereco->getUf()
			));

			/*$idEstado = $sql->select("select idEstado from estado where uf = :uf", array(
				":uf"=>$this->endereco->getUf()
			));*/

			//Mensagem::exibirMensagem($idEstado['idEstado']);
			

			/*$sql->query("insert into cidade (nome, idEstado) values (:nome, :idEstado)", array(
				":nome"=>$this->endereco->getCidade(),
				":idEstado"=>$idEstado['idEstado']
			));*/
		}
	}
?>