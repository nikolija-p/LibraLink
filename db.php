<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "biblioteka";
	$conn = new mysqli($servername,$username,$password,$database);
	if ($conn->connect_error) {
		die("Problemi sa konektovanjem u bazu");
	}


?>
