<?php
    namespace Projeto\starline\Control;

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    require_once('../DAO/cadastrarPiloto.php');
    require_once('../DAO/consultarPiloto.php');
    require_once('../DAO/atualizarPiloto.php');
    require_once('../DAO/conexao.php');

    use Projeto\starline\DAO\CadastrarPiloto;
    use Projeto\starline\DAO\ConsultarPiloto;
    use Projeto\starline\DAO\AtualizarPiloto;
    use Projeto\starline\DAO\Conexao;

    header('Content-Type: application/json; charset=utf-8');

    $conexao = new Conexao();
    $acao    = $_POST['acao'] ?? $_GET['acao'] ?? 'atualizar';

    // ----------------------------------------------------
    // CADASTRAR PILOTO
    // ----------------------------------------------------
    if ($acao === 'cadastrar') 
    {
        $nome = $_POST['nome'];
        $identificacao = $_POST['identificacao'];
        $formacao = $_POST['formacao'];
        $email = $_POST['email'];

        if (empty($nome) || empty($identificacao) || empty($email)) 
        {
            echo json_encode(["sucesso"  => false, "mensagem" => "Preencha todos os campos obrigatórios."]);
            exit;
        }
        $cadastrar = new CadastrarPiloto();
        $res = $cadastrar->cadastrarPiloto($conexao, $nome, (int)$identificacao, $formacao, $email);
        if ($res === "cadastrado" || $res === true) 
        {
            echo json_encode(["sucesso"  => true, "mensagem" => "Piloto cadastrado com sucesso!"]);
        }
        else 
        {
            echo json_encode(["sucesso"  => false, "mensagem" => "Erro ao cadastrar piloto: " . $res]);
        }
        exit;
    }

    // ----------------------------------------------------
    // CONSULTAR PILOTO(S)
    // ----------------------------------------------------
    if ($acao === 'consultar') 
    {
        $consultar = new ConsultarPiloto();
        $codigo = $_GET['id_piloto'] $_POST['id_piloto'];
        if ($codigo > 0) 
        {
            $piloto = $consultar->consultarPorId($conexao, (int)$codigo);
            echo json_encode(["sucesso" => $piloto ? true : false, "dados" => $piloto]);
        } 
        else 
        {
            $pilotos = $consultar->consultarTodos($conexao);
            echo json_encode(["sucesso" => true, "dados"   => $pilotos]);
        }
        exit;
    }

    // ----------------------------------------------------
    // ATUALIZAR PILOTO (CÓDIGO ORIGINAL MANTIDO)
    // ----------------------------------------------------
    // Resgata o ID do piloto salvo na sessão ou via requisição
    $codigo = $_SESSION['id_piloto'] $_POST['id_piloto'];
    $nome = $_POST['nome'];
    $identificacao = $_POST['identificacao'];
    $formacao = $_POST['formacao'];
    $email = $_POST['email'];
    $atualizar = new AtualizarPiloto();
    // Mapeamento dos campos que serão atualizados no banco de dados
    $dados = [
        'nome' => $nome,
        'identificacao' => (int)$identificacao,
        'formacao' => $formacao,
        'email' => $email
    ];
    $sucesso = true;
    $mensagemErro = '';
    foreach ($dados as $campo => $dado) 
    {
        $res = $atualizar->atualizarPiloto($conexao, (int)$codigo, $campo, $dado);
        if ($res !== true) 
        {
            $sucesso = false;
            $mensagemErro = "Erro no campo [$campo]: " . $res;
            break;
        }
    }

    if ($sucesso) 
    {
        // Atualiza a sessão caso o piloto esteja logado
        $_SESSION['nome']          = $nome;
        $_SESSION['identificacao'] = $identificacao;
        $_SESSION['formacao']      = $formacao;
        $_SESSION['email']         = $email;

        echo json_encode(["sucesso"  => true, "mensagem" => "Piloto atualizado com sucesso!"]);
    }
    else 
    {
        echo json_encode(["sucesso"  => false, "mensagem" => $mensagemErro]);
    }
?>