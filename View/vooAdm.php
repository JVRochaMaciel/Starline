<?php
    namespace Projeto\starline\View;

    // Inicia a sessão caso ela ainda não esteja iniciada
    if (session_status() === PHP_SESSION_NONE)
    {
        session_start();
    }

    // Importa os arquivos necessários para trabalhar com voos
    require_once '../DAO/conexao.php';
    require_once '../DAO/consultarVoo.php';
    require_once '../DAO/cadastrarVoo.php';
    require_once '../DAO/atualizarVoo.php';
    require_once '../Model/voos.php';

    // Define os namespaces das classes utilizadas
    use Projeto\starline\DAO\Conexao;
    use Projeto\starline\DAO\ConsultarVoo;
    use Projeto\starline\DAO\CadastrarVoo;
    use Projeto\starline\DAO\AtualizarVoo;
    use Projeto\starline\Model\Voo;

    // Recupera os dados do administrador pela sessão
    $nome  = $_SESSION['nomeAdm'] ?? '';
    $login = $_SESSION['loginAdm'] ?? '';

    // Cria as conexões e objetos necessários
    $conexao = new Conexao();
    $consultarVoo = new ConsultarVoo(); // Objeto responsável por consultar os voos
    $cadastrarVooDAO = new CadastrarVoo(); // Objeto responsável por cadastrar voos
    $atualizarVooDAO = new AtualizarVoo(); // Objeto responsável por atualizar voos

    $mensagem = "";

    // Verifica se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {

        // Pega o ID do voo. Se estiver vazio, será considerado um novo voo
        $idVoo       = isset($_POST['idVooHidden']) && $_POST['idVooHidden'] !== '' ? (int)$_POST['idVooHidden'] : 0;

        // Pega os dados enviados pelo formulário
        $origem      = trim($_POST['origem'] ?? '');
        $destino     = trim($_POST['destino'] ?? '');
        $dataPartida = $_POST['dataPartida'] ?? '';
        $dataChegada = $_POST['dataChegada'] ?? '';
        $idNave      = (int)($_POST['idNave'] ?? 0);
        $idPiloto    = (int)($_POST['idPiloto'] ?? 0);

        // Verifica se todos os campos obrigatórios foram preenchidos
        if (!empty($origem) && !empty($destino) && !empty($dataPartida) && !empty($dataChegada) && $idNave > 0 && $idPiloto > 0) 
        {

            // Cria o objeto Voo com os dados recebidos
            $vooObj = new Voo($idVoo, $origem, $destino, $dataPartida, $dataChegada, $idNave, $idPiloto);

            // Se existe ID, atualiza o voo
            if ($idVoo > 0) 
            {
                $mensagem = $atualizarVooDAO->atualizar($conexao, $vooObj);
            } 
            // Se não existe ID, cadastra um novo voo
            else 
            {
                $mensagem = $cadastrarVooDAO->cadastrar($conexao, $vooObj);
            }
        } 
        else 
        {
            // Mensagem caso algum campo obrigatório esteja vazio
            $mensagem = "Por favor, preencha todos os campos obrigatórios!";
        }
    }
    // Busca todos os voos cadastrados para mostrar na tabela
    $listaVoos = $consultarVoo->consultarTodos($conexao);
    // Busca as naves e pilotos para preencher os campos SELECT
    $conn = $conexao->conectar();
    $listaNaves = [];
    $listaPilotos = [];
    if ($conn) 
    {
        // Busca todas as naves cadastradas
        $resNaves = mysqli_query($conn, "select id_nave, nome from nave order by nome asc");
        if ($resNaves) 
        {
            // Guarda cada nave dentro do array
            while ($row = mysqli_fetch_assoc($resNaves)) 
            {
                $listaNaves[] = $row;
            }
        }
        // Busca todos os pilotos cadastrados
        $resPilotos = mysqli_query($conn, "select id_piloto, nome from piloto order by nome asc");
        if ($resPilotos) 
        {
            // Guarda cada piloto dentro do array
            while ($row = mysqli_fetch_assoc($resPilotos)) 
            {
                $listaPilotos[] = $row;
            }
        }
        // Fecha a conexão com o banco
        mysqli_close($conn);
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo - Voos | StarLine</title>
    <!-- Google Fonts & FontAwesome -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- CSS da página -->
    <link rel="stylesheet" href="../css/voosAdm.css">
</head>
    <body>
        <!-- TOPO / HEADER -->
        <header class="topo">
            <div class="logo">
                <img src="../img/logo.png" alt="StarLine Logo" onerror="this.src='https://via.placeholder.com/150x40?text=StarLine'">
            </div>
            <div class="titulo">
                <h1>Painel de Gestão Espacial</h1>
                <p>Gerenciamento de Rotas e Voos Comerciais</p>
            </div>
            <div class="admin">
                <div>
                    <!-- Mostra o nome e login do administrador -->
                    <strong><?php echo $nome; ?></strong>
                    <small><?php echo $login; ?></small>
                </div>
                <div class="avatar">
                    <i class="fa-solid fa-user-astronaut"></i>
                </div>
            </div>
        </header>
        <!-- CONTEÚDO PRINCIPAL -->
        <main class="conteudo">
            <!-- Mostra uma mensagem depois de cadastrar ou atualizar -->
            <?php if (!empty($mensagem)): ?>
                <div class="alerta">
                    <i class="fa-solid fa-circle-info"></i> <?= htmlspecialchars($mensagem) ?>
                </div>
            <?php endif; ?>
            <div class="cabecalho">
                <div>
                    <h2>Lista de Voos Programados</h2>
                    <p>Monitore e gerencie todos os voos interestelares cadastrados no sistema.</p>
                </div>
                <div class="acoes-topo">
                    <!-- Abre o formulário para cadastrar um novo voo -->
                    <button type="button" class="novo" onclick="novoVoo()">
                        <i class="fa-solid fa-rocket"></i> Novo Voo
                    </button>
                    <!-- Volta para o menu administrativo -->
                    <a href="menuAdm.php" class="voltar">
                        <i class="fa-solid fa-arrow-left"></i> Voltar
                    </a>
                </div>
            </div>
            <!-- TABELA DE CONSULTA -->
            <div class="tabela">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Origem</th>
                            <th>Destino</th>
                            <th>Data / Hora Partida</th>
                            <th>Data / Hora Chegada</th>
                            <th>Nave</th>
                            <th>Piloto</th>
                            <th style="text-align: center;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Verifica se existem voos cadastrados -->
                        <?php if (empty($listaVoos)): ?>
                            <tr>
                                <td colspan="8" style="text-align: center; color: #888;">Nenhum voo encontrado no sistema.</td>
                            </tr>
                        <?php else: ?>
                            <!-- Percorre todos os voos encontrados -->
                            <?php foreach ($listaVoos as $voo): ?>
                                <tr>
                                    <!-- Mostra o ID do voo -->
                                    <td>#<?= sprintf('%03d', $voo['id_voo']) ?></td>
                                    <!-- Mostra a origem -->
                                    <td><strong><?= htmlspecialchars($voo['origem']) ?></strong></td>
                                    <!-- Mostra o destino -->
                                    <td><strong><?= htmlspecialchars($voo['destino']) ?></strong></td>
                                    <!-- Mostra a data de partida formatada -->
                                    <td><?= date('d/m/Y H:i', strtotime($voo['dataPartida'])) ?></td>
                                    <!-- Mostra a data de chegada formatada -->
                                    <td><?= date('d/m/Y H:i', strtotime($voo['dataChegada'])) ?></td>
                                    <!-- Mostra a nave utilizada no voo -->
                                    <td><span class="tag-info"><i class="fa-solid fa-shuttle-space"></i> [ID: <?= $voo['id_nave'] ?>] <?= htmlspecialchars($voo['nome_nave']) ?></span></td>
                                    <!-- Mostra o piloto responsável -->
                                    <td><span class="tag-info"><i class="fa-solid fa-id-card"></i> [ID: <?= $voo['id_piloto'] ?>] <?= htmlspecialchars($voo['nome_piloto']) ?></span></td>
                                    <td style="text-align: center;">
                                        <!-- Botão que abre o formulário para editar o voo -->
                                        <button type="button" class="editar" title="Editar Voo" 
                                                onclick="editarVoo(
                                                    '<?= $voo['id_voo'] ?>', 
                                                    '<?= addslashes($voo['origem']) ?>', 
                                                    '<?= addslashes($voo['destino']) ?>', 
                                                    '<?= date('Y-m-d\TH:i', strtotime($voo['dataPartida'])) ?>', 
                                                    '<?= date('Y-m-d\TH:i', strtotime($voo['dataChegada'])) ?>', 
                                                    '<?= $voo['id_nave'] ?>', 
                                                    '<?= $voo['id_piloto'] ?>'
                                                )">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <!-- FORMULÁRIO (CADASTRAR / ATUALIZAR) -->
            <div class="formulario" id="formulario">
                <div class="form-titulo">
                    <!-- O título muda entre cadastrar e atualizar pelo JavaScript -->
                    <h2 id="tituloFormulario">Cadastrar Novo Voo</h2>

                    <!-- Fecha o formulário -->
                    <button type="button" onclick="fecharFormulario()">&times;</button>
                </div>
                <!-- Formulário responsável por enviar os dados para esta própria página -->
                <form action="vooAdm.php" method="POST">
                    <!-- Guarda o ID do voo que será atualizado -->
                    <input type="hidden" name="idVooHidden" id="idVooHidden" value="">
                    <div class="campos">
                        <div class="campo">
                            <label for="idVooDisplay">Código do Voo</label>
                            <!-- Apenas mostra o código, não permite edição -->
                            <input type="text" id="idVooDisplay" placeholder="Gerado Automaticamente" readonly disabled>
                        </div>
                        <div class="campo">
                            <label for="origem">Planeta/Estação de Origem</label>
                            <input type="text" name="origem" id="origem" placeholder="Ex: Terra (BR-SP)" required>
                        </div>
                        <div class="campo">
                            <label for="destino">Planeta/Estação de Destino</label>
                            <input type="text" name="destino" id="destino" placeholder="Ex: Marte (Base Alpha)" required>
                        </div>
                        <div class="campo">
                            <label for="dataPartida">Data e Hora de Partida</label>
                            <input type="datetime-local" name="dataPartida" id="dataPartida" required>
                        </div>
                        <div class="campo">
                            <label for="dataChegada">Data e Hora de Chegada</label>
                            <input type="datetime-local" name="dataChegada" id="dataChegada" required>
                        </div>
                        <!-- SELECT NAVE -->
                        <div class="campo">
                            <label for="idNave">Nave Designada</label>
                            <!-- Lista as naves disponíveis no banco -->
                            <select name="idNave" id="idNave" required>
                                <option value="">Selecione uma Nave...</option>
                                <?php foreach ($listaNaves as $nave): ?>
                                    <option value="<?= $nave['id_nave'] ?>">
                                        [ID: <?= $nave['id_nave'] ?>] <?= htmlspecialchars($nave['nome']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- SELECT PILOTO -->
                        <div class="campo">
                            <label for="idPiloto">Piloto Encarregado</label>
                            <!-- Lista os pilotos disponíveis no banco -->
                            <select name="idPiloto" id="idPiloto" required>
                                <option value="">Selecione um Piloto...</option>
                                <?php foreach ($listaPilotos as $piloto): ?>
                                    <option value="<?= $piloto['id_piloto'] ?>">
                                        [ID: <?= $piloto['id_piloto'] ?>] <?= htmlspecialchars($piloto['nome']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <!-- Envia os dados para cadastrar ou atualizar o voo -->
                    <button type="submit" class="salvar">
                        <i class="fa-solid fa-floppy-disk"></i> Salvar Voo
                    </button>
                </form>
            </div>
        </main>
        <!-- Rodapé da página -->
        <footer>
            <p>© 2026 StarLine Agência Espacial. Todos os direitos reservados.</p>
        </footer>
        <!-- JavaScript responsável pelas ações do formulário -->
        <script src="../js/voosAdm.js"></script>
    </body>
</html>