<?php
    namespace Projeto\starline\View;
    session_start();
    // Redireciona para o login se a sessão não existir
    if (!isset($_SESSION['login'])) 
    {
        header('Location: ../index.php');
        exit();
    }
    $nome = $_SESSION['nome'] ?? '';
    $cpf = $_SESSION['cpf'] ?? '';
    $dataNascimento = $_SESSION['dataNascimento'] ?? '';
    $telefone = $_SESSION['telefone'] ?? '';
    $login = $_SESSION['login'] ?? '';
    $senha = $_SESSION['senha'] ?? '';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StarLine - Perfil</title>
    <link rel="stylesheet" href="../css/perfilUsuario.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
    <body>
        <aside class="sidebar">
            <div class="logo"><img src="../img/logo.png" alt="StarLine"></div>
            <nav class="menu">
                <a href="../View/menuUsuario.php" class="menu-item"><i class="fa-solid fa-house"></i><span>Início</span></a>
                <a href="../View/destinosUsuario.php" class="menu-item"><i class="fa-solid fa-earth-americas"></i><span>Destinos</span></a>
                <a href="../View/minhasReservas.php" class="menu-item"><i class="fa-regular fa-calendar"></i><span>Minhas Reservas</span></a>
                <a href="../View/compraUsuario.php" class="menu-item"><i class="fa-solid fa-cart-shopping"></i><span>Compras</span></a>
                <a href="../View/perfilUsuario.php" class="menu-item ativo"><i class="fa-regular fa-user"></i><span>Perfil</span></a>
            </nav>
            <div class="sair">
                <a href="../index.php" class="menu-item"><i class="fa-solid fa-right-from-bracket"></i><span>Sair</span></a>
            </div>
        </aside>
        <main class="conteudo">
            <header class="topo">
                <div>
                    <h1>Meu Perfil</h1>
                    <p>Atualize seus dados cadastrais.</p>
                </div>
                <div class="usuario">
                    <div class="avatar">
                        <i class="fa-solid fa-user-astronaut"></i>
                    </div>
                    <strong>
                        <?php echo htmlspecialchars($nome); ?>
                    </strong>
                    <i class="fa-solid fa-chevron-down"></i>
                </div>
            </header>
            <section class="perfil">
                <div class="titulo">
                    <i class="fa-regular fa-user"></i>
                    <div>
                        <h2>Dados da conta</h2>
                        <p>Altere suas informações quando quiser.</p>
                    </div>
                </div>
                <form id="formPerfil">
                    <div class="linha">
                        <div class="campo">
                            <label>Nome Completo</label>
                            <div class="input">
                                <i class="fa-solid fa-user"></i>
                                <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>" required>
                            </div>
                        </div>
                        <div class="campo">
                            <label>CPF</label>
                            <div class="input">
                                <i class="fa-solid fa-id-card"></i>
                                <input type="text" id="cpf" name="cpf" value="<?php echo htmlspecialchars($cpf); ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="linha">
                        <div class="campo">
                            <label>Data de Nascimento</label>
                            <div class="input">
                                <i class="fa-solid fa-calendar"></i>
                                <input type="date" id="dataNascimento" name="dataNascimento" value="<?php echo htmlspecialchars($dataNascimento); ?>" required>
                            </div>
                        </div>
                        <div class="campo">
                            <label>Telefone</label>
                            <div class="input">
                                <i class="fa-solid fa-phone"></i>
                                <input type="text" id="telefone" name="telefone" value="<?php echo htmlspecialchars($telefone); ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="campo">
                        <label>Login / E-mail</label>
                        <div class="input">
                            <i class="fa-solid fa-envelope"></i>
                            <input type="text" id="login" name="login" value="<?php echo htmlspecialchars($login); ?>" required>
                        </div>
                    </div>
                    <div class="campo">
                        <label>Senha</label>
                        <div class="input">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" id="senha" name="senha" value="<?php echo htmlspecialchars($senha); ?>" required>
                            <i class="fa-solid fa-eye olho" id="mostrarSenha"></i>
                        </div>
                    </div>
                    <button type="submit">
                        <i class="fa-solid fa-check"></i>
                        Atualizar Cadastro
                    </button>
                    <p id="mensagem" style="margin-top: 15px; font-weight: 500; text-align: center;"></p>
                </form>
            </section>
            <footer>
                © 2026 StarLine Agência Espacial. Todos os direitos reservados.
            </footer>
        </main>
        <div id="modalSucesso" class="modal-overlay" style="display: none;">
            <div class="modal-content">
                <div class="modal-icon">
                    <i class="fa-solid fa-check"></i>
                </div>
                <h2>Cadastro Atualizado! 🚀</h2>
                <p>Seus dados foram alterados com sucesso no sistema.</p>
                <button type="button" id="btnFecharModal">Ir para o Menu</button>
            </div>
        </div>
        <script src="../js/perfilUsuario.js"></script>
    </body>
</html>