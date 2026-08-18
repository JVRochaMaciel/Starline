<?php
    // Define o namespace da classe
    namespace Projeto\starline\DAO;
    // Importa o arquivo de conexão
    require_once('conexao.php');
    // Importa a classe de conexão
    use Projeto\starline\DAO\Conexao;
    // Classe responsável por consultar usuários
    class ConsultarUsuario
    {
        // Consulta um usuário específico pelo código
        function consultarUsuario(Conexao $conexao, int $codigo)
        {
            try
            {
                // Abre a conexão com o banco
                $conn = $conexao->conectar();
                // Define a consulta para buscar o usuário pelo código
                $sql = "select * from usuarios where id_usuarios = '$codigo'";
                // Executa a consulta
                $result = mysqli_query($conn, $sql);
                // Percorre os resultados encontrados
                while($dados = mysqli_fetch_array($result))
                {
                    // Verifica se o usuário possui o código informado
                    if($dados['id_usuarios'] == $codigo)
                    {
                        // Retorna os dados do usuário em formato HTML
                        return "
                        <div class='card-usuario'>
                            <h2>Usuário</h2>
                            <p>
                                <strong>Código:</strong>
                                ".$dados['id_usuarios']."
                            </p>
                            <p>
                                <strong>Nome:</strong>
                                ".$dados['nome']."
                            </p>
                            <p>
                                <strong>CPF:</strong>
                                ".$dados['cpf']."
                            </p>
                            <p>
                                <strong>Telefone:</strong>
                                ".$dados['telefone']."
                            </p>
                            <p>
                                <strong>Login:</strong>
                                ".$dados['login']."
                            </p>
                            <p>
                                <strong>Data de Nascimento:</strong>
                                ".$dados['dataNascimento']."
                            </p>
                            <p>
                                <strong>Status:</strong>
                                ".$dados['statu']."
                            </p>
                            <p>
                                <strong>ID Administrador:</strong>
                                ".$dados['id_adm']."
                            </p>
                        </div>";
                    }
                }
            }
            catch(\Exception $erro)
            {
                // Exibe uma mensagem caso ocorra algum erro
                echo "Algo deu errado <br><br> $erro";
            }
        }
        // Lista todos os usuários cadastrados
        function listarUsuarios(Conexao $conexao)
        {
            // Cria um vetor vazio para armazenar os usuários
            $usuarios = [];
            try
            {
                // Abre a conexão com o banco
                $conn = $conexao->conectar();
                // Consulta todos os usuários ordenados pelo ID
                $sql = "select * from usuarios order by id_usuarios";
                // Executa a consulta
                $result = mysqli_query($conn, $sql);
                // Percorre os usuários encontrados
                while ($dados = mysqli_fetch_assoc($result))
                {
                    // Adiciona cada usuário ao vetor
                    $usuarios[] = $dados;
                }
            }
            catch (\Exception $erro)
            {
                // Exibe uma mensagem caso ocorra algum erro
                echo "Algo deu errado <br><br> $erro";
            }
            // Retorna a lista de usuários
            return $usuarios;
        }
    }
?>