create database sistemaOrdemDeServico;
use sistemaOrdemDeServico;

#Tabelas Fortes
#Tabelas criadas 19/19
#OBS: Criar Tabela de Acesso apenas depois que todas as funcionalidades estiverem definidas
/*
select * from estado;
select * from cidade;
select * from endereco;
select * from empresa;
select * from funcionario;
select * from acesso;
select * from cliente;
select * from servico;
select * from fornecedor;
select * from produto;
select * from itemproduto;
select * from ordemDeServico;
select * from itemProdutoVenda;
select * from servicoordemdeservico;
select * from parcela;

truncate estado;
truncate cidade;
truncate endereco;
truncate empresa;
truncate servico;
truncate parcela;
*/
create table produto(
    idProduto int not null auto_increment primary key,
    nome varchar(255) not null,    
    tipo varchar(50) not null,
    descricao varchar(255) null
)default charset = 'utf8';

create table itemproduto(
    idItemProduto int not null auto_increment primary key,
    nome varchar(255) not null,
    marca varchar(50) not null,
    modelo varchar(50) null,    
    promocao boolean not null,
    desconto float null,
    dataCompra timestamp default current_timestamp(),
    dataValidade date not null,
    codigoDeBarra long not null,
    quantidadeEstoque int not null,
    quantidadeVenda int null,
    ativo boolean not null,
    valorCompra float not null,
    precoVenda float not null,
    porcentagemAtacado float not null,
    porcentagemVarejo float not null,
    idProduto int references produto(idProduto),
    idFornecedor int references fornecedor(idFornecedor),
    idEmpresa int references empresa(idEmpresa)
)default charset = 'utf8';

create table estado(
    idEstado int not null auto_increment primary key,
    uf char(2) not null 
)default charset = 'utf8';

create table cidade(
    idCidade int not null auto_increment primary key,
    nome varchar(50) not null,
    /*cepInicial int not null,
    cepFinal int not null,*/
    idEstado int references estado(idEstado)
)default charset = 'utf8';

create table endereco(
    idEndereco int not null auto_increment primary key,
    bairro varchar(50) not null,
    rua varchar(50) not null,
    numero int not null,
    complemento varchar(50) null,
    idCidade int references cidade(idCidade)
)default charset = 'utf8';

create table empresa(
    idEmpresa int not null auto_increment primary key,
    razaoSocial varchar(255) not null,
    nomeFantasia varchar(255) not null,
    cnpj varchar(18) not null,
    idEndereco int references endereco(idEndereco)
)default charset = 'utf8';

create table fornecedor(
    idFornecedor int not null auto_increment primary key,
    razaoSocial varchar(255) not null,
    nomeFantasia varchar(255) not null,
    cnpj varchar(18) not null,
    idEndereco int references endereco(idEndereco),
    idEmpresa int references empresa(idEmpresa)
)default charset = 'utf8';

create table servico(
    idServico int not null auto_increment primary key,
    nome varchar(50) not null,
    tipo varchar(50) not null,
    descricao varchar(255) not null,
    valor float not null,
    idEmpresa int references empresa(idEmpresa)
)default charset = 'utf8';

create table cliente(
    idCliente int not null auto_increment primary key,
    sexo char(1) not null,
    nome varchar(50) not null,
    cpf varchar(11) not null,
    dataNascimento date null,
    idEmpresa int references empresa(idEmpresa),
    idEndereco int references endereco(idEndereco)
)default charset = 'utf8';

create table acesso(
    idAcesso int not null auto_increment primary key,
    nome varchar(40) not null,
    cadastrarEmpresa boolean not null,
    editarEmpresa boolean not null,
    pesquisarEmpresa boolean not null,
    excluirEmpresa boolean not null,    
    cadastrarFuncionario boolean not null,
    editarFuncionario boolean not null,
    pesquisarFuncionario boolean not null,
    excluirFuncionario boolean not null,
    criarAcesso boolean not null,
    editarAcesso boolean not null,
    pesquisarAcesso boolean not null,
    excluirAcesso boolean not null,
    cadastrarCliente boolean not null,
    editarCliente boolean not null, 
    pesquisarCliente boolean not null,
    excluirCliente boolean not null,    
    adicionarServico boolean not null,
    editarServico boolean not null,
    pesquisarServico boolean not null,
    excluirServico boolean not null,    
    cadastrarFornecedor boolean not null,
    pesquisarFornecedor boolean not null,
    editarFornecedor boolean not null,
    excluirFornecedor boolean not null,
    cadastrarProduto boolean not null,
    editarProduto boolean not null,
    pesquisarProduto boolean not null,
    excluirProduto boolean not null,
    criarOrdemDeServico boolean not null,
    editarOrdemDeServico boolean not null, 
    pesquisarOrdemDeServico boolean not null,
    excluirOrdemDeServico boolean not null,    
    exibirFinanceiro boolean not null,
    editarFinanceiro boolean not null
)default charset = 'utf8';

create table funcionario(
    idFuncionario int not null auto_increment primary key,
    sexo char(1) not null,
    nome varchar(50) not null,
    cpf varchar(11) not null,
    dataNascimento date not null,/*date*/
    login varchar(255) not null,
    senha varchar(255) not null,
    idAcesso int references acesso(idAcesso),   /*Verificar se a tabela de Acesso está OK*/
    idEndereco int references endereco(idEndereco),
    idEmpresa int references empresa(idEmpresa)
)default charset = 'utf8';    

create table contatoCliente(
    idContato int not null auto_increment primary key,
    descricao varchar(255) not null,
    tipo varchar(50) not null,
    idReferenciado int references cliente(idCliente)
)default charset = 'utf8';

create table contatoFuncionario(
    idContato int not null auto_increment primary key,
    descricao varchar(255) not null,
    tipo varchar(50) not null,
    idReferenciado int references funcionario(idFuncionario)
)default charset = 'utf8';

create table contatoFornecedor(
    idContato int not null auto_increment primary key,
    descricao varchar(255) not null,
    tipo varchar(50) not null,
    idReferenciado int references fornecedor(idFornecedor)
)default charset = 'utf8';

create table contatoEmpresa(
    idContato int not null auto_increment primary key,
    descricao varchar(255) not null,
    tipo varchar(50) not null,
    idReferenciado int references empresa(idEmpresa)
)default charset = 'utf8';

create table ordemDeServico(
    idOrdemDeServico int not null auto_increment primary key,
    dataDeSolicitacao date not null,
    descricao varchar(255) not null,
    dataDeExecucao date not null,
    formaDePagamento varchar(20) not null,
    desconto float null,
    quantidadeParcelas int not null,
    valorFinal float not null,
    tipo varchar(50) not null,
    finalizada boolean not null default false,
    idEmpresa int references empresa(idEmpresa),
    idCliente int references cliente(idCliente),
    idFuncionarioAtendente int references funcionario(idFuncionario),
    idFuncionarioTecnico int references funcionario(idFuncionario)
)default charset = 'utf8';

create table parcela(
    idParcela int not null auto_increment primary key,
    codigo int not null,
    dataVencimento date null,
    quantidadeTotal int not null,
    ativo boolean not null,
    valor float not null,
    parcelaAtual int not null,
    idOrdemDeServico int references ordemDeServico(idOrdemDeServico),
    idCliente int references cliente(idCliente) 
)default charset = 'utf8';

create table itemProdutoVenda(
    idItemVenda int not null auto_increment primary key,
    nome varchar(255) not null,
    marca varchar(50) not null,
    modelo varchar(50) null, 
    dataVenda timestamp default current_timestamp(),
    dataValidade date not null,
    codigoDeBarra long not null,
    quantidade int not null,
    precoVenda float not null,
    idItemProduto int references itemProduto(idItemProduto),
    idOrdemDeServico int references ordemDeServico(idOrdemDeServico)
)default charset = 'utf8';
/*
create table itemServicovenda(
    idItemServicovenda int not null auto_increment primary key,
    nome varchar(50) not null,
    dataVenda timestamp default current_timestamp(),
    tipo varchar(50) not null,
    descricao varchar(255) not null,
    valor float not null,
    idServico int references servico(idServico),
    idOrdemDeServico int references ordemDeServico(idOrdemDeServico)
)default charset = 'utf8';
*/
create table servicoordemdeservico(
    idServico_ordemDeServico int not null auto_increment primary key,
    idServico int references servico(idServico),
    idOrdemDeServico int references ordemDeServico(idOrdemDeServico)
)default charset = 'utf8';

/*Inserindo cadastros iniciais*/
insert into estado (uf) values ('PE');
insert into cidade (nome, idEstado) values ('Serra Talhada', '1');
insert into endereco (bairro, rua, numero, complemento, idCidade) values ('Nossa Senhora da Penha', 'Rua Padre Romão Ferraz', '123', '', 1);
insert into empresa (razaoSocial, nomeFantasia, cnpj, idEndereco) values ('Empresa', 'Empresa', '80149485000119', 1);
insert into empresa (razaoSocial, nomeFantasia, cnpj, idEndereco) values ('OutraEmpresa', 'OutraEmpresa', '80149485000119', 1);

insert into acesso (nome, cadastrarEmpresa, editarEmpresa, pesquisarEmpresa, excluirEmpresa, cadastrarFuncionario, editarFuncionario,
    pesquisarFuncionario, excluirFuncionario, criarAcesso, editarAcesso, pesquisarAcesso, excluirAcesso, cadastrarCliente, editarCliente, 
    pesquisarCliente, excluirCliente, adicionarServico, editarServico, pesquisarServico, excluirServico, cadastrarFornecedor, 
    pesquisarFornecedor, editarFornecedor, excluirFornecedor, cadastrarProduto, editarProduto,  pesquisarProduto, excluirProduto, 
    criarOrdemDeServico, editarOrdemDeServico, pesquisarOrdemDeServico, excluirOrdemDeServico,    
    exibirFinanceiro, editarFinanceiro) values ('superadmin', true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, 
    true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true);
    
insert into funcionario (sexo, nome, cpf, dataNascimento, login, senha, idAcesso, idEndereco, idEmpresa) 
values ('M', 'admin', '10619029439', '1998-08-29', 'admin', 'admin', '1', '2', '1');

insert into funcionario (sexo, nome, cpf, dataNascimento, login, senha, idAcesso, idEndereco, idEmpresa) 
values ('M', 'Pietro', '10619029439', '1998-08-29', 'pietro', '123', '1', '2', '1');

insert into fornecedor (razaoSocial, nomeFantasia, cnpj, idEndereco, idEmpresa) values ('Fornecedor', 'Fornecedor', '80149485000119', 1, 1);

insert into cliente (sexo, nome, cpf, dataNascimento, idEmpresa, idEndereco) values ('M', 'Cliente', '10619029439', '1998-08-29', 1, 1);

insert into servico (nome, tipo, descricao, valor, idEmpresa) values ('Formatação de PC', 'Técnico', 'Formato teu PC', 40.52, 1);
insert into servico (nome, tipo, descricao, valor, idEmpresa) values ('Limpar PC', 'Técnico', 'Limpo teu PC', 10.52, 1);

/*insert into produto (nome, tipo, descricao) values ('Carro de controle remoto', 'Brinquedo', 'Carrinho de controle remoto');

#Por algum motivo esta de baixo não está funcionando
insert into produto (nome, marca, modelo, promocao, desconto, dataCompra, dataValidade, codigoDeBarra, quantidadeEstoque, 
quantidadeVenda, ativo, valorCompra, precoVenda, porcentagemAtacado, porcentagemVarejo, idProduto, idFornecedor) values
('Carrinho de controle remoto', 'Estrela', '', false, null, '1998-08-29', '1998-08-29', 'codigodebarras', 40, null, true, 40.50, 70.00, 0, 0, 1, 1);*/
