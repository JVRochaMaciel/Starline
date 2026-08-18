<?php
    namespace Projeto\starline\DAO;

    // Importa o arquivo de conexão
    require_once('conexao.php');
    use Projeto\starline\DAO\Conexao;

    //Classe responsável por consultar os dados de um Administrador específico no banco.
    class ConsultarAdm
    {
        function consultarAdm(Conexao $conexao, int $codigo)
        {
            try
            {
                // Estabelece a conexão com o MySQL
                $conn = $conexao->conectar();

                // Instrução SQL para buscar o administrador específico
                $sql = "select * from adm where codigo = '$codigo'";
                $result = mysqli_query($conn, $sql);

                // Percorre os resultados retornados do banco de dados
                while($dados = mysqli_fetch_array($result))
                {
                    // Garante que o código retornado seja exatamente o mesmo solicitado
                    if($dados['codigo'] == $codigo)
                    {
                        // Retorna o card HTML estilizado com os dados do administrador
                        return "
                        <div class='card-adm'>
                            <h2>Administrador</h2>
                            
                            <p>
                                <strong>Código:</strong>
                                ".$dados['codigo']."
                            </p>
                            
                            <p>
                                <strong>Nome:</strong>
                                ".$dados['nome']."
                            </p>
                            
                            <p>
                                <strong>Login:</strong>
                                ".$dados['login']."
                            </p>
                            
                            <!-- Guarda a senha real no atributo data-senha para ser alternada pelo JS -->
                            <p>
                                <strong>Senha:</strong>
                                <span id='senha' data-senha='".$dados['senha']."'>••••••••</span>
                            </p>
                            
                            <!-- Botão que aciona a função JavaScript mostrarSenha() -->
                            <button type='button' onclick='mostrarSenha()'>
                                Mostrar senha
                            </button>
                        </div>";
                    }
                }
            }
            catch(\Exception $erro)
            {
                // Tratamento de exceção em caso de falha de banco ou consulta
                echo "Algo deu errado <br><br> $erro";
            }
        }
    }
?>