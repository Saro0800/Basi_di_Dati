<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nuovo Corso</title>
    <style type="text/css">
        .right{
            text-align: center;
            color: white;
            font-size: 14pt;
            background: #4CAF50;
            width: 500px;
            height: 50px;
        }
        .wrong {
            text-align: center;
            color: white;
            font-size: 14pt;
            background: red;
            width: 500px;
            height: 50px;
        }
    </style>
</head>
<body>
<?php

//funzione per la stampa di errori relativi al mancato inserimento dei dati
function print_insertion_error($param){
    echo "<table>";
    echo "<tr><td class='wrong'>Non è stato inserito nulla nel campo: $param</td></tr>";
    echo "</table>";
}

//funzione per il controllo dell'inserimento dei parametri
function check_parameter_insertion(){
    $error = false;
    if(!isset($_GET["codc"]) || trim($_GET["codc"])==''){
        //chiamo la funzione che stampa l'errore sui parametri
        print_insertion_error("Codice Ciclista");
        $error = true;
    }
    if(!isset($_GET["namec"]) || trim($_GET["namec"])==''){
        //chiamo la funzione che stampa l'errore sui parametri
        print_insertion_error("Nome Ciclista");
        $error = true;
    }
    if(!isset($_GET["cognomec"]) || trim($_GET["cognomec"])==''){
        //chiamo la funzione che stampa l'errore sui parametri
        print_insertion_error("Cognome Ciclista");
        $error = true;
    }
    if(!isset($_GET["nazionalitàc"]) || trim($_GET["nazionalitàc"])==''){
        //chiamo la funzione che stampa l'errore sui parametri
        print_insertion_error("Nazionalità Ciclista");
        $error = true;
    }
    if(!isset($_GET["cods"]) || trim($_GET["cods"])==''){
        //chiamo la funzione che stampa l'errore sui parametri
        print_insertion_error("Codice Squadra");
        $error = true;
    }
    if(!isset($_GET["anno_nascita"]) || trim($_GET["anno_nascita"])==''){
        //chiamo la funzione che stampa l'errore sui parametri
        print_insertion_error("Anno nascita Ciclista");
        $error = true;
    }
    if($error == true)
        die();
}

check_parameter_insertion();

//acquisizione dei parametri
$CodC = $_GET["codc"];
$NameC = $_GET["namec"];
$CognomeC = $_GET["cognomec"];
$NazionalitaC = $_GET["nazionalitàc"];
$CodS = $_GET["cods"];
$Anno = $_GET["anno_nascita"];

//creo la connessione
$conn = mysqli_connect('localhost', 'root','','campionato');
if(!$conn)
    die("Conncection error: ".mysqli_error($conn));

//controllo che il codice non sia già presente
$query = "  SELECT CodC
            FROM ciclista
            WHERE CodC = '$CodC'; ";

$result = mysqli_query($conn, $query);
if($result == false){
    echo "<table>";
    echo "<tr><td class='wrong'>Errore durante la ricerca del CodC</td></td>";
    echo "</table>";
    die();
}

if(mysqli_num_rows($result)>0){
    echo "<table>";
    echo "<tr><td class='wrong'>CodC già presente</td></td>";
    echo "</table>";
    die();
}

//controllo la consistenza della richiesta
$query = "  SELECT CodC
            FROM ciclista
            WHERE Nome = '$NameC' and
                  Cognome = '$CognomeC' and 
                  Nazionalita = '$NazionalitaC' and 
                  CodS = '$CodS' and 
                  AnnoNascita = '$Anno'; ";

$result = mysqli_query($conn, $query);
if($result == false){
    echo "<table>";
    echo "<tr><td class='wrong'>Errore durante la ricerca della query</td></td>";
    echo "</table>";
    die();
}

if(mysqli_num_rows($result)>0){
    echo "<table>";
    echo "<tr><td class='wrong'>Ciclista già presente (con un altro codice)</td></td>";
    echo "</table>";
    die();
}


$query = "  INSERT INTO CICLISTA
            VALUES ('$CodC','$NameC','$CognomeC','$NazionalitaC','$CodS','$Anno');";

$result = mysqli_query($conn, $query);
if($result == false){
    echo "<table>";
    echo "<tr><td class='wrong'>Errore durante l'inserimento</td></tr>";
    echo "</table>";
    die();
}

echo "<table>";
echo "<tr><td class='right'>Istanza inserita correttamente</td></td>";
echo "</table>";

mysqli_close($conn);




?>
</body>

</html>
