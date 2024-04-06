<?php
    session_start();
    include_once "../conexaoUPA.php";
    
	$nome=$_POST["nome"];
	$endereco=$_POST["endereco"];
	$numero=$_POST["numero"];
	$bairro=$_POST["bairro"];
	$cidade=$_POST["cidade"];
	$estado=$_POST["estado"];
	$crm=$_POST["crm"];
	$contato=$_POST["cont"];
	$especi=$_POST["espe"];
	$sexo=$_POST["sexo"];
	
	if($nome == "" || $estado == "" || $cidade == "" || $endereco == "" || $crm == "" || $sexo = "" || $bairro == "" || $numero == "" || $especi == "" || $contato == ""){
	    $_SESSION['msg'] = "Necessário preencher todos os campos!";
	    header("Location: medico.php");
	}else{
	    $usuario = mysqli_query($dbcon, "SELECT matricula FROM usuario WHERE matricula = $_SESSION[login]");
	    $usuariobd = mysqli_fetch_assoc($usuario);
	    
	    $sql=$dbcon->query("INSERT INTO endereco(numero, rua, bairro, cidade, estado) VALUES('$numero', '$endereco', '$bairro', '$cidade', '$estado')" );
	
	    if($sql){
	       $endereco = mysqli_query($dbcon, "SELECT cod_endereco FROM endereco WHERE numero = $numero");
	       $enderecobd = mysqli_fetch_assoc($endereco);
	       $ex = $enderecobd['cod_endereco'];
	       
	       $paciente = mysqli_query($dbcon, "SELECT crm FROM medico WHERE crm = $crm");
	       $resulcrm = mysqli_fetch_assoc($paciente);
	       if($resulcrm['crm'] == $crm){
	         $delete = mysqli_query($dbcon, "DELETE FROM endereco WHERE cod_endereco = $ex");
	         if($delete){
	           $_SESSION['msg'] = "CRM já cadastrado no sistema!";
	           header("Location: medico.php");
	         }
	       }else{
	         $sqldb=$dbcon->query("INSERT INTO medico(crm, nome, contato, especialidade, sexo, usuario_matricula, endereco_cod_endereco) VALUES('$crm', '$nome', '$contato', '$especi', '$sexo', '$usuariobd[matricula]', '$enderecobd[cod_endereco]')");
	       	       
	         if($sqldb){
	           $_SESSION['msgcad'] = "Cadastro efetuado com sucesso!";
	           header("Location: medico.php");
	         }else{
	           $_SESSION['msg'] = "Algo deu errado! Tente novamente! ";
	           header("Location: medico.php");
	         }
	       }
	    }else{
	       $_SESSION['msg'] = "Erro ao cadastrar médico! Verifique os dados e tente novamente! ";
	       header("Location: medico.php");
	    }
	}
?>