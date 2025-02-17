<?php
session_start();
include_once "../application/database.php";

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $data = json_decode(file_get_contents("php://input"), true);
    //var_dump($data);
   // Sanitiza os dados recebidos
   $paciente = mysqli_real_escape_string($dbcon, $data["nome"] ?? "");
   $sus = mysqli_real_escape_string($dbcon, $data["sus"] ?? "");
   $desc = mysqli_real_escape_string($dbcon, $data["desc"] ?? "");
   $medico = mysqli_real_escape_string($dbcon, $data["medico"] ?? "");
   $crm = mysqli_real_escape_string($dbcon, $data["crm"] ?? "");
   $dataConsulta = mysqli_real_escape_string($dbcon, $data["data"] ?? "");
   

    // Validação: Nenhum campo pode estar vazio
    if (empty($paciente) || empty($sus) || empty($medico) || empty($dataConsulta) || empty($crm) || empty($desc)) {
        echo json_encode(["status" => "error", "message" => "Todos os campos devem ser preenchidos."]);
        exit;
    }

    // Verifica se o paciente está cadastrado
    $stmt = $dbcon->prepare("SELECT cartao_sus, nome FROM paciente WHERE cartao_sus = ?");
    $stmt->bind_param("s", $sus);
    $stmt->execute();
    $result = $stmt->get_result();
    $pacibd = $result->fetch_assoc();
    $stmt->close();

    if (!$pacibd) {
        echo json_encode(["status" => "error", "message" => "Paciente não cadastrado no sistema."]);
        exit;
    }

    // Verifica se o médico está cadastrado
    $stmt = $dbcon->prepare("SELECT crm, nome FROM medico WHERE crm = ?");
    $stmt->bind_param("s", $crm);
    $stmt->execute();
    $result = $stmt->get_result();
    $medibd = $result->fetch_assoc();
    $stmt->close();

    if (!$medibd) {
        echo json_encode(["status" => "error", "message" => "Médico não cadastrado no sistema."]);
        exit;
    }

    // Insere a consulta no banco
    $stmt = $dbcon->prepare("INSERT INTO consulta (descricao, data, paciente_cartao_sus, medico_crm) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $desc, $data, $sus, $crm);

    if ($stmt->execute()) {
        $stmt->close();

        // Dados da consulta cadastrada para envio por e-mail
        $dadosConsulta = [
            'paciente' => $paciente,
            'data' => $data,
            'observacoes' => $desc,
        ];
        
        #$emailMedico = "inadiaalmeida10@gmail.com";
        #$nomeMedico = "Inadia Almeida";
        
        // Descomente esta linha se já tiver a função implementada
        // enviarEmailConsulta($emailMedico, $nomeMedico, $dadosConsulta);

        echo json_encode(["status" => "success", "message" => "Consulta cadastrada com sucesso!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Erro ao cadastrar consulta!"]);
    }

    $dbcon->close();
    }
?>