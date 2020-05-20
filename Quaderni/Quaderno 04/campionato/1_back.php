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
            width: 400px;
            height: 50px;
        }
        .wrong {
            text-align: center;
            color: white;
            font-size: 14pt;
            background: red;
            width: 400px;
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
    if(!isset($_GET["CodC"]) || trim($_GET["CodC"])==''){
        //chiamo la funzione che stampa l'errore sui parametri
        print_insertion_error("Codice Ciclista");
        $error = true;
    }
    if(!isset($_GET["CodT"]) || trim($_GET["CodT"])=='') {
        print_insertion_error("Nome Tappa");
        $error = true;
    }


    if($error == true)
        die();
}

check_parameter_insertion();

//acquisizione dei parametri
$CodC = $_GET["CodC"];
$CodT = $_GET["CodT"];

//creo la connessione
$conn = mysqli_connect('localhost', 'root','','campionato');
if(!$conn)
    die("Conncection error: ".mysqli_error($conn));

$query = "SELECT C.Nome, C.Cognome, S.NomeS, T.Edizione, T.CodT, CI.Posizione
          FROM  CLASSIFICA_INDIVIDUALE AS CI,
		        SQUADRA AS S,
		        TAPPA AS T,
		        CICLISTA AS C
          WHERE 	CI.CodC = C.CodC and
		            CI.CodT = T.CodT and
		            CI.Edizione = CI.Edizione and
		            C.CodS = S.CodS and
		            CI.CodC = '$CodC' and
		            CI.CodT = '$CodT'
          ORDER BY T.Edizione ASC	; ";

$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result)==0){
    echo "<br/><center><p class='right'>Query eseguita: nessun risultato ottenuto</p></center>";
    die();
}

echo "<br/><center>
    <table border=\"1\" style=\"text-align: center;\">
        <thead><tr>
            <th style='width: 100px'>Nome</th>
            <th style='width: 100px'>Cognome</th>
            <th style='width: 150px'>Nome Squadra</th>
            <th style='width: 100px'>Edizione</th>
            <th style='width: 100px'>CodT</th>
            <th style='width: 100px'>Posizione</th>
        </tr></thead>";

while($row = mysqli_fetch_row($result)) {
    echo "<tr>";
    foreach ($row as $cell)
        echo "<td style='width: 100px'>$cell</td>";
    echo "</tr>";
}

echo "</table>
</center>";



mysqli_close($conn);




?>
</body>

</html>