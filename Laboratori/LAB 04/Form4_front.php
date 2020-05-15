<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form4</title>
</head>
<body>
    <h3>Ricerca attività</h3>
    <form action="Form4_back.php" method="get">
        <table border="0" width="300px">
            <tr>
                <td >Cognome:</td>
                <td>
                    <select id="cognome" name="cognome" style="width:170px">
                        <option value="" >Inserisci cognome</option>
                        <?php
                        //stabilisco la connessione
                        $dbname = 'palestra';
                        $conn = mysqli_connect('localhost','root','',$dbname);

                        //controllo che la connessione sia avvenuta con successo
                        if(!$conn)
                            die('Connection error: '.mysqli_error($conn));

                        $query='SELECT distinct Cognome
                                FROM ISTRUTTORE ;';
                        $result=mysqli_query($conn, $query);
                        if(!$result)
                            die('Query error: '.mysqli_error($conn));

                        if(mysqli_num_rows($result)>0)
                            while($row = mysqli_fetch_array($result)){
                                $cogn = $row["Cognome"];
                                echo "<option value='$cogn'>$cogn</option>";
                            }
                        mysqli_close($conn);
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Giorno:</td>
                <td>
                    <select id="giorno" name="giorno" style="width:170px">
                        <option value="">Inserisci giorno</option>
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
        </table>
        <br/>
        <input type="submit" value="Cerca">
        <input type="reset" value="Reset">

    </form>



</body>
</html>