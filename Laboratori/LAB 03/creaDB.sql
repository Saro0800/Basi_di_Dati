/*CREAZIONE DEL DB*/
SET storage_engine=InnoDB; 
CREATE DATABASE IF NOT EXISTS PALESTRA; 
SET FOREIGN_KEY_CHECKS=1; /*(attivato)*/

/*Eliminazione delle tabelle esistenti*/
DROP TABLE IF EXISTS PROGRAMMA;
DROP TABLE IF EXISTS ISTRUTTORE;
DROP TABLE IF EXISTS CORSI;

/*Creazione della tabella Istruttore*/
CREATE TABLE ISTRUTTORE
(	CodFisc char (16) primary key,
	Nome	varchar (20),
	Cognome varchar (20),
	DataNascita date,
	Email	varchar (30),
	Telefono varchar (15)
);

/*Creazione della tabella Corsi*/
CREATE TABLE CORSI
(	CodC char (5) primary key,
	Nome varchar (20),
	Tipo varchar (100),
	Livello smallint,
	CONSTRAINT check_livello CHECK (Livello>0 AND Livello<5)
);

/*Creazione della tabella Programma*/
CREATE TABLE PROGRAMMA
(	CodFisc char (16),
	Giorno varchar (20),
	OraInizio time,
	Durata smallint /*check (Durata>0)*/,
	CodC char (5),
	Sala varchar (5),
	primary key (CodFisc, Giorno, OraInizio),
	foreign key (CodFisc)
		references ISTRUTTORE (CodFisc)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	foreign key (CodC)
		references CORSI (CodC)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);








