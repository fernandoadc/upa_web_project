<?php
    session_start();
    include_once "../conexaoUPA.php";
    
	$nome=$_POST["nome"];
	$endereco=$_POST["endereco"];
	$numero=$_POST["numero"];
	$bairro=$_POST["bairro"];
	$cidade=$_POST["cidade"];
	$estado=$_POST["estado"];
	$nascimento=$_POST["nasc"];
	$idade=$_POST["idade"];
	$rg=$_POST["rg"];
	$sus=$_POST["sus"];
	$contato=$_POST["cont"];
	$mae=$_POST["mae"];
	$sexo=$_POST["sexo"];
	
	if($nome == "" || $cidade == "" || $endereco == "" || $mae == "" || $sexo = "" || $bairro == "" || $numero == "" || $nascimento == "" || $idade == "" || $rg == "" || $sus == "" || $contato == ""){
	    $_SESSION['msg'] = "Necessário preencher todos os campos!";
	    header("Location: paciente.php");
	}else{
	    $usuario = mysqli_query($dbcon, "SELECT matricula FROM usuario WHERE matricula = $_SESSION[login]");
	    $usuariobd = mysqli_fetch_assoc($usuario);
	    
	    $sql=$dbcon->query("INSERT INTO endereco(numero, rua, bairro, cidade, estado) VALUES('$numero', '$endereco', '$bairro', '$cidade', '$estado')" );
	    
	    if($sql){
	       $endereco = mysqli_query($dbcon, "SELECT cod_endereco FROM endereco WHERE numero = $numero");
	       $enderecobd = mysqli_fetch_assoc($endereco);
	       $ex = $enderecobd['cod_endereco'];
	       
	       $paciente = mysqli_query($dbcon, "SELECT cartao_sus FROM paciente WHERE cartao_sus = $sus");
	       $resulsus = mysqli_fetch_assoc($paciente);
	       
	       if($resulsus['cartao_sus'] == $sus){
	          $delete = mysqli_query($dbcon, "DELETE FROM endereco WHERE cod_endereco = $ex");
	          if($delete){
	            $_SESSION['msg'] = "Cartão sus já cadastrado no sistema!!";
	            header("Location: paciente.php");
	          }
	       }else{
	          $sqldb=$dbcon->query("INSERT INTO paciente(cartao_sus, nome, idade, nascimento, sexo, rg, contato, mae, usuario_matricula, endereco_cod_endereco) VALUES('$sus', '$nome', '$idade', '$nascimento', '$sexo', '$rg', '$contato', '$mae', '$usuariobd[matricula]', '$enderecobd[cod_endereco]')");
	       	       
	          if($sqldb){
	            $_SESSION['msgcad'] = "Cadastro efetuado com sucesso!";
	            header("Location: paciente.php");
	          }else{
	            $_SESSION['msg'] = "Algo deu errado! Tente novamente!";
	            header("Location: paciente.php");
	          }
	       }
	     }else{
	       $_SESSION['msg'] = "Algo deu errado! Tente novamente! ";
	       header("Location: paciente.php");
	     }
	}
?>