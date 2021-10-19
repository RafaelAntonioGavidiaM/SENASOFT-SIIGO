create database reto;

use reto;
create table partida(
idPartida int not null auto_increment,
codigoPartida varchar(30),
estado varchar(30),
ganador varchar(30),
primary key(idPartida));



create table usuarioPartida(
	idUsuario int not null auto_increment,
	nombre varchar(30),
	idPartida int not null,
	turno varchar(30),
	primary key(idUsuario)


);

create table pregunta(
	idPregunta int not null auto_increment ,
	pregunta varchar(50),
	idUsuario int not null,
	respuesta varchar(50),
	idUsuarioRespuesta int not null,
	primary key(idPregunta)


);
create table cartaUsuarioPartida(
idCartaUsuarioPartida int not null auto_increment ,
idUsuario int not null,
idCarta int not null,
primary key(idCartaUsuarioPartida)
);

create table carta(
idCarta int not null auto_increment,
nombreCarta varchar(30),
imagen varchar(100),
idTipo int not null,
primary key(idCarta));

create table cartaPartida(
idCartaPartida int not null auto_increment,
idPartida int ,
idCarta int not null,

primary key(idCartaPartida));

create table tipoCarta(
idTipo int not  null auto_increment,
nombreTipo varchar(30),
primary key(idTipo));


alter table pregunta add foreign key (idUsuario) references usuarioPartida(idUsuario);

alter table pregunta add foreign key (idUsuarioRespuesta) references usuarioPartida(idUsuario);

alter table usuarioPartida add foreign key (idPartida) references partida(idPartida);

alter table cartaUsuarioPartida add  foreign key (idUsuario) references usuarioPartida(idUsuario);

alter table cartaUsuarioPartida add  foreign key (idCarta) references carta(idCarta);

alter table carta  add foreign key (idTipo) references tipoCarta(idTipo);

alter table cartaPartida add  foreign key (idPartida) references partida(idPartida);






