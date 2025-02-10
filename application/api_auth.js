//Login - Autenticação de usuários
document.addEventListener('DOMContentLoaded', function() {
    console.log('JavaScript carregado');
    
    document.getElementById('login-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Impede o envio tradicional do formulário
        console.log('Formulário enviado');
        
        const matricula = document.getElementById('matricula').value;
        const senha = document.getElementById('senha').value;
        
        console.log('Matrícula:', matricula);
        console.log('Senha:', senha);

        if (!matricula || !senha) {
            console.log('Preencha todos os campos');
            return;
        }

        const data = {
            matricula: matricula,
            senha: senha
        };

        fetch('http://localhost/upa_web_project/api/auth.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        })
        .then(response => response.json())
        .then(data => {
            const messageDiv = document.getElementById('login-message');
            if (data.success) {
                //messageDiv.innerHTML = `<p style="color: green;">${data.message}</p>`;
                window.location.href = "_admin/administrativo.php"; 
            } else {
                console.log('erro!');
            }
        })

        //{
        //"matricula": "2019008428",
        //"senha": "390.Pico"
        //}
    });
});