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
    status smallint not  null,
    campus_id int not null,
    competicao_id int not null,
    constraint foreign key (campus_id) references campus(id),
    constraint foreign key (competicao_id) references competicao(id),
    primary key(id)
);

create table atleta(
	id int not null auto_increment,
    nome varchar(60) not null,
    data_nascimento date not null,
    sexo smallint not null,
    cpf varchar(15) not null,
    rg varchar(15) not null,
    foto_aluno varchar(256) not null,
    foto_cpf varchar(256) not null,
    foto_rg varchar(256) not null,
    professor_id int not null,
    constraint foreign key (professor_id) references professor(id),
    primary key(id)
);

/*create table participante(
	competicao_id int not null,
    professor_id int not null,
    status smallint not null,
    constraint foreign key (competicao_id) references competicao(id),
    constraint foreign key (professor_id) references professor(id),
    primary key(competicao_id, professor_id)
);*/

create table competidor(
	prova_id int not null,
    atleta_id int not null,
    constraint foreign key (prova_id) references prova(id),
    constraint foreign key (atleta_id) references atleta(id),
    primary key(prova_id, atleta_id)
);
desc competidor;
insert into competicao values(null, 'Competição de Teste', 'Virtual', '2018-11-14', '2019-11-14', 50, 4, 20, 'Textinho ae, muita coisa, copia e cola muitos espaços Textinho ae, muita coisa, copia e cola muitos espaçosTextinho ae, muita coisa, copia e cola muitos espaçosTextinho ae, muita coisa, copia e cola muitos espaçosTextinho ae, muita coisa, copia e cola muitos espaços');
select * from professor;
select * from administrador;
insert into modalidade values(null, 'futsal', 'dksjfdshfjk',1);
insert into prova values(null,'Futsal Feminino',1,100,'dsflkdsf dfjksldfd',2);
desc professor;
select modalidade.id, modalidade.nome, modalidade.descricao from competicao, modalidade left join prova on modalidade.id = prova.modalidade_id where prova.modalidade_id is null and competicao.id = modalidade.competicao_id and competicao.id = (select max(id) from competicao) order by modalidade.id asc;
select * from professor;

select id, nome, tipo, qtd_max_atleta, descricao from prova where prova.modalidade_id = 1;
select modalidade.id as modalidade_id, modalidade.nome as modalidade, modalidade.descricao as desc_modalidade, prova.id as prova_id, prova.nome as prova, prova.tipo, prova.descricao as desc_prova from  modalidade, prova, competicao where prova.modalidade_id = modalidade.id and modalidade.competicao_id = competicao.id and competicao.id = (select max(id) from competicao) order by modalidade.id asc;
select professor.id, professor.nome, professor.status, professor.cpf, professor.rg, professor.telefone, professor.email, professor.num_suap, campus.nome, campus.sigla, campus.uf from professor, campus where campus.id = professor.campus_id and professor.id = 7;
select professor.id,professor.nome,professor.status,campus.nome from campus, professor, competicao where campus.id = professor.campus_id and professor.competicao_id = competicao.id and competicao.id = (select max(id) from competicao) and professor.nome like '%' order by professor.status desc;

select campus.id, campus.nome, campus.sigla, campus.uf from campus, professor, competicao where campus.id = professor.campus_id and professor.competicao_id = competicao.id and competicao.id = (select max(id) from competicao) group by campus.nome order by campus.nome desc;
select professor.id as id_professor, professor.nome as nome_professor, competicao.data_encerramento > now() as atual from professor, competicao where professor.competicao_id = competicao.id and competicao.id = 1 and professor.email = 'dayllonchavier@gmail.com' and professor.senha = sha1('12345678');
select professor.id, professor.nome, professor.status, professor.cpf, professor.rg, professor.telefone, professor.email, professor.num_suap, campus.nome as campus_nome, campus.sigla, campus.uf from professor, campus where campus.id = professor.campus_id and professor.id = 7;
select campus.nome, campus.sigla, campus.uf from campus, professor, competicao where campus.id = professor.campus_id and professor.competicao_id = competicao.id and competicao.id = 1;
desc professor;
select * from professor;

select atleta.id, atleta.nome, atleta.cpf, atleta.rg, atleta.data_nascimento from atleta, professor where atleta.professor_id = professor.id and professor.id = 8;

select professor.id, professor.nome from professor, campus, competicao where professor.campus_id = campus.id and campus.id = 2 and competicao.id = professor.competicao_id and competicao.id = (select max(id) from competicao) and professor.id != 8;
select * from professor;select atleta.nome, atleta.cpf, atleta.rg, atleta.data_nasc, atleta.foto_aluno, atleta.foto_cpf, atleta.foto_rg from atleta, competicao, professor where atleta.professor_id = professor.id and professor.competicao_id = competicao.id and atleta.id = 8;
select atleta.id, atleta.nome, atleta.cpf, atleta.rg, atleta.data_nascimento from atleta, professor, campus where campus.id = professor.campus_id and atleta.professor_id = professor.id and professor.id = 8 and atleta.nome like '%' and campus.id = 2;
select * from professor;
delete from competidor where competidor.atleta_id = 9;
select campus.id, campus.nome, campus.uf, campus.sigla from campus, professor, competicao where campus.id = professor.campus_id and professor.competicao_id = competicao.id and competicao.id = (select max(id) from competicao) and professor.status = 1 group by campus.nome;

select atleta.id, atleta.nome, atleta.data_nascimento, atleta.cpf, atleta.rg, professor.nome, professor.email, professor.telefone, campus.nome, campus.sigla, campus.uf from campus, competicao, atleta, professor where campus.id = professor.campus_id and campus.id != ? and professor.competicao_id = competicao.id and competicao.id = (select max(id) from competicao) and atleta.professor_id = professor.id and professor.nome like ? order by professor.nome asc;

update professor set nome = 'a', cpf = 'a', rg = 'a', telefone = 'a', email = 'a', senha = 'a', num_suap = 'a' where id = 1;
select count(competidor.prova_id) from competidor, atleta, professor, competicao where professor.competicao_id = competicao.id and competicao.id = (select max(id) from competicao) and atleta.professor_id = professor.id and atleta.id = competidor.atleta_id and atleta.id = 5;
update alteta set foto_perfil = 'a' where id = 1;
select lim_modalidade_atleta as limite from competicao where id = (select max(id) from competicao);
select atleta.id from atleta,professor,competicao where atleta.professor_id = professor.id and professor.competicao_id = competicao.id and competicao.id = (select max(id) from competicao) and atleta.cpf = '878.978.793-24' and atleta.rg = '8787843';
desc competicao;
select professor.nome, professor.cpf, professor.rg, professor.telefone, professor.email, professor.num_suap, campus.nome, competicao.nome, competicao.campus, competicao.data_abertura, competicao.data_encerramento from professor, competicao where professor.competicao_id = competicao.id and competicao.id = (select max(id) from competicao) and professor.campus_id = campus.id and professor.id = 8;
insert into atleta(id,nome,data_nascimento,cpf,rg,foto_aluno,foto_rg,foto_cpf) values(null,'a','a','a','a','a','a','a');
insert into administrador values(null, 'Admin Master', '000.000.000-00', 'adminmaster@gmail.com', sha1('admin000'), 0, 1);
insert into administrador values(null, 'Zé', '333.333.333-33', 'ze@gmail.com', sha1('admin'), 1, 1);
select administrador.id, administrador.nome, administrador.cpf, administrador.email, competicao.nome as competicao, competicao.data_abertura, competicao.data_encerramento from competicao, administrador where administrador.competicao_id = competicao.id and competicao.id = 1 and administrador.nome like 'Ad%' and administrador.status = 1;
select * from professor;
update administrador set nome = 'd', cpf = '1', email = '1', senha = '1' where id = 8;
delete from administrador where id = 6;
insert into administrador(nome,cpf,email,senha,status,competicao_id) values('Jooj','333.333.333-33','jooj@gmail.com',sha1('joojjooj'),1,1);
select administrador.nome, administrador.cpf, administrador.email, competicao.nome, competicao.data_abertura, competicao.data_encerramento from competicao, administrador where administrador.competicao_id = competicao.id and competicao.id = 1 and administrador.status = 0;
select nome, campus, data_abertura, data_encerramento, descricao from competicao where id = (select max(id) from competicao);
insert into campus value(null,'Ceres','IFGTO','TO');
insert into professor values(null,'Professor teste','111.222.333-33','1111111','99876-9086','professor3@gmail.com',sha1('prof123'),'123',2,3,1);
insert into participante values(1,1,1);
select administrador.id as id_administrador, administrador.nome as nome_administrador, competicao.data_encerramento > now() as atual, administrador.status from administrador, competicao where administrador.competicao_id = competicao.id and competicao.id = 1 and administrador.email = 'adminmaster@gmail.com' and administrador.senha = sha1('admin000') and cpf = '000.000.000-00';
select professor.id as id_professor, professor.nome as nome_professor, competicao.data_encerramento > now() as atual from professor, competicao, participante where professor.id = participante.professor_id and participante.competicao_id = competicao.id and competicao.id = 1 and professor.id = 1; 