# Starline

A **Starline** é um projeto acadêmico fictício desenvolvido no **SENAC São Bernardo do Campo**, com o objetivo de aplicar conhecimentos de desenvolvimento web e banco de dados na criação de uma plataforma simulada de viagens espaciais.

## Sobre o projeto

O sistema representa uma empresa fictícia de turismo espacial, permitindo simular a consulta de destinos, a visualização de voos e o gerenciamento de compras e reservas. A plataforma também conta com uma área administrativa para gerenciar as informações do sistema.

Este projeto foi desenvolvido exclusivamente para fins educacionais, como parte das atividades de aprendizagem do curso técnico do SENAC, não representando uma empresa real ou um serviço comercial de viagens espaciais.

## Funcionalidades

- Cadastro e autenticação de usuários
- Consulta de destinos e informações sobre viagens
- Visualização e gerenciamento de voos
- Gerenciamento de naves espaciais e pilotos
- Simulação de compras de passagens e reservas
- Área administrativa para gerenciamento do sistema
- Gerenciamento de perfis de usuários

## Tecnologias utilizadas

- **PHP** — lógica e processamento do sistema
- **MySQL** — armazenamento e gerenciamento de dados
- **JavaScript** — interatividade e funcionalidades da interface
- **HTML5** — estrutura das páginas
- **CSS3** — estilização e layout

## Estrutura do projeto

- `Control/` — controles e processamento das funcionalidades
- `DAO/` — operações de acesso ao banco de dados
- `Model/` — modelos e representação dos dados
- `View/` — páginas e interfaces do sistema
- `css/` — arquivos de estilização
- `js/` — scripts JavaScript
- `img/` — imagens e recursos visuais
- `Starline_Banco.sql` — script SQL do banco de dados

## Como executar

1. Instale um ambiente de desenvolvimento PHP, como o XAMPP, com MySQL.
2. Clone o repositório e coloque a pasta do projeto no diretório `htdocs`.
3. Inicie os serviços Apache e MySQL.
4. Importe o arquivo `Starline_Banco.sql` pelo phpMyAdmin.
5. Verifique as configurações de conexão com o banco de dados em `DAO/conexao.php`.
6. Acesse o projeto pelo navegador utilizando o endereço local correspondente à pasta do projeto.

## Objetivo acadêmico

O projeto tem como objetivo praticar conceitos de programação, desenvolvimento de interfaces, organização de código, operações CRUD e integração entre aplicações web e bancos de dados relacionais.

---

**Instituição:** SENAC São Bernardo do Campo  
**Natureza:** Projeto acadêmico fictício  
**Área:** Desenvolvimento de Sistemas

*Starline — Explorando novas possibilidades além da Terra.*
