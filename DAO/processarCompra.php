<?php
    namespace Projeto\starline\DAO;

    // Inicializa a sessão para acessar os dados do usuário autenticado
    session_start();

    // Importa a classe de conexão com o banco de dados
    require_once 'conexao.php';

    // Trava de segurança: impede o acesso direto à página caso o usuário não esteja logado
    if (!isset($_SESSION['id_usuarios']) || empty($_SESSION['id_usuarios'])) 
    {
        header("Location: ../index.php");
        exit();
    }

    // Resgata os dados enviados pelo formulário via POST e o ID do usuário salvo na sessão
    $pagamento = $_POST['pagamento'];
    $valor = $_POST['valor'];
    $localViagem = $_POST['localViagem'];
    $id_usuarios = $_SESSION['id_usuarios'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processando Compra...</title>
    
    <!-- Importação da biblioteca SweetAlert2 para exibição de alertas estilizados -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        body 
        {
            background-color: #0b0c10;
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
    <body>
        <?php
            // Validação: verifica se nenhum dos campos obrigatórios veio vazio do formulário
            if (!empty($pagamento) && !empty($valor) && !empty($localViagem)) 
            {
                try 
                {
                    // Instancia a classe de conexão e abre o link com o banco MySQL
                    $conexao = new Conexao();
                    $conn = $conexao->conectar();
                    // Consulta SQL com Prepared Statement para inserção segura (evita SQL Injection)
                    $sql  = "insert into compra (pagamento, valor, localViagem, id_usuarios) values (?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    // Associa os parâmetros: "s" = string, "d" = double/float, "i" = integer
                    $stmt->bind_param("sdsi", $pagamento, $valor, $localViagem, $id_usuarios);
                    // Tenta executar a gravação no banco de dados
                    if ($stmt->execute()) 
                    {
                        // SUCESSO: Exibe o modal SweetAlert2 de confirmação e redireciona para o Menu do Usuário
                        echo "<script>
                            Swal.fire
                            ({
                                title: 'Viagem Confirmada! 🚀',
                                text: 'Sua passagem para $localViagem foi reservada com sucesso.',
                                icon: 'success',
                                background: '#161922',
                                color: '#ffffff',
                                confirmButtonColor: '#ff5e00',
                                confirmButtonText: 'Ir para o Menu'
                            })
                            .then(() => 
                            {
                                window.location.href = '../View/menuUsuario.php';
                            });
                        </script>";
                    } 
                    else 
                    {
                        // ERRO NO BANCO: Exibe mensagem de erro e retorna o usuário à tela anterior
                        echo "<script>
                            Swal.fire
                            ({
                                title: 'Erro ao processar',
                                text: 'Não foi possível registrar sua reserva no momento.',
                                icon: 'error',
                                background: '#161922',
                                color: '#ffffff',
                                confirmButtonColor: '#ff5e00'
                            })
                            .then(() => 
                            {
                                window.history.back();
                            });
                        </script>";
                    }
                    // Fecha a declaração do MySQLi
                    $stmt->close();
                } 
                catch (\Exception $e) 
                {
                    // Exibe erro genérico caso haja falha na conexão/banco
                    echo "Erro de conexão: " . $e->getMessage();
                }
            } 
            else 
            {
                // DADOS INCOMPLETOS: Exibe um alerta avisando que faltam informações e volta uma página
                echo "<script> 
                    Swal.fire
                    ({ 
                        title: 'Dados Incompletos', 
                        text: 'Por favor, selecione todas as opções da viagem.', 
                        icon: 'warning', 
                        background: '#161922', 
                        color: '#ffffff', 
                        confirmButtonColor: '#ff5e00' 
                    })
                    .then(() => 
                    { 
                        window.history.back(); 
                    }); 
                </script>";
            }
        ?>
    </body>
</html>