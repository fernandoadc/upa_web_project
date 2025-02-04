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

         //{
         //   "matricula": "2019008422",
         //   "senha": "Admin123",
        //    "senhac": "Admin123",
        //    "contato": "93992295832",
        //    "email": "admin@admin.com"
         // }
          

        fetch("http://localhost/upa_web_project-main/upa_web_project/application/api/cadastro.php", {
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