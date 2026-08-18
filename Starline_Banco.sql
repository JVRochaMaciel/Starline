create database starline;

use starline;
create table usuarios(
	id_usuarios int not null auto_increment primary key,
    nome varchar(200) not null,
    cpf varchar(14) not null,
    telefone varchar(15) not null,
    login varchar(200) not null,
    senha varchar(30) not null,
    dataNascimento date not null,
    statu varchar(10) not null default 'Ativo',
    id_adm int not null
)engine = Innodb;

create table adm(
	id_adm int not null auto_increment primary key,
    login varchar(200) not null,
    senha varchar(30) not null,
    nome varchar(200) not null
)engine = Innodb;

create table compra(
	id_compras int not null auto_increment primary key,
    pagamento varchar(45) not null,
    valor decimal not null,
    localViagem varchar(45) not null,
	statu varchar(10) not null default 'Ativo',
    id_usuarios int not null
)engine = Innodb;

create table nave(
	id_nave int not null auto_increment primary key,
    assentos int not null,
    nome varchar(100) not null
)engine = Innodb;

create table voo(
	id_voo int not null auto_increment primary key,
    origem varchar(200) not null,
    destino varchar(200) not null,
    dataPartida datetime not null,
    dataChegada datetime not null,
    id_nave int not null,
    id_piloto int not null
)engine = Innodb;

create table piloto(
	id_piloto int not null auto_increment primary key,
    nome varchar(200) not null,
    identificacao int not null,
    formacao varchar(200) not null,
    email varchar(200) not null,
    statu varchar(10) not null default 'Ativo'
)engine = Innodb;

create table pilotar(
	id_pilotar int not null auto_increment primary key,
    id_piloto int not null,
    id_nave int not null
)engine = Innodb;

alter table usuarios add constraint usuariosAdm foreign key (id_adm) references adm(id_adm);
alter table compra add constraint compraUsuarios foreign key (id_usuarios) references usuarios(id_usuarios);
alter table voo add constraint vooNave foreign key (id_nave) references nave(id_nave);
alter table voo add constraint vooPiloto foreign key (id_piloto) references piloto(id_piloto);
alter table pilotar add constraint pilotarNave foreign key (id_nave) references nave(id_nave);
alter table pilotar add constraint pilotarPiloto foreign key (id_piloto) references piloto(id_piloto);