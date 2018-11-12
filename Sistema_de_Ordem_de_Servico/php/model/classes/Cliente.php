<?php  
	class Cliente extends Pessoa{
		public function __construct($nome, $cpf, $nasciemnto, $sexo, $contatosArray, $endereco, $empresa){
			$this->super($nome, $cpf, $nasciemnto, $sexo, $contatosArray, $endereco, $empresa);
		}
	}
?>