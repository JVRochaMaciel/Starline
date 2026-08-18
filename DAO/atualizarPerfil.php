<?php
    // Define o namespace do controlador
    namespace Projeto\starline\DAO;
    // Inicia a sessão
    session_start();
    // Importa os arquivos necessários
    require_once("../DAO/atualizarUsuario.php");
    require_once("../DAO/conexao.php");
    // Importa as classes que serão utilizadas
    use Projeto\starline\DAO\AtualizarUsuario;
    use Projeto\starline\DAO\Conexao;
    // Define que a resposta será enviada em formato JSON
    header('Content-Type: application/json');
    // Pega o código do usuário armazenado na sessão
    $codigo = $_SESSION['codigo'];
    // Recebe os dados enviados pelo formulário
    $nome = $_POST['nome'] ?? '';
    $cpf = $_POST['cpf'] ?? '';
    $dataNascimento = $_POST['dataNascimento'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $login = $_POST['login'] ?? '';
    $senha = $_POST['senha'] ?? '';
    // Cria a conexão com o banco de dados
    $conexao = new Conexao();
    // Cria o objeto responsável pela atualização
    $atualizar = new AtualizarUsuario();
    // Organiza os dados que serão atualizados
    $dados = ['nome' => $nome, 'cpf' => $cpf, 'dataNascimento' => $dataNascimento, 'telefone' => $telefone, 'login' => $login, 'senha' => $senha];
    // Inicialmente considera a atualização como bem-sucedida
    $sucesso = true;
    // Percorre todos os campos para atualizar cada um no banco
    foreach ($dados as $campo => $dado) 
    {
        // Tenta atualizar o campo atual
        if (!$atualizar->atualizarUsuario($conexao, $codigo, $campo, $dado)) 
        {
            // Caso algum campo falhe, define o sucesso como falso
            $sucesso = false;
            // Interrompe o loop
            break;
        }
    }
    // Verifica se todos os campos foram atualizados
    if ($sucesso) 
    {
        // Atualiza o nome armazenado na sessão
        $_SESSION['nome'] = $nome;
        // Retorna uma resposta de sucesso
        echo json_encode(["sucesso" => true, "mensagem" => "Cadastro atualizado com sucesso!"]);
    } 
    else 
    {
        // Retorna uma resposta de erro
        echo json_encode
        (["sucesso" => false, "mensagem" => "Não foi possível atualizar o cadastro."]);
    }
?>