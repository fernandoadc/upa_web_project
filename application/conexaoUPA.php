<?php
	$host = "localhost";
	$usuario = "root";
	$senha = "";	
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