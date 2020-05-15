/*POPOLAMENTO DEL DB*/

/*Popolamento della tabella ISTRUTTORE*/
INSERT INTO ISTRUTTORE
			(CodFisc, Nome, Cognome, DataNascita, Email)
VALUES ('SMTPLA80N31B791Z','Paul','Smith','1980-12-31','p.smith@email.it');

INSERT INTO ISTRUTTORE
			(CodFisc, Nome, Cognome, DataNascita, Email, Telefono)
VALUES ('KHNJHN81E30C455Y','John','Johnson','1981-5-30','j.johnson@email.it','+2300110303444');

INSERT INTO ISTRUTTORE
			(CodFisc, Nome, Cognome, DataNascita, Email, Telefono)
VALUES ('AAAGGG83E30C445A','Peter','Johnson','1981-5-30','p.johnson@email.it','+2300110303444');

/*Popolamento della tabella CORSI*/
INSERT INTO CORSI
			(CodC, Nome, Tipo, Livello)
VALUES ('CT100','Spinning principianti','Spinning',1);

INSERT INTO CORSI
			(CodC, Nome, Tipo, Livello)
VALUES ('CT101','Ginnastica e musica','Attività musicale',2);

INSERT INTO CORSI
			(CodC, Nome, Tipo, Livello)
VALUES ('CT104','Spinning professionisti','Spinning',4);

/*Popolamento della tabella PROGRAMMA*/
INSERT INTO PROGRAMMA
			(CodFisc, Giorno, OraInizio, Durata, CodC, Sala)
VALUES ('SMTPLA80N31B791Z','Lunedì','10:00',45,'CT100','S1');

INSERT INTO PROGRAMMA
			(CodFisc, Giorno, OraInizio, Durata, CodC, Sala)
VALUES ('SMTPLA80N31B791Z','Martedì','11:00',45,'CT100','S1');

INSERT INTO PROGRAMMA
			(CodFisc, Giorno, OraInizio, Durata, CodC, Sala)
VALUES ('SMTPLA80N31B791Z','Martedì','15:00',45,'CT100','S2');

INSERT INTO PROGRAMMA
			(CodFisc, Giorno, OraInizio, Durata, CodC, Sala)
VALUES ('KHNJHN81E30C455Y','Lunedì','10:00',30,'CT101','S2');

INSERT INTO PROGRAMMA
			(CodFisc, Giorno, OraInizio, Durata, CodC, Sala)
VALUES ('KHNJHN81E30C455Y','Lunedì','11:30',30,'CT104','S2');

INSERT INTO PROGRAMMA
			(CodFisc, Giorno, OraInizio, Durata, CodC, Sala)
VALUES ('KHNJHN81E30C455Y','Mercoledì','9:00',60,'CT104','S1');

