<?php
	include_once 'db.php';
	session_start();

	$TableName = $_GET['tab'];
?>

<html>

    <head>

    	<title>Insertuj podatke</title>
        
        <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



		<script type="text/javascript">

		</script>

    </head>

    <body>

        <h1 align="center">Insertuj podatke</h1>

        <div align="center" class="container">
            <form action="crud/insert.php" method="POST">
                <div  class="form-group">
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
												<input type="text" class="form-control" placeholder="" name="<?php echo $row["COLUMN_NAME"] ?>" value="" >
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
                        <td colspan="2" align="center">
                            <br/>
							<input type="submit" value="Sacuvaj" class="btn">
                        </td>
                    </tr>
				</table>
                </div>
            </form>
            <button class="btn-default" type="button">
            <a href="index.php?tab=<?php echo $_GET["tab"]; ?>">Nazad</a>
            </button>
            <br>
        </div>

    </body>

</html>
