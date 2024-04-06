<?php
    session_start();
    include_once "../conexaoUPA.php";
    
	$paciente=$_POST["nome"];
	$sus=$_POST["sus"];
	$desc=$_POST["desc"];
	$medico=$_POST["medico"];
	$crm=$_POST["crm"];
	$data=$_POST["data"];
	
	if($paciente == "" || $sus == "" || $medico == "" || $data == "" || $crm == "" || $desc == ""){
	    $_SESSION['msg'] = "Necessário preencher todos os campos!";
	    header("Location: consulta.php");
	}else{
	    $paci = mysqli_query($dbcon, "SELECT cartao_sus, nome FROM paciente WHERE cartao_sus = $sus");
	    $pacibd = mysqli_fetch_assoc($paci);
	    
	    if(($pacibd['cartao_sus'] == $sus) /* ($pacibd['nome'] == $paciente)*/){
	      //echo ($pacibd['nome']);
	      //echo ($pacibd['cartao_sus']);
	      
	      $medi = mysqli_query($dbcon, "SELECT crm, nome FROM medico WHERE crm = $crm");
	      $medibd = mysqli_fetch_assoc($medi);
	      
	      if($medibd['crm'] == $crm){
	        $sql=$dbcon->query("INSERT INTO consulta(descricao, data, paciente_cartao_sus, medico_crm) VALUES('$desc', '$data', '$sus', '$crm')" );
	        if($sql){    	       
	          $_SESSION['msgcad'] = "Consulta cadastrada com sucesso!";
	          header("Location: consulta.php");
	        }else{
	          $_SESSION['msg'] = "Erro ao cadastrar usuário! Verifique seus dados e tente novamente! ";
	          header("Location: consulta.php");
	        }
	      }else{
	        $_SESSION['msg'] = "Médico não cadastrado no sistema! ";
	        header("Location: consulta.php");
	      }
	   }else{
	      $_SESSION['msg'] = "Paciente não cadastrado no sistema!";
	      header("Location: consulta.php");
	   }
	}
?>