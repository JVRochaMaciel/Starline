<?php
    namespace Projeto\starline\DAO;

    // Carrega o arquivo de Conexão com o Banco de Dados
    require_once("conexao.php");
    use Projeto\starline\DAO\Conexao;

    // Inicializa a sessão para podermos guardar os dados do usuário conectado
    if (session_status() === PHP_SESSION_NONE) 
    {
        session_start();
    }

    // Instancia e abre a conexão com o banco MySQL
    $conexao = new Conexao();
    $conn = $conexao->conectar();

    // Resgata as credenciais enviadas via POST pelo formulário de login
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    //VERIFICAÇÃO DE ADMINISTRADOR
    $sqlAdm = "select * from adm where login = '$login'and senha = '$senha'";
    $resultadoAdm = mysqli_query($conn, $sqlAdm);

    if ($resultadoAdm && mysqli_num_rows($resultadoAdm) > 0) {
        $dados = mysqli_fetch_assoc($resultadoAdm);

        // Limpa a sessão do usuário comum para evitar conflitos
        unset($_SESSION['id_usuarios'], $_SESSION['nome'], $_SESSION['login']);

        // Salva TODAS as informações do ADM na sessão
        $_SESSION['id_adm']         = $dados['id_adm'];
        $_SESSION['nomeAdm']        = $dados['nome'];
        $_SESSION['cpfAdm']         = $dados['cpf'];
        $_SESSION['dataNascAdm']    = $dados['dataNascimento'];
        $_SESSION['telefoneAdm']    = $dados['telefone'];
        $_SESSION['loginAdm']       = $dados['login'];
        $_SESSION['senhaAdm']       = $dados['senha'];

        header("Location: ../View/menuAdm.php");
        exit();
    }

    //VERIFICAÇÃO DE USUÁRIO COMUM
    $sqlUsuario       = "select * from usuarios where login = '$login' and senha = '$senha'";
    $resultadoUsuario = mysqli_query($conn, $sqlUsuario);

    // Se encontrar o usuário no banco de dados
    if (mysqli_num_rows($resultadoUsuario) > 0)
    {
        // Extrai os dados retornados da consulta
        $dados = mysqli_fetch_assoc($resultadoUsuario);

        // Salva as informações essenciais na Sessão do servidor
        $_SESSION['id_usuarios'] = $dados['id_usuarios'];
        $_SESSION['codigo'] = $dados['id_usuarios']; // <= IMPORTANTE!
        $_SESSION['nome'] = $dados['nome'];
        $_SESSION['cpf'] = $dados['cpf'];
        $_SESSION['telefone'] = $dados['telefone'];
        $_SESSION['login'] = $dados['login'];
        $_SESSION['senha'] = $dados['senha'];
        $_SESSION['dataNascimento'] = $dados['dataNascimento'];
        // Redireciona/Carrega o menu principal do usuário
        include("../View/menuUsuario.php");
        exit(); // Encerra o script
    }

    //TRATAMENTO DE FALHA NO LOGIN
    // Se o código chegou até aqui, significa que nem ADM nem Usuário foram encontrados.
    // Redireciona para a tela de login enviando a flag ?erro=1 via URL
    header("Location: ../index.php?erro=1");
    exit();
?>