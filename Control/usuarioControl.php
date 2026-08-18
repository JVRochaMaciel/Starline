<?php
    namespace Projeto\starline\Control;
    session_start();
    require_once('../DAO/atualizarUsuario.php');
    require_once('../DAO/conexao.php');
    use Projeto\starline\DAO\AtualizarUsuario;
    use Projeto\starline\DAO\Conexao;
    header('Content-Type: application/json');
    $codigo = $_SESSION['id_usuarios'] ?? $_SESSION['codigo'] ?? null;

    if (!$codigo) 
    {
        echo json_encode(["sucesso" => false, "mensagem" => "Sessão inválida ou expirada."]);
        exit;
    }

    $nome = $_POST['nome'] ?? '';
    $cpf = $_POST['cpf'] ?? '';
    $dataNascimento = $_POST['dataNascimento'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $login = $_POST['login'] ?? '';
    $senha = $_POST['senha'] ?? '';

    // Formata a data de nascimento no padrao DATE (YYYY-MM-DD) esperado pelo MySQL
    if (!empty($dataNascimento)) 
    {
        $dtNascFormatada = date('Y-m-d', strtotime($dataNascimento));
    } 
    else 
    {
        $dtNascFormatada = date('Y-m-d');
    }

    $conexao = new Conexao();
    $atualizar = new AtualizarUsuario();

    $res = $atualizar->atualizarPerfil($conexao, (int)$codigo, $nome, $cpf, $dtNascFormatada, $telefone, $login, $senha);

    if ($res === true)
    {
        $_SESSION['nome'] = $nome;
        $_SESSION['cpf'] = $cpf;
        $_SESSION['dataNascimento'] = $dataNascimento;
        $_SESSION['telefone'] = $telefone;
        $_SESSION['login'] = $login;
        $_SESSION['senha'] = $senha;

        echo json_encode([
            "sucesso"  => true,
            "mensagem" => "Atualizado com sucesso!"
        ]);
    }
    else 
    {
        echo json_encode([
            "sucesso"  => false,
            "mensagem" => "Erro ao atualizar no banco: " . $res
        ]);
    }
?>