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
    <title>StarLine - Estação Espacial</title>
    <!-- CSS específico da página -->
    <link rel="stylesheet" href="../css/detalhesEstacao.css">
    <!-- Biblioteca de ícones -->
    <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Fonte utilizada no projeto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"rel="stylesheet">
</head>
    <body>
        <!-- MENU LATERAL -->
        <aside class="sidebar">
            <!-- Logo da StarLine -->
            <div class="logo-area">
                <img src="../img/logo.png" alt="StarLine">
            </div>
            <!-- Opções de navegação -->
            <nav class="menu">
                <!-- Link para a página inicial -->
                <a href="../View/menuUsuario.php" class="menu-item">
                    <i class="fa-solid fa-house"></i>
                    <span>Início</span>
                </a>
                <!-- Destinos fica ativo nesta página -->
                <a href="../View/destinosUsuario.php" class="menu-item ativo">
                    <i class="fa-solid fa-earth-americas"></i>
                    <span>Destinos</span>
                </a>
                <!-- Link para as reservas -->
                <a href="../View/minhasReservas.php" class="menu-item">
                    <i class="fa-regular fa-calendar"></i>
                    <span>Minhas Reservas</span>
                </a>
                <!-- Link para as compras -->
                <a href="../View/compraUsuario.php" class="menu-item">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span>Compras</span>
                </a>
                <!-- Link para o perfil -->
                <a href="../View/perfilUsuario.php" class="menu-item">
                    <i class="fa-regular fa-user"></i>
                    <span>Perfil</span>
                </a>
            </nav>
            <!-- Botão para sair do sistema -->
            <div class="menu-final">
                <a href="../index.php" class="menu-item">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Sair</span>
                </a>
            </div>
        </aside>
        <!-- CONTEÚDO PRINCIPAL -->
        <main class="conteudo">
            <!-- TOPO -->
            <header class="topo">
                <!-- Título e descrição da página -->
                <div>
                    <h1>Estação Espacial</h1>
                    <p>Uma experiência única acima da Terra.</p>
                </div>
                <!-- Informações do usuário logado -->
                <div class="usuario">
                    <div class="avatar">
                        <i class="fa-solid fa-user-astronaut"></i>
                    </div>
                    <strong>
                        <?php echo $nome; ?>
                    </strong>
                    <i class="fa-solid fa-chevron-down"></i>
                </div>
            </header>
            <!-- DETALHES DO DESTINO -->
            <section class="detalhes">
                <!-- IMAGEM DA ESTAÇÃO -->
                <div class="imagem">
                    <img src="../img/estacao.jpg"alt="Estação Espacial">
                </div>
                <!-- INFORMAÇÕES DO DESTINO -->
                <div class="informacoes">
                    <!-- CATEGORIA DO DESTINO -->
                    <span class="categoria">
                        <i class="fa-solid fa-satellite"></i>
                        Estação Espacial
                    </span>
                    <!-- TÍTULO -->
                    <h2>
                        Uma experiência única acima da Terra.
                    </h2>
                    <!-- DESCRIÇÃO -->
                    <p class="descricao">
                        Conheça a estação espacial StarLine e aproveite
                        uma viagem com vista privilegiada do planeta.
                    </p>
                    <!-- DADOS DA VIAGEM -->
                    <div class="dados">
                        <!-- DURAÇÃO -->
                        <div>
                            <i class="fa-regular fa-clock"></i>
                            <span>
                                <small>Duração</small>
                                6 dias
                            </span>
                        </div>
                        <!-- CAPACIDADE -->
                        <div>
                            <i class="fa-solid fa-users"></i>
                            <span>
                                <small>Capacidade</small>
                                60 passageiros
                            </span>
                        </div>
                    </div>
                    <!-- EXPERIÊNCIAS DA VIAGEM -->
                    <div class="experiencias">
                        <h3>Principais experiências</h3>
                        <p>
                            <i class="fa-solid fa-earth-americas"></i>
                            Vista da Terra
                        </p>
                        <p>
                            <i class="fa-solid fa-rocket"></i>
                            Experiência de gravidade zero
                        </p>
                        <p>
                            <i class="fa-solid fa-satellite"></i>
                            Visita à estação
                        </p>
                    </div>
                    <!-- COMPRA / RESERVA -->
                    <div class="compra">
                        <!-- Preço da viagem -->
                        <div>
                            <small>A partir de</small>
                            <strong>R$ 129.900</strong>
                        </div>
                        <!-- Botão para reservar a viagem -->
                        <a href="../View/compraUsuario.php">
                            <button type="button">
                                Reservar viagem
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </section>
            <!-- RODAPÉ -->
            <footer>
                © 2026 StarLine Agência Espacial.
                Todos os direitos reservados.
            </footer>
        </main>
        <!-- JavaScript da página -->
        <script src="../js/detalhesEstacao.js"></script>
    </body>
</html>