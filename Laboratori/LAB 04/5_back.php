<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Nuovo Corso</title>
        <style type="text/css">
            td {
                .right{
                    align-content: center;
                    color: white;
                    size: 16pt;
                    background: forestgreen;
                    width: 500px;
                    height: 300px
                }
                .wrong{
                    align-content: center;
                    color: white;
                    size: 16pt;
                    background: #ff0000;
                    width: 500px;
                    height: 300px
                }
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

        //funzione per la stampa di errori relativi ad errori di tipo<!DOCTYPE html>
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

        //funzione per la stampa di errori relativi a codici già presenti
        function print_cod_error($param){
            echo "<table>";
            echo "<tr><td class='wrong'>Il codice '$param' è già usato</td></tr>";
            echo "</table>";

        }
        //funzione per la stampa di errori relativi a instance di corsi già presenti
        function instance_already_inserted($param){
            echo "<table>";
            echo "<tr><td class='wrong'>Esiste già un'istanza con i parametri specificati ma 'CodC' diverso</td></tr>";
            echo "</table>";

        }

        //funzione per il controllo dell'inserimento dei parametri
        function check_parameter_insertion(){
            $error = false;
            if(!isset($_POST["cod"]) || trim($_POST["cod"])==''){
                //chiamo la funzione che stampa l'errore sui parametri
                print_insertion_error("Codice");
                $error = true;
            }
            if(!isset($_POST["name"]) || trim($_POST["name"])==''){
                print_insertion_error("Nome");
                $error = true;
            }
            if(!isset($_POST["type"]) || trim($_POST["type"])==''){
                print_insertion_error("Tipo");
                $error = true;
            }
            if(!isset($_POST["level"]) || trim($_POST["level"])==''){
                print_insertion_error("Livello");
                $error = true;
            }

            if($error == true)
                die();
        }

        //funzione per il controllo del formato dei parametri
        function check_parameter_content(){
            $error = false;
            $cod = $_POST["cod"];
            //controllo relativo al codice
            if( $cod[0]!='C' || $cod[1]!='T'){
                print_content_error("Codice");
                $error = true;
            }
            //controllo relativo al livello
            if(!filter_var($_POST["level"], FILTER_VALIDATE_INT)){
                print_content_error("Livello");
                $error = true;
            }

            if($error == true)
                die();
        }

        check_parameter_insertion();
        check_parameter_content();

        //acquisizione dei parametri
        $cod = $_POST["cod"];
        $name = $_POST["name"];
        $type = $_POST["type"];
        $level = $_POST["level"];

        //creo la connessione
        $conn = mysqli_connect('localhost', 'root','','palestra');
        if(!$conn)
            die("Conncection error: ".mysqli_error($conn));

        //controllo che il vincolo di integrità sia soddisfatto
        if($level<1 || $level>4){
            echo "<table>";
            echo "<tr><td class='wrong'>Livello specificato non valido (numero intero compreso tra 1 e 4)</td></td>";
            echo "</table>";
            die();
        }

        //query per il controllo della presenza del cod specificato
        $query = "  SELECT CodC
                    FROM corsi AS C
                    WHERE C.CodC='$cod';";

        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result)>=1){
            //stampa messaggio di errore
            print_cod_error($cod);
            die();
        }

        //query per il controllo della consistenza dela richiesta
        $query = "  SELECT  CodC
                    FROM    corsi AS C
                    WHERE   C.Nome='$name' AND 
                            C.Tipo='$type' AND
                            C.Livello='$level';";

        $result = mysqli_query($conn, $query);
        if($result == false){
            echo "<table>";
            echo "<tr><td class='wrong'>Errore durante la ricerca dell'istanza</td></td>";
            echo "</table>";
            die();
        }

        if(mysqli_num_rows($result)>=1){
            //stampa messaggio di errore
            instance_already_inserted($cod);
            die();
        }

        $query = " INSERT INTO corsi (CodC, Nome, Tipo, Livello)
                   VALUES ('$cod','$name', '$type', '$level'); ";

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

        function print_content_error($param){
            echo "<table>";
            echo "<tr><td> class='wrong'>Formato non corretto per il campo: $param</td></tr>";
            echo "</table>";

        }

        //funzione per la stampa di errori relativi a codici già presenti
        function print_cod_error($param){
            echo "<table>";
            echo "<tr><td> class='wrong'>Il codice '$param' è già usato</td></tr>";
            echo "</table>";

        }
        //funzione per la stampa di errori relativi a instance di corsi già presenti
        function instance_already_inserted($param){
            echo "<table>";
            echo "<tr></tr><td> class='wrong'>Esiste già un'istanza con i parametri specificati ma 'CodC' diverso</td></tr>";
            echo "</table>";

        }

        //funzione per il controllo dell'inserimento dei parametri
        function check_parameter_insertion(){
            $error = false;
            if(array_key_exists("cod",$_POST) || trim($_POST["cod"])==''){
                //chiamo la funzione che stampa l'errore sui parametri
                print_insertion_error("Codice");
                $error = true;
            }
            if(array_key_exists("name",$_POST) || trim($_POST["name"])==''){
                print_insertion_error("Nome");
                $error = true;
            }
            if(array_key_exists("type",$_POST) || trim($_POST["type"])==''){
                print_insertion_error("Tipo");
                $error = true;
            }
            if(array_key_exists("level",$_POST) || trim($_POST["level"])==''){
                print_insertion_error("Livello");
                $error = true;
            }

            if($error == true)
                die();
        }

        //funzione per il controllo del formato dei parametri
        function check_parameter_content(){
            $error = false;
            $cod = $_POST["cod"];
            //controllo relativo al codice
            if( $cod[0]!='C' || $cod[1]!='T'){
                print_content_error("Codice");
                $error = true;
            }
            else{
                for($i=2; i<strlen($cod); $i++){
                    if(!filter_var($cod[$i], FILTER_VALIDATE_INT)){
                        print_content_error("Codice");
                        $error = true;
                        break;
                    }
                }
            }
            //controllo relativo al livello
            if(!filter_var($_POST["levell"], FILTER_VALIDATE_INT)){
                print_content_error("Livello");
                $error = true;
            }

            if($error == true)
                die();
        }

        check_parameter_insertion();
        check_parameter_content();

        //acquisizione dei parametri
        $cod = $_POST["cod"];
        $name = $_POST["name"];
        $type = $_POST["type"];
        $level = $_POST["level"];

        //creo la connessione
        $conn = mysqli_connect('localhost', 'root','','palestra');

        //query per il controllo della presenza del cod specificato
        $query = "  SELECT CodC
                    FROM corsi AS C
                    WHERE C.CodC='$cod';";

        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result)>=1){
            //stampa messaggio di errore
            print_cod_error($cod);
            die();
        }

        //query per il controllo della consistenza dela richiesta
        $query = "  SELECT  CodC
                    FROM    corsi AS C
                    WHERE   C.Nome='$name' AND 
                            C.Tipo='$type' AND
                            C.Livell='$level';";

        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result)>=1){
            //stampa messaggio di errore
            instance_already_inserted($cod);
            die();
        }

        $query = " INSERT INTO corsi (CodC, Nome, Tipo, Livello)
                   VALUES ($cod, $name, $type, $level); ";

        $result = mysqli_query($conn, $query);
        if($result == false){
            echo "<table>";
            echo "<tr><td class='wrong'>Errore durante l'inserimento .mysqli_error($conn)</td></td>";
            echo "</table>";
            die();
        }

        mysqli_close($conn);




        ?>
    </body>

</html>
