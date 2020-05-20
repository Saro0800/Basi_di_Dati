<html>
    <head>
        <title>Posizione Ciclista in Tappa</title>
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
        <h2 style="text-align: center;">Posizione Ciclista in Tappa</h2>
        <br/>
        <form name="search_rider" id="search_rider" action="1_back.php" method="GET"  class="sfondo">
            <table style="text-align: center; font-size: 20px" align="center" >
                <tr><td>Codice Ciclista</td></tr>
                <tr><td><select name="CodC" id="Codc" style="width: 390px; height: 25px;">
                        <option value=""/>
                        <?php
                        $conn = mysqli_connect('localhost','root','','campionato');
                        $query = "  SELECT CodC, Nome, Cognome
                                    FROM ciclista 
                                    ORDER BY CodC;";
                        $result = mysqli_query($conn, $query);
                        if($result==false)
                            die(mysqli_errno($conn));

                        while($row = mysqli_fetch_array($result)){
                            $code = $row["CodC"];
                            $name = $row["Nome"];
                            $surn = $row["Cognome"];

                            echo "<option value='$code'>$code - $name $surn</option>";
                        }
                        ?>
                    </select></td></tr>
                <tr><td>Codice Tappa</td></tr>
                <tr><td>
                        <input type="number" name="CodT" style="width: 390px; height: 25px;"/>
                    </td></tr>
            </table>
            <br/><br/><br/>
            <center><input class="tasto" type="submit" value="Invia"/>
                    <input class="tasto" type="reset" value="Reset">
            </center>

        </form>


    </body>

</html>
