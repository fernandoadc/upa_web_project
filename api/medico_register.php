<?php
session_start();
include_once "../application/database.php";

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    $nome = mysqli_real_escape_string($dbcon, $data['nome']);
    $endereco = mysqli_real_escape_string($dbcon, $data['endereco']);
    $numero = mysqli_real_escape_string($dbcon, $data['numero']);
    $bairro = mysqli_real_escape_string($dbcon, $data['bairro']);
    $cidade = mysqli_real_escape_string($dbcon, $data['cidade']);
    $estado = mysqli_real_escape_string($dbcon, $data['estado']);
    $crm = mysqli_real_escape_string($dbcon, $data['crm']);
    $contato = mysqli_real_escape_string($dbcon, $data['cont']);
    $especialidade = mysqli_real_escape_string($dbcon, $data['especialidade'] ?? null);
    $sexo = mysqli_real_escape_string($dbcon, $data["sexo"] ?? null) ;

    // Verificando se os campos obrigatórios estão preenchidos  || empty($sexo) || empty($especialidade)
    if (empty($nome) || empty($cidade) || empty($endereco)  || empty($bairro) || empty($numero) || 
        empty($crm) || empty($contato)) {
        echo json_encode(["success" => false, "message" => "Necessário preencher todos os campos!"]);
        exit;
    } else {
        // Inserindo o endereço
        $sql = $dbcon->query("INSERT INTO endereco(numero, rua, bairro, cidade, estado) VALUES('$numero', '$endereco', '$bairro', '$cidade', '$estado')");
        
        if ($sql) {
            // Pegando o ID do endereço inserido
            $endereco_id = mysqli_insert_id($dbcon);
            
            // Verificando se o SUS já existe
            $medico = mysqli_query($dbcon, "SELECT crm FROM medico WHERE crm = '$crm'");
            $resulcrm = mysqli_fetch_assoc($medico);
        
            if ($resulcrm) {
                // CRM já existe, então deleta o endereço recém-criado
                $delete = mysqli_query($dbcon, "DELETE FROM endereco WHERE cod_endereco = '$endereco_id'");
                echo json_encode(["success" => false, "message" => "CRM já cadastrado no sistema!"]);
                exit;
            }

            // Inserindo o paciente
            $sqldb = $dbcon->query("INSERT INTO medico(crm, nome, contato, especialidade, sexo, endereco_cod_endereco) 
                                    VALUES('$crm', '$nome', '$contato', '$especialidade', '$sexo', '$endereco_id')");
            
            if ($sqldb) {
                echo json_encode(["success" => true, "message" => "Cadastro efetuado com sucesso!"]);
            } else {
                echo json_encode(["success" => false, "message" => "Erro ao cadastrar medico!"]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Erro ao cadastrar endereço!"]);
        }
    }
}
?>