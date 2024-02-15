-- Para MySQL / MariaDB:

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


---------------------------------------------------------

-- Para PostgreSQL:

-- Criar banco de dados
CREATE DATABASE copyhub;

-- Usar o banco de dados
\c copyhub;

-- Criar tabela usuarios
CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(250) NOT NULL,
    email VARCHAR(250) NOT NULL,
    senha VARCHAR(250) NOT NULL,
    bio TEXT,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Criar tabela posts
CREATE TABLE posts (
    id SERIAL PRIMARY KEY,
    id_usuario INT,
    titulo VARCHAR(250) NOT NULL,
    categoria VARCHAR(100) NOT NULL,
    texto TEXT,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);

-- Criar tabela favoritos
CREATE TABLE favoritos (
    id_usuario INT,
    id_post INT,
    PRIMARY KEY (id_usuario, id_post),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
    FOREIGN KEY (id_post) REFERENCES posts(id)
);
