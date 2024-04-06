<?php
    session_start();
    include_once "conexaoUPA.php";
    
	$nome=$_POST["nome"];
	$email=$_POST["email"];
	$senha=$_POST["senha"];
	$matricula=$_POST["matricula"];
	$contato=$_POST["contato"];
	$conf=$_POST["senhac"];
	
	if($nome == "" || $email == "" || $senha == "" || $matricula == "" || $contato == "" || $conf == ""){
	    $_SESSION['msg'] = "Necessário preencher todos os campos!";
	    header("Location: cadastro.php");
	}elseif($senha != $conf){
	    $_SESSION['msg'] = "As senhas não correspondem!";
	    header("Location: cadastro.php");
	}elseif((strlen($senha)) < 6){
	    $_SESSION['msg'] = "A senha deve ter no mínimo 6 caracteres!";
	    header("Location: cadastro.php");
	}elseif((strlen($senha)) > 12){
	    $_SESSION['msg'] = "A senha deve ter no máximo 12 caracteres!";
	    header("Location: cadastro.php");
	}
	else{
	    $senha = base64_encode($senha);
	    $sql=$dbcon->query("INSERT INTO usuario(matricula, nome, email, contato, senha) VALUES('$matricula', '$nome', '$email', '$contato', '$senha')" );
	
	    if($sql){	       
	       $_SESSION['msgcad'] = "Cadastro efetuado com sucesso!";
	       header("Location: index.php");
	    }else{
	       $_SESSION['msg'] = "Erro ao cadastrar usuário! Verifique seus dados e tente novamente! ";
	       header("Location: cadastro.php");
	    }
	}
?>