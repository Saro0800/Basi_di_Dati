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
    if(!isset($_GET["codt"]) || trim($_GET["codt"])==''){
        //chiamo la funzione che stampa l'errore sui parametri
        print_insertion_error("Codice Tappa");
        $error = true;
    }
    if(!isset($_GET["edizione"]) || trim($_GET["edizione"])==''){
        //chiamo la funzione che stampa l'errore sui parametri
        print_insertion_error("Edizione");
        $error = true;
    }
    if(!isset($_GET["pos"]) || trim($_GET["pos"])==''){
        //chiamo la funzione che stampa l'errore sui parametri
        print_insertion_error("Posizione Ciclista");
        $error = true;
    }
    if($error == true)
        die();
}




check_parameter_insertion();

//acquisizione dei parametri
$CodC = $_GET["codc"];
$CodT = $_GET["codt"];
$Edizione = $_GET["edizione"];
$Pos = $_GET["pos"];

//creo la connessione
$conn = mysqli_connect('localhost', 'root','','campionato');
if(!$conn)
    die("Conncection error: ".mysqli_error($conn));

//controllo che la tappa e l'edizione siano collegati
$query = "  SELECT *
            FROM tappa
            WHERE Edizione = '$Edizione' and
                  CodT = '$CodT' ;";

$result = mysqli_query($conn, $query);
if($result == false){
    echo "<table>";
    echo "<tr><td class='wrong'>Errore durante la verifica del collegamento di CodT e Edizione</td></td>";
    echo "</table>";
    die();
}

if(mysqli_num_rows($result)==0){
    echo "<table>";
    echo "<tr><td class='wrong'>Combinazione di (CodT, Edizione) non presente</td></td>";
    echo "</table>";
    die();
}

//controllo l'unicità della chiave primaria
$query = "  SELECT *
            FROM classifica_individuale
            WHERE CodC = '$CodC' and 
                  CodT = '$CodT' and 
                  Edizione = '$Edizione' ;";

$result = mysqli_query($conn, $query);
if($result == false){
    echo "<table>";
    echo "<tr><td class='wrong'>Errore durante la ricerca dell'istanza</td></td>";
    echo "</table>";
    die();
}

if(mysqli_num_rows($result)>0){
    echo "<table>";
    echo "<tr><td class='wrong'>Combinazione di (CodC, CodT, Edizione) già presente</td></td>";
    echo "</table>";
    die();
}

//controllo che la posizione non sia già occupata
$query = "  SELECT *
            FROM classifica_individuale
            WHERE CodT = '$CodT' and 
                  Edizione = '$Edizione' and
                  Posizione = '$Pos';  ";

$result = mysqli_query($conn, $query);
if($result == false){
    echo "<table>";
    echo "<tr><td class='wrong'>Errore durante la ricerca della posizione</td></td>";
    echo "</table>";
    die();
}

if(mysqli_num_rows($result)>0){
    echo "<table>";
    echo "<tr><td class='wrong'>Posizione già occupata per (CodT, Edizione)</td></td>";
    echo "</table>";
    die();
}


$query = "  INSERT INTO CLASSIFICA_INDIVIDUALE
            VALUES ('$CodC','$CodT','$Edizione','$Pos');";

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