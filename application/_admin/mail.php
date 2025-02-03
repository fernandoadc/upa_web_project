//<?php
//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;

// Inclua o autoloader do Composer
/*require 'vendor/autoload.php';

function enviarEmailConsulta($emailMedico, $nomeMedico, $dadosConsulta) {
    $mail = new PHPMailer(true);

    try {
        // Configurações do servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Alterar para o servidor de email usado
        $mail->SMTPAuth = true;
        $mail->Username = 'tinhofernando44@gmail.com'; // Seu email
        $mail->Password = '390.pico'; // Sua senha ou senha de aplicativo
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->SMTPDebug = 2; // Ativar depuração para mensagens detalhadas

        // Configuração do remetente
        $mail->setFrom('tinhofernando44@gmail.com', 'Sistema UPA Santarém');
        $mail->addAddress($emailMedico, $nomeMedico); // Email e nome do destinatário

        // Conteúdo do email
        $mail->isHTML(true);
        $mail->Subject = 'Nova Consulta Agendada';
        $mail->Body = "
            <h1>Detalhes da Nova Consulta</h1>
            <p><strong>Paciente:</strong> {$dadosConsulta['paciente']}</p>
            <p><strong>Data:</strong> {$dadosConsulta['data']}</p>
            <p><strong>Observações:</strong> {$dadosConsulta['observacoes']}</p>
        ";
        // Enviar email
        $mail->send();
        echo "Email enviado com sucesso!";
    } catch (Exception $e) {
        echo "Erro ao enviar o email: {$mail->ErrorInfo}";
    }
}
*/

<?php 
		if(isset($_POST['sendmail'])) {
			require 'PHPMailerAutoload.php';
			//require 'credential.php';

			$mail = new PHPMailer;

			// $mail->SMTPDebug = 4;                               // Enable verbose debug output

			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = EMAIL;                 // SMTP username
			$mail->Password = PASS;                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587; 
                                               // TCP port to connect to

			$mail->setFrom(EMAIL, 'Dsmart Tutorials');
			$mail->addAddress($_POST['email']);     // Add a recipient

			$mail->addReplyTo(EMAIL);
			// print_r($_FILES['file']); exit;
			for ($i=0; $i < count($_FILES['file']['tmp_name']) ; $i++) { 
				$mail->addAttachment($_FILES['file']['tmp_name'][$i], $_FILES['file']['name'][$i]);    // Optional name
			}
			$mail->isHTML(true);                                  // Set email format to HTML

			$mail->Subject = $_POST['subject'];
			$mail->Body    = '<div style="border:2px solid red;">This is the HTML message body <b>in bold!</b></div>';
			$mail->AltBody = $_POST['message'];

			if(!$mail->send()) {
			    echo 'Message could not be sent.';
			    echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
			    echo 'Message has been sent';
			}
		}
	 ?>