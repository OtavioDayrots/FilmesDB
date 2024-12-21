-- cria o banco de dados
create database filmesdb;

-- instrução perigosa, ela exclui TUDO!!!
-- drop database filmesdb;

-- seleciona o banco para uso
use filmesdb;

-- cria a tabela de filme
create table filme (
	id int primary key auto_increment,
	img_link varchar(255) not null,
	titulo varchar(255) not null,
	ano int not null, 
	-- tipo de dado para texto gigantes.
	-- nem todo DB vai ter esse tipo
	descricao text
);

-- retorna tudo
select * from filme;
drop table filme;

-- retorna 1 por id
select * from filme where id = 12;

-- retorna o nome e ano de todos
select titulo, ano from filme;

-- conta a quantidade de registros
select count(*) from filme;

-- atualizar o registro
update filme set titulo = 'TESTE' where id = 2;
update filme set titulo = 'TESTE' where titulo = 'Um Sonho de Liberdade';

delete from filme where id = 2;

create table Usuario (
	id int primary key auto_increment,
	nome varchar(255) not null,
	email varchar(255) not null,
	nascimento date not null
);

select * from usuario;