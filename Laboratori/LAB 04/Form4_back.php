<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form4</title>
</head>
<body>
    <h3>Risultato della ricerca</h3>
    <?php
        //controllo dei dati inseriti
        if(trim($_GET["cognome"])=='' || trim($_GET["giorno"])==''){
            echo "<font color='red'><h3>Error: missing parameters</h3>";
            exit();
        }
        $dbname = 'palestra';
        $conn = mysqli_connect('localhost','root','',$dbname);

        if(!$conn)
            die("Conncection error: ".mysqli_error($conn));

        $cognome = $_REQUEST["cognome"];
        $giorno = $_REQUEST["giorno"];

        //$cognome = utf8_decode( mysqli_real_escape_string($conn, $cognome));
        //$giorno = utf8_decode( mysqli_real_escape_string($conn, $giorno));

        /*query richiesta*/
        $query = "
        SELECT  C.Nome AS Nome, C.Tipo AS Tipo, P.OraInizio AS OraInizio, 
                ADDTIME(P.OraInizio, SEC_TO_TIME(P.Durata*60)) AS OraFine, P.Giorno AS Giorno, C.Livello AS Livello
        FROM    CORSI AS C, ISTRUTTORE AS I, PROGRAMMA AS P
        WHERE   P.CodFisc = I.CodFisc AND
                P.CodC = C.CodC AND
                I.Cognome = '$cognome' AND
                P.Giorno = '$giorno'
        ORDER BY C.Livello ASC, C.Nome ASC	;   ";

        $result = mysqli_query($conn, $query);
        if(!$result)
            die("Query error: ".mysqli_error($conn));

        if(mysqli_num_rows($result)>0){
            echo "<table border='1' width='700'>";
            echo "<tr>";
            for($i=0; $i<mysqli_num_fields($result); $i++){
                $attribute = mysqli_fetch_field($result);
                $attribute_name = $attribute->name;
                echo "<th> $attribute_name </td>";
            }
            echo "</tr>";

            while($row = mysqli_fetch_row($result)){
                echo "<tr>";
                for($i=0; $i<mysqli_num_fields($result); $i++){
                    echo "<td> $row[$i]</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }
        else{
            //$giorno = utf8_encode($giorno);
            echo "<p>Nessun corso è tenuto da $cognome di $giorno</p>";
            exit();
        }



    ?>
</body>
</html>
