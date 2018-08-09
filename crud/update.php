<?php
include_once ("../db.php");
	session_start();

	$TableName = $_POST["tab"];
	$key = $_POST["key"];
	$value = $_POST["value"];

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

			$vrednost="";
			$parametar="";

			$sql = "SELECT COLUMN_NAME, DATA_TYPE FROM INFORMATION_SCHEMA.columns WHERE TABLE_NAME = '".$TableName."' AND TABLE_SCHEMA = '".$database."'";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				$i=0;
				while($row = $result->fetch_assoc())
				{
					if($i!=0)
					{
						$vrednost = $vrednost.$row["COLUMN_NAME"].'='.VrednostKolone($_POST[$row["COLUMN_NAME"]], $row["DATA_TYPE"]);
						if ($result->num_rows != $i+1) {
							$vrednost = $vrednost.', ';
						}
					}
					$i++;
				}
			}

			$query = "UPDATE ".$database.".".$TableName." SET ".$vrednost." WHERE ".$key." = ".$value;
			if ($conn->query($query) === TRUE) {
				//echo "Uspesno editovanje podataka"."<br>";
				//echo "<a href='index.php'>Nazad</a>";
				header('Location: ../index.php?tab='.$TableName.'');
			} else {
				echo "Error: ".$query."<br>".$conn->error."<br>";
				echo "<a href='index.php'>Nazad</a>";
			}

		?>

	</body>

</html>
