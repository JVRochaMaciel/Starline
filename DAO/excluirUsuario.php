<?php
    // Define o namespace da classe
    namespace Projeto\starline\DAO;
    // Importa o arquivo de conexão com o banco de dados
    require_once('conexao.php');
    // Importa a classe de conexão
    use Projeto\starline\DAO\Conexao;
    // Define que a resposta será enviada no formato JSON
    header('Content-Type: application/json');
    // Obtém o ID enviado pelo método POST
    $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
    // Verifica se o ID é válido
    if ($id <= 0)
    {
        echo json_encode([
            'sucesso' => false,
            'mensagem' => 'ID inválido.'
        ]);
        exit;
    }
    try
    {
        // Cria uma nova conexão
        $conexao = new Conexao();
        // Conecta ao banco de dados
        $conn = $conexao->conectar();
        // Define o comando SQL para excluir o usuário
        $sql = "delete from usuarios where id_usuarios = ?";
        // Prepara o comando SQL
        $stmt = mysqli_prepare($conn, $sql);
        // Verifica se o comando foi preparado corretamente
        if (!$stmt)
        {
            echo json_encode([
                'sucesso' => false,
                'mensagem' => 'Erro ao preparar a exclusão.'
            ]);
            exit;
        }
        // Substitui o ? pelo ID informado
        mysqli_stmt_bind_param($stmt, "i", $id);
        // Executa a exclusão
        mysqli_stmt_execute($stmt);
        // Verifica se algum usuário foi excluído
        if (mysqli_stmt_affected_rows($stmt) > 0)
        {
            echo json_encode([
                'sucesso' => true,
                'id' => $id
            ]);
        }
        else
        {
            // Informa que o usuário não foi encontrado ou não pôde ser excluído
            echo json_encode([
                'sucesso' => false,
                'mensagem' => 'Usuário não encontrado ou não pôde ser excluído.'
            ]);
        }
        // Fecha o comando preparado
        mysqli_stmt_close($stmt);
    }
    catch (\Exception $erro)
    {
        // Retorna o erro ocorrido durante a exclusão
        echo json_encode([
            'sucesso' => false,
            'mensagem' => $erro->getMessage()
        ]);
    }
?>