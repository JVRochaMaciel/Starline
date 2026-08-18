<?php
    namespace Projeto\starline\View;
    // Inicia a sessão para acessar os dados do usuário logado
    session_start();
    // Recupera o nome do usuário salvo na sessão
    $nome = $_SESSION['nome'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Título da página -->
    <title>StarLine - Lua</title>
    <!-- CSS específico da página -->
    <link rel="stylesheet" href="../css/detalhesLua.css">
    <!-- Biblioteca de ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Fonte utilizada no projeto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
    <body>
        <!-- Menu lateral -->
        <aside class="sidebar">
            <!-- Logo da StarLine -->
            <div class="logo">
                <img src="../img/logo.png" alt="StarLine">
            </div>
            <!-- Links de navegação -->
            <nav class="menu">
                <!-- Página inicial -->
                <a href="../View/menuUsuario.php" class="menu-item">
                    <i class="fa-solid fa-house"></i>
                    <span>Início</span>
                </a>
                <!-- Destinos está selecionado nesta página -->
                <a href="../View/destinosUsuario.php" class="menu-item ativo">
                    <i class="fa-solid fa-earth-americas"></i>
                    <span>Destinos</span>
                </a>
                <!-- Reservas do usuário -->
                <a href="../View/minhasReservas.php" class="menu-item">
                    <i class="fa-regular fa-calendar"></i>
                    <span>Minhas Reservas</span>
                </a>
                <!-- Compras do usuário -->
                <a href="../View/compraUsuario.php" class="menu-item">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span>Compras</span>
                </a>
                <!-- Perfil do usuário -->
                <a href="../View/perfilUsuario.php" class="menu-item">
                    <i class="fa-regular fa-user"></i>
                    <span>Perfil</span>
                </a>
            </nav>
            <!-- Botão para sair do sistema -->
            <div class="sair">
                <a href="../index.php" class="menu-item">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Sair</span>
                </a>
            </div>
        </aside>
        <!-- Conteúdo principal -->
        <main class="conteudo">
            <!-- Cabeçalho -->
            <header class="topo">
                <!-- Título e descrição -->
                <div>
                    <h1>Lua</h1>
                    <p>Uma viagem para conhecer nosso satélite natural.</p>
                </div>
                <!-- Dados do usuário logado -->
                <div class="usuario">
                    <div class="avatar">
                        <i class="fa-solid fa-user-astronaut"></i>
                    </div>
                    <strong><?php echo $nome; ?></strong>
                    <i class="fa-solid fa-chevron-down"></i>
                </div>
            </header>
            <!-- Informações do destino -->
            <section class="detalhes">
                <!-- Imagem da Lua -->
                <div class="imagem">
                    <img src="../img/lua.jpg" alt="Lua">
                </div>
                <!-- Informações da viagem -->
                <div class="informacoes">
                    <!-- Nome do destino -->
                    <span class="categoria">
                        <i class="fa-solid fa-moon"></i> Lua
                    </span>
                    <!-- Título -->
                    <h2>Uma viagem para além da Terra.</h2>
                    <!-- Descrição -->
                    <p class="descricao">
                        Explore a Lua de perto e descubra uma experiência espacial inesquecível com a StarLine.
                    </p>
                    <!-- Dados da viagem -->
                    <div class="dados">
                        <!-- Duração -->
                        <div>
                            <i class="fa-regular fa-clock"></i>
                            <span>
                                <small>Duração</small>
                                3 dias
                            </span>
                        </div>
                        <!-- Capacidade -->
                        <div>
                            <i class="fa-solid fa-users"></i>
                            <span>
                                <small>Capacidade</small>
                                60 passageiros
                            </span>
                        </div>
                    </div>
                    <!-- Experiências da viagem -->
                    <div class="experiencias">
                        <h3>Principais experiências</h3>
                        <p>
                            <i class="fa-solid fa-moon"></i>
                            Visita à superfície lunar
                        </p>
                        <p>
                            <i class="fa-solid fa-earth-americas"></i>
                            Vista da Terra
                        </p>
                        <p>
                            <i class="fa-solid fa-camera"></i>
                            Registro da viagem
                        </p>
                    </div>
                    <!-- Área de compra -->
                    <div class="compra">
                        <!-- Preço da viagem -->
                        <div>
                            <small>A partir de</small>
                            <strong>R$ 89.900</strong>
                        </div>
                        <!-- Botão para reservar a viagem -->
                        <a href="../View/compraUsuario.php">
                            <button onclick="reservar()">
                                Reservar viagem
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </section>
            <!-- Rodapé -->
            <footer>
                © 2026 StarLine Agência Espacial. Todos os direitos reservados.
            </footer>
        </main>
        <!-- JavaScript da página -->
        <script src="../js/detalhesLua.js"></script>
    </body>
</html>