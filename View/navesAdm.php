<?php
    namespace Projeto\starline\View;
    // Inicia a sessão caso ela ainda não esteja iniciada.
    if (session_status() === PHP_SESSION_NONE) 
    {
        session_start();
    }
    // Importa o controle responsável pelas operações das naves.
    require_once '../Control/naveControl.php';
    use Projeto\starline\Control\ControlNave;
    // Pega o nome e o login do administrador salvos na sessão.
    $nome  = $_SESSION['nomeAdm'] ?? '';
    $login = $_SESSION['loginAdm'] ?? '';
    // Cria o objeto de controle das naves.
    $controlNave = new ControlNave();
    // Verifica se o formulário foi enviado pelo método POST.
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnSalvar'])) 
    {
        // Pega os dados enviados pelo formulário.
        $idNave   = $_POST['idNave']   ?? '';
        $nomeNave = $_POST['nome']     ?? '';
        $assentos = (int)($_POST['assentos'] ?? 0);
        // Verifica se os campos obrigatórios foram preenchidos.
        if (!empty($nomeNave) && $assentos > 0) 
        {
            // Se houver ID, realiza a ATUALIZAÇÃO.
            if (!empty($idNave)) 
            {
                // Envia os dados para atualizar a nave no banco.
                $sucesso = $controlNave->atualizarTudo((int)$idNave, $nomeNave, $assentos);
                // Verifica se a atualização foi realizada.
                if ($sucesso) 
                {
                    echo "<script>alert('Nave atualizada com sucesso!'); window.location.href='navesAdm.php';</script>";
                    exit;
                }
                else 
                {
                    echo "<script>alert('Erro ao atualizar nave.');</script>";
                }
            } 
            else
            {
                // Se não houver ID, realiza CADASTRO NOVO.
                $res = $controlNave->cadastrar($nomeNave, $assentos);
                // Verifica se o cadastro foi realizado.
                if ($res === "cadastrado") 
                {
                    echo "<script>alert('Nave cadastrada com sucesso!'); window.location.href='navesAdm.php';</script>";
                    exit;
                }
                else
                {
                    echo "<script>alert('Erro ao cadastrar nave: " . addslashes($res) . "');</script>";
                }
            }
        } 
        else 
        {
            // Mostra uma mensagem caso os dados estejam incompletos.
            echo "<script>alert('Preencha todos os campos corretamente!');</script>";
        }
    }
    // Busca todas as naves cadastradas para mostrar na tabela.
    $naves = $controlNave->consultarTodas();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StarLine - Naves</title>
    <!-- Arquivo CSS da página. -->
    <link rel="stylesheet" href="../css/naveAdm.css">
    <!-- Biblioteca de ícones. -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Fontes utilizadas na página. -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
    <body>
        <!-- Cabeçalho da página. -->
        <header class="topo">
            <!-- Logo do sistema. -->
            <div class="logo">
                <img src="../img/logo.png" alt="StarLine">
            </div>
            <!-- Título da página. -->
            <div class="titulo">
                <h1>Naves</h1>
                <p>Cadastre, consulte e atualize naves.</p>
            </div>
            <!-- Informações do administrador logado. -->
            <div class="admin">
                <div class="avatar">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
                <div>
                    <strong><?php echo $nome; ?></strong>
                    <small><?php echo $login; ?></small>
                </div>
            </div>
        </header>
        <main class="conteudo">
            <!-- Cabeçalho da área de gerenciamento. -->
            <div class="cabecalho">
                <div>
                    <h2>Naves cadastradas</h2>
                    <p>Gerencie as naves da StarLine.</p>
                </div>
                <div class="acoes-topo">
                    <!-- Abre o formulário para cadastrar uma nova nave. -->
                    <button class="novo" type="button" onclick="novaNave()">
                        <i class="fa-solid fa-plus"></i> Nova Nave
                    </button>
                    <!-- Volta para o menu administrativo. -->
                    <a href="../View/menuAdm.php" class="voltar">
                        <i class="fa-solid fa-arrow-left"></i> Voltar
                    </a>
                </div>
            </div>
            <!-- Tabela que mostra as naves cadastradas. -->
            <section class="tabela">
                <?php if (empty($naves)): ?>
                    <!-- Mensagem mostrada quando não existem naves. -->
                    <div style="text-align: center; padding: 40px 20px; color: #fff;">
                        <p style="font-size: 1.1rem; margin-bottom: 15px;">
                            Não há nenhuma nave cadastrada no momento.
                        </p>
                        <!-- Abre o formulário para cadastrar uma nave. -->
                        <button class="novo" type="button" onclick="novaNave()">
                            <i class="fa-solid fa-plus"></i> Clique aqui para cadastrar uma nova nave
                        </button>
                    </div>
                <?php else: ?>
                    <!-- Tabela com os dados das naves. -->
                    <table>
                        <thead>
                            <tr>
                                <th>N° Nave</th>
                                <th>Nome</th>
                                <th>Assentos</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($naves as $nave): ?>
                                <!-- Cada linha representa uma nave cadastrada. -->
                                <tr>
                                    <!-- ID da nave. -->
                                    <td><?php echo $nave['id_nave']; ?></td>
                                    <!-- Nome da nave. -->
                                    <td><?php echo htmlspecialchars($nave['nome']); ?></td>
                                    <!-- Quantidade de assentos da nave. -->
                                    <td><?php echo htmlspecialchars($nave['assentos']); ?></td>
                                    <td>
                                        <!-- Botão que abre o formulário com os dados da nave para edição. -->
                                        <button class="editar" type="button" onclick="editarNave(
                                            '<?php echo $nave['id_nave']; ?>',
                                            '<?php echo addslashes($nave['nome']); ?>',
                                            '<?php echo addslashes($nave['assentos']); ?>'
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
            <!-- Formulário utilizado para cadastrar ou atualizar uma nave. -->
            <section class="formulario" id="formulario" style="display: none;">
                <form method="POST" action="navesAdm.php">
                    <!-- Título e botão para fechar o formulário. -->
                    <div class="form-titulo">
                        <h2 id="tituloFormulario">Cadastrar nave</h2>
                        <button type="button" onclick="fecharFormulario()">×</button>
                    </div>
                    <div class="campos">
                        <!-- Guarda o ID da nave durante uma atualização. -->
                        <input type="hidden" name="idNave" id="idNaveHidden">
                        <!-- Mostra o ID da nave, mas não permite alterá-lo. -->
                        <div class="campo">
                            <label>ID da Nave</label>
                            <input type="text" id="idNave" readonly placeholder="Automático">
                        </div>
                        <!-- Campo para informar o nome da nave. -->
                        <div class="campo">
                            <label>Nome da Nave</label>
                            <input type="text" name="nome" id="nome" placeholder="Ex: Falcon X" required>
                        </div>
                        <!-- Campo para informar a quantidade de assentos. -->
                        <div class="campo">
                            <label>Assentos</label>
                            <input type="number" name="assentos" id="assentos" placeholder="Ex: 50" min="1" required>
                        </div>
                    </div>
                    <!-- Envia o formulário para cadastrar ou atualizar a nave. -->
                    <button class="salvar" type="submit" name="btnSalvar">
                        <i class="fa-solid fa-check"></i> Salvar Nave
                    </button>
                </form>
            </section>
        </main>
        <!-- Rodapé da página. -->
        <footer>
            © 2026 StarLine Agência Espacial. Todos os direitos reservados.
        </footer>
        <!-- JavaScript responsável pelas funções de cadastro e edição. -->
        <script src="../js/naveAdm.js"></script>
    </body>
</html>