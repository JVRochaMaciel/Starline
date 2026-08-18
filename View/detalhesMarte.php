<?php
    namespace Projeto\starline\View;
    // Inicia a sessão para conseguir acessar os dados do usuário logado
    session_start();
    // Pega o nome do usuário armazenado na sessão
    $nome = $_SESSION['nome'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StarLine - Marte</title>
    <!-- CSS específico da página de Marte -->
    <link rel="stylesheet" href="../css/detalhesMarte.css">
    <!-- Biblioteca de ícones Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Fontes utilizadas no projeto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
    <body>
        <!-- Menu lateral de navegação -->
        <aside class="sidebar">
            <!-- Logo da StarLine -->
            <div class="logo">
                <img src="../img/logo.png" alt="StarLine">
            </div>
            <!-- Opções do menu -->
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
                <!-- Link para as reservas do usuário -->
                <a href="../View/minhasReservas.php" class="menu-item">
                    <i class="fa-regular fa-calendar"></i>
                    <span>Minhas Reservas</span>
                </a>
                <!-- Link para as compras do usuário -->
                <a href="../View/compraUsuario.php" class="menu-item">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span>Compras</span>
                </a>
                <!-- Link para o perfil do usuário -->
                <a href="../View/perfilUsuario.php" class="menu-item">
                    <i class="fa-regular fa-user"></i>
                    <span>Perfil</span>
                </a>
            </nav>
            <!-- Opção para sair do sistema -->
            <div class="sair">
                <a href="../index.php" class="menu-item">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Sair</span>
                </a>
            </div>
        </aside>
        <!-- Conteúdo principal da página -->
        <main class="conteudo">
            <!-- Cabeçalho da página -->
            <header class="topo">
                <div>
                    <h1>Marte</h1>
                    <p>Uma aventura pelo planeta vermelho.</p>
                </div>
                <!-- Informações do usuário logado -->
                <div class="usuario">
                    <div class="avatar">
                        <i class="fa-solid fa-user-astronaut"></i>
                    </div>
                    <strong><?php echo $nome; ?></strong>
                    <i class="fa-solid fa-chevron-down"></i>
                </div>
            </header>
            <!-- Seção com os detalhes do destino -->
            <section class="detalhes">
                <!-- Imagem de Marte -->
                <div class="imagem">
                    <img src="../img/marte.jpg" alt="Marte">
                </div>
                <!-- Informações sobre o destino -->
                <div class="informacoes">
                    <!-- Categoria do destino -->
                    <span class="categoria">
                        <i class="fa-solid fa-globe"></i> Marte
                    </span>
                    <!-- Título do destino -->
                    <h2>Uma aventura pelo planeta vermelho.</h2>
                    <!-- Descrição do destino -->
                    <p class="descricao">
                        Viaje até Marte e conheça um dos destinos mais incríveis do espaço com a StarLine.
                    </p>
                    <!-- Informações da viagem -->
                    <div class="dados">
                        <!-- Duração da viagem -->
                        <div>
                            <i class="fa-regular fa-clock"></i>
                            <span>
                                <small>Duração</small>
                                12 dias
                            </span>
                        </div>
                        <!-- Capacidade da viagem -->
                        <div>
                            <i class="fa-solid fa-users"></i>
                            <span>
                                <small>Capacidade</small>
                                60 passageiros
                            </span>
                        </div>
                    </div>
                    <!-- Experiências disponíveis durante a viagem -->
                    <div class="experiencias">
                        <h3>Principais experiências</h3>
                        <p>
                            <i class="fa-solid fa-globe"></i>
                            Exploração de Marte
                        </p>
                        <p>
                            <i class="fa-solid fa-earth-americas"></i>
                            Vista do espaço
                        </p>
                        <p>
                            <i class="fa-solid fa-camera"></i>
                            Registro da viagem
                        </p>
                    </div>
                    <!-- Área de preço e botão de reserva -->
                    <div class="compra">
                        <!-- Preço da viagem -->
                        <div>
                            <small>A partir de</small>
                            <strong>R$ 499.900</strong>
                        </div>
                        <!-- Botão que leva para a página de compra -->
                        <a href="../View/compraUsuario.php">
                            <button onclick="reservar()">
                                Reservar viagem
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </section>
            <!-- Rodapé da página -->
            <footer>
                © 2026 StarLine Agência Espacial. Todos os direitos reservados.
            </footer>
        </main>
        <!-- JavaScript específico da página -->
        <script src="../js/detalhesMarte.js"></script>
    </body>
</html>