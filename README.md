###### Atualizado em: Fevereiro 5, 2025 - 14:30 UTC-3 (Horário Oficial de Brasília, BRT)



<h1 align="center">
  <br>
   Sistema Informatizado para Unidade de Pronto Atendimento - SIUPA
  <br>
</h1>

<h4 align="center">Este repositório contém as documentações, base de dados e códigos utilizados para o desenvolvimento do SIUPA para disciplina de Sistemas Distribuídos</h4>

<p align="center">
  <a href="#resumo">Resumo</a> •
  <a href="#funcionalidades">Funcionalidades</a> •
 <a href="#tecnologias">Tecnologias</a> •
 <a href="#requisitos">Requisitos</a> •
 <a href="#instalacao">Instalação e Configuração</a> •
  <a href="#autor">Autor</a>
</p>

## Resumo

Este projeto é um sistema web desenvolvido para auxiliar na gestão e atendimento de uma Unidade de Pronto Atendimento (UPA). 
Ele permite o gerenciamento de informações relacionadas a pacientes, consultas e registros médicos, facilitando o trabalho da equipe de saúde e otimizando o fluxo de atendimento.


## <a id="funcionalidades"></a> 📝 Funcionalidades

- **Cadastro de Pacientes**: Interface para o cadastro de novos pacientes com informações pessoais e de contato.
- **Registro de Consultas**: Possibilidade de registrar novas consultas e associá-las a pacientes específicos.
- **Gestão de Atendimento**: Interface para acompanhar o atendimento e a triagem dos pacientes.
- **Relatórios**: Geração de relatórios sobre atendimentos e tempo médio de espera.
- **Login e Controle de Acesso**: Sistema de autenticação para diferentes perfis de usuário (ex: administradores e atendentes).

## <a id="tecnologias"></a>🛠 Tecnologias Utilizadas

- **HTML5 & CSS3** – Estrutura e design das páginas web.
- **Bootstrap 4.6** – Framework CSS para design responsivo.
- **PHP 8.0** – Backend e lógica do servidor.
- **MySQL 5.7** – Banco de dados para armazenamento das informações.

## <a id="requisitos"></a>❗Requisitos Mínimos

Antes de rodar o sistema, certifique-se de ter instalado:

- **Apache/Nginx** (ou um ambiente como XAMPP, WAMP ou Laragon)
- **PHP 8.0 ou superior**
- **MySQL 5.7 ou superior**
- **Git** (para clonar o repositório)

## <a id="instalacao"></a>📥 Instalação e Configuração

Abra o terminal (ou Git Bash) e execute:

```sh
git clone https://github.com/fernandoadc/upa_web_project.git
```
### Configurar o Banco de Dados
O modelo físico do banco está disponível na pasta `Docs/model`.
1. Crie um banco de dados chamado `db_upa` no MySQL.
2. Importe o arquivo SQL do modelo físico para criar as tabelas.

### Configurar Credenciais do Banco
Abra o arquivo `conexaoUPA.php`, localizado na pasta de aplicação, e ajuste as credenciais conforme necessário:

```php
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "db_upa";
```


### Rodar o Sistema
Após configurar tudo, abra um navegador e acesse:  
[http://localhost/upa_web_project/](http://localhost/upa_web_project/)

### Credenciais de Login
Você pode criar um novo usuário diretamente no sistema.  
Para isso, basta clicar em "Cadastrar" na página inicial.


## Autor
<table>
  <tr>
     <td align="center">
      <a href="http://lattes.cnpq.br/2201818644935012">
        <img src="https://avatars.githubusercontent.com/u/57629887?v=4" width="100px;" alt="Foto do Fernando"/><br>
        <sub>
          <b>Fernando Almeida do Carmo</b>
        </sub>
      </a>
    </td>
  </tr>
</table>

