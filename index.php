<?php
    namespace Projeto\starline;

    // Variável para controlar se houve erro de autenticação
    $erro = false;

    // Verifica se o parâmetro 'erro' foi enviado via URL (ex: index.php?erro=1)
    // Isso acontece quando o arquivo validarLogin.php recusa as credenciais do usuário
    if (isset($_GET["erro"])) 
    {
        $erro = true;
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Starline - Login</title>    
    <!-- Ícone da aba do navegador -->
    <link rel="icon" type="image/png" sizes="64x64" href="img/logo.png">
    <!-- CSS com os estilos específicos da tela de login -->
    <link rel="stylesheet" href="css/login.css">
    <!-- Importação de fontes e ícones (Poppins e Font Awesome) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
    <body>
        <!-- Overlay escuro/translúcido de fundo -->
        <div class="overlay">
            <!-- Box Central do Formulário -->
            <div class="login-box">
                <img src="img/logo.png" class="logo" alt="Logo Starline">
                <h1>Bem-vindo!</h1>
                <p>Acesse sua conta para continuar</p>
                <?php
                    // Se a variável $erro for true, exibe a mensagem de aviso estilizada
                    if ($erro) 
                    {
                        ?>
                            <div style=" background: #ff4d4d; color: white; padding: 10px; border-radius: 8px; margin-bottom: 15px; text-align: center;">
                                Login ou senha incorretos!
                            </div>
                        <?php
                    }
                ?>
                <!-- Formulário de login enviado via POST para o arquivo de validação -->
                <form action="DAO/validarLogin.php" method="POST">
                    <!-- Campo de Usuário/Login -->
                    <div class="input-box">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" name="login" id="login" placeholder="Login" required>
                    </div>
                    <!-- Campo de Senha com Ícone para Alternar Visibilidade -->
                    <div class="input-box">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="senha" id="senha" placeholder="Senha" required>
                        <!-- Ícone acionado pelo JS para exibir/ocultar a senha -->
                        <i class="fa-solid fa-eye eye" id="mostrarSenha"></i>
                    </div>
                    <!-- Botão de submissão do formulário -->
                    <button type="submit">
                        Entrar
                    </button>
                </form>
                <!-- Link de navegação para novos usuários cadastram-se -->
                <span>
                    Ainda não possui conta?
                    <a href="View/cadastro.php">Cadastre-se</a>
                </span>
            </div>
        </div>
        <!-- Script JS para interatividade (ex: alternar o olho da senha) -->
        <script src="js/login.js"></script>
    </body>
</html>