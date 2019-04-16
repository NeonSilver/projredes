<?php 
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "projeto_t2";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	mysqli_set_charset($conn,"utf8"); //para carregar correctamente os caracteres especiais (ex: éã)
	// Check connection
	if (!$conn) 
		{
    	die("Connection failed: " . mysqli_connect_error());
		};		
?>