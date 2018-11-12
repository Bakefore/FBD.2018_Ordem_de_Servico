<div class="sessao" id="cadastrar-produto">
	<div class="linha">
		<div class="coluna col12">
			<h2>Cadastrar Produto</h2>
		</div>	
		<form action="" method="">
			<div class="coluna col4">
				<label for="input-produto-nome">Nome *</label>
				<input type="text" name="input-produto-nome" id="input-produto-nome" required>
			</div>
			<div class="coluna col2">
				<label for="select-produto-tipo">Tipo de Produto *</label>
				<select name="select-produto-tipo" id="select-produto-tipo" required>
					<option value="alimenticio">Alimentício</option>
					<option value="movel">Móvel</option>
					<option value="eletronico">Eletrônico</option>
					<option value="veiculo">Veículo</option>
				</select>
			</div>
			<div class="coluna col2">
				<label for="input-produto-marca">Marca *</label>
				<input type="text" name="input-produto-marca" id="input-produto-marca" required>
			</div>
			<div class="coluna col2">
				<label for="input-produto-modelo">Modelo</label>
				<input type="text" name="input-produto-modelo" id="input-produto-modelo">
			</div>
			<div class="coluna col2">
				<label for="input-produto-validade">Data de Validade *</label>
				<input type="date" name="input-produto-validade" id="input-produto-validade" required>
			</div>
			<div class="coluna col4">
				<label for="select-produto-fornecedor">Fornecedor *</label>
				<select name="select-produto-fornecedor" id="select-produto-fornecedor" required></select>		
			</div>
			<div class="coluna col4">
				<label for="select-produto-empresa">Empresa *</label>
				<select name="select-produto-empresa" id="select-produto-empresa" required></select>
			</div>
			<div class="coluna col2">
				<label for="input-produto-custo-compra">Custo de Compra *</label>
				<input type="text" name="input-produto-custo-compra" id="input-produto-custo-compra" required>
			</div>
			<div class="coluna col2">
				<label for="input-produto-preco">Preço de Venda *</label>
				<input type="text" name="input-produto-preco" id="input-produto-preco" required>
			</div>
			<div class="coluna col4">
				<label for="input-produto-codigo">Código de Barras *</label>
				<input type="text" name="input-produto-codigo" id="input-produto-codigo">	

				<div class="coluna col2 sem-padding-left">
					<label for="select-produto-status">Status *</label>
					<select name="select-produto-status" id="select-produto-status" required>
						<option value="ativo">Ativo</option>
						<option value="inativo">Inativo</option>
					</select>
				</div>	
				<div class="coluna col2 sem-padding-right">
					<label for="input-produto-varejo">Varejo</label>
					<input type="text" name="input-produto-varejo" id="input-produto-varejo" required>
				</div>				
			</div>
			<div class="coluna col2">
				<label for="input-produto-quantidade">Quantidade Inicial *</label>
				<input type="text" name="input-produto-quantidade" id="input-produto-quantidade">

				<label for="input-produto-atacado">Atacado</label>
				<input type="text" name="input-produto-atacado" id="input-produto-atacado" required>
			</div>
			
			<div class="coluna col6">
				<label for="textarea-produto-descricao">Descrição *</label>
				<textarea class="descricao-servico" id="textarea-produto-descricao" required></textarea>
			</div>
			<div class="div-centralizada">
				<input type="submit" value="Cadastrar Produto" class="botao-cadastro">
			</div>
		</form>
	</div>
</div>