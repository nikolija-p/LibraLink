<?php
	include_once 'db.php';
	session_start();

	$TableName = $_GET["tab"];
	$key = $_GET["key"];
	$value = $_GET["value"];

	$i=0;
	$par = array();
	$sql = "SELECT * FROM ".$TableName." WHERE ".$key." = ".$value;
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$i=0;
			foreach ($row as $key => $value)
			{
				if($i!=0)
				{
					$par[$i]= $value;
				}
				$i++;
			}
		}
	}

?>

<html>

    <head>

    	<title>Izmena podataka</title>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <link rel="stylesheet" type="text/css" href="../css/style.css" />

		<script type="text/javascript">

		</script>

    </head>

    <body>

        <h1 align="center">Izmena podataka</h1>

        <div align="center" class="container">
            <form action="crud/update.php" method="POST">
                <div class="form-group">
                <table align="center">
					<?php
						$sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.columns WHERE TABLE_NAME = '".$TableName."' AND TABLE_SCHEMA = '".$database."'";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
							$i=0;
							while($row = $result->fetch_assoc())
							{
								if($i!=0)
								{
									?>
										<tr>
											<td>
												<b><?php echo $row["COLUMN_NAME"] ?>:</b>
											</td>
											<td>
												<input type="text" placeholder="" class="form-control" name="<?php echo $row["COLUMN_NAME"] ?>" value="<?php echo $par[$i] ?>" >
											</td>
										</tr>
									<?php
								}
								$i++;
							}
						}
					?>
					<tr>
						<td colspan="2">
							<input type="hidden" placeholder="" name="tab" value="<?php echo $_GET["tab"]; ?>" >
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="hidden" placeholder="" name="key" value="<?php echo $_GET["key"]; ?>" >
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="hidden" placeholder="" name="value" value="<?php echo $_GET["value"]; ?>" >
						</td>
					</tr>
					<tr>
                        <br/>
                        <td colspan="2" align="center">
                            <br/>
							<input type="submit" value="Sacuvaj" class="btn">
                        </td>
                    </tr>
				</table>
               </div>
            </form>
            <a href="index.php?tab=<?php echo $_GET["tab"]; ?>" class="btn-default">Nazad</a><br>
        </div>

    </body>

</html>
