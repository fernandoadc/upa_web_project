<?php
    session_start();
    include_once "../database.php";
	require 'PHPMailerAutoload.php';
	// No início do seu arquivo consultabd.php
	//include_once "mail.php";
	//if(isset($_POST['sendmail'])) {
	

	#function enviarEmailConsulta($emailMedico, $nomeMedico, $dadosConsulta) {
		//require 'credential.php';

	$mail = new PHPMailer;

	$mail->SMTPDebug = 3;                               // Enable verbose debug output

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'tinhofernando44@gmail.com';                 // SMTP username
	$mail->Password = 'xoeesraksrlagmzw';                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587; 
										// TCP port to connect to

	$mail->setFrom('tinhofernando44@gmail.com', 'Fernando Almeida');
	$mail->addAddress('inadiaalmeida10@gmail.com');     // Add a recipient

	#$mail->addReplyTo(EMAIL);
	// print_r($_FILES['file']); exit;
	#for ($i=0; $i < count($_FILES['file']['tmp_name']) ; $i++) { 
	#	$mail->addAttachment($_FILES['file']['tmp_name'][$i], $_FILES['file']['name'][$i]);    // Optional name
	#}
	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = 'subject';
	$mail->Body    = '<div style="border:2px solid red;">This is the HTML message body <b>in bold!</b></div>';
	#$mail->AltBody = 'message';

	$mail->send();
	if(!$mail->send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		echo 'Message has been sent';
	}
	#}


	###IR para Plano B (API)




    
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

			  // Após salvar a consulta no banco
			  $dadosConsulta = [
				'paciente' => $paciente,
				'data' => $data,
				'observacoes' => $desc,
			  ];
			  $emailMedico = "inadiaalmeida10@gmail.com";
			  $nomeMedico = "Inadia Almeida";

			  #enviarEmailConsulta($emailMedico, $nomeMedico, $dadosConsulta);


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