<?php
    // Limpa qualquer saída anterior para não quebrar o JSON
    ob_clean();
    header('Content-Type: application/json; charset=utf-8');

    // Oculta warnings/notices do PHP que corrompem a resposta JSON
    error_reporting(0);
    ini_set('display_errors', 0);

    require_once 'conexao.php';
    require_once 'atualizarCompra.php';

    use Projeto\starline\DAO\Conexao;
    use Projeto\starline\DAO\AtualizarCompra;

    // Recebe e sanitiza os parâmetros do POST
    $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
    $status = isset($_POST['status']) ? trim($_POST['status']) : '';

    if ($id <= 0) 
    {
        echo json_encode(['sucesso' => false, 'mensagem' => 'ID da compra inválido.']);
        exit;
    }

    if (empty($status)) 
    {
        $status = 'Ativo';
    }

    try 
    {
        $conexao = new Conexao();
        $atualizar = new AtualizarCompra();

        // Chama o método da sua DAO MySQLi
        $sucesso = $atualizar->atualizarStatus($conexao, $id, $status);

        if ($sucesso) 
        {
            echo json_encode(['sucesso' => true, 'novoStatus' => $status]);
        } 
        else 
        {
            echo json_encode(['sucesso' => false, 'mensagem' => 'Falha ao conectar ou atualizar no banco de dados.']);
        }
    } 
    catch (\Throwable $erro) 
    {
        echo json_encode(['sucesso' => false, 'mensagem' => 'Erro interno: ' . $erro->getMessage()
        ]);
    }
exit;