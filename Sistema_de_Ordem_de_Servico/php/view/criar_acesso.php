<div class="sessao" id="criar-acesso">
	<div class="linha">
		<div class="coluna col12">
			<h2>Criar Acesso</h2>
		</div>				
		<form action="" method="">
			<div class="coluna col12">
				<label for="input-acesso-nome">Nome *</label>
				</br>
				<input class="input-titulo-nome" type="text" name="input-acesso-nome" id="input-acesso-nome">
			</div>
			<div class="div-criar-acesso">						
			    <input type="checkbox" value="0" name="input-empresa-cadastar-empresa" id="input-empresa-cadastar-empresa" />
			    <label for="input-empresa-cadastar-empresa">Cadastrar Empresa</label>
				</br></br>
			    <input type="checkbox" value="0" name="input-empresa-pesquisar-empresa" id="input-empresa-pesquisar-empresa" />
			    <label for="input-empresa-pesquisar-empresa" onclick="desmarcarEditarExcluir('input-empresa-pesquisar-empresa', 'input-empresa-editar-empresa', 'input-empresa-excluir-empresa')">Pesquisar Empresa</label>		
			    </br></br>
			    <input type="checkbox" value="0" name="input-empresa-editar-empresa" id="input-empresa-editar-empresa" />
			    <label for="input-empresa-editar-empresa" onclick="marcarCheckbox('input-empresa-pesquisar-empresa', 'input-empresa-editar-empresa')">Editar Empresa</label>
			    </br></br>
			    <input type="checkbox" value="0" name="input-empresa-excluir-empresa" id="input-empresa-excluir-empresa" />
			    <label for="input-empresa-excluir-empresa" onclick="marcarCheckbox('input-empresa-pesquisar-empresa', 'input-empresa-excluir-empresa')">Excluir Empresa</label>				
			</div>
			<div class="div-criar-acesso">						
			   	<input type="checkbox" value="0" name="input-acesso-criar-acesso" id="input-acesso-criar-acesso" />
			    <label for="input-acesso-criar-acesso">Criar Acesso</label>
				</br></br>
			    <input type="checkbox" value="0" name="input-acesso-pesquisar-acesso" id="input-acesso-pesquisar-acesso" />
			    <label for="input-acesso-pesquisar-acesso" onclick="desmarcarEditarExcluir('input-acesso-pesquisar-acesso', 'input-acesso-editar-acesso', 'input-acesso-excluir-acesso')">Pesquisar Acesso</label>		
			    </br></br>
			    <input type="checkbox" value="0" name="input-acesso-editar-acesso" id="input-acesso-editar-acesso" />
			    <label for="input-acesso-editar-acesso" onclick="marcarCheckbox('input-acesso-pesquisar-acesso', 'input-acesso-editar-acesso')">Editar Acesso</label>		
			    </br></br>
			    <input type="checkbox" value="0" name="input-acesso-excluir-acesso" id="input-acesso-excluir-acesso" />
			    <label for="input-acesso-excluir-acesso" onclick="marcarCheckbox('input-acesso-pesquisar-acesso', 'input-acesso-excluir-acesso')">Excluir Acesso</label>					
			</div>
			<div class="div-criar-acesso">						
			    <input type="checkbox" value="0" name="input-funcionario-cadastrar-funcionario" id="input-funcionario-cadastrar-funcionario" />
			    <label for="input-funcionario-cadastrar-funcionario">Cadastrar Funcionário</label>
				</br></br>
			    <input type="checkbox" value="0" name="input-funcionario-pesquisar-funcionario" id="input-funcionario-pesquisar-funcionario" />
			    <label for="input-funcionario-pesquisar-funcionario" onclick="desmarcarEditarExcluir('input-funcionario-pesquisar-funcionario', 'input-funcionario-editar-funcionario', 'input-funcionario-excluir-funcionario')">Pesquisar Funcionário</label>		
			    </br></br>
			    <input type="checkbox" value="0" name="input-funcionario-editar-funcionario" id="input-funcionario-editar-funcionario" />
			    <label for="input-funcionario-editar-funcionario" onclick="marcarCheckbox('input-funcionario-pesquisar-funcionario', 'input-funcionario-editar-funcionario')">Editar Funcionário</label>		
			    </br></br>
			    <input type="checkbox" value="0" name="input-funcionario-excluir-funcionario" id="input-funcionario-excluir-funcionario" />
			    <label for="input-funcionario-excluir-funcionario" onclick="marcarCheckbox('input-funcionario-pesquisar-funcionario', 'input-funcionario-excluir-funcionario')">Excluir Funcionário</label>						
			</div>
			<div class="div-criar-acesso">						
			    <input type="checkbox" value="0" name="input-cliente-cadastrar-cliente" id="input-cliente-cadastrar-cliente" />
			    <label for="input-cliente-cadastrar-cliente">Cadastrar Cliente</label>
				</br></br>
			    <input type="checkbox" value="0" name="input-cliente-pesquisar-cliente" id="input-cliente-pesquisar-cliente" />
			    <label for="input-cliente-pesquisar-cliente" onclick="desmarcarEditarExcluir('input-cliente-pesquisar-cliente', 'input-cliente-editar-cliente', 'input-cliente-excluir-cliente')">Pesquisar Cliente</label>		
			    </br></br>
			    <input type="checkbox" value="0" name="input-cliente-editar-cliente" id="input-cliente-editar-cliente" />
			    <label for="input-cliente-editar-cliente" onclick="marcarCheckbox('input-cliente-pesquisar-cliente', 'input-cliente-editar-cliente')">Editar Cliente</label>		
			    </br></br>
			    <input type="checkbox" value="0" name="input-cliente-excluir-cliente" id="input-cliente-excluir-cliente" />
			    <label for="input-cliente-excluir-cliente" onclick="marcarCheckbox('input-cliente-pesquisar-cliente', 'input-cliente-excluir-cliente')">Excluir Cliente</label>						
			</div>
			<div class="div-criar-acesso">						
			    <input type="checkbox" value="0" name="input-servico-cadastrar-servico" id="input-servico-cadastrar-servico" />
			    <label for="input-servico-cadastrar-servico">Cadastrar Serviço</label>
				</br></br>
			    <input type="checkbox" value="0" name="input-servico-pesquisar-servico" id="input-servico-pesquisar-servico" />
			    <label for="input-servico-pesquisar-servico" onclick="desmarcarEditarExcluir('input-servico-pesquisar-servico', 'input-servico-editar-servico', 'input-servico-excluir-servico')">Pesquisar Serviço</label>		
			    </br></br>
			    <input type="checkbox" value="0" name="input-servico-editar-servico" id="input-servico-editar-servico" />
			    <label for="input-servico-editar-servico" onclick="marcarCheckbox('input-servico-pesquisar-servico', 'input-servico-editar-servico')">Editar Serviço</label>		
			    </br></br>
			    <input type="checkbox" value="0" name="input-servico-excluir-servico" id="input-servico-excluir-servico" />
			    <label for="input-servico-excluir-servico" onclick="marcarCheckbox('input-servico-pesquisar-servico', 'input-servico-excluir-servico')">Excluir Serviço</label>				
			</div>
			<div class="div-criar-acesso">						
			    <input type="checkbox" value="0" name="input-produto-cadastrar-produto" id="input-produto-cadastrar-produto" />
			    <label for="input-produto-cadastrar-produto">Cadastrar Produto</label>
				</br></br>
			    <input type="checkbox" value="0" name="input-produto-pesquisar-produto" id="input-produto-pesquisar-produto" />
			    <label for="input-produto-pesquisar-produto" onclick="desmarcarEditarExcluir('input-produto-pesquisar-produto', 'input-produto-editar-produto', 'input-produto-excluir-produto')">Pesquisar Produto</label>		
			    </br></br>
			    <input type="checkbox" value="0" name="input-produto-editar-produto" id="input-produto-editar-produto" />
			    <label for="input-produto-editar-produto" onclick="marcarCheckbox('input-produto-pesquisar-produto', 'input-produto-editar-produto')">Editar Produto</label>		
			    </br></br>
			    <input type="checkbox" value="0" name="input-produto-excluir-produto" id="input-produto-excluir-produto" />
			    <label for="input-produto-excluir-produto" onclick="marcarCheckbox('input-produto-pesquisar-produto', 'input-produto-excluir-produto')">Excluir Produto</label>				
			</div>
			<div class="div-criar-acesso">						
			    <input type="checkbox" value="0" name="input-os-criar-os" id="input-os-criar-os" />
			    <label for="input-os-criar-os">Criar Ordem de Serviço</label>
				</br></br>
			    <input type="checkbox" value="0" name="input-os-pesquisar-os" id="input-os-pesquisar-os" />
			    <label for="input-os-pesquisar-os" onclick="desmarcarEditarExcluir('input-os-pesquisar-os', 'input-os-editar-os', 'input-os-excluir-os')">Pesquisar Ordem de Serviço</label>		
			    </br></br>
			    <input type="checkbox" value="0" name="input-os-editar-os" id="input-os-editar-os" />
			    <label for="input-os-editar-os" onclick="marcarCheckbox('input-os-pesquisar-os', 'input-os-editar-os')">Editar Ordem de Serviço</label>		
			    </br></br>
			    <input type="checkbox" value="0" name="input-os-excluir-os" id="input-os-excluir-os" />
			    <label for="input-os-excluir-os" onclick="marcarCheckbox('input-os-pesquisar-os', 'input-os-excluir-os')">Excluir Ordem de Serviço</label>				
			</div>
			<div class="div-criar-acesso">						
			    <input type="checkbox" value="0" name="input-exibir-financas" id="input-exibir-financas" />
			    <label for="input-exibir-financas" onclick="desmarcarEditarExcluir('input-exibir-financas', 'input-editar-financas')">Exibir Finanças</label>
				</br></br>
				<input type="checkbox" value="0" name="input-editar-financas" id="input-editar-financas" />
			    <label for="input-editar-financas" onclick="marcarCheckbox('input-exibir-financas', 'input-editar-financas')">Editar Finanças</label>			    			
			</div>
			<div class="div-centralizada">
				<input type="submit" value="Criar Acesso" class="botao-cadastro">
			</div>
		</form>
	</div>
</div>