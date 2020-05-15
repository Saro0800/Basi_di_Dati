/*LABORATORIO 1*/

/*1. trovare i dati relativi a tutti i fattorini della ditta*/
SELECT *
FROM deliverers;

/*2. trovare gli identificativi di tutte le aziende che hanno usufruito dei servizi di fattorini della ditta*/
SELECT COMPANYID
FROM COMPANIES;

/*3. trovare il nome e il codice di ogni fattorino il cui nome  inizia con la lettera 'B'*/
SELECT DELIVERERID, NAME
FROM DELIVERERS
WHERE NAME LIKE 'B%';

/*4. Trovare il nome, il sesso e il codice identificativo dei fattorini il cui interno (campo PHONENO) 
    è diverso da 8467 oppure non esiste*/
SELECT DELIVERERID, SEX, NAME
FROM deliverers
WHERE PHONENO<>'8467' OR PHONENO IS NULL; 

/*5. Trovare il nome e la città di residenza dei fattorini che hanno ricevuto almeno una multa*/
SELECT D.NAME, D.TOWN
FROM DELIVERERS D
WHERE D.DELIVERERID IN (SELECT DISTINCT DELIVERERID
                        FROM PENALTIES);
                        
/*6. Trovare i nomi e le iniziali (INITIALS) dei referenti (FATTORINI) di azienda che hanno ricevuto almeno una multa dopo
     il 31/12/1980 oridnati in ordine alfabetico rispetto al nome*/
SELECT D.NAME, D.INITIALS
FROM DELIVERERS D
WHERE D.DELIVERERID IN( SELECT C.DELIVERERID
                        FROM companies C
                        WHERE d.delivererid IN (SELECT DISTINCT P.DELIVERERID
                                                FROM PENALTIES P
                                                WHERE P.DATA > TO_DATE('31/12/1980','DD/MM/YYYY')
                                                )
                      )
    
ORDER BY D.NAME;

/*7. Trovare gli identificativi delle coppie formate da un'azienda e un fattorino residente a Stratford 
     tra cui ci sono stati almeno due ritiri e una consegna */
SELECT C.COMPANYID, C.DELIVERERID
FROM COMPANYDEL C
WHERE C.DELIVERERID IN (SELECT DELIVERERID
                        FROM DELIVERERS 
                        WHERE TOWN = 'Stratford')
      AND C.NUMDELIVERIES>=1 AND C.NUMCOLLECTIONS>=2;
      
/*8. Trovare gli identificativi dei fattorini (in ordine decrescenti) nati dopo il 1962 che hanno effettuato 
     almeno una consegna a una compagnia avente il referente al primo mandato */

SELECT CD.DELIVERERID
FROM COMPANYDEL CD, DELIVERERS D
WHERE CD.DELIVERERID=D.DELIVERERID AND 
      COMPANYID IN( SELECT C.COMPANYID
                    FROM COMPANIES C
                    WHERE C.MANDATE='first')
      AND D.YEAR_OF_BIRTH > 1962
ORDER BY CD.DELIVERERID DESC;

/*9. Trovare il nome dei fattorini residenti a Inglewood o Stratford che si sono recati presso almeno 
    2 aziende*/

SELECT D.NAME
FROM DELIVERERS D
WHERE D.DELIVERERID IN ( SELECT DELIVERERID
                         FROM COMPANYDEL
                         GROUP BY DELIVERERID
                         HAVING COUNT (*)>=2
                        )
      AND (D.TOWN='Inglewood' OR D.TOWN='Stratford');
      
/*10. Per tutti i fattorini di Inglewood che hanno preso almeno due multe, trovare il codice fattorino
      e l'importo totale delle multe*/
      
SELECT P.DELIVERERID, SUM(P.AMOUNT)
FROM PENALTIES P
WHERE P.DELIVERERID IN ( SELECT D.DELIVERERID
                         FROM DELIVERERS D
                         WHERE D.TOWN='Inglewood')
GROUP BY P.DELIVERERID
HAVING COUNT(*)>=2;

/*11. Per tutti i fattorini che hanno ricevuto almeno 2 multe e non più di 4, trovare il nome del fattorino
      e la multa minima pagata*/

SELECT D.NAME, MIN(P.AMOUNT)
FROM PENALTIES P, DELIVERERS D
WHERE P.DELIVERERID = D.DELIVERERID
GROUP BY P.DELIVERERID, D.NAME
HAVING COUNT(*)>=2 AND COUNT(*)<4;

/*12. Trovare il numero totale di consegne e il numero totale di ritiri effettuati da tutti i fattorini non residenti a
      Sratford il cui cognome (campo NAME) inizia con 'B' */
SELECT  SUM(CD.NUMDELIVERIES), SUM(CD.NUMCOLLECTIONS)
FROM    DELIVERERS D, COMPANYDEL CD
WHERE   D.DELIVERERID = CD.DELIVERERID AND
        D.TOWN<>'Stratford' AND
        D.NAME LIKE 'B%';
      
















