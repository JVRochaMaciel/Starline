<?php
    namespace Projeto\starline\View;
    // Inicia a sessão apenas se ainda não houver uma sessão ativa
    // Isso evita erro caso a sessão já tenha sido iniciada em outro arquivo
    if (session_status() === PHP_SESSION_NONE) 
    {
        session_start();
    }
    // Inclui a conexão com o banco de dados
    require_once '../DAO/Conexao.php';
    // Pega os dados do administrador que estão salvos na sessão
    $login = $_SESSION['loginAdm'] ?? '';
    $nome = $_SESSION['nomeAdm'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Título que aparece na aba do navegador -->
    <title>StarLine - Administração</title>
    <!-- Arquivo CSS responsável pelo estilo da página -->
    <link rel="stylesheet" href="../css/menuAdm.css">
    <!-- Biblioteca de ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Fontes utilizadas na página -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
    <body>
        <!-- Cabeçalho principal do painel -->
        <header class="topo">
            <!-- Logo da StarLine -->
            <div class="logo">
                <img src="../img/logo.png" alt="StarLine">
            </div>
            <!-- Título e descrição do painel -->
            <div class="titulo">
                <h1>Painel Administrativo</h1>
                <p>Gerencie os dados do sistema StarLine.</p>
            </div>
            <!-- Informações do administrador logado -->
            <div class="admin">
                <!-- Ícone do administrador -->
                <div class="avatar">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
                <!-- Nome e login do administrador -->
                <div>
                    <strong><?php echo $nome; ?></strong>
                    <small><?php echo $login; ?></small>
                </div>
            </div>
        </header>
        <!-- Conteúdo principal da página -->
        <main class="conteudo">
            <!-- Área de boas-vindas -->
            <section class="boas-vindas">
                <h2>Gerenciamento de Dados</h2>
                <p>Selecione uma opção para gerenciar as informações.</p>
            </section>
            <!-- Cards das áreas que podem ser administradas -->
            <section class="cards">
                <!-- Card de gerenciamento de naves -->
                <div class="card">
                    <div class="icone">
                        <i class="fa-solid fa-rocket"></i>
                    </div>
                    <div class="info">
                        <h3>Naves</h3>
                        <p>Cadastre, edite ou remova naves.</p>
                    </div>
                    <!-- Link para a página de naves -->
                    <a href="../View/navesAdm.php">
                        Gerenciar <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
                <!-- Card de gerenciamento de pilotos -->
                <div class="card">
                    <div class="icone">
                        <i class="fa-solid fa-user-astronaut"></i>
                    </div>
                    <div class="info">
                        <h3>Pilotos</h3>
                        <p>Cadastre, edite ou remova pilotos.</p>
                    </div>
                    <!-- Link para a página de pilotos -->
                    <a href="../View/pilotosAdm.php">
                        Gerenciar <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
                <!-- Card de gerenciamento de voos -->
                <div class="card">
                    <div class="icone">
                        <i class="fa-solid fa-calendar-days"></i>
                    </div>
                    <div class="info">
                        <h3>Voos</h3>
                        <p>Cadastre, edite ou remova voos.</p>
                    </div>
                    <!-- Link para a página de voos -->
                    <a href="../View/vooAdm.php">
                        Gerenciar <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
                <!-- Card de gerenciamento de usuários -->
                <div class="card">
                    <div class="icone">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="info">
                        <h3>Usuários</h3>
                        <p>Consulte os usuários.</p>
                    </div>
                    <!-- Link para a página de usuários -->
                    <a href="../View/usuariosAdm.php">
                        Gerenciar <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
                <!-- Card de gerenciamento de compras -->
                <div class="card">
                    <div class="icone">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <div class="info">
                        <h3>Compras</h3>
                        <p>Consulte ou edite as compras</p>
                    </div>
                    <!-- Link para a página de compras -->
                    <a href="../View/compraAdm.php">
                        Gerenciar <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </section>
            <!-- Ações disponíveis para o administrador -->
            <section class="acoes">
                <!-- Link para o perfil do administrador -->
                <a href="../View/perfilAdm.php">
                    <i class="fa-solid fa-user"></i>
                    Meu Perfil
                </a>
                <!-- Link para sair do sistema -->
                <a href="../index.php" class="sair">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Sair
                </a>
            </section>
        </main>
        <!-- Rodapé da página -->
        <footer>
            © 2026 StarLine Agência Espacial. Todos os direitos reservados.
        </footer>
        <!-- Arquivo JavaScript do menu administrativo -->
        <script src="../js/menuAdm.js"></script>
    </body>
</html>