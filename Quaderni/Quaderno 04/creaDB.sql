/*----------------------------------------------------------------------*/
/*CREAZIONE DEL DB*/
SET storage_engine=InnoDB; 
CREATE DATABASE IF NOT EXISTS CAMPIONATO; 
SET FOREIGN_KEY_CHECKS=1; /*(attivato)*/

/*Eliminazione delle tabelle esistenti*/
DROP TABLE IF EXISTS CLASSIFICA_INDIVIDUALE;
DROP TABLE IF EXISTS CICLISTA;
DROP TABLE IF EXISTS SQUADRA;
DROP TABLE IF EXISTS TAPPA;


/*creazione della tabella squadre*/
CREATE TABLE SQUADRA
(	CodS int primary key,
	NomeS varchar (50) not null,
	AnnoFondazione int not null
		CHECK (AnnoFondazione>=1900 AND AnnoFondazione<=2000),
	SedeLEgale varchar (50)
);

/*creazione della tabella ciclista*/
CREATE TABLE CICLISTA
(	CodC int primary key,
	Nome varchar (20) not null, 
	Cognome varchar (20) not null,
	Nazionalita varchar (50) not null,
	CodS int, 
	AnnoNascita int
		CHECK (AnnoNascita>=1900 AND AnnoNascita<=2000),
	foreign key (CodS)
			references SQUADRA (CodS)
			ON UPDATE CASCADE
			ON DELETE CASCADE	
);

/*creazione della tabella tappa*/
CREATE TABLE TAPPA
(	CodT int AUTO_INCREMENT,
	Edizione int 
		check (Edizione>0),
	CittaPartenza varchar(50) not null,
	CittaArrivo varchar(50) not null,
	Lunghezza real not null,
	Dislivello real not null,
	GradoDifficolta int not null
		check (GradoDifficolta>=0 AND GradoDifficolta<=10),
	primary key(CodT, Edizione)
);

/*creazione della tabella classifica_individuale*/
CREATE TABLE CLASSIFICA_INDIVIDUALE
(	CodC int,
	CodT int,
	Edizione int,
	Posizione int not null
		check (Posizione>0),
	primary key(CodC, CodT, Edizione),
	foreign key (CodC)
		references CICLISTA (CodC)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	foreign key (CodT, Edizione)
		references TAPPA (CodT, Edizione)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

/*----------------------------------------------------------------------*/
/*POPOLAMENTO DEL DB*/
/*popolamento della tabella squadra*/
INSERT INTO SQUADRA
VALUES (1,"Polito",1980,"Torino");
INSERT INTO SQUADRA
VALUES (2,"Polimi",1970,"Milano");

/*popolamento della tabella ciclista*/
INSERT INTO CICLISTA
VALUES (1,"Rosario","Cavelli","Italiana","00001",1999);
INSERT INTO CICLISTA
VALUES (2,"Gaetano","Coppoletta","Italiana","00001",1999);
INSERT INTO CICLISTA
VALUES (3,"Daniele","Coppola","Italiana","00001",1999);
INSERT INTO CICLISTA
VALUES (4,"Mario","Rossi","Milano","00002",2000);

/*popolamento della tabella tappa*/
INSERT INTO TAPPA(Edizione, CittaPartenza, CittaArrivo, Lunghezza, Dislivello, GradoDifficolta)
VALUES (1,"Roma","Milano",2000, 1000, 4);
INSERT INTO TAPPA(Edizione, CittaPartenza, CittaArrivo, Lunghezza, Dislivello, GradoDifficolta)
VALUES (2,"Bolzano","Palermo", 2000, 1000, 2);
INSERT INTO TAPPA(Edizione, CittaPartenza, CittaArrivo, Lunghezza, Dislivello, GradoDifficolta)
VALUES (1,"Trento","Bari", 2000, 1000, 3);
INSERT INTO TAPPA (Edizione, CittaPartenza, CittaArrivo, Lunghezza, Dislivello, GradoDifficolta)
VALUES (1, "Milano", "Bergamo", 20000, 100, 7);
INSERT INTO TAPPA (Edizione, CittaPartenza, CittaArrivo, Lunghezza, Dislivello, GradoDifficolta)
VALUES (1, "Bergamo", "Varese", 3000, 150, 8);
INSERT INTO TAPPA (Edizione, CittaPartenza, CittaArrivo, Lunghezza, Dislivello, GradoDifficolta)
VALUES (2, "Roma", "Ostia", 7000, 90, 4);

/*popolamento tabella classifica_individuale*/
INSERT INTO CLASSIFICA_INDIVIDUALE (CodC, CodT, Edizione, Posizione)
VALUES(1,1,1,1);
INSERT INTO CLASSIFICA_INDIVIDUALE (CodC, CodT, Edizione, Posizione)
VALUES(2,2,2,1);
INSERT INTO CLASSIFICA_INDIVIDUALE (CodC, CodT, Edizione, Posizione)
VALUES(3,2,2,2);
INSERT INTO CLASSIFICA_INDIVIDUALE (CodC, CodT, Edizione, Posizione)
VALUES(4,3,1,3);














