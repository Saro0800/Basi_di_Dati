<html>
<head>
    <title>Nuovo Ciclista</title>
    <style type="text/css">
        .tasto{
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 16px 32px;
            text-decoration: none;
            margin: 4px 2px;
            cursor: pointer;
        }
        .sfondo{
            background: lightgrey;
            width: 400px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body>
<br/>
<h2 style="text-align: center;">Inserisci Ciclista</h2>
<br/>
<form name="search_rider" id="search_rider" action="2a_Back.php" method="GET"  class="sfondo">
    <table style="text-align: center; font-size: 20px" align="center" >
        <tr><td>Codice Ciclista</td></tr>
        <tr><td><input type="text" name="codc" style="width: 390px; height: 25px;"></td></tr>

        <tr><td>Nome Ciclista</td></tr>
        <tr><td><input type="text" name="namec" style="width: 390px; height: 25px;"></td></tr>

        <tr><td>Cognome Ciclista</td></tr>
        <tr><td><input type="text" name="cognomec" style="width: 390px; height: 25px;"></td></tr>

        <tr><td>Nazionalità Ciclista</td></tr>
        <tr><td><input type="text" name="nazionalitàc" style="width: 390px; height: 25px;"></td></tr>

        <tr><td>Codice Squadra</td></tr>
        <tr><td><select name="cods" id="cods" style="width: 390px; height: 25px;">
                    <option value=""/>
                    <?php
                    $conn = mysqli_connect('localhost','root','','campionato');
                    $query = "  SELECT CodS, NomeS
                                    FROM squadra 
                                    ORDER BY CodS;  ";
                    $result = mysqli_query($conn, $query);
                    if($result==false)
                        die(mysqli_errno($conn));

                    while($row = mysqli_fetch_array($result)){
                        $code = $row["CodS"];
                        $name = $row["NomeS"];

                        echo "<option value='$code'>$code - $name</option>";
                    }
                    ?>
                </select></td></tr>
        <tr><td>Anno di nascita</td></tr>
        <tr><td>
                <input type="number" name="anno_nascita" min=1900 max=2000 style="width: 390px; height: 25px;"/>
            </td></tr>
    </table>
    <br/><br/><br/>
    <center><input class="tasto" type="submit" value="Invia"/>
        <input class="tasto" type="reset" value="Reset">
    </center>

</form>

<br/><br/>
<h2 style="text-align: center;">Inserisci Posizione in Classifica</h2>
<br/>
<form name="set_position" id="set_position" action="2b_Back.php" method="GET"  class="sfondo">
    <table style="text-align: center; font-size: 20px" align="center" >
        <tr><td>Codice Ciclista</td></tr>
        <tr><td><select name="codc" id="codc" style="width: 390px; height: 25px;">
                    <option value=""/>
                    <?php
                    $conn = mysqli_connect('localhost','root','','campionato');
                    $query = "  SELECT CodC, Nome, Cognome
                                    FROM ciclista 
                                    ORDER BY CodC;  ";
                    $result = mysqli_query($conn, $query);
                    if($result==false)
                        die(mysqli_errno($conn));

                    while($row = mysqli_fetch_array($result)){
                        $code = $row["CodC"];
                        $name = $row["Nome"];
                        $cognome = $row["Cognome"];
                        echo "<option value='$code'>$code - $name $cognome</option>";
                    }
                    ?>
                </select></td></tr>

        <tr><td>Codice Tappa</td></tr>
        <tr><td><select name="codt" id="codt" style="width: 390px; height: 25px;">
                    <option value=""/>
                    <?php
                    $conn = mysqli_connect('localhost','root','','campionato');
                    $query = "  SELECT CodT, CittaPartenza, CittaArrivo
                                FROM tappa 
                                ORDER BY CodT;  ";
                    $result = mysqli_query($conn, $query);
                    if($result==false)
                        die(mysqli_errno($conn));

                    while($row = mysqli_fetch_array($result)){
                        $code = $row["CodT"];
                        $cp = $row["CittaPartenza"];
                        $ca = $row["CittaArrivo"];

                        echo "<option value='$code'>$code - $cp $ca</option>";
                    }
                    ?>
                </select></td></tr>
        <tr><td>Edizione</td></tr>
        <tr><td><select name="edizione" id="edizione" style="width: 390px; height: 25px;">
                    <option value=""/>
                    <?php
                    $conn = mysqli_connect('localhost','root','','campionato');
                    $query = "  SELECT DISTINCT Edizione
                                    FROM tappa 
                                    ORDER BY Edizione;  ";
                    $result = mysqli_query($conn, $query);
                    if($result==false)
                        die(mysqli_errno($conn));

                    while($row = mysqli_fetch_array($result)){
                        $Edizione = $row["Edizione"];
                        echo "<option value='$Edizione'>Edizione: $Edizione</option>";
                    }
                    ?>
                </select></td></tr>
        <tr><td>Posizione Ciclista</td></tr>
        <tr><td>
                <input type="number" name="pos" min=1 style="width: 390px; height: 25px;"/>
            </td></tr>
    </table>
    <br/><br/><br/>
    <center><input class="tasto" type="submit" value="Invia"/>
        <input class="tasto" type="reset" value="Reset">
    </center>

</form>
</body>
</html>
