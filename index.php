<?php
	include_once 'db.php';
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>LibraLink biblioteka</title>

	<script type="text/javascript"></script>
	<script src="src/js/tabela.js"></script>
	<?php if(isset($_GET["tab"]) && $_GET["tab"]!='') {
		?>
			<script type="text/javascript">
				Tabela('<?php echo $_GET["tab"]; ?>', 0, 0, 0);
			</script>
		<?php
	}
	?>

</head>

<body>
	<body class="fixed-nav sticky-footer bg-dark" id="page-top">
			<!-- Navigation-->
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
                    <h2>
					<a class="navbar-brand fa fa-book" href="index.php">Početna strana</a> </h2>
                    <img src="logo.png" alt="Slika nije ucitana" class="img-responsive" width="70" height="70">
					<a class="open-menu"><i class="fa fa-bars fa-lg" aria-hidden="true"></i></a>
					<div class="collapse navbar-collapse" id="navbarResponsive">
							<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
									<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components" align="center">
											<a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
													<i class="fa fa-database"></i>
													<span class="nav-link-text"><?php echo $database; ?></span>
											</a>
											<ul class="sidenav-second-level collapse show" id="collapseComponents">
											</ul>
									</li>
									<?php
	$sql = "SELECT DISTINCT TABLE_NAME FROM INFORMATION_SCHEMA.columns WHERE TABLE_SCHEMA = '".$database."' order BY TABLE_NAME";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
		echo '<tr>';
		echo '<td>';
			?>
				<button class="btn btn-primary" onclick="Tabela('<?php echo $row["TABLE_NAME"]; ?>', 0, 0, 1);" ><?php echo $row["TABLE_NAME"]; ?></button>
			<?php
		echo '</td>';
		echo '</tr>';
		}
	}
?>
							</ul>
							<ul class="navbar-nav sidenav-toggler">
									<li class="nav-item">
											<a class="nav-link text-center" id="sidenavToggler">
													<i class="fa fa-fw fa-angle-left"></i>
											</a>
									</li>
							</ul>
					</div>
			</nav>
			<div class="content-wrapper">
					<div class="container-fluid">
							<div class="row">
									<div class="container">
											<div class="result float-left"></div>
											<div id="" class="action-buttons float-right margin-b-20">
												<!--	<button type="button" class="btn btn-success insert-open-modal" data-toggle="modal" data-target="#myModal">Insert</button> -->
											</div>
											<table class="table table-bordered table-hover">
													<thead id="thead">
															<tr>
															</tr>
													</thead>
													<tbody id="tbody">

													</tbody>
											</table>
											<div class="col-sm-9">

												<div id="mojdivtabela"></div>

											</div>
									</div>


							</div>
					</div>
					<!-- /.container-fluid-->
					<!-- /.content-wrapper-->
					<footer class="sticky-footer">
							<div class="container">
									<div class="text-center">
											<small>Footer</small>
									</div>
							</div>
					</footer>
					<!-- Scroll to Top Button-->
					<a class="scroll-to-top rounded" href="#page-top">
							<i class="fa fa-angle-up"></i>
					</a>
			</div>
			<!-- Modal -->
			<div id="myModal" class="modal fade" role="dialog">
					<div class="modal-dialog">
							<div class="modal-content">
									<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
									</div>
									<div class="modal-body insert-org">
									</div>
									<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
							</div>
					</div>
			</div>

			<!-- Bootstrap core JavaScript-->
			<link href="src/css/sb-admin.css" rel="stylesheet">
			<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
			<link href="src/css/style.css" rel="stylesheet">
			<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
			<script src="vendor/jquery/jquery.min.js"></script>
			<script src="vendor/popper/popper.min.js"></script>
			<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
			<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
			<script src="src/js/sb-admin.min.js"></script>
			<script src="src/js/jquery-1.9.1.js"></script>
			<script src="src/js/jquery-ui-1.9.2.min.js"></script>
			<script src="src/js/jquery.form.js"></script>
			<script src="src/js/main.js" rel="stylesheet"></script>




  </body>
</html>
