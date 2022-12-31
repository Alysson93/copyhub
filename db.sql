create database copyhub;

use copyhub;

create table usuarios (
	id int primary key auto_increment,
	nome varchar(250) not null,
	email varchar(250) not null,
	senha varchar(250) not null,
	bio text,
	criado_em timestamp default current_timestamp
);

create table posts (
	id int primary key auto_increment,
	id_usuario int,
	titulo varchar(250) not null,
	categoria varchar(100) not null,
	texto text,
	criado_em timestamp default current_timestamp,
	foreign key (id_usuario) references usuarios(id)
);

create table favoritos (
	id_usuario int,
	id_post int,
	primary key (id_usuario, id_post),
	foreign key (id_usuario) references usuarios(id),
	foreign key (id_post) references posts(id)
);