<?php
    session_start();
    include_once "../application/conexaoUPA.php";

    header("Content-Type: application/json");  

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $data = json_decode(file_get_contents("php://input"), true);    

        $nome=mysqli_real_escape_string($dbcon, $data['nome']);
        $email=mysqli_real_escape_string($dbcon, $data['email']);
        $senha=mysqli_real_escape_string($dbcon, $data['senha']);
        $matricula=mysqli_real_escape_string($dbcon, $data['matricula']);
        $contato=mysqli_real_escape_string($dbcon, $data['contato']);
        $conf=mysqli_real_escape_string($dbcon, $data['senhac']);
        

        if ($nome == "" || $email == "" || $senha == "" || $matricula == "" || $contato == "" || $conf == "") {
            echo json_encode(["success" => false, "message" => "Necessário preencher todos os campos!"]);
            exit;
        } elseif ($senha != $conf) {
            echo json_encode(["success" => false, "message" => "As senhas não correspondem!"]);
            exit;
        } elseif ((strlen($senha)) < 6) {
            echo json_encode(["success" => false, "message" => "A senha deve ter no mínimo 6 caracteres!"]);
            exit;
        } elseif ((strlen($senha)) > 12) {
            echo json_encode(["success" => false, "message" => "A senha deve ter no máximo 12 caracteres!"]);
            exit;
        } else {
            $senha = base64_encode($senha);
            $sql = $dbcon->query("INSERT INTO usuario(matricula, nome, email, contato, senha) VALUES('$matricula', '$nome', '$email', '$contato', '$senha')");
    
            if ($sql) {
                echo json_encode(["success" => true, "message" => "Cadastro efetuado com sucesso!"]);
            } else {
                echo json_encode(["success" => false, "message" => "Erro ao cadastrar usuário! Verifique seus dados e tente novamente!"]);
            }
            exit;
        }
    }
?>