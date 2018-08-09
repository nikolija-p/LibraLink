			<?php
				include_once 'db.php';
				session_start();

				$TableName = $_POST['tablename'];
				$pageNumber = ($_POST['page']);
				if(isset($UkupnoSlogova) && $UkupnoSlogova!='')//slogova u tabeli
				{
					$UkupnoSlogova = 0;
				}
				if(isset($_POST["search"]) && $_POST["search"]!='')//ako je setovana pretraga
				{
					$search = ($_POST['search']);//rec za pretragu
					$column = ($_POST['column']);//kolona za pretragu
				}else{
					$search = "";
					$column = "";
				}
				$sqlPretraga='';
				$PaginacijaKoraci=3;
			?>


			KOLONE
			<table class="table table-hover table-bordered">
				<thead>
					<?php
						if($TableName!="")	{
							$sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.columns WHERE TABLE_NAME = '".$TableName."' AND TABLE_SCHEMA = '".$database."'";
							$result = $conn->query($sql);

							if ($result->num_rows > 0) {
								echo '<tr>';
								$i=0;
								while($row = $result->fetch_assoc())
								{
									if($i== 0)
									{
										echo '<th>';
										echo 'Change';
										echo '</th>';
									}else{
										foreach ($row as $key => $value)
										{
											echo '<th>';
											echo $value;
											echo '</th>';
										}
									}
									$i++;
								}
								echo '</tr>';
							}
						}
					?>
				</thead>
				<tbody>
					<?php

						if($TableName!="")	{
							if(isset($_POST["search"]) && $_POST["search"]!='')
							{

								$sqlPretraga = $column.' Like '."'%".$search."%'";//ovo je postavljeno umesto gore komentarisanog
																				  //pretraga samo odabrane kolone
								$sql = "SELECT * FROM ".$database.".".$TableName." WHERE ".$sqlPretraga." LIMIT ".$pageNumber.", ".$PaginacijaKoraci."";
							}
							else
							{
								$sql = "SELECT * FROM ".$database.".".$TableName." LIMIT ".$pageNumber.", ".$PaginacijaKoraci."";
							}
							$result = $conn->query($sql);

							if($sqlPretraga==''){
								$sqltotal = "SELECT * FROM ".$database.".".$TableName."";
							}else{
								$sqltotal = "SELECT * FROM ".$database.".".$TableName." WHERE ".$sqlPretraga."";
							}
							$resulttotal = $conn->query($sqltotal);
							$UkupnoSlogova = $resulttotal->num_rows;

							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc())
								{
									echo '<tr>';
									$i=0;
									foreach ($row as $key => $value)
									{
										if($i==0)
										{
											echo '<td>';
											?>
												<button type="button" class="btn btn-primary" name="button"> <a style="color: white;" href="uForm.php?tab=<?php echo $TableName; ?>&key=<?php echo $key; ?>&value=<?php echo $value; ?>">Update</a></button><br>
												<button type="button" class="btn btn-danger" name="button"><a  style="color: white;" href="crud/delete.php?tab=<?php echo $TableName; ?>&key=<?php echo $key; ?>&value=<?php echo $value; ?>" OnClick="return confirm('Jeste li sigurni?');">Delete</a></button>
											<?php
											echo '</td>';
										}
										else
										{
											echo '<td>';
											echo $value;
											echo '</td>';
										}
										$i++;
									}
									echo '</tr>';
								}
							}
						}
					?>
				</tbody>
			</table>

			<input type="text" placeholder="pretraziti..." id="Pretraga" value="<?php echo $search; ?>">
			<select id="cmbMake" name="Make" >
					<?php
						//popunjavanje combobox kontrole
						//hteo sam da se vide sva polja u ovoj kontroli, pa cak i id kolona, po kojoj takodje moze da se vrsi pretraga, ali ne i update i insert
						if($TableName!="")	{
							$sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.columns WHERE TABLE_NAME = '".$TableName."' AND TABLE_SCHEMA = '".$database."'";
							$result = $conn->query($sql);

							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc())
								{
									foreach ($row as $key => $value)
									{
										if($column == $value) {
											echo '<option selected="selected">'.$value.'</option>';
										}
										else
										{
											echo '<option>'.$value.'</option>';
										}
									}
								}
							}
						}
					?>
			</select>
			<button   class="btn btn-basic"  onclick="Tabela('<?php echo $TableName; ?>', 0, 0, 0);" >Search</button>
			<br>
			<br>

			<nav aria-label="Page navigation example">
			  <ul class="pagination">
				<li class="page-item">
				  <a class="page-link" onclick="Tabela('<?php echo $TableName; ?>', <?php echo $pageNumber-$PaginacijaKoraci;  ?>, <?php echo $UkupnoSlogova; ?>, 0);" href="#" aria-label="Previous">
					<span aria-hidden="true">&lt;</span>
					<span class="sr-only">Previous</span>
				  </a>
				</li>
				<li class="page-item">
				  <a class="page-link" onclick="Tabela('<?php echo $TableName; ?>', <?php echo $pageNumber+$PaginacijaKoraci; ?>, <?php echo $UkupnoSlogova; ?>, 0);" href="#" aria-label="Next">
					<span aria-hidden="true">&gt;</span>
					<span class="sr-only">Next</span>
				  </a>
				</li>
			  </ul>
			</nav>

				<button type="button" class="btn btn-warning" name="button"><a style="color: white;" href="iForm.php?tab=<?php echo $TableName; ?>">Insert new data</a></button>
				<!-- <button type="button" class="btn btn-info" name="button"><a style="color: white;" href="index.php" onclick="PonistiPretragu()">Refresh</a></button> -->
