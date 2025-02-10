<?php
	$host = "localhost";
	$usuario = "phpmyadmin";
	$senha = "390.Pico";	
	$banco = "db_upa";

	try {
		$dbcon = new MySQLi("$host", "$usuario", "$senha", "$banco");

			if($dbcon->connect_error)
			{
				echo "<script>alert('ERRO DE CONEXAO!'); history.back();</script>";
			}
		
	} catch (Exception $e) {
		echo "errrrroo";
	}
	
?>