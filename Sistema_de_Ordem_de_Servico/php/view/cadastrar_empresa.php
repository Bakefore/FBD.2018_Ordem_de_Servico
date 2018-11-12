<div class="sessao" id="cadastrar-empresa">
	<div class="linha">
		<div class="coluna col12">
			<h2>Cadastrar Empresa</h2>
		</div>
		<form action="" method="post">
			<!--Linha 1-->					
			<div class="coluna col4">
				<label for="input-empresa-razao-social">Razão Social *</label>
				<input type="text" name="input-empresa-razao-social" id="input-empresa-razao-social" required>
			</div>
			<div class="coluna col4">
				<label for="input-empresa-nome-fantasia">Nome Fantasia</label>
				<input type="text" name="input-empresa-nome-fantasia" id="input-empresa-nome-fantasia">
			</div>
			<div class="coluna col4">
				<label for="input-empresa-cnpj">CNPJ *</label>
				<input type="text" name="input-empresa-cnpj" id="input-empresa-cnpj" required>
			</div>
			<!--Linha 2-->
			<div class="coluna col4">
				<label for="input-empresa-email">E-mail</label>
				<input type="email" name="input-empresa-email" id="input-empresa-email">
			</div>
			<div class="coluna col2">
				<label for="input-empresa-telefone">Telefone</label>
				<input type="text" name="input-empresa-telefone" id="input-empresa-telefone">
			</div>
			<div class="coluna col2">
				<label for="input-empresa-celular">Celular *</label>
				<input type="text" name="input-empresa-celular" id="input-empresa-celular" required>
			</div>
			<div class="coluna col2">
				<label for="input-empresa-cep">CEP *</label>
				<input maxlength="9" onblur="editarVariaveisGlobais(this.value, 'input-empresa-rua', 'input-empresa-bairro', 'input-empresa-cidade', 'select-empresa-uf');" type="text" name="input-empresa-cep" id="input-empresa-cep" required>
			</div>
			<div class="coluna col2">
				<label for="select-empresa-uf">UF *</label>
				<select name="select-empresa-uf" id="select-empresa-uf" required></select>
			</div>
			<!--Linha 3-->
			<div class="coluna col2">
				<label for="input-empresa-cidade">Cidade *</label>
				<input type="text" name="input-empresa-cidade" id="input-empresa-cidade" required>
			</div>
			<div class="coluna col2">
				<label for="input-empresa-bairro">Bairro *</label>
				<input type="text" name="input-empresa-bairro" id="input-empresa-bairro" required>
			</div>
			<div class="coluna col4">
				<label for="input-empresa-rua">Rua *</label>
				<input type="text" name="input-empresa-rua" id="input-empresa-rua" required>
			</div>
			<div class="coluna col2">
				<label for="input-empresa-numero">Número *</label>
				<input type="text" name="input-empresa-numero" id="input-empresa-numero" required>
			</div>
			<div class="coluna col2">
				<label for="input-empresa-complemento">Complemento</label>
				<input type="text" name="input-empresa-complemento" id="input-empresa-complemento">
			</div>
			<div class="div-centralizada">
				<input type="submit" value="Cadastrar Empresa" class="botao-cadastro">
			</div>
		</form>
	</div>
</div>