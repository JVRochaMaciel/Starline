<?php
    // Define o namespace desta página
    namespace Projeto\starline\View;

    // Inicia a sessão caso ela ainda não esteja iniciada
    if (session_status() === PHP_SESSION_NONE) 
    {
        session_start();
    }
    // Importa os arquivos necessários para conexão, consulta, cadastro e atualização
    require_once '../DAO/conexao.php';
    require_once '../DAO/consultarPiloto.php';
    require_once '../DAO/cadastrarPiloto.php';
    require_once '../DAO/atualizarPiloto.php';
    // Importa as classes utilizadas nesta página
    use Projeto\starline\DAO\Conexao;
    use Projeto\starline\DAO\ConsultarPiloto;
    use Projeto\starline\DAO\CadastrarPiloto;
    use Projeto\starline\DAO\AtualizarPiloto;
    // Pega os dados do administrador que está logado
    $nome  = $_SESSION['nomeAdm'] ?? '';
    $login = $_SESSION['loginAdm'] ?? '';
    // Cria a conexão com o banco de dados
    $conexao = new Conexao();
    // Processa o formulário de cadastro ou atualização
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnSalvar'])) 
    {
        // Pega os dados enviados pelo formulário
        $idPiloto      = $_POST['idPiloto']      ?? '';
        $nomePiloto    = $_POST['nome']          ?? '';
        $identificacao = $_POST['identificacao'] ?? 0;
        $formacao      = $_POST['formacao']      ?? '';
        $email         = $_POST['email']         ?? '';
        $statusPiloto  = $_POST['statu']         ?? 'Ativo';

        // Verifica se os campos obrigatórios foram preenchidos
        if (!empty($nomePiloto) && !empty($identificacao) && !empty($formacao) && !empty($email)) 
        {    
            // Se houver ID, realiza a atualização do piloto
            if (!empty($idPiloto)) 
            {
                // Cria o objeto responsável pela atualização
                $atualizar = new AtualizarPiloto();
                // Guarda os dados que serão atualizados
                $dados = [
                    'nome'          => $nomePiloto,
                    'identificacao' => (int)$identificacao,
                    'formacao'      => $formacao,
                    'email'         => $email,
                    'statu'         => $statusPiloto
                ];
                // Começa considerando que a atualização deu certo
                $sucesso = true;
                // Atualiza cada campo do piloto
                foreach ($dados as $campo => $dado) 
                {
                    // Tenta atualizar o campo atual
                    $res = $atualizar->atualizarPiloto($conexao, (int)$idPiloto, $campo, $dado);
                    // Se algum campo der erro, interrompe a atualização
                    if ($res !== true) 
                    {
                        $sucesso = false;
                        break;
                    }
                }
                // Se tudo deu certo, mostra a mensagem e recarrega a página
                if ($sucesso) 
                {
                    echo "<script>alert('Piloto atualizado com sucesso!'); window.location.href='pilotosAdm.php';</script>";
                    exit;
                } 
                else 
                {
                    echo "<script>alert('Erro ao atualizar piloto.');</script>";
                }
            } 
            else 
            {

                // Se não houver ID, realiza um novo cadastro
                $cadastrar = new CadastrarPiloto();

                // Envia os dados para o cadastro
                $res = $cadastrar->cadastrarPiloto($conexao, $nomePiloto, (int)$identificacao, $formacao, $email);

                // Verifica se o cadastro foi realizado
                if ($res === "cadastrado") 
                {
                    echo "<script>alert('Piloto cadastrado com sucesso!'); window.location.href='pilotosAdm.php';</script>";
                    exit;
                } 
                else 
                {
                    echo "<script>alert('Erro ao cadastrar piloto no banco.');</script>";
                }
            }
        } 
        else 
        {
            // Mostra mensagem caso algum campo esteja vazio
            echo "<script>alert('Preencha todos os campos!');</script>";
        }
    }
    // Busca todos os pilotos cadastrados no banco
    $consultar = new ConsultarPiloto();
    $pilotos = $consultar->consultarPiloto($conexao);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <!-- Faz a página se adaptar ao tamanho da tela -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StarLine - Pilotos</title>
    <!-- CSS da página -->
    <link rel="stylesheet" href="../css/pilotoAdm.css">
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
                <h1>Pilotos</h1>
                <p>Cadastre, consulte, atualize e exclua pilotos.</p>
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
        <!-- Conteúdo principal -->
        <main class="conteudo">
            <!-- Cabeçalho da área de pilotos -->
            <div class="cabecalho">
                <div>
                    <h2>Pilotos cadastrados</h2>
                    <p>Gerencie os pilotos da StarLine.</p>
                </div>
                <div class="acoes-topo">
                    <!-- Abre o formulário para cadastrar um novo piloto -->
                    <button class="novo" type="button" onclick="novoPiloto()">
                        <i class="fa-solid fa-plus"></i> Novo Piloto
                    </button>
                    <!-- Volta para o menu administrativo -->
                    <a href="../View/menuAdm.php" class="voltar">
                        <i class="fa-solid fa-arrow-left"></i> Voltar
                    </a>
                </div>
            </div>
            <!-- Área da tabela -->
            <section class="tabela">
                <!-- Verifica se existem pilotos cadastrados -->
                <?php if (empty($pilotos)): ?>
                    <!-- Mensagem exibida quando não existem pilotos -->
                    <div style="text-align: center; padding: 40px 20px; color: #fff;">
                        <p style="font-size: 1.1rem; margin-bottom: 15px;">
                            Não há nenhum piloto cadastrado no momento.
                        </p>
                        <!-- Botão para abrir o cadastro -->
                        <button class="novo" type="button" onclick="novoPiloto()">
                            <i class="fa-solid fa-plus"></i> Clique aqui para cadastrar um novo piloto
                        </button>
                    </div>
                <?php else: ?>
                    <!-- Tabela com os pilotos cadastrados -->
                    <table>
                        <!-- Cabeçalho da tabela -->
                        <thead>
                            <tr>
                                <th>N° Piloto</th>
                                <th>Nome</th>
                                <th>Identificação</th>
                                <th>Formação</th>
                                <th>E-mail</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Percorre todos os pilotos -->
                            <?php foreach ($pilotos as $piloto): ?>
                                <tr>
                                    <!-- ID do piloto -->
                                    <td><?php echo $piloto['id_piloto']; ?></td>
                                    <!-- Nome do piloto -->
                                    <td><?php echo htmlspecialchars($piloto['nome']); ?></td>
                                    <!-- Número de identificação -->
                                    <td><?php echo htmlspecialchars($piloto['identificacao']); ?></td>
                                    <!-- Formação do piloto -->
                                    <td><?php echo htmlspecialchars($piloto['formacao']); ?></td>
                                    <!-- E-mail do piloto -->
                                    <td><?php echo htmlspecialchars($piloto['email']); ?></td>
                                    <!-- Status do piloto -->
                                    <td>
                                        <?php 
                                            // Define a classe CSS de acordo com o status
                                            $classeStatus = (in_array(strtolower($piloto['statu']), ['desativado', 'desativo'])) ? 'desativado' : 'ativo';
                                        ?>
                                        <span class="<?php echo $classeStatus; ?>">
                                            <?php echo htmlspecialchars($piloto['statu']); ?>
                                        </span>
                                    </td>
                                    <!-- Botão de ações -->
                                    <td>
                                        <!-- Abre o formulário com os dados do piloto selecionado -->
                                        <button class="editar" type="button" onclick="editarPiloto(
                                            '<?php echo $piloto['id_piloto']; ?>',
                                            '<?php echo addslashes($piloto['nome']); ?>',
                                            '<?php echo addslashes($piloto['identificacao']); ?>',
                                            '<?php echo addslashes($piloto['formacao']); ?>',
                                            '<?php echo addslashes($piloto['email']); ?>',
                                            '<?php echo addslashes($piloto['statu']); ?>'
                                        )">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </section>
            <!-- Formulário de cadastro e atualização -->
            <section class="formulario" id="formulario" style="display: none;">
                <!-- Formulário envia os dados para esta mesma página -->
                <form method="POST" action="pilotosAdm.php">
                    <div class="form-titulo">
                        <!-- O título é alterado pelo JavaScript -->
                        <h2 id="tituloFormulario">Cadastrar piloto</h2>
                        <!-- Fecha o formulário -->
                        <button type="button" onclick="fecharFormulario()">×</button>
                    </div>
                    <div class="campos">
                        <!-- Guarda o ID do piloto durante uma atualização -->
                        <input type="hidden" name="idPiloto" id="idPilotoHidden">
                        <!-- Mostra o ID do piloto -->
                        <div class="campo">
                            <label>ID do Piloto</label>
                            <input type="text" id="idPiloto" readonly placeholder="Automático">
                        </div>
                        <!-- Campo para o nome -->
                        <div class="campo">
                            <label>Nome</label>
                            <input type="text" name="nome" id="nome" placeholder="Nome completo" required>
                        </div>
                        <!-- Campo para identificação -->
                        <div class="campo">
                            <label>Identificação</label>
                            <input type="number" name="identificacao" id="identificacao" placeholder="Ex: 12345" required>
                        </div>
                        <!-- Campo para formação -->
                        <div class="campo">
                            <label>Formação</label>
                            <input type="text" name="formacao" id="formacao" placeholder="Ex: Astrofísica / Comercial" required>
                        </div>
                        <!-- Campo para e-mail -->
                        <div class="campo">
                            <label>E-mail</label>
                            <input type="email" name="email" id="email" placeholder="piloto@starline.com" required>
                        </div>
                        <!-- Campo para status -->
                        <div class="campo">
                            <label>Status</label>
                            <select name="statu" id="status">
                                <option value="Ativo">Ativo</option>
                                <option value="Desativado">Desativado</option>
                            </select>
                        </div>
                    </div>
                    <!-- Envia o formulário para cadastrar ou atualizar -->
                    <button class="salvar" type="submit" name="btnSalvar">
                        <i class="fa-solid fa-check"></i> Salvar piloto
                    </button>
                </form>
            </section>
        </main>
        <!-- Rodapé -->
        <footer>
            © 2026 StarLine Agência Espacial. Todos os direitos reservados.
        </footer>
        <!-- JavaScript responsável pelas ações do formulário -->
        <script src="../js/pilotoAdm.js"></script>
    </body>
</html>