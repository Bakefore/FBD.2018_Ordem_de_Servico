<?php  
	class Sql extends PDO{
		private $conexao;

		public function __construct($ipDaBaseDeDados, $nomeBaseDados, $usuario, $senha){
			$this->conexao = new PDO("mysql:host=$ipDaBaseDeDados;dbname=$nomeBaseDados", "$usuario", "$senha");
		}

		public function __construct(){
			$this->conexao = new PDO("mysql:host=localhost:3306;dbname=sistemaOrdemDeServico", "root", "");
		}

		private function definirParametros($statement, $parametros = array()){
			foreach ($parametros as $key => $value) {
				$statement->bindParam($key, $value);
			}
		}
		/*
		private function setParam($statement, $key, $value){
			$statement->bindParam($key, $value);
		}
		*/
		public function query($linhaDaQuery, $parametros = array()){
			$stmt = $this->conexao->prepare($linhaDaQuery);
			$this->definirParametros($stmt, $parametros);
			$stmt->execute();
			return $stmt;
		}

		public function select($linhaDaQuery, $parametros = array()):array{
			$stmt = $this->query($linhaDaQuery, $parametros);
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
	}
?>