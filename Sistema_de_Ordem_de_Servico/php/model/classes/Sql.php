<?php  
	class Sql extends PDO{
		private $conexao;

		/*public function __construct($ipDaBaseDeDados, $nomeBaseDados, $usuario, $senha){
			$this->conexao = new PDO("mysql:host=$ipDaBaseDeDados;dbname=$nomeBaseDados", "$usuario", "$senha");
		}*/

		public function __construct(){
			$this->conexao = new PDO("mysql:host=localhost:3307;dbname=sistemaOrdemDeServico", "root", "");//:3307
			$this->conexao->exec("SET CHARACTER SET utf8");
		}

		/*private function definirParametros($statement, $parametros = array()){
			foreach ($parametros as $key => $value) {
				$statement->bindParam($key, $value);
			}
		}*/

		private function setParams($statement, $parameters = array()){
			foreach ($parameters as $key => $value) {
				$this->setParam($statement, $key, $value);
			}
		}

		private function setParam($statement, $key, $value){
			$statement->bindParam($key, $value);
		}

		public function query($linha, $parametros = array()){
			$stmt = $this->conexao->prepare($linha);
			$this->setParams($stmt, $parametros);
			$stmt->execute();
			return $stmt;
		}

		public function select($linha, $parametros = array()):array{
			$stmt = $this->query($linha, $parametros);
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
	}
?>