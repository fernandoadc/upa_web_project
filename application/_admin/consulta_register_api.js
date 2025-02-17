document.addEventListener('DOMContentLoaded', function() {
    console.log('JavaScript carregado');
  
  
    //Cadastro
    document.getElementById('consulta-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Impede o envio tradicional do formulário
        console.log('Formulário enviado');
        
        const data = {
            nome: document.getElementById("nome").value,
            sus: document.getElementById("sus").value,
            desc: document.getElementById("desc").value,
            medico: document.getElementById("medico").value, // ID duplicado, precisa corrigir!
            crm: document.getElementById("crm").value,
            data: document.getElementById("datepicker").value
        };
  
         //{
         //   "matricula": "2019008422",
         //   "senha": "Admin123",
        //    "senhac": "Admin123",
        //    "contato": "93992295832",
        //    "email": "admin@admin.com"
         // }
          
  
        fetch("http://localhost/upa_web_project/api/consulta_register.php", { 
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Consulta cadastrada com sucesso!");
                window.location.href = "consulta.php";  // Limpa os campos do formulário
            } else {
                alert("Erro: " + data.message);
            }
        })
    });
  });