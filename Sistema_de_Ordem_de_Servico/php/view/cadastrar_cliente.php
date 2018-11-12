<div class="sessao" id="cadastrar-cliente">
	<div class="linha">
		<div class="coluna col12">
			<h2>Cadastrar Cliente</h2>
		</div>	
		<form action="" method="">
			<!--Linha 1-->					
			<div class="coluna col4">
				<label for="input-cliente-nome">Nome *</label>
				<input type="text" name="input-cliente-nome" id="input-cliente-nome" required>
			</div>					
			<div class="coluna col2">
				<label for="input-cliente-cpf">CPF *</label>
				<input type="text" name="input-cliente-cpf" id="input-cliente-cpf" required>
			</div>
			<div class="coluna col2">
				<label for="input-cliente-nascimento">Nascimento *</label>
				<input type="date" name="input-cliente-nascimento" id="input-cliente-nascimento" required>
			</div>
			<div class="coluna col2">
				<label for="select-cliente-sexo">Sexo *</label>
				<select name="select-cliente-sexo" id="select-cliente-sexo" required>
					<option value="M">Masculino</option>
					<option value="F">Feminino</option>
				</select>
			</div>
			<div class="coluna col2">
				<label for="select-cliente-empresa">Empresa *</label>
				<select name="select-cliente-empresa" id="select-cliente-empresa" required></select>
				<!--Criar Função para modificar os acessos dispníveis de acordo com a empresa que foi selecionada-->
			</div>					
			<!--Linha 2-->
			<div class="coluna col4">
				<label for="input-cliente-email">E-mail</label>
				<input type="email" name="input-cliente-email" id="input-cliente-email">
			</div>
			<div class="coluna col2">
				<label for="input-cliente-telefone">Telefone</label>
				<input type="text" name="input-cliente-telefone" id="input-cliente-telefone">
			</div>
			<div class="coluna col2">
				<label for="input-cliente-celular">Celular *</label>
				<input type="text" name="input-cliente-celular" id="input-cliente-celular" required>
			</div>
			<div class="coluna col2">
				<label for="input-cliente-cep">CEP *</label>
				<input maxlength="9" onblur="editarVariaveisGlobais(this.value, 'input-cliente-rua', 'input-cliente-bairro', 'input-cliente-cidade', 'select-cliente-uf');" type="text" name="input-cliente-cep" id="input-cliente-cep" required>
			</div>
			<div class="coluna col2">
				<label for="select-cliente-uf">UF *</label>
				<select name="select-cliente-uf" id="select-cliente-uf" required></select>
			</div>
			<!--Linha 3-->
			<div class="coluna col2">
				<label for="input-cliente-cidade">Cidade *</label>
				<input type="text" name="input-cliente-cidade" id="input-cliente-cidade" required>
			</div>
			<div class="coluna col2">
				<label for="input-cliente-bairro">Bairro *</label>
				<input type="text" name="input-cliente-bairro" id="input-cliente-bairro" required>
			</div>
			<div class="coluna col4">
				<label for="input-cliente-rua">Rua *</label>
				<input type="text" name="input-cliente-rua" id="input-cliente-rua" required>
			</div>
			<div class="coluna col2">
				<label for="input-cliente-numero">Número *</label>
				<input type="text" name="input-cliente-numero" id="input-cliente-numero" required>
			</div>
			<div class="coluna col2">
				<label for="input-cliente-complemento">Complemento</label>
				<input type="text" name="input-cliente-complemento" id="input-cliente-complemento">
			</div>
			<div class="div-centralizada">
				<input type="submit" value="Cadastrar Cliente" class="botao-cadastro">
			</div>
		</form>
	</div>
</div>