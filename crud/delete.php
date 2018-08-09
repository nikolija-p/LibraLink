<?php
	include_once ('../db.php');
	session_start();

	$TableName = $_GET["tab"];
	$key = $_GET["key"];
	$value = $_GET["value"];
?>

<html>

    <head>
    </head>

	<body>

		<?php

		$query = "DELETE FROM ".$database.".".$TableName." WHERE ".$key." = ".$value;
			if ($conn->query($query) === TRUE) {
				//echo "Uspesno brisanje podatka"."<br>";
				//echo "<a href='index.php'>Nazad</a>";
				header('Location: ../index.php?tab='.$TableName.'');
			} else {
				echo "Error: ".$query."<br>".$conn->error."<br>";
				echo "<a href='../index.php'>Nazad</a>";
			}

		?>

	</body>

</html>
