document.addEventListener('DOMContentLoaded', function() {
  console.log('JavaScript carregado');


  //Cadastro
  document.getElementById('medico-form').addEventListener('submit', function(event) {
      event.preventDefault(); // Impede o envio tradicional do formulário
      console.log('Formulário enviado');
      
      const data = {
          nome: document.getElementById("nome").value,
          endereco: document.getElementById("endereco").value,
          numero: document.getElementById("numero").value,
          bairro: document.getElementById("bairro").value,
          cidade: document.getElementById("cidade").value,
          estado: document.getElementById("estado").value,
          crm: document.getElementById("crm").value,
          cont: document.getElementById("cont").value,
          especialidade: document.getElementById("espe").value,
          sexo: document.getElementById("sexo").value
      };

       //{
       //   "matricula": "2019008422",
       //   "senha": "Admin123",
      //    "senhac": "Admin123",
      //    "contato": "93992295832",
      //    "email": "admin@admin.com"
       // }
        

      fetch("http://localhost/upa_web_project/api/medico_register.php", { 
          method: "POST",
          headers: {
              "Content-Type": "application/json",
          },
          body: JSON.stringify(data),
      })
      .then(response => response.json())
      .then(data => {
          if (data.success) {
              alert("Médico cadastrado com sucesso!");
              window.location.href = "medico.php";  // Limpa os campos do formulário
          } else {
              alert("Erro: " + data.message);
          }
      })
  });
});