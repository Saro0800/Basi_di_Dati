<html>
	<head>
		<title>Form 3</title>
	</head>

	<body>
		<h3>Ricerca Corso</h3>
		<br/>
		<form method="get" action="form2.php">
			<table border="0">
			<tr> 
				<td size="14">Seleziona un corso: </td>
				<td>
					<select id='cod' name='cod'>
					<option value=''> </option>
					<?php 
						$dbname = 'palestra';
						$conn = mysqli_connect('localhost','root','',$dbname);
						
						if($conn == false)
							die("Errore di connessione: ".mysqli_err($conn));
							
						$query = "	SELECT CodC
									FROM CORSI ;";
						$result = mysqli_query($conn, $query);
						
						if($query == false)
							die("Errore nell'esecuzione della query: " .mysqli_error($conn));
						if(mysqli_num_rows($result) > 0){
							while($row = mysqli_fetch_array($result)){
								$code = $row["CodC"];
								echo "<option value='$code'> $code </option>";
							}
						}
						else
							echo "<font color='red'><h3> Query vuota</h3>";
						//mysqli_close($conn);
					?>
					</select>
				</td>
				
			</tr>
		</table>
		<br/>
		<input type="submit" name="done_button" size="14" value="Cerca"/>
		</form>
	</body>

</html>