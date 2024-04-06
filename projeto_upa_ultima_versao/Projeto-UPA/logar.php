<?php
    session_start();
    include_once "conexaoUPA.php";
    
	$login = $_POST["login"];
	$senha = $_POST["senha"];
	
	if($login == "" || $senha == ""){
	  $_SESSION['msg'] = "Campos em branco!";
	  header("Location: index.php");
	}
    else{
    	//checa se existe parametro passado no campo matricula
    	if (isset($login)) {
    		$mat = '';//retornar matricula do BD
    		$pass = '';//retornar senha do BD
    		$sql = 'SELECT matricula FROM usuario WHERE matricula='.$login.''; 
    		$resul_user_bd = $dbcon->query($sql);

    	    //tratamento do resultado da busca
    		if ($resul_user_bd->num_rows > 0) {
			    while($row = $resul_user_bd->fetch_assoc()) {
			        $mat.= $row["matricula"];
			    }
			}else{
				$_SESSION['msg'] = "Usuário não encontrado!";
				header("Location: index.php");
			}

			//se existir a matricula no sistema e se houver uma senha passado via formulario
    		if (isset($resul_user_bd) && isset($senha)) {
    			// buscar string senha
    			$sql = 'SELECT senha FROM usuario WHERE matricula='.$mat.'';
    			$resultado_senha_bd = $dbcon->query($sql);

    			//armazena a senha resultante na variavel $pass
    			if($resultado_senha_bd->num_rows > 0){
			       while($row = $resultado_senha_bd->fetch_assoc()) {
			    	//echo $row["senha"];
			        $pass= $row["senha"];
			       }
				}

    			//desencriptacao da senha retornada do BD
    			$senha_decode = base64_decode($pass);

    			//comparacao as duas senhas
	    			if ($senha==$senha_decode){
	    				$_SESSION['login'] = $login;
	    				$_SESSION['senha'] = $senha;
	    				echo "<script>location.href='_admin/administrativo.php'</script>";
	    			}else{
	    			    $_SESSION['msg'] = "Usuário ou Senha não correspondem!";
	    			    header("Location: index.php");
	    			}
    		}else{
    			echo "Usuário não existe";
    		}
	
    	}

/*
        $bdbusca=$dbcon->query("SELECT senha FROM usuario WHERE matricula='$login'");
        $senha = base64_decode($bdbusca);
	    $sql=$dbcon->query("SELECT * FROM  usuario WHERE matricula='$login' and senha='$senha'");
	
	    if(mysqli_num_rows($sql)>0){
	      //if(Bcrypt::check($senha, $sql)){
		   $_SESSION["login"]=$login;
		   $_SESSION["senha"]=$senha;
		   echo "<script>location.href='cadastroPac1.php'</script>";
		  //}
	    }else{
		  $_SESSION['msg'] = "Usuário ou senha não correspondem!";
		  header("Location: index.php");
	    }
	    */
    }
?>