<?php
    session_start();
    include_once '../conexaoUPA.php'; // Inclui a conexão com o banco
    
    // Configura o cabeçalho da resposta
    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        //var_dump($data); // Verifica o JSON recebido
    
        $matricula = $data['matricula'] ?? '';
        $senha = $data['senha'] ?? '';
        #var_dump($matricula, $senha); 
    
        if (!empty($matricula)  && !empty($senha)) {
            // Consulta o usuário pelo número de matrícula
            $mat = '';
            $query = $dbcon->prepare("SELECT matricula FROM usuario WHERE matricula = ?");
            $query->bind_param("s", $matricula);
            $query->execute();
            $resul_user_bd = $query->get_result();
    
            if ($resul_user_bd->num_rows > 0) {
                while($row = $resul_user_bd->fetch_assoc()) {
			        $mat.= $row["matricula"];
			    }
                
    
                // Verifica se a senha enviada bate com o hash armazenado
                #if (password_verify($senha, $senhaHash)) {
                #    echo json_encode(['success' => true, 'message' => 'Login realizado com sucesso']);
                #} else {
                #    echo json_encode(['success' => false, 'message' => 'Credenciais inválidas']);
                #}
            } else {
                echo json_encode(['success' => false, 'message' => 'Matrícula não encontrada']);
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
	    				$_SESSION['login'] = $matricula;
	    				$_SESSION['senha'] = $senha;
	    				#echo "<script>location.href='_admin/administrativo.php'</script>";
                        echo json_encode(['success' => true, 'message' => 'Login realizado com sucesso']);
	    			}else{
	    			    #$_SESSION['msg'] = "Usuário ou Senha não correspondem!";
	    			    #header("Location: index.php");
                        echo json_encode(['success' => false, 'message' => 'Usuário ou Senha não correspondem!']);
	    			}
    		}else{
    			echo "Usuário não existe";
    		}
        } #else {
          #  echo json_encode(['success' => false, 'message' => 'Dados incompletos']);
        #}
    } #else {
      #  echo json_encode(['success' => false, 'message' => 'Método não permitido']);
   # }
    
    
?>
