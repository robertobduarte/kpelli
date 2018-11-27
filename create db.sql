#MYSQL

CREATE SCHEMA `kpelli` DEFAULT CHARACTER SET utf8 ;

use base;


# TABLE PESSOA ----------------------------------
create table kpelli_pessoa(
	id int primary key auto_increment,
	nome varchar(300) not null,
	telefone varchar(100),
	email varchar(100)
);

insert into kpelli_pessoa(nome, telefone, email) values
('Roberto Duarte', '999373893', 'robertobduarte@gmail.com' ),
('Aline Romero', '991626778', 'alinefromero@gmail.com' );



# TABLE USUÁRIO ----------------------------------
create table kpelli_usuario(
	id int primary key auto_increment,
	usuario varchar(50) not null,
	senha varchar (100) not null,
	pessoa int not null
);

insert into kpelli_usuario(usuario, senha, pessoa) values
('robertobduarte@gmail.com', '028c7e235a40850970af02af35a38749', 1 ),
('alinefromero@gmail.com', '028c7e235a40850970af02af35a38749', 2 );
--senha: kpelli



# TABLE MENU ----------------------------------
create table kpelli_menu(
	id int primary key auto_increment,
	nome varchar(300) not null,
	submenu varchar(1) default 'N',
	pai int default null,
    caminho varchar(200)
);

insert into kpelli_menu(nome, submenu, pai, caminho)values
('Produtos', 'N', null, 'produtos.php' ),
('Clientes', 'N', null, 'pessoa.php' ),
('Relatórios', 'S', null, null ),
('Venda', 'N', null, 'pedido.php' );



# TABLE UNIDADE MEDIDA ----------------------------------
create table kpelli_unidMedida(
	id varchar(5) not null primary key,
	nome varchar(50) not null
);

insert into kpelli_unidMedida(id, nome) values
('kg', 'Quilograma' ),
('g', 'Grama' ),
('ml', 'Mililitro' ),
('l', 'Litro' );




# TABLE LINHA ----------------------------------
create table kpelli_linha(
	id int primary key auto_increment,
	nome varchar(300) not null
);

insert into kpelli_linha( nome ) values
('Nutrição' ),
('Efeito Liso Amino' ),
('Efeito Liso Luminy' ),
('Reconstrução Hidracare' ),
('Matização White Violet' ),
('Home Care' ),
('Finalização' ),
('Rejuvenescimento Capilar' );



# TABLE CATEGORIA ----------------------------------
create table kpelli_categoria(
	id int primary key auto_increment,
	nome varchar(300) not null
);

insert into kpelli_categoria( nome ) values
('Nutrição' ),
('Professional' ),
('Finalização' ),
('Home Care' );



# TABLE PRODUTO ----------------------------------
create table kpelli_produto(
	id int primary key auto_increment,
	nome varchar(300) not null,
	categoria int not null,
	linha int not null,
	unidMedida char(5) not null,
	quantidade float not null,
);

insert into kpelli_produto( nome, categoria, linha, unidMedida, quantidade) values
('Shampoo', 4, 6, 'ml', 300 ),
('Conditioner', 4, 6, 'ml', 300 ),
('Step 1', 2, 2, 'ml', 1000 ),
('Shampoo', 2, 3, 'ml', 1000 );

