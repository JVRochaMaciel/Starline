<?php
    namespace Projeto\starline\View;
    // Inicia a sessão caso ainda não exista uma sessão ativa
    if (session_status() === PHP_SESSION_NONE)
    {
        session_start();
    }
    // Importa os arquivos necessários para acessar a conexão e consultar as compras
    require_once '../DAO/conexao.php';
    require_once '../DAO/consultarCompra.php';
    use Projeto\starline\DAO\Conexao;
    use Projeto\starline\DAO\ConsultarCompra;
    // Recupera os dados do administrador que estão salvos na sessão
    $nome = $_SESSION['nomeAdm'] ?? '';
    $login = $_SESSION['loginAdm'] ?? '';
    // Cria a conexão com o banco de dados
    $conexao = new Conexao();
    // Cria o objeto responsável por consultar as compras
    $consultarCompra = new ConsultarCompra();
    // Busca todas as compras cadastradas no banco
    $compras = $consultarCompra->listarCompras($conexao);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Título da página -->
    <title>StarLine - Compras</title>
    <!-- CSS responsável pelo visual da página -->
    <link rel="stylesheet" href="../css/compraAdm.css">
    <!-- FontAwesome para utilizar os ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Fontes utilizadas no sistema -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
    <body>
        <!-- CABEÇALHO -->
        <header class="topo">
            <div class="logo">
                <!-- Logo da StarLine -->
                <img src="../img/logo.png" alt="StarLine">
            </div>
            <div class="titulo">
                <h1>Compras</h1>
                <p>
                    Consulte e atualize as compras realizadas.
                </p>
            </div>
            <!-- Informações do administrador logado -->
            <div class="admin">
                <div class="avatar">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
                <div>
                    <strong>
                        <?php echo htmlspecialchars($nome); ?>
                    </strong>
                    <small>
                        <?php echo htmlspecialchars($login); ?>
                    </small>
                </div>
            </div>
        </header>
        <main class="conteudo">
            <!-- CABEÇALHO DA TABELA -->
            <div class="cabecalho">
                <div>
                    <h2>
                        Compras cadastradas
                    </h2>
                    <p>
                        Confira as informações das compras dos usuários.
                    </p>
                </div>
                <!-- Volta para o menu administrativo -->
                <a href="../View/menuAdm.php" class="voltar">
                    <i class="fa-solid fa-arrow-left"></i>
                    Voltar
                </a>
            </div>
            <!-- TABELA DE COMPRAS -->
            <section class="tabela">
                <table>
                    <thead>
                        <tr>
                            <th>N° Compra</th>
                            <th>Usuário</th>
                            <th>Destino</th>
                            <th>Pagamento</th>
                            <th>Valor</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    <!-- Verifica se existem compras cadastradas -->
                    <?php if (!empty($compras)): ?>
                        <!-- Percorre todas as compras encontradas -->
                        <?php foreach ($compras as $dados): ?>
                            <tr data-id="<?php echo $dados['id_compras']; ?>">
                                <!-- ID DA COMPRA -->
                                <td>
                                    <?php
                                        echo $dados['id_compras'];
                                    ?>
                                </td>
                                <!-- USUÁRIO -->
                                <td>
                                    <?php
                                        // Mostra o nome do usuário ou, caso não exista, mostra o ID
                                        echo htmlspecialchars(
                                            $dados['nomeUsuario']
                                            ?? $dados['id_usuarios']
                                        );
                                    ?>
                                </td>
                                <!-- DESTINO -->
                                <td>
                                    <?php
                                        echo htmlspecialchars(
                                            $dados['localViagem']
                                        );
                                    ?>
                                </td>
                                <!-- PAGAMENTO -->
                                <td>
                                    <?php
                                        echo htmlspecialchars(
                                            $dados['pagamento']
                                        );
                                    ?>
                                </td>
                                <!-- VALOR -->
                                <td>
                                    R$
                                    <?php
                                    // Formata o valor para o padrão brasileiro
                                    echo number_format(
                                        (float)$dados['valor'],
                                        2,
                                        ',',
                                        '.'
                                    );
                                    ?>
                                </td>
                                <!-- STATUS -->
                                <td>
                                    <!-- Mostra uma aparência diferente dependendo do status -->
                                    <?php if ($dados['statu'] === 'Ativo'): ?>
                                        <span class="ativo">
                                            Ativo
                                        </span>
                                    <?php else: ?>
                                        <span class="desativado">
                                            Desativado
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <!-- AÇÕES -->
                                <td>
                                    <!-- BOTÃO EDITAR -->
                                    <button type="button" class="editar" onclick="editarCompra(<?php echo $dados['id_compras'];?>)">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    <!-- BOTÃO DESATIVAR / ATIVAR -->
                                    <?php if ($dados['statu'] === 'Ativo'): ?>
                                        <!-- Desativa a compra através do JavaScript -->
                                        <button type="button" class="excluir" onclick="alterarStatus(<?php echo $dados['id_compras'];?>,this)">
                                            <i class="fa-solid fa-ban"></i>
                                        </button>
                                    <?php else: ?>
                                        <!-- Ativa a compra através do JavaScript -->
                                        <button type="button" class="ativar" onclick="alterarStatus(<?php echo $dados['id_compras'];?>,this)">
                                            <i class="fa-solid fa-check"></i>
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <!-- Mensagem exibida quando não existem compras -->
                        <tr>
                            <td colspan="7">
                                Nenhuma compra cadastrada até o momento.
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </section>
            <!-- FORMULÁRIO DE ATUALIZAÇÃO -->
            <section class="formulario" id="formulario" style="display:none;">
                <div class="form-titulo">
                    <h2>
                        Atualizar compra
                    </h2>
                    <!-- Fecha o formulário -->
                    <button type="button" onclick="fecharFormulario()">
                        ×
                    </button>
                </div>
                <div class="campos">
                    <!-- ID DA COMPRA -->
                    <div class="campo">
                        <label>
                            ID da Compra
                        </label>
                        <!-- Campo somente para visualização do ID -->
                        <input type="text" id="idCompra" readonly>
                    </div>
                    <!-- ID DO USUÁRIO -->
                    <div class="campo">
                        <label>
                            ID do Usuário
                        </label>
                        <input type="number" id="idUsuario" min="1">
                    </div>
                    <!-- LOCAL -->
                    <div class="campo">
                        <label>
                            Local da Viagem
                        </label>
                        <!-- Permite escolher o destino da compra -->
                        <select id="local">
                            <option value="Lua">
                                Lua
                            </option>
                            <option value="Marte">
                                Marte
                            </option>
                            <option value="Estação Espacial">
                                Estação Espacial
                            </option>
                        </select>
                    </div>
                    <!-- PAGAMENTO -->
                    <div class="campo">
                        <label>
                            Pagamento
                        </label>
                        <!-- Escolhe a forma de pagamento -->
                        <select id="pagamento">
                            <option value="Cartão">
                                Cartão
                            </option>
                            <option value="Pix">
                                Pix
                            </option>
                            <option value="Boleto">
                                Boleto
                            </option>
                        </select>
                    </div>
                    <!-- VALOR -->
                    <div class="campo">
                        <label>
                            Valor
                        </label>
                        <input type="number" id="valor" step="0.01" min="0.01">
                    </div>
                    <!-- STATUS -->
                    <div class="campo">
                        <label>
                            Status
                        </label>
                        <!-- Permite alterar o status da compra -->
                        <select id="status">
                            <option value="Ativo">
                                Ativo
                            </option>
                            <option value="Desativado">
                                Desativado
                            </option>
                        </select>
                    </div>
                </div>
                <!-- BOTÃO PARA SALVAR AS ALTERAÇÕES -->
                <button type="button" class="salvar" onclick="salvarCompra()">
                    <i class="fa-solid fa-check"></i>
                    Salvar alterações
                </button>
            </section>
        </main>
        <!-- RODAPÉ -->
        <footer>
            © 2026 StarLine Agência Espacial. Todos os direitos reservados.
        </footer>
        <script>
            // Envia os dados das compras do PHP para o JavaScript
            const compras =
                <?php
                    echo json_encode(
                        $compras ?? [],
                        JSON_UNESCAPED_UNICODE
                    );
                ?>;
        </script>
        <!-- JavaScript responsável pelas ações da página -->
        <script
            src="../js/compraAdm.js"
        ></script>
    </body>
</html>