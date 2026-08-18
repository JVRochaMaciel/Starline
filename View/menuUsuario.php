<?php
    namespace Projeto\starline\View;

    // Inicia a sessão apenas se ainda não houver uma sessão ativa
    // (evita o warning de "session already active" quando esta view
    // é chamada via include() a partir de DAO/validarLogin.php)
    if (session_status() === PHP_SESSION_NONE) 
    {
        session_start();
    }
    
    // Conexão com o banco de dados para buscar os dados do banco
    require_once '../DAO/Conexao.php';

    // Resgatando as variáveis de sessão para personalização do menu
    $nome = $_SESSION['nome'] ?? '';
    $login = $_SESSION['login'] ?? '';
    $id_usuarios = $_SESSION['id_usuarios'] ?? '';

    // Busca da última viagem comprada pelo usuário
    $ultimaCompra = null;

    try 
    {
        // Instancia a classe de Conexão e conecta ao MySQL
        $conexao = new \Projeto\starline\DAO\Conexao();
        $conn = $conexao->conectar();

        // Query para trazer apenas a última compra realizada pelo ID do usuário logado
        $sql  = "select localViagem, valor, pagamento from compra where id_usuarios = ? order by id_compras desc limit 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_usuarios);
        $stmt->execute();
        $resultado = $stmt->get_result();

        // Se encontrou algum registro, armazena os dados na variável $ultimaCompra
        if ($resultado->num_rows > 0) 
        {
            $ultimaCompra = $resultado->fetch_assoc();
        }
        $stmt->close();
    } 
    catch (\Exception $e) 
    {
        // Em caso de falha no banco, a exceção é tratada em silêncio para manter a página funcional
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StarLine - Menu Usuário</title>
 
    <!-- CSS exclusivo do painel do usuário -->
    <link rel="stylesheet" href="../css/menuUsuario.css">

    <!-- Biblioteca de ícones FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Fontes do Google Fonts (Poppins) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
    <body>
        <!-- Menu Lateral (Sidebar) -->
        <aside class="sidebar">
            <div class="logo-area">
                <img src="../img/logo.png" alt="StarLine">
            </div>
    
            <nav class="menu">
                <!-- Marcado com a classe 'ativo' indicando a página atual -->
                <a href="../View/menuUsuario.php" class="menu-item ativo"><i class="fa-solid fa-house"></i><span>Início</span></a>
                <a href="../View/destinosUsuario.php" class="menu-item"><i class="fa-solid fa-earth-americas"></i><span>Destinos</span></a>
                <a href="../View/minhasReservas.php" class="menu-item"><i class="fa-regular fa-calendar"></i><span>Minhas Reservas</span></a>
                <a href="../View/compraUsuario.php" class="menu-item"><i class="fa-solid fa-cart-shopping"></i><span>Compras</span></a>
                <a href="../View/perfilUsuario.php" class="menu-item"><i class="fa-regular fa-user"></i><span>Perfil</span></a>
            </nav>
    
            <!-- Botão para encerrar a sessão -->
            <div class="menu-final">
                <a href="../index.php" class="menu-item">
                    <i class="fa-solid fa-right-from-bracket"></i><span>Sair</span>
                </a>
            </div>
        </aside>
    
        <!-- Area Principal do Dashboard -->
        <main class="conteudo">
    
            <!-- Cabeçalho com saudação personalizada -->
            <header class="topo">
                <div>
                    <h1>Olá, <?php echo $nome; ?>!</h1>
                    <p>Prepare-se para viver experiências inesquecíveis.</p>
                </div>
    
                <div class="usuario">
                    <div class="avatar"><i class="fa-solid fa-user-astronaut"></i></div>
                    <strong><?php echo $nome; ?></strong>
                    <i class="fa-solid fa-chevron-down"></i>
                </div>
            </header>
    
            <!-- Banner de Boas-Vindas -->
            <section class="banner">
                <div class="banner-conteudo">
                    <h2>O universo<br>está esperando por você.</h2>
                    <p>Viaje para a Lua, Marte e estações espaciais com segurança, conforto e tecnologia StarLine.</p>
    
                    <button onclick="explorarDestinos()">
                        Explorar Destinos <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </section>
    
            <div class="area-principal">
    
                <!-- Seção de Destaque dos Destinos -->
                <section class="destinos">
                    <div class="titulo-secao">
                        <i class="fa-solid fa-rocket"></i>
                        <h2>Destinos Populares</h2>
                    </div>
    
                    <div class="cards">
                        <!-- Card Lua -->
                        <article class="card">
                            <img src="../img/lua.jpg" alt="Lua">
                            <div class="card-info">
                                <h3>Lua</h3>
                                <p>A partir de</p>
                                <strong>R$ 89.900</strong>
                                <a href="../View/compraUsuario.php"><button onclick="reservar('Lua')">Reservar <i class="fa-solid fa-arrow-right"></i></button></a>
                            </div>
                        </article>
    
                        <!-- Card Marte -->
                        <article class="card">
                            <img src="../img/marte.jpg" alt="Marte">
                            <div class="card-info">
                                <h3>Marte</h3>
                                <p>A partir de</p>
                                <strong>R$ 499.900</strong>
                                <a href="../View/compraUsuario.php"><button onclick="reservar('Marte')">Reservar <i class="fa-solid fa-arrow-right"></i></button></a>
                            </div>
                        </article>
    
                        <!-- Card Estação Espacial -->
                        <article class="card">
                            <img src="../img/estacao.jpg" alt="Estação Espacial">
                            <div class="card-info">
                                <h3>Estação Espacial</h3>
                                <p>A partir de</p>
                                <strong>R$ 129.900</strong>
                                <a href="../View/compraUsuario.php"><button onclick="reservar('Estação Espacial')">Reservar<i class="fa-solid fa-arrow-right"></i></button></a>
                            </div>
                        </article>
                    </div>
                </section>
    
                <!-- Sidebar Lateral: Minha Conta & Card de Próxima Viagem -->
                <aside class="lateral">
                    <div class="painel">
                        <h2>Minha Conta</h2>
                        <div class="linha"></div>
    
                        <div class="dados-usuario">
                            <div class="avatar grande">
                                <i class="fa-solid fa-user-astronaut"></i>
                            </div>
                            <div>
                                <h3><?php echo $nome; ?></h3>
                                <p><?php echo $login; ?></p>
                            </div>
                        </div>
                    </div>
    
                    <!-- CARD DINÂMICO: Exibe a última viagem do banco de dados caso exista -->
                    <div class="card-resumo" style="background-color: #161922; border: 1px solid #282c37; border-radius: 12px; padding: 20px; margin-top: 15px; color: #fff;">
                        <h3 style="font-size: 1.1rem; color: #fff; margin-bottom: 15px; display: flex; align-items: center; gap: 8px;">
                            Próxima Viagem
                        </h3>

                        <?php if ($ultimaCompra): ?>
                            <!-- Bloco exibido quando há uma viagem cadastrada -->
                            <div style="display: flex; flex-direction: column; gap: 12px;">
                                <!-- Nome do Destino e Status -->
                                <div style="display: flex; align-items: center; gap: 12px; background: #0e1017; padding: 10px 14px; border-radius: 8px; border: 1px solid #232733;">
                                    <i class="fa-solid fa-rocket" style="color: #ff5e00; font-size: 1.2rem;"></i>
                                    <div>
                                        <strong style="display: block; font-size: 1rem; color: #fff;">
                                            <?php echo htmlspecialchars($ultimaCompra['localViagem']); ?>
                                        </strong>
                                        <span style="color: #00ff88; font-size: 0.75rem; font-weight: 500;">
                                            ● Embarque confirmado
                                        </span>
                                    </div>
                                </div>

                                <!-- Informações de Valor e Forma de Pagamento -->
                                <div style="font-size: 0.85rem; color: #a0a5b5; display: flex; flex-direction: column; gap: 4px; padding: 0 4px;">
                                    <p style="margin: 0;">
                                        <strong style="color: #8a8f9d;">Valor:</strong> 
                                        <span style="color: #ff5e00; font-weight: 600;">R$ <?php echo number_format($ultimaCompra['valor'], 2, ',', '.'); ?></span>
                                    </p>
                                    <p style="margin: 0;">
                                        <strong style="color: #8a8f9d;">Pagamento:</strong> 
                                        <span style="color: #fff;"><?php echo htmlspecialchars($ultimaCompra['pagamento']); ?></span>
                                    </p>
                                </div>

                                <!-- Link direto para a página de reservas -->
                                <a href="minhasReservas.php" style="display: flex; align-items: center; justify-content: center; gap: 8px; background-color: #232733; color: #fff; text-decoration: none; padding: 10px; border-radius: 8px; font-size: 0.85rem; font-weight: 500; margin-top: 5px; transition: 0.3s; border: 1px solid #323746;">
                                    <i class="fa-regular fa-calendar"></i> Ver reserva
                                </a>
                            </div>

                        <?php else: ?>
                            <!-- Bloco alternativo para usuários novos sem viagens -->
                            <div style="text-align: center; padding: 10px 0;">
                                <p style="font-size: 0.85rem; color: #8a8f9d; margin-bottom: 12px;">Nenhuma viagem agendada.</p>
                                <a href="../View/compraUsuario.php" style="display: inline-block; background-color: #ff5e00; color: #fff; text-decoration: none; padding: 8px 16px; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">
                                    Garantir Passagem
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </aside>
            </div>
    
            <!-- Rodapé de Diferenciais/Benefícios -->
            <section class="beneficios">
                <div class="titulo-beneficios">
                    <span></span>
                    <h2>Por que viajar com a StarLine?</h2>
                    <span></span>
                </div>
    
                <div class="beneficios-grid">
                    <div class="beneficio">
                        <i class="fa-solid fa-shield-halved"></i>
                        <div>
                            <h3>Máxima Segurança</h3>
                            <p>Tecnologia e protocolos de segurança avançados.</p>
                        </div>
                    </div>
    
                    <div class="beneficio">
                        <i class="fa-solid fa-chair"></i>
                        <div>
                            <h3>Conforto Premium</h3>
                            <p>Cabines espaçosas e experiência única.</p>
                        </div>
                    </div>
    
                    <div class="beneficio">
                        <i class="fa-solid fa-rocket"></i>
                        <div>
                            <h3>Tecnologia Avançada</h3>
                            <p>Naves modernas e alta performance.</p>
                        </div>
                    </div>
    
                    <div class="beneficio">
                        <i class="fa-regular fa-star"></i>
                        <div>
                            <h3>Experiências Únicas</h3>
                            <p>Momentos que você levará para sempre.</p>
                        </div>
                    </div>
                </div>
            </section>
    
            <!-- Rodapé Institucional -->
            <footer>
                © 2026 StarLine Agência Espacial. Todos os direitos reservados.
            </footer>
        </main>
    
        <!-- JS com as interações de clique dos botões e navegação -->
        <script src="../js/menuUsuario.js"></script>
    </body>
</html>