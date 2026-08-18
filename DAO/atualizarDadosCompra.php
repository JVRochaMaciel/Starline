<?php
    namespace Projeto\starline\DAO;

    header('Content-Type: application/json; charset=utf-8');
    ob_clean();

    require_once('conexao.php');
    require_once('atualizarCompra.php');

    use Projeto\starline\DAO\Conexao;
    use Projeto\starline\DAO\AtualizarCompra;

    // Recebe e valida os parâmetros do formulário
    $idCompra    = isset($_POST['idCompra']) ? (int)$_POST['idCompra'] : 0;
    $idUsuario   = isset($_POST['idUsuario']) ? (int)$_POST['idUsuario'] : 0;
    $localViagem = $_POST['localViagem'] ?? $_POST['local'] ?? '';
    $pagamento   = $_POST['pagamento'] ?? '';
    $valor       = isset($_POST['valor']) ? (float)$_POST['valor'] : 0.0;
    $status      = $_POST['status'] ?? 'Ativo';

    if ($idCompra > 0 && $idUsuario > 0) 
    {
        $conexao = new Conexao();
        $dao = new AtualizarCompra();

        $sucesso = $dao->atualizarTudo($conexao, $idCompra, $idUsuario, $localViagem, $pagamento, $valor, $status);

        if ($sucesso) 
        {
            echo json_encode([
                'sucesso'     => true,
                'idCompra'    => $idCompra,
                'idUsuario'   => $idUsuario,
                'localViagem' => $localViagem,
                'pagamento'   => $pagamento,
                'valor'       => $valor,
                'status'      => $status
            ]);
        } 
        else 
        {
            echo json_encode([
                'sucesso' => false, 
                'mensagem' => 'Erro ao atualizar os dados no banco de dados.'
            ]);
        }
    } 
    else 
    {
        echo json_encode([
            'sucesso' => false, 
            'mensagem' => 'Dados inválidos. ID da compra ou usuário não informados.'
        ]);
    }
    exit;
?>