<?php
    // Define o namespace da classe
    namespace Projeto\starline\DAO;
    // Importa os arquivos necessários
    require_once('conexao.php');
    require_once('atualizarUsuario.php');
    // Importa as classes que serão utilizadas
    use Projeto\starline\DAO\Conexao;
    use Projeto\starline\DAO\AtualizarUsuario;
    // Recebe o ID do usuário enviado pelo formulário
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    // Recebe o novo status enviado pelo formulário
    $status = isset($_POST['status']) ? $_POST['status'] : '';
    // Verifica se o ID e o status são válidos
    if ($id > 0 && !empty($status))
    {
        // Cria uma nova conexão com o banco
        $conexao = new Conexao();
        // Cria o objeto responsável pela atualização
        $dao = new AtualizarUsuario();
        // Atualiza o status do usuário
        $sucesso = $dao->atualizarStatus($conexao, $id, $status);
        // Retorna os dados em formato JSON
        echo json_encode([
            'sucesso' => $sucesso,
            'id' => $id,
            'status' => $status
        ]);
    }
    else
    {
        // Retorna falso caso os dados sejam inválidos
        echo json_encode([
            'sucesso' => false
        ]);
    }
?>