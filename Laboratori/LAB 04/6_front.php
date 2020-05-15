<html>
    <head>
        <title>Nuova Programmazione</title>
        <style type="text/css">
            .blank1{
                text-align: left;
                font-size: 13pt;
                width: 150px;
                height: 25px;

            }
            .blank2{
                text-align: left;
                font-size: 13pt;
                width: 220px;
                height: 25px;

            }
            }
            .wrong {
                text-align: center;
                color: white;
                font-size: 14pt;
                background: #ff0000;
                width: 400px;
            }
        </style>

    </head>

    <body>
        <h2>Nuova Programmazione</h2>
        <form name="new_program" id="new_program" action="6_back.php" method="post">
            <table>
            <?php
            $conn = mysqli_connect('localhost','root','','palestra');
            if($conn==false){
                echo "<p style='wrong'>Errore durante il tentativo di connessione</p>";
                die();
            }

            $query="SELECT i.CodFisc
                    FROM istruttore AS i;";
            $result=mysqli_query($conn, $query);
            if($result==false){
                echo "<p class='wrong'>Errore: CodiFisc mancanti</p>";
                die();
            }
            echo "<tr><td class='blank1'>Codice Istruttore: </td>";
            echo "<td><select class='blank2' name='CodFisc'>";
            echo "<option value=''/>";
            while($row=mysqli_fetch_array($result)){
                $code = $row["CodFisc"];
                echo "<option value=$code>$code</option>";
            }
            echo "</select>";
            echo "</tr>";

            $query="SELECT C.CodC
                    FROM corsi AS C;";
            $result=mysqli_query($conn, $query);
            if($result==false){
                echo "<p class='wrong'>Errore: CodC mancanti</p>";
                die();
            }
            echo "<table>";
            echo "<tr><td class='blank1'>Codice del Corso: </td>";
            echo "<td><select class='blank2' name='CodC'>";
            echo "<option value=''/>";
            while($row=mysqli_fetch_array($result)){
                $code = $row["CodC"];
                echo "<option value=$code>$code</option>";
            }
            echo "</select>";

            mysqli_close($conn);

            ?>

            <tr>
                <td class="blank1">Giorno: </td>
                <td><select name="day" class="blank2">
                        <option value=""> </option>
                        <option value="Lunedi">Lunedì</option>
                        <option value="Martedi">Martedì</option>
                        <option value="Mercoledi">Mercoledì</option>
                        <option value="Giovedi">Giovedì</option>
                        <option value="Venerdi">Venerdì</option>
                        <option value="Sabato">Sabato</option>
                        <option value="Domenica">Domenica</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="blank1">Ora di Inizio:</td>
                <td >
                    <input style="font-size: 12pt;" type="time" id="starting_time" name="starting_time"/>
                </td>
            </tr>
            <tr>
                <td class="blank1">Durata:</td>
                <td >
                    <input type="number" class="blank2" id="duration" name="duration" min="1"/>

                </td>
            </tr>
            <tr>
                <td class="blank1">Sala:</td>
                <td >
                    <input type="text" class="blank2" id="room" name="room"/>
                </td>
            </tr>
            </table>
        <br>
            <input type="submit" style="font-size: 12pt;" id="done" value="Invia"/>
            <input type="reset" style="font-size: 12pt;" id="reset" value="Reset"/>



        </form>
    </body>


</html>