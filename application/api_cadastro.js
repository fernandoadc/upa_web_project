//Login - Autenticação de usuários
document.addEventListener('DOMContentLoaded', function() {
    console.log('JavaScript carregado');


    //Cadastro
    document.getElementById('cadastro-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Impede o envio tradicional do formulário
        console.log('Formulário enviado');
        
        const data = {
            nome: document.getElementById("nome").value,
            matricula: document.getElementById("matricula").value,
            senha: document.getElementById("senha").value,
            senhac: document.getElementById("senhac").value,
            contato: document.getElementById("contato").value,
            email: document.getElementById("email").value
        };

        fetch("http://localhost/upa_web_project-main/projeto_upa_ultima_versao/Projeto-UPA/api/cadastro.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Usuário cadastrado com sucesso!");
                window.location.href = "index.php";  // Limpa os campos do formulário
            } else {
                alert("Erro: " + data.message);
            }
        })
    });
});