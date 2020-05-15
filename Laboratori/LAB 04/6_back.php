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
                background: forestgreen;
                width: 400px;
                height: 50px;
            }
            .wrong {
                text-align: center;
                color: white;
                font-size: 14pt;
                background: #ff0000;
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

        //funzione per la stampa di errori relativi ad errori di tipo
        function print_content_error($param){
            echo "<table>";
            echo "<tr><td class='wrong'>Formato non corretto per il campo: $param</td></tr>";
            echo "</table>";
        }

        //funzione per il controllo dell'inserimento dei parametri
        function check_parameters(){
            $error=false;
            if(!isset($_POST["CodFisc"]) || trim($_POST["CodFisc"])==''){
                print_insertion_error("CodFisc");
                $error = true;
            }
            if(!isset($_POST["CodC"]) || trim($_POST["CodC"])==''){
                print_insertion_error("CodC");
                $error = true;
            }
            if(!isset($_POST["day"]) || trim($_POST["day"])==''){
                print_insertion_error("Giorno");
                $error = true;
            }
            if(!isset($_POST["starting_time"]) || trim($_POST["starting_time"])==''){
                print_insertion_error("Ora Inizio");
                $error = true;
            }
            if(!isset($_POST["duration"]) || trim($_POST["duration"])==''){
                print_insertion_error("Durata");
                $error = true;
            }
            if(!isset($_POST["room"]) || trim($_POST["room"])==''){
                print_insertion_error("Sala");
                $error = true;
            }
            if($error==true)
                die();
        }

        function room_availability_check($start, $end, $day, $room, $conn){
            $query = "SELECT *
                      FROM programma AS P
                      WHERE (TIME(P.OraInizio) BETWEEN '$start' AND '$end' OR 
                            TIME(ADDTIME(P.OraInizio, SEC_TO_TIME(P.Durata*60))) BETWEEN '$start' AND '$end') AND
                            P.Giorno = '$day' AND 
                            P.Sala = '$room'; ";
            $result=mysqli_query($conn, $query);
            if($result==false){
                echo "<table>";
                echo "<tr><td class='wrong'>Errore durante la ricerca del programma</td></td>";
                echo "</table>";
                die();
            }
            if(mysqli_num_rows($result)>0)
                return false;
            return true;
        }

        function trainer_availability_check($codf, $day, $start, $end, $conn){
            $query = "SELECT *
                      FROM programma AS P
                      WHERE P.CodFisc = '$codf' AND
                            P.Giorno = '$day' AND 
                            (TIME(P.OraInizio) BETWEEN '$start' AND '$end' OR 
                            TIME(ADDTIME(P.OraInizio, SEC_TO_TIME(P.Durata*60))) BETWEEN '$start' AND '$end'); ";
            $result=mysqli_query($conn, $query);
            if($result==false){
                echo "<table>";
                echo "<tr><td class='wrong'>Errore durante la ricerca del trainer</td></td>";
                echo "</table>";
                die();
            }
            if(mysqli_num_rows($result)>0)
                return false;
            return true;
        }

        function availability_check($codf, $day, $start, $end, $room, $conn){
            if(!room_availability_check($start, $end, $day, $room, $conn)){
                echo "<table>";
                echo "<tr><td class='wrong'>La sala '$room' non è disponibile il giorno '$day' alle '$start'</td></tr>";
                echo "</table>";
                die();
            }
            else if (!trainer_availability_check($codf, $day, $start, $end, $conn)){
                echo "<table>";
                echo "<tr><td class='wrong'>Il trainer '$codf' non è disponibile il giorno '$day' alle '$start'</td></tr>";
                echo "</table>";
                die();
            }
        }

        check_parameters();
        $codf = $_POST["CodFisc"];
        $codc = $_POST["CodC"];
        $day = $_POST["day"];
        $start = $_POST["starting_time"];
        $duration = $_POST["duration"];
        $room = $_POST["room"];
        $time = strtotime($start);
        $end = date("H:i", strtotime('+'.$duration.' minutes', $time));

        $conn = mysqli_connect('localhost','root','','palestra');
        if(!$conn)
            die("Conncection error: ".mysqli_error($conn));
        availability_check($codf, $day, $start, $end, $room, $conn);

        $query = " INSERT INTO programma (CodFisc, Giorno, OraInizio, Durata, Sala, CodC)
                   VALUES ('$codf', '$day', '$start', '$duration', '$room', '$codc'); ";

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

