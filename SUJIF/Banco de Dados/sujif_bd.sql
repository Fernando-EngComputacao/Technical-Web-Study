create database sujif_bd;
use sujif_bd;

create table competicao(
	id int not null auto_increment,
    nome varchar(80) not null,
    campus varchar(80) not null,
    data_abertura date not null,
    data_encerramento date not null,
    lim_atleta_campus int not null,
    lim_modalidade_atleta int not null,
    lim_campus int not null,
    descricao text not null,
    primary key(id)
);

create table campus(
	id int not null auto_increment,
    nome varchar(80) not null,
    sigla varchar(10) not null,
    uf varchar(2) not null,
    primary key(id)
);

create table administrador(
	id int not null auto_increment,
    nome varchar(60) not null,
    cpf varchar(15) not null,
    email varchar(80) not null,
    senha varchar(60) not null,
    status smallint not null,
    competicao_id int not null,
    constraint foreign key (competicao_id) references competicao(id),
    primary key(id)
);

create table modalidade(
	id int not null auto_increment,
    nome varchar(80) not null,
    descricao varchar(500),
    competicao_id int not null,
    constraint foreign key (competicao_id) references competicao(id),
    primary key(id)
);

create table prova(
	id int not null auto_increment,
    nome varchar(80) not null,
    tipo smallint not null,
    qtd_max_atleta int not null,
    descricao varchar(500) not null,
    modalidade_id int not null,
    constraint foreign key (modalidade_id) references modalidade(id),
    primary key(id)
);

create table professor(
	id int not null auto_increment,
    nome varchar(60) not null,
    cpf varchar(15) not null,
    rg varchar(15) not null,
    telefone varchar(20) not null,
    email varchar(80) not null,
    senha varchar(60) not null,
    num_suap varchar(20)  not null,
    campus_id int not null,
    constraint foreign key (campus_id) references campus(id),
    primary key(id)
);

create table atleta(
	id int not null auto_increment,
    nome varchar(60) not null,
    data_nascimento date not null,
    cpf varchar(15) not null,
    rg varchar(15) not null,
    foto_aluno varchar(256) not null,
    foto_cpf varchar(256) not null,
    foto_rg varchar(256) not null,
    professor_id int not null,
    constraint foreign key (professor_id) references professor(id),
    primary key(id)
);

create table participante(
	competicao_id int not null,
    professor_id int not null,
    status smallint not null,
    constraint foreign key (competicao_id) references competicao(id),
    constraint foreign key (professor_id) references professor(id),
    primary key(competicao_id, professor_id)
);

create table competidor(
	prova_id int not null,
    atleta_id int not null,
    constraint foreign key (prova_id) references prova(id),
    constraint foreign key (atleta_id) references atleta(id),
    primary key(prova_id, atleta_id)
);

insert into competicao values(null, 'Competição de Teste', 'Virtual', '2018-11-14', '2019-11-14', 50, 4, 20, 'Textinho ae, muita coisa, copia e cola muitos espaços Textinho ae, muita coisa, copia e cola muitos espaçosTextinho ae, muita coisa, copia e cola muitos espaçosTextinho ae, muita coisa, copia e cola muitos espaçosTextinho ae, muita coisa, copia e cola muitos espaços');
select * from competicao;

insert into administrador values(null, 'Admin Master', '000.000.000-00', 'adminmaster@gmail.com', sha1('admin000'), 0, 1);
select * from administrador;