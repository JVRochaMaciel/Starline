<?php
    namespace Projeto\starline\View;
    require_once('../DAO/conexao.php');
    require_once('../DAO/listarComprasPorUsuario.php');
    use Projeto\starline\DAO\Conexao;
    use Projeto\starline\DAO\ListarComprasPorUsuario;
    session_start();
    // Pega o ID do usuário logado
    $id_usuario = $_SESSION['id_usuarios'] ?? '';
    $nome = $_SESSION['nome'] ?? '';
    // Instancia as classes
    $conexao = new Conexao();
    $listar = new ListarComprasPorUsuario();
    $ultimaCompra = $listar->ultimaCompra($conexao, $id_usuario);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StarLine - Minhas Reservas</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../css/reservasUsuario.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
    <body>
     <!-- ========================================SIDEBAR========================================= -->
        <aside class="sidebar">
            <!-- LOGO -->
            <div class="logo">
                <img src="../img/logo.png" alt="StarLine">
            </div>
            <!-- MENU -->
            <nav class="menu">
                <a href="../View/menuUsuario.php"class="menu-item"><i class="fa-solid fa-house"></i><span>Início</span></a>
                <a href="../View/destinosUsuario.php" class="menu-item"><i class="fa-solid fa-earth-americas"></i><span>Destinos</span></a>
                <a href="../View/reservasUsuario.php" class="menu-item ativo"><i class="fa-regular fa-calendar"></i><span>Minhas Reservas</span></a>
                <a href="../View/compraUsuario.php" class="menu-item"><i class="fa-solid fa-cart-shopping"></i><span>Compras</span></a>
                <a href="../View/perfilUsuario.php" class="menu-item"><i class="fa-regular fa-user"></i><span>Perfil</span></a>
            </nav>
            <!-- SAIR -->
            <div class="sair">
                <a href="../index.php"class="menu-item"><i class="fa-solid fa-right-from-bracket"></i><span>Sair</span></a>
            </div>
        </aside>
        <!-- ========================================CONTEÚDO PRINCIPAL========================================= -->
        <main class="conteudo">
            <!-- ========================================TOPO========================================= -->
            <header class="topo">
                <div>
                    <h1>Minhas Reservas</h1>
                    <p>
                        Confira todas as suas compras e viagens.
                    </p>
                </div>
                <!-- USUÁRIO -->
                <div class="usuario">
                    <div class="avatar">
                        <i class="fa-solid fa-user-astronaut"></i>
                    </div>
                    <strong><?php echo $nome; ?></strong>
                    <i class="fa-solid fa-chevron-down"></i>
                </div>
            </header>
            <!-- ========================================RESUMO========================================= -->
        <section class="resumo">
            <?php if ($ultimaCompra !== null): ?>
                <div class="resumo-card">
                    <i class="fa-solid fa-rocket"></i>
                    <div>
                        <small>Última compra</small>
                        <strong>
                            <?php echo $ultimaCompra['localViagem']; ?>
                        </strong>
                        <span>
                            Código #<?php echo $ultimaCompra['id_compras']; ?>
                        </span>
                    </div>
                </div>
                <div class="resumo-card">
                    <i class="fa-solid fa-wallet"></i>
                    <div>
                        <small>Valor da última compra</small>
                        <strong>
                            R$
                            <?php
                            echo number_format(
                                $ultimaCompra['valor'],
                                2,
                                ',',
                                '.'
                            );
                            ?>
                        </strong>
                        <span>
                            <?php echo $ultimaCompra['pagamento']; ?>
                        </span>
                    </div>
                </div>
                <div class="resumo-card">
                    <i class="fa-solid fa-circle-check"></i>
                    <div>
                        <small>Status da última compra</small>
                        <strong>
                            <?php echo $ultimaCompra['statu']; ?>
                        </strong>
                        <span>
                            Compra #<?php echo $ultimaCompra['id_compras']; ?>
                        </span>
                    </div>
                </div>
            <?php else: ?>
                <div class="resumo-card">
                    <i class="fa-solid fa-rocket"></i>
                    <div>
                        <small>Última compra</small>
                        <strong>Nenhuma</strong>
                        <span>Você ainda não realizou uma compra</span>
                    </div>
                </div>
                <div class="resumo-card">
                    <i class="fa-solid fa-wallet"></i>
                    <div>
                        <small>Valor</small>
                        <strong>R$ 0,00</strong>
                        <span>Nenhuma compra realizada</span>
                    </div>
                </div>
                <div class="resumo-card">
                    <i class="fa-solid fa-circle-info"></i>
                    <div>
                        <small>Status</small>
                        <strong>Sem compras</strong>
                        <span>Explore nossos destinos</span>
                    </div>
                </div>
            <?php endif; ?>
        </section>
        <!-- ========================================FILTROS========================================= -->
            <div class="filtros">
                <button class="filtro ativo" type="button">Todas</button>
                <button class="filtro" type="button">Ativas</button>
                <button class="filtro" type="button">Canceladas</button>
            </div>
            <!-- ========================================COMPRAS========================================= -->
            <section class="compras">
                <!-- CABEÇALHO DA LISTA -->
                <div class="cabecalho-compra">
                    <span>Compra</span>
                    <span>Local da Viagem</span>
                    <span>Valor</span>
                    <span>Pagamento</span>
                    <span>Status</span>
                </div>
                <!--A DAO vai buscar as compras no banco e criar os cards automaticamente.Se não houver nenhuma compra,ele mostrará a mensagem de "nenhuma compra".-->
                <?php
                    echo $listar->listar($conexao, $id_usuario);
                ?>
            </section>
            <!-- ========================================FOOTER========================================= -->
            <footer>
                © 2026 StarLine Agência Espacial.
                Todos os direitos reservados.
            </footer>
        </main>
        <!-- JAVASCRIPT -->
        <script src="../js/reservasUsuario.js"></script>
    </body>
</html>