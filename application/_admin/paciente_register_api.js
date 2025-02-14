document.addEventListener('DOMContentLoaded', function() {
    console.log('JavaScript carregado');


    //Cadastro
    document.getElementById('paciente-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Impede o envio tradicional do formulário
        console.log('Formulário enviado');
        
        const data = {
            nome: document.getElementById("nome").value,
            endereco: document.getElementById("endereco").value,
            numero: document.getElementById("numero").value,
            bairro: document.getElementById("bairro").value,
            cidade: document.getElementById("cidade").value,
            estado: document.getElementById("estado").value,
            //nascimento: document.getElementById("nascimento").value,
            idade: document.getElementById("idade").value,
            rg: document.getElementById("rg").value,
            sus: document.getElementById("sus").value,
            cont: document.getElementById("cont").value,
            mae: document.getElementById("mae").value,
            sexo: document.getElementById("sexo").value
        };
        console.log(sexo);  

         //{
         //   "matricula": "2019008422",
         //   "senha": "Admin123",
        //    "senhac": "Admin123",
        //    "contato": "93992295832",
        //    "email": "admin@admin.com"
         // }
          

        fetch("http://localhost/upa_web_project/api/paciente_register.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Paciente cadastrado com sucesso!");
                window.location.href = "paciente.php";  // Limpa os campos do formulário
            } else {
                alert("Erro: " + data.message);
            }
        })
    });
});