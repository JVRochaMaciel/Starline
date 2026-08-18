<?php
    namespace Projeto\starline\View;
    // Inclui os arquivos necessários para conexão e cadastro do usuário
    require_once("../DAO/conexao.php");
    require_once("../DAO/cadastrarUsuario.php");
    // Importa as classes utilizadas
    use Projeto\starline\DAO\Conexao;
    use Projeto\starline\DAO\CadastrarUsuario;
    // Cria a conexão com o banco de dados
    $conexao = new Conexao();
    // Cria o objeto responsável pelo cadastro
    $cadastrar = new CadastrarUsuario();
    // Controla a exibição do modal de sucesso
    $sucesso = false;
    // Verifica se o formulário foi enviado
    if(isset($_POST['nome']))
    {
        // Recebe os dados enviados pelo formulário
        $nome = $_POST['nome'] ?? '';
        $cpf = $_POST['cpf'] ?? '';
        $telefone = $_POST['telefone'] ?? ''; 
        $login = $_POST['login'] ?? '';
        $senha = $_POST['senha'] ?? '';
        $dataNascimento = $_POST['dataNascimento'] ?? '';
        // Realiza o cadastro do usuário no banco de dados
        $mensagem = $cadastrar->cadastrarUsuario($conexao, $nome, $cpf, $telefone, $login, $senha, $dataNascimento);
        // Verifica se o cadastro foi realizado com sucesso
        if($mensagem == "cadastrado")
        {
            $sucesso = true;
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <!-- Configurações básicas da página -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Título da página -->
    <title>Starline - Cadastro de Usuário</title>
    <!-- Arquivo CSS da página -->
    <link rel="stylesheet" href="../css/cadastro.css">
    <!-- Fonte Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Biblioteca de ícones Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
    <body>
        <!-- Área de sobreposição da tela de cadastro -->
        <div class="overlay">
            <!-- Caixa principal do cadastro -->
            <div class="cadastro-box">
                <!-- Logo da StarLine -->
                <img src="../img/logo.png" class="logo" alt="Logo StarLine">
                <!-- Título e descrição -->
                <h1>Criar Conta</h1>
                <p>Preencha seus dados para realizar o cadastro.</p>
                <!-- Formulário de cadastro -->
                <form method="POST">
                    <!-- Nome e CPF -->
                    <div class="duplo">
                        <div class="input-box">
                            <!-- Ícone do nome -->
                            <i class="fa-solid fa-user"></i>
                            <!-- Campo para nome -->
                            <input type="text" name="nome" placeholder="Nome Completo" required>
                        </div>
                        <div class="input-box">
                            <!-- Ícone do CPF -->
                            <i class="fa-solid fa-id-card"></i>
                            <!-- Campo para CPF -->
                            <input type="text" name="cpf" placeholder="CPF" maxlength="14" required>
                        </div>
                    </div>
                    <!-- Data de nascimento e telefone -->
                    <div class="duplo">
                        <div class="input-box">
                            <!-- Ícone da data -->
                            <i class="fa-solid fa-calendar"></i>
                            <!-- Campo para data de nascimento -->
                            <input type="date" name="dataNascimento" required>
                        </div>
                        <div class="input-box">
                            <!-- Ícone do telefone -->
                            <i class="fa-solid fa-phone"></i>
                            <!-- Campo para telefone -->
                            <input type="tel" name="telefone" placeholder="Telefone" maxlength="15" required>
                        </div>
                    </div>
                    <!-- Campo de login -->
                    <div class="input-box">
                        <!-- Ícone do e-mail -->
                        <i class="fa-solid fa-envelope"></i>
                        <!-- Campo para login ou e-mail -->
                        <input type="text" name="login" placeholder="Login / E-mail" required>
                    </div>
                    <!-- Campo de senha -->
                    <div class="input-box">
                        <!-- Ícone da senha -->
                        <i class="fa-solid fa-lock"></i>
                        <!-- Campo para senha -->
                        <input id="senha" type="password" name="senha" placeholder="Senha" required>
                        <!-- Botão/ícone para mostrar a senha -->
                        <i class="fa-solid fa-eye eye"id="mostrarSenha"></i>
                    </div>
                    <!-- Botão para enviar o cadastro -->
                    <button type="submit">
                        Cadastrar
                    </button>
                </form>
                <!-- Link para voltar para o login -->
                <span>
                    Já possui uma conta?
                    <a href="../index.php">
                        Entrar
                    </a>
                </span>
            </div>
        </div>
        <!-- Modal de sucesso -->
        <!-- Só será exibido quando $sucesso for true -->
        <div id="modalSucesso" class="modal-overlay" style="display: <?php echo $sucesso ? 'flex' : 'none'; ?>;">
            <!-- Conteúdo do modal -->
            <div class="modal-content">
                <!-- Ícone de sucesso -->
                <div class="modal-icon">
                    <i class="fa-solid fa-check"></i>
                </div>
                <!-- Mensagem de sucesso -->
                <h2>
                    Conta Criada! 🚀
                </h2>
                <p>
                    Seu cadastro foi realizado com sucesso.
                </p>
                <!-- Botão para ir para o login -->
                <button type="button" id="btnIrLogin">
                    Fazer Login
                </button>
            </div>
        </div>
        <!-- Arquivo JavaScript da página -->
        <script src="../js/cadastro.js"></script>
    </body>
</html>