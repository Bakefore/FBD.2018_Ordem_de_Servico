<div class="sessao" id="cadastrar-servico">
	<div class="linha">
		<div class="coluna col12">
			<h2>Cadastrar Serviço</h2>
		</div>	
		<form action="" method="">
			<div class="coluna col4">
				<label for="input-servico-nome">Nome *</label>
				<input type="text" name="input-servico-nome" id="input-servico-nome" required>

				<label for="select-servico-empresa">Empresa *</label>
				<select name="select-servico-empresa" id="select-servico-empresa" required></select>		
			</div>
			<div class="coluna col2">
				<label for="input-servico-valor">Valor *</label>
				<input type="text" name="input-servico-valor" id="input-servico-valor" required>

				<label for="select-servico-tipo">Tipo de Serviço *</label>
				<select name="select-servico-tipo" id="select-servico-tipo" required>
					<option value="tecnico">Técnico</option>
				</select>
			</div>	
			<div class="coluna col6">
				<label for="textarea-servico-descricao">Descrição *</label>
				<textarea class="descricao-servico" id="textarea-servico-descricao" required></textarea>
			</div>	
			<div class="div-centralizada">
				<input type="submit" value="Cadastrar Serviço" class="botao-cadastro">
			</div>								
		</form>
	</div>
</div>