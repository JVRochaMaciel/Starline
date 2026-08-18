<?php
    namespace Projeto\starline\View;
    // Inicia a sessão para poder acessar os dados do usuário logado
    session_start();
    // Pega o nome do usuário salvo na sessão
    $nome = $_SESSION['nome'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Título da página -->
    <title>StarLine - Destinos</title>
    <!-- CSS responsável pelo visual da página -->
    <link rel="stylesheet" href="../css/destinosUsuario.css">
    <!-- FontAwesome para utilizar os ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Fontes utilizadas no projeto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
    <body>
        <!-- MENU LATERAL -->
        <aside class="sidebar">
            <!-- Logo da StarLine -->
            <div class="logo-area">
                <img src="../img/logo.png" alt="StarLine">
            </div>
            <!-- Links de navegação do sistema -->
            <nav>
                <!-- Página inicial -->
                <a href="../View/menuUsuario.php">
                    <i class="fa-solid fa-house"></i>
                    <span>Início</span>
                </a>
                <!-- Destinos é a página atual, por isso recebe a classe ativo -->
                <a href="../View/destinosUsuario.php" class="ativo">
                    <i class="fa-solid fa-earth-americas"></i>
                    <span>Destinos</span>
                </a>
                <!-- Página de reservas -->
                <a href="../View/minhasReservas.php">
                    <i class="fa-regular fa-calendar"></i>
                    <span>Minhas Reservas</span>
                </a>
                <!-- Página de compras -->
                <a href="../View/compraUsuario.php">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span>Compras</span>
                </a>
                <!-- Página de perfil -->
                <a href="../View/perfilUsuario.php">
                    <i class="fa-regular fa-user"></i>
                    <span>Perfil</span>
                </a>
            </nav>
            <!-- Botão para sair do sistema -->
            <div class="sair">
                <a href="../index.php">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Sair</span>
                </a>
            </div>
        </aside>
        <!-- CONTEÚDO PRINCIPAL -->
        <main class="conteudo">
            <!-- CABEÇALHO DA PÁGINA -->
            <header class="topo">
                <div>
                    <h1>Destinos</h1>
                    <p>Escolha seu próximo destino e embarque em uma jornada inesquecível.</p>
                </div>
                <!-- Mostra os dados do usuário logado -->
                <div class="usuario">
                    <div class="avatar">
                        <i class="fa-solid fa-user-astronaut"></i>
                    </div>
                    <strong><?php echo $nome; ?></strong>
                    <i class="fa-solid fa-chevron-down"></i>
                </div>
            </header>
            <!-- FILTROS DOS DESTINOS -->
            <section class="filtros">
                <!-- Campo para pesquisar um destino pelo nome -->
                <div class="busca">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="campoBusca" placeholder="Buscar destino...">
                </div>
                <!-- Seleciona o tipo de destino -->
                <select id="tipoDestino">
                    <option value="todos">Todos os destinos</option>
                    <option value="planeta">Planetas</option>
                    <option value="estacao">Estações espaciais</option>
                </select>
                <!-- Define a ordem dos preços -->
                <select id="ordem">
                    <option value="menor">Menor preço</option>
                    <option value="maior">Maior preço</option>
                </select>
                <!-- Executa a função de filtro do JavaScript -->
                <button onclick="filtrarDestinos()">
                    <i class="fa-solid fa-filter"></i>
                    Filtrar
                </button>
            </section>
            <!-- LISTA DE DESTINOS -->
            <section class="destinos">
                <!-- CARD DA LUA -->
                <article class="card-destino" data-nome="lua" data-tipo="planeta">
                    <div class="imagem">
                        <img src="../img/lua.jpg" alt="Lua">
                        <!-- Identifica a Lua como o destino mais popular -->
                        <span>
                            <i class="fa-solid fa-star"></i> Mais Popular
                        </span>
                    </div>
                    <div class="informacoes">
                        <h2>Lua</h2>
                        <p>
                            Aproveite a vista incrível da Terra e viva uma experiência única em nosso satélite natural.
                        </p>
                        <div class="detalhes">
                            <!-- Preço da viagem -->
                            <div>
                                <small>A partir de</small>
                                <strong>R$ 89.900</strong>
                            </div>
                            <!-- Duração da viagem -->
                            <div class="duracao">
                                <i class="fa-regular fa-clock"></i>
                                <div>
                                    <small>Duração</small>
                                    <strong>3 dias</strong>
                                </div>
                            </div>
                        </div>
                        <!-- Abre os detalhes da viagem para a Lua -->
                        <a href="../View/detalhesLua.php">
                            <button onclick="verDestino('Lua')">
                                Ver detalhes
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </a>
                    </div>
                </article>
                <!-- CARD DE MARTE -->
                <article class="card-destino" data-nome="marte" data-tipo="planeta">
                    <div class="imagem">
                        <img src="../img/marte.jpg" alt="Marte">
                        <!-- Identifica Marte como um novo destino -->
                        <span>
                            <i class="fa-solid fa-rocket"></i> Novo Destino
                        </span>
                    </div>
                    <div class="informacoes">
                        <h2>Marte</h2>
                        <p>
                            Explore o planeta vermelho e descubra paisagens fascinantes em uma missão inesquecível.
                        </p>
                        <div class="detalhes">
                            <!-- Preço da viagem -->
                            <div>
                                <small>A partir de</small>
                                <strong>R$ 499.900</strong>
                            </div>
                            <!-- Duração da viagem -->
                            <div class="duracao">
                                <i class="fa-regular fa-clock"></i>
                                <div>
                                    <small>Duração</small>
                                    <strong>12 dias</strong>
                                </div>
                            </div>
                        </div>
                        <!-- Abre os detalhes da viagem para Marte -->
                        <a href="../View/detalhesMarte.php">
                            <button onclick="verDestino('Marte')">
                                Ver detalhes
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </a>
                    </div>
                </article>
                <!-- CARD DA ESTAÇÃO ESPACIAL -->
                <article class="card-destino" data-nome="estacao espacial" data-tipo="estacao">
                    <div class="imagem">
                        <img src="../img/estacao.jpg" alt="Estação Espacial">
                    </div>
                    <div class="informacoes">
                        <h2>Estação Espacial</h2>
                        <p>
                            Viva o dia a dia no espaço com conforto e segurança em nossa estação espacial.
                        </p>
                        <div class="detalhes">
                            <!-- Preço da viagem -->
                            <div>
                                <small>A partir de</small>
                                <strong>R$ 129.900</strong>
                            </div>
                            <!-- Duração da viagem -->
                            <div class="duracao">
                                <i class="fa-regular fa-clock"></i>
                                <div>
                                    <small>Duração</small>
                                    <strong>5 dias</strong>
                                </div>
                            </div>
                        </div>
                        <!-- Abre os detalhes da estação espacial -->
                        <a href="../View/detalhesEstacao.php">
                            <button onclick="verDestino('Estação Espacial')">
                                Ver detalhes
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </a>
                    </div>
                </article>
            </section>
            <!-- ÁREA DE CONTATO COM O CONSULTOR -->
            <section class="consultor">
                <div class="icone-consultor">
                    <i class="fa-solid fa-user-astronaut"></i>
                </div>
                <div>
                    <h2>Não encontrou o que procura?</h2>
                    <p>Fale com nossos consultores e monte sua viagem personalizada.</p>
                </div>
                <!-- Chama a função JavaScript para falar com o consultor -->
                <button onclick="falarConsultor()">
                    <i class="fa-regular fa-comment"></i>
                    Falar com consultor
                </button>
            </section>
            <!-- RODAPÉ -->
            <footer>
                © 2026 StarLine Agência Espacial. Todos os direitos reservados.
            </footer>
        </main>
        <!-- JavaScript responsável pelos filtros e interações da página -->
        <script src="../js/destinosUsuario.js"></script>
    </body>
</html>