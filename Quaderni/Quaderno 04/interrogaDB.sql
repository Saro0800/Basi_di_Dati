/*INTERROGAZIONE DELLA BASI DATI*/

/*Interrogazione della base dati*/
SELECT 	C.Nome, C.Cognome, S.NomeS, T.Edizione, T.CodT, CI.Posizione
FROM 	CLASSIFICA_INDIVIDUALE AS CI,
		SQUADRA AS S,
		TAPPA AS T,
		CICLISTA AS C
WHERE 	CI.CodC = C.CodC and
		CI.CodT = T.CodT and
		CI.Edizione = CI.Edizione and
		C.CodS = S.CodS and
		CI.CodC = "00001" and
		CI.CodT = "2"
ORDER BY T.Edizione ASC	;
		
/*Popolamento della base di dati*/
INSERT INTO CICLISTA
VALUES (5,"Edoardo","Colarella","Italiana",1,1999);

INSERT INTO CLASSIFICA_INDIVIDUALE (CodC, CodT, Edizione, Posizione)
VALUES(5,3,1,1);


