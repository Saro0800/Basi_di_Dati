<html>
	<head>
		<title>Risultato Form 2</title>
	</head>
	
	<body>
		<h3>Risultato della ricerca</h3>
		<?php 
			//controllo che il campo venga riempito
			if(!isset($_REQUEST["cod"]) || trim($_REQUEST["cod"])==''){
				echo '<font color="red"><h3>Codice non inserito</h3>';
				exit;
			}
			
			//acquisisco il valore
			$cod = $_REQUEST["cod"];
			//nome del DB
			$dbname = 'palestra';
			//creo la connesione
			$connection = mysqli_connect('localhost','root','',$dbname);
			
			//controllo che la connessione sia avvenuta con successo
			if($connection == FALSE){
				echo '<font color="red"><h3>Impossibile contattare il server $dbname</h3>';
				exit;
			}
			
			//query
			$query = "	SELECT *
						FROM corsi
						WHERE CodC = '$cod';";
			//esecuzione della query
			$result = mysqli_query($connection, $query);	
			if($result == false)
				die("Errore nell'esecuzione della query: " .mysqli_error($connection));
			
			//controllo se la query ha prodotto un risultato non vuoto
			if(mysqli_num_rows($result)<=0)
				die("La query non ha prodotto nessun risultato");
			
			echo '<table border="2">';
			echo '<tr>';
			//stampa della riga di intestazione
			for($i=0 ; $i<mysqli_num_fields($result) ; $i++){
				$attribute = mysqli_fetch_field($result);
				$attribute_name = $attribute->name;
				echo "<th> $attribute_name </td>";
			}
			echo '</tr>';
			//stampa del risultato
			while($row = mysqli_fetch_row($result)){
				echo '<tr>';
				for($i=0 ; $i<mysqli_num_fields($result) ; $i++)
					echo "<td width='170' align='center'> $row[$i] </td>";
				echo '</tr>';
			}
			echo '</table>';
			mysqli_close($connection);
		?>
	</body>
</html>
