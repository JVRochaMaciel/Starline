<?php
    namespace Projeto\starline\DAO;
    //Classe responsável por gerenciar e retornar a conexão com o banco de dados MySQL
    class Conexao
    {
        function conectar()
        {
            try
            {
                // Estabelece a conexão enviando: Host, Usuário, Senha e Nome do Banco
                $conn = mysqli_connect('localhost', 'root', '', 'starline');

                // Validação: se a conexão foi realizada com sucesso, retorna o objeto $conn
                if($conn)
                {
                    return $conn;
                }
            }
            catch(\Exception $erro)
            {
                // Captura e exibe a mensagem de erro caso ocorra falha na tentativa de conexão
                echo "Algo deu errado<br><br> $erro";
            }
        } // Fim do método conectar
    } // Fim da classe Conexao
?>