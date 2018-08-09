<?php
include_once ('../db.php');
	session_start();

	$TableName = $_POST["tab"];

	function VrednostKolone($vrednost, $tip) {
		if($tip=="int")
		{
			return $vrednost;
		}
		else if($tip=="varchar")
		{
			return "'".$vrednost."'";
		}
		else if($tip=="longtext")
		{
			return "'".$vrednost."'";
		}
		else if($tip=="datetime")
		{
			return "'".$vrednost."'";
		}
		else if($tip=="text")
		{
			return "'".$vrednost."'";
		}
		else
		{
			return "'".$vrednost."'";
		}
	}
?>

<html>

    <head>
    </head>

	<body>

		<?php

			$kolona="";
			$parametar="";

			$sql = "SELECT COLUMN_NAME, DATA_TYPE FROM INFORMATION_SCHEMA.columns WHERE TABLE_NAME = '".$TableName."' AND TABLE_SCHEMA = '".$database."'";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				$i=0;
				while($row = $result->fetch_assoc())
				{
					if($i!=0)
					{
						$kolona = $kolona.$row["COLUMN_NAME"];
						if ($result->num_rows != $i+1) {
							$kolona = $kolona.', ';
						}
						$parametar = $parametar.VrednostKolone($_POST[$row["COLUMN_NAME"]], $row["DATA_TYPE"]);
						if ($result->num_rows != $i+1) {
							$parametar = $parametar.', ';
						}
					}
					$i++;
				}
			}

			$query = "INSERT INTO ".$database.".".$TableName." (".$kolona.") VALUES (".$parametar.")";
			if ($conn->query($query) === TRUE) {
				//echo "Uspesan unos podataka"."<br>";
				//echo "<a href='index.php'>Nazad</a>";
				header('Location: ../index.php?tab='.$TableName.'');
			} else {
				echo "Error: ".$query."<br>".$conn->error."<br>";
				echo "<a href='../index.php'>Nazad</a>";
			}

		?>

	</body>

</html>
