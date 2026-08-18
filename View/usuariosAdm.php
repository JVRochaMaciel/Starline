<?php
    // Define o namespace desta página
    namespace Projeto\starline\View;

    // Inicia a sessão caso ela ainda não esteja iniciada
    if (session_status() === PHP_SESSION_NONE)
    {
        session_start();
    }

    // Importa os arquivos necessários para conexão e consulta dos usuários
    require_once '../DAO/conexao.php';
    require_once '../DAO/consultarUsuario.php';

    // Importa as classes utilizadas
    use Projeto\starline\DAO\Conexao;
    use Projeto\starline\DAO\ConsultarUsuario;

    // Pega o nome e o login do administrador que está logado
    $nome  = $_SESSION['nomeAdm'] ?? '';
    $login = $_SESSION['loginAdm'] ?? '';

    // Cria a conexão com o banco de dados
    $conexao = new Conexao();

    // Cria o objeto responsável por consultar os usuários
    $consultarUsuario = new ConsultarUsuario();

    // Busca todos os usuários cadastrados
    $usuarios = $consultarUsuario->listarUsuarios($conexao);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <!-- Faz a página se adaptar a diferentes tamanhos de tela -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StarLine - Usuários</title>
    <!-- CSS específico da página -->
    <link rel="stylesheet" href="../css/usuarioAdm.css">
    <!-- Biblioteca de ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Fontes utilizadas no site -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
    <body>
        <!-- Cabeçalho da página -->
        <header class="topo">
            <!-- Logo do sistema -->
            <div class="logo">
                <img src="../img/logo.png" alt="StarLine">
            </div>
            <!-- Título e descrição da página -->
            <div class="titulo">
                <h1>Usuários</h1>
                <p>Gerencie os usuários cadastrados no sistema.</p>
            </div>
            <!-- Informações do administrador logado -->
            <div class="admin">
                <!-- Ícone do administrador -->
                <div class="avatar">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
                <div>
                    <!-- Mostra o nome do administrador -->
                    <strong><?php echo $nome; ?></strong>
                    <!-- Mostra o login do administrador -->
                    <small><?php echo $login; ?></small>
                </div>
            </div>
        </header>
        <!-- Conteúdo principal da página -->
        <main class="conteudo">
            <!-- Cabeçalho da área de usuários -->
            <div class="cabecalho">
                <div>
                    <h2>Usuários cadastrados</h2>
                    <p>Consulte e atualize os dados dos usuários.</p>
                </div>
                <!-- Botão para voltar ao menu administrativo -->
                <div class="acoes-topo">
                    <a href="../View/menuAdm.php" class="voltar">
                        <i class="fa-solid fa-arrow-left"></i>
                        Voltar
                    </a>
                </div>
            </div>
            <!-- Tabela que mostra os usuários cadastrados -->
            <section class="tabela">
                <table>
                    <!-- Cabeçalho da tabela -->
                    <thead>
                        <tr>
                            <th>N° Usuários</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Telefone</th>
                            <th>Login</th>
                            <th>Data Nasc.</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    <!-- Verifica se existem usuários cadastrados -->
                    <?php if (count($usuarios) > 0): ?>
                        <!-- Percorre todos os usuários encontrados -->
                        <?php foreach ($usuarios as $dados): ?>
                            <!-- Cada linha representa um usuário -->
                            <tr data-id="<?php echo $dados['id_usuarios']; ?>">
                                <!-- ID do usuário -->
                                <td>
                                    <?php echo $dados['id_usuarios']; ?>
                                </td>
                                <!-- Nome do usuário -->
                                <td>
                                    <?php echo $dados['nome']; ?>
                                </td>
                                <!-- CPF do usuário -->
                                <td>
                                    <?php echo $dados['cpf']; ?>
                                </td>
                                <!-- Telefone do usuário -->
                                <td>
                                    <?php echo $dados['telefone']; ?>
                                </td>
                                <!-- Login do usuário -->
                                <td>
                                    <?php echo $dados['login']; ?>
                                </td>
                                <!-- Data de nascimento -->
                                <td>
                                    <?php echo $dados['dataNascimento']; ?>
                                </td>
                                <!-- Mostra o status atual do usuário -->
                                <td>
                                    <!-- Se o status for Ativo, mostra a classe ativo -->
                                    <?php if ($dados['statu'] === 'Ativo'): ?>
                                        <span class="ativo">
                                            Ativo
                                        </span>
                                    <!-- Caso contrário, mostra como desativado -->
                                    <?php else: ?>
                                        <span class="desativado">
                                            Desativado
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <!-- Botões de ação -->
                                <td>
                                    <!-- Botão que abre o formulário de edição -->
                                    <button
                                        class="editar"
                                        onclick="editarUsuario(<?php echo $dados['id_usuarios']; ?>)">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <!-- Caso não exista nenhum usuário -->
                    <?php else: ?>
                        <tr>
                            <td colspan="8">
                                Nenhum usuário cadastrado até o momento.
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </section>
            <!-- Formulário usado para atualizar o status do usuário -->
            <section class="formulario" id="formulario" style="display: none;">
                <!-- Título do formulário -->
                <div class="form-titulo">
                    <h2>Atualizar Status do Usuário</h2>
                    <!-- Botão para fechar o formulário -->
                    <button onclick="fecharFormulario()">
                        ×
                    </button>
                </div>
                <div class="campos">
                    <!-- ID do usuário selecionado -->
                    <div class="campo">
                        <label>ID do Usuário</label>
                        <!-- Campo somente para visualização -->
                        <input type="text" id="idUsuario" readonly>
                    </div>
                    <!-- Nome do usuário selecionado -->
                    <div class="campo">
                        <label>Nome</label>
                        <input type="text" id="nomeUsuario" readonly>
                    </div>
                    <!-- CPF do usuário selecionado -->
                    <div class="campo">
                        <label>CPF</label>
                        <input type="text" id="cpfUsuario" readonly>
                    </div>
                    <!-- Telefone do usuário selecionado -->
                    <div class="campo">
                        <label>Telefone</label>
                        <input type="text" id="telefoneUsuario" readonly>
                    </div>
                    <!-- Login do usuário selecionado -->
                    <div class="campo">
                        <label>Login</label>
                        <input type="text" id="loginUsuario" readonly>
                    </div>
                    <!-- Seleção do novo status -->
                    <div class="campo">
                        <label>Status</label>
                        <select id="statusUsuario">
                            <option value="Ativo">
                                Ativo
                            </option>
                            <option value="Desativado">
                                Desativado
                            </option>
                        </select>
                    </div>
                </div>
                <!-- Botão que chama o JavaScript para salvar o novo status -->
                <button
                    class="salvar"
                    onclick="salvarStatusUsuario()">
                    <i class="fa-solid fa-check"></i>
                    Salvar alterações
                </button>
            </section>
        </main>
        <!-- Rodapé da página -->
        <footer>
            © 2026 StarLine Agência Espacial. Todos os direitos reservados.
        </footer>
        <!-- Envia os usuários do PHP para o JavaScript -->
        <script>
            const usuarios = <?php echo json_encode($usuarios); ?>;
        </script>
        <!-- JavaScript responsável pelas ações da página -->
        <script src="../js/usuarioAdm.js"></script>
    </body>
</html>