/* Esercizio 1
-----------------------------------------*/
SELECT P.DELIVERERID, MIN(P.DATA), MAX(P.DATA)
FROM PENALTIES P
GROUP BY P.DELIVERERID
HAVING COUNT(*)>= 2;

/* Esercizio 2
-----------------------------------------*/
SELECT P.DELIVERERID, P.DATA, P.AMOUNT
FROM PENALTIES P
WHERE P.DATA = ( SELECT MAX(P1.DATA)
                 FROM PENALTIES P1
                 WHERE P.DELIVERERID = P1.DELIVERERID );
                
/* Esercizio 3
-----------------------------------------*/
SELECT CD.COMPANYID
FROM COMPANYDEL CD
GROUP BY CD.COMPANYID
HAVING COUNT(*) >= ( SELECT 0.3*COUNT(*)
                     FROM DELIVERERS );





                 
