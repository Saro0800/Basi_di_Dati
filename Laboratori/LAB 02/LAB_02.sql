/*  Esercizio 1
    -------------------------------------------------------
*/
SELECT D.DELIVERERID, D.NAME, D.INITIALS
FROM DELIVERERS D
WHERE D.DELIVERERID NOT IN (    SELECT P.DELIVERERID
                                FROM PENALTIES P
                            );
                            
/*  Esercizio 2
    -------------------------------------------------------
*/
SELECT D.DELIVERERID
FROM DELIVERERS D
WHERE D.DELIVERERID IN (    SELECT P.DELIVERERID
                            FROM PENALTIES P
                            WHERE P.DELIVERERID IN (     SELECT DISTINCT P.DELIVERERID 
                                                        FROM PENALTIES P
                                                        WHERE P.AMOUNT = 25)
                                  AND P.AMOUNT = 30);

/*  Esercizio 3
    -------------------------------------------------------
*/
SELECT D.DELIVERERID, D.NAME
FROM DELIVERERS D
WHERE D.DELIVERERID IN (    SELECT P.DELIVERERID
                            FROM PENALTIES P
                            GROUP BY P.DELIVERERID, P.DATA
                            HAVING COUNT(*)>1
                        );

/*  Esercizio 4
    -------------------------------------------------------
*/                            
SELECT CD.DELIVERERID
FROM COMPANYDEL CD
GROUP BY CD.DELIVERERID
HAVING COUNT(*) = ( SELECT COUNT(*)
                    FROM COMPANIES C
                  );

/*  Esercizio 5
    -------------------------------------------------------
*/      
SELECT CD.DELIVERERID
FROM COMPANYDEL CD
WHERE CD.COMPANYID IN ( SELECT COMPANYID
                        FROM COMPANYDEL
                        WHERE DELIVERERID = 57
                    )
      AND CD.DELIVERERID <> 57;
      
/*  Esercizio 6
    -------------------------------------------------------
*/   
SELECT D.DELIVERERID, D.NAME
FROM PENALTIES P, DELIVERERS D
WHERE P.DELIVERERID = D.DELIVERERID
      AND P.DATA <= TO_DATE('31/12/1980','DD/MM/YYYY')
      AND P.DATA >= TO_DATE('01/01/1980','DD/MM/YYYY')
GROUP BY D.DELIVERERID, D.NAME
HAVING COUNT(*) >   ( SELECT COUNT(*)
                      FROM PENALTIES P1
                      WHERE D.DELIVERERID = P1.DELIVERERID
                            AND P1.DATA <= TO_DATE('31/12/1981','DD/MM/YYYY')
                            AND P1.DATA >= TO_DATE('01/01/1981','DD/MM/YYYY')
                    );

/*  Esercizio 7
    -------------------------------------------------------
*/
SELECT P.DELIVERERID 
FROM PENALTIES P
GROUP BY P.DELIVERERID
HAVING COUNT(*) = ( SELECT MAX(NPenalties)
                    FROM    (SELECT COUNT(*) AS NPenalties
                             FROM PENALTIES P1
                             GROUP BY P1.DELIVERERID
                            )
                  );
                  
/*  Esercizio 8
    -------------------------------------------------------
*/
SELECT CD.DELIVERERID
FROM COMPANYDEL CD
WHERE CD.DELIVERERID <> 57
      AND CD.COMPANYID IN ( SELECT CD1.COMPANYID
                            FROM COMPANYDEL CD1
                            WHERE CD1.DELIVERERID = 57 
                          )
GROUP BY CD.DELIVERERID
HAVING COUNT(*) = ( SELECT COUNT(*)
                    FROM COMPANYDEL CD2
                    WHERE CD2.DELIVERERID = 57
                    );
               
/*  Esercizio 9
    -------------------------------------------------------
*/   
SELECT DISTINCT DELIVERERID
FROM COMPANYDEL
WHERE DELIVERERID <> 57
      AND DELIVERERID NOT IN ( SELECT DELIVERERID
                               FROM COMPANYDEL
                               WHERE COMPANYID NOT IN ( SELECT COMPANYID
                                                        FROM COMPANYDEL
                                                        WHERE DELIVERERID = 57)
                                                      );
                                                      
/*  Esercizio 10
    -------------------------------------------------------
*/   
SELECT DISTINCT DELIVERERID
FROM COMPANYDEL
WHERE DELIVERERID <> 57
      AND DELIVERERID NOT IN ( SELECT DELIVERERID
                               FROM COMPANYDEL
                               WHERE COMPANYID NOT IN ( SELECT COMPANYID
                                                        FROM COMPANYDEL
                                                        WHERE DELIVERERID = 57)
                                                      )
GROUP BY DELIVERERID
HAVING COUNT(*) = ( SELECT COUNT(*)
                    FROM COMPANYDEL CD2
                    WHERE CD2.DELIVERERID = 57
                    );
                                 



















                            
                            
    