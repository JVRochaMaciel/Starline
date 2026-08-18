<?php
    namespace Projeto\starline\View;

    // Inicia a sessão para conseguir acessar os dados do administrador.
    session_start();

    // Importa os arquivos necessários para trabalhar com o administrador.
    require_once("../DAO/conexao.php");
    require_once("../Model/adm.php");
    require_once("../Control/admControl.php");

    use Projeto\starline\Model\Adm;
    use Projeto\starline\Control\ControlAdm;

    // Pega os dados do administrador que estão salvos na sessão.
    $id_adm = $_SESSION['id_adm'] ?? '';
    $nome = $_SESSION['nomeAdm'] ?? '';
    $login = $_SESSION['loginAdm'] ?? '';
    $senha = $_SESSION['senhaAdm'] ?? '';

    // Variáveis usadas para mostrar mensagens na tela.
    $mensagem = "";
    $sucesso  = false;

    // Verifica se o formulário foi enviado.
    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        // Pega os novos dados enviados pelo formulário.
        $nomeForm  = $_POST['nome'] ?? '';
        $loginForm = $_POST['login'] ?? '';
        $senhaForm = $_POST['senha'] ?? '';

        // Cria o objeto ADM com os dados atualizados.
        $admModel = new Adm($id_adm, $nomeForm, $loginForm, $senhaForm);

        // Cria o controle responsável por atualizar o ADM.
        $controlAdm = new ControlAdm($admModel);

        // Tenta atualizar os dados no banco.
        if ($controlAdm->atualizarTudo($nomeForm, $loginForm, $senhaForm)) 
        {
            // Atualiza os dados do administrador na sessão.
            $_SESSION['nomeAdm']  = $nomeForm;
            $_SESSION['loginAdm'] = $loginForm;
            $_SESSION['senhaAdm'] = $senhaForm;

            // Atualiza também as variáveis usadas na página.
            $nome  = $nomeForm;
            $login = $loginForm;
            $senha = $senhaForm;

            // Indica que a atualização foi realizada com sucesso.
            $sucesso = true;
        } 
        else 
        {
            // Mostra uma mensagem caso a atualização dê errado.
            $mensagem = "Erro ao atualizar os dados.";
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StarLine - Perfil ADM</title>
    <link rel="stylesheet" href="../css/perfilAdm.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
    <body>
        <main class="conteudo">
            <!-- Cabeçalho da página -->
            <header class="topo">
                <div>
                    <h1>Meu Perfil</h1>
                    <p>Atualize seus dados administrativos.</p>
                </div>
                <!-- Botão para voltar ao menu administrativo -->
                <a href="menuAdm.php"><button class="btn-voltar" type="button" onclick="voltar()">
                    <i class="fa-solid fa-arrow-left"></i>
                    Voltar
                </button></a>
            </header>

            <section class="perfil">
                <!-- Título da área de dados do administrador -->
                <div class="perfil-topo">
                    <div class="icone">
                        <i class="fa-solid fa-user-tie"></i>
                    </div>
                    <div>
                        <h2>Dados da conta</h2>
                        <p>Altere suas informações quando quiser.</p>
                    </div>
                </div>

                <div class="linha"></div>

                <!-- Formulário responsável por enviar os dados para atualização -->
                <form id="formPerfilAdm" method="POST" action="perfilAdm.php">
                    <div class="campos">
                        <!-- Campo para alterar o nome -->
                        <div class="campo">
                            <label>Nome Completo</label>
                            <div class="input">
                                <i class="fa-solid fa-user"></i>
                                <input type="text" name="nome" value="<?php echo htmlspecialchars($nome); ?>" required>
                            </div>
                        </div>
                    </div>

                    <!-- Campo para alterar o login -->
                    <div class="campo senha">
                        <label>Login / E-mail</label>
                        <div class="input">
                            <i class="fa-solid fa-envelope"></i>
                            <input type="text" name="login" value="<?php echo htmlspecialchars($login); ?>" required>
                        </div>
                    </div>

                    <!-- Campo para alterar a senha -->
                    <div class="campo senha">
                        <label>Senha</label>
                        <div class="input">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" id="senha" name="senha" value="<?php echo htmlspecialchars($senha); ?>" required>
                            <!-- Botão que mostra ou esconde a senha -->
                            <button type="button" onclick="mostrarSenha()">
                                <i class="fa-solid fa-eye" id="iconeSenha"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Envia o formulário para atualizar o cadastro -->
                    <button type="submit" class="atualizar">
                        <i class="fa-solid fa-check"></i>
                        Atualizar Cadastro
                    </button>

                    <!-- Mostra uma mensagem de erro, caso exista -->
                    <p id="mensagem" style="margin-top: 15px; color: #ff4d4d; text-align: center; font-weight: 500;"><?php echo htmlspecialchars($mensagem); ?></p>
                </form>
            </section>

            <footer>
                © 2026 StarLine Agência Espacial. Todos os direitos reservados.
            </footer>
        </main>

        <!-- Modal exibido quando a atualização foi realizada com sucesso -->
        <div id="modalSucesso" class="modal-overlay" style="display: <?php echo $sucesso ? 'flex' : 'none'; ?>;">
            <div class="modal-content">
                <div class="modal-icon">
                    <i class="fa-solid fa-check"></i>
                </div>
                <h2>Cadastro Atualizado! 🚀</h2>
                <p>Seus dados administrativos foram alterados com sucesso.</p>
                <button type="button" id="btnFecharModal">Voltar</button>
            </div>
        </div>

        <!-- JavaScript responsável pelas funções da página -->
        <script src="../js/perfilAdm.js"></script>
    </body>
</html>