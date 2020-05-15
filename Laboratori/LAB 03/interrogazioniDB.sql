/*Interrogazioni del DB PALESTRA*/

/*4.1---------------*/

UPDATE ISTRUTTORE
SET Telefono = '+390112333551'
WHERE CodFisc = 'KHNJHN81E30C455Y';

/*4.2---------------*/
UPDATE PROGRAMMA
SET Sala='S4'
WHERE Sala='S2';

/*4.3---------------*/
DELETE FROM CORSI
WHERE CodC IN (	SELECT CodC
				FROM PROGRAMMA
				GROUP BY CodC
				HAVING COUNT(*)=1
			  );
			  
/*4.4---------------*/
DELETE FROM ISTRUTTORE
WHERE CodFisc =  'SMTPLA80N31B791Z';

