<?php
    namespace Projeto\starline\View;

    // Iniciando a sessão para ter acesso aos dados do usuário logado
    session_start();

    // Trava de segurança: se a sessão não tiver o ID do usuário, redireciona para a tela de login
    if (!isset($_SESSION['id_usuarios'])) 
    {
        header("Location: ../index.php");
        exit();
    }

    // Resgatando as informações da sessão para usar no topo da página e nos formulários
    $nome = $_SESSION['nome'] ?? '';
    $login = $_SESSION['login'] ?? '';
    $id_usuarios = $_SESSION['id_usuarios'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StarLine - Efetuar Compra</title>
    <!-- CSS exclusivo desta página de compras -->
    <link rel="stylesheet" href="../css/compraUsuario.css">
    <!-- Biblioteca FontAwesome para ícones do sistema -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Importação da fonte Poppins do Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
    <body>
        <!-- Menu Lateral de Navegação (Sidebar) -->
        <aside class="sidebar">
            <div class="logo-area">
                <img src="../img/logo.png" alt="StarLine">
            </div>
            <nav class="menu">
                <a href="../View/menuUsuario.php" class="menu-item"><i class="fa-solid fa-house"></i><span>Início</span></a>
                <a href="../View/destinosUsuario.php" class="menu-item"><i class="fa-solid fa-earth-americas"></i><span>Destinos</span></a>
                <a href="../View/minhasReservas.php" class="menu-item"><i class="fa-regular fa-calendar"></i><span>Minhas Reservas</span></a>
                <a href="../View/compraUsuario.php" class="menu-item ativo"><i class="fa-solid fa-cart-shopping"></i><span>Compras</span></a>
                <a href="../View/perfilUsuario.php" class="menu-item"><i class="fa-regular fa-user"></i><span>Perfil</span></a>
            </nav>
            <!-- Botão de Sair que encerra o fluxo e retorna ao login -->
            <div class="menu-final">
                <a href="../index.php" class="menu-item">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Sair</span>
                </a>
            </div>
        </aside>
        <!-- Conteúdo Principal do Painel -->
        <main class="conteudo">
            <!-- Cabeçalho com o nome do usuário vindo da Session -->
            <header class="topo">
                <div>
                    <h1>Nova Compra</h1>
                    <p>Escolha seu destino e finalize sua viagem.</p>
                </div>
                <div class="usuario">
                    <div class="avatar">
                        <i class="fa-solid fa-user-astronaut"></i>
                    </div>
                    <strong><?php echo $nome; ?></strong>
                    <i class="fa-solid fa-chevron-down"></i>
                </div>
            </header>
            <div class="area-compra">
                <!-- Formulário principal enviando os dados da compra via POST para o DAO -->
                <form id="formCompra" action="../DAO/processarCompra.php" method="POST">
                    <section class="formulario">
                        <!-- Seleção de Destinos -->
                        <div class="etapa">
                            <h2><span>1</span> Escolha seu destino</h2>
                            <div class="destinos">
                                <!-- Cada card chama a função JS 'selecionarDestino' passando seus dados de preço e imagem -->
                                <div class="destino" onclick="selecionarDestino(this, 'Lua', 89900, '../img/lua.jpg')">
                                    <img src="../img/lua.jpg" alt="Lua">
                                    <div class="destino-info">
                                        <h3>Lua</h3>
                                        <p>A partir de</p>
                                        <strong>R$ 89.900,00</strong>
                                        <button type="button">Selecionar</button>
                                    </div>
                                </div>
                                <!-- Marte vem pré-selecionado por padrão -->
                                <div class="destino selecionado" onclick="selecionarDestino(this, 'Marte', 499900, '../img/marte.jpg')">
                                    <img src="../img/marte.jpg" alt="Marte">
                                    <div class="destino-info">
                                        <h3>Marte</h3>
                                        <p>A partir de</p>
                                        <strong>R$ 499.900,00</strong>
                                        <button type="button">Selecionado</button>
                                    </div>
                                </div>
                                <div class="destino" onclick="selecionarDestino(this, 'Estação Espacial', 129900, '../img/estacao.jpg')">
                                    <img src="../img/estacao.jpg" alt="Estação Espacial">
                                    <div class="destino-info">
                                        <h3>Estação Espacial</h3>
                                        <p>A partir de</p>
                                        <strong>R$ 129.900,00</strong>
                                        <button type="button">Selecionar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Exibição Dinâmica do Valor -->
                        <div class="etapa">
                            <h2><span>2</span> Valor da Viagem</h2>
                            <div class="detalhes">
                                <div class="campo">
                                    <i class="fa-solid fa-money-bill-wave"></i>
                                    <div>
                                        <small>Valor Selecionado</small>
                                        <p id="exibicaoValor">R$ 499.900,00</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Escolha do Método de Pagamento -->
                        <div class="etapa">
                            <h2><span>3</span> Forma de pagamento</h2>
                            <div class="pagamentos">
                                <label class="pagamento selecionado">
                                    <input type="radio" name="pagamento" value="Pix" checked>
                                    <i class="fa-brands fa-pix"></i>
                                    <span>Pix</span>
                                </label>
                                <label class="pagamento">
                                    <input type="radio" name="pagamento" value="Cartão">
                                    <i class="fa-regular fa-credit-card"></i>
                                    <span>Cartão de Crédito</span>
                                </label>
                                <label class="pagamento">
                                    <input type="radio" name="pagamento" value="Boleto">
                                    <i class="fa-solid fa-barcode"></i>
                                    <span>Boleto Bancário</span>
                                </label>
                            </div>
                            <!-- Inputs Ocultos: O JavaScript atualiza estes valores antes do envio -->
                            <input type="hidden" id="campoLocal" name="localViagem" value="Marte">
                            <input type="hidden" id="campoValor" name="valor" value="499900">
                            
                            <!-- Passamos a FK do usuário diretamente na requisição POST -->
                            <input type="hidden" name="id_usuarios" value="<?php echo $id_usuarios; ?>">

                            <!-- Botão que envia o formulário para processamento -->
                            <button type="submit" class="btn-confirmar">
                                Confirmar Compra <i class="fa-solid fa-lock"></i>
                            </button>
                        </div>
                    </section>
                </form>
                <!-- Painel Lateral: Resumo em Tempo Real da Compra -->
                <aside class="resumo">
                    <div class="painel">
                        <h2>Resumo da compra</h2>
                        <div class="resumo-destino">
                            <img id="imagemDestino" src="../img/marte.jpg" alt="Marte">
                            <div>
                                <h3 id="nomeDestino">Marte</h3>
                                <p>Viagem Espacial StarLine</p>
                            </div>
                        </div>
                        <div class="linha"></div>
                        <div class="resumo-linha total">
                            <strong>Total</strong>
                            <strong id="valorTotal">R$ 499.900,00</strong>
                        </div>
                        <div class="aviso">
                            <i class="fa-solid fa-circle-info"></i>
                            <p>Você poderá acompanhar sua compra na seção <strong>Minhas Reservas.</strong></p>
                        </div>
                    </div>  
                    <!-- Card Informativo sobre Segurança -->
                    <div class="painel seguranca">
                        <i class="fa-solid fa-shield-halved"></i>
                        <div>
                            <h3>Segurança StarLine</h3>
                            <p>Seus dados e pagamentos estão protegidos.</p>
                        </div>
                    </div>
                </aside>
            </div>
            <!-- Rodapé do sistema -->
            <footer>
                © 2026 StarLine Agência Espacial. Todos os direitos reservados.
            </footer>
        </main>
        <!-- Arquivo JS responsável pelas trocas de destino e valores dinâmicos -->
        <script src="../js/compraUsuario.js"></script>
    </body>
</html>