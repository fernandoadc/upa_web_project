<?php
session_start();
include_once "../application/database.php";

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    $nome = mysqli_real_escape_string($dbcon, $data['nome'] ?? null);
    $endereco = mysqli_real_escape_string($dbcon, $data['endereco'] ?? null);
    $numero = mysqli_real_escape_string($dbcon, $data['numero'] ?? null);
    $bairro = mysqli_real_escape_string($dbcon, $data['bairro'] ?? null);
    $cidade = mysqli_real_escape_string($dbcon, $data['cidade'] ?? null);
    $estado = mysqli_real_escape_string($dbcon, $data['estado'] ?? null);
    #$nascimento = mysqli_real_escape_string($dbcon, $data['nascimento'] ?? null);
    $idade = mysqli_real_escape_string($dbcon, $data['idade'] ?? null);
    $rg = mysqli_real_escape_string($dbcon, $data['rg'] ?? null);
    $sus = mysqli_real_escape_string($dbcon, $data['sus'] ?? null);
    $contato = mysqli_real_escape_string($dbcon, $data['cont'] ?? null);
    $mae = mysqli_real_escape_string($dbcon, $data['mae'] ?? null);
    #$sexo = mysqli_real_escape_string($dbcon, $data['sexo'] ?? null);

    // Verificando se os campos obrigatórios estão preenchidos
    if (empty($nome) || empty($cidade) || empty($endereco) || empty($mae) || empty($bairro) || empty($numero) || empty($idade) || empty($rg) || empty($sus) || empty($contato)) {
        echo json_encode(["success" => false, "message" => "Necessário preencher todos os campos!"]);
        exit;
    } else {
        // Inserindo o endereço
        $sql = $dbcon->query("INSERT INTO endereco(numero, rua, bairro, cidade, estado) VALUES('$numero', '$endereco', '$bairro', '$cidade', '$estado')");
        
        if ($sql) {
            // Pegando o ID do endereço inserido
            $endereco_id = mysqli_insert_id($dbcon);
            
            // Verificando se o SUS já existe
            $paciente = mysqli_query($dbcon, "SELECT cartao_sus FROM paciente WHERE cartao_sus = '$sus'");
            $resulsus = mysqli_fetch_assoc($paciente);
        
            if ($resulsus) {
                // SUS já existe, então deleta o endereço recém-criado
                $delete = mysqli_query($dbcon, "DELETE FROM endereco WHERE cod_endereco = '$endereco_id'");
                echo json_encode(["success" => false, "message" => "Cartão SUS já cadastrado no sistema!"]);
                exit;
            }

            // Inserindo o paciente
            $sqldb = $dbcon->query("INSERT INTO paciente(cartao_sus, nome, idade, rg, contato, mae, endereco_cod_endereco) 
                                    VALUES('$sus', '$nome', '$idade', '$rg', '$contato', '$mae', '$endereco_id')");
            
            if ($sqldb) {
                echo json_encode(["success" => true, "message" => "Cadastro efetuado com sucesso!"]);
            } else {
                echo json_encode(["success" => false, "message" => "Erro ao cadastrar paciente!"]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Erro ao cadastrar endereço!"]);
        }
    }
}
?>




<!--dando erro no sexo-->