<?php
    // Define o namespace da classe
    namespace Projeto\starline\DAO;
    // Importa o arquivo de conexão
    require_once('conexao.php');
    // Importa a classe de conexão
    use Projeto\starline\DAO\Conexao;
    // Classe responsável por consultar pilotos
    class ConsultarPiloto
    {
        // Consulta todos os pilotos cadastrados
        public function consultarPiloto(Conexao $conexao)
        {
            try 
            {
                // Abre a conexão com o banco
                $conn = $conexao->conectar();
                // Define a consulta dos pilotos
                $sql = "select id_piloto, nome, identificacao, formacao, email, statu from piloto";
                // Executa a consulta
                $resultado = mysqli_query($conn, $sql);
                // Cria um vetor para armazenar os pilotos
                $pilotos = [];
                // Verifica se existem pilotos encontrados
                if ($resultado && mysqli_num_rows($resultado) > 0) 
                {
                    // Percorre os resultados
                    while ($linha = mysqli_fetch_assoc($resultado)) 
                    {
                        // Adiciona cada piloto ao vetor
                        $pilotos[] = $linha;
                    }
                }
                // Fecha a conexão com o banco
                mysqli_close($conn);
                // Retorna a lista de pilotos
                return $pilotos;
            } 
            catch (\Exception $erro) 
            {
                // Retorna um vetor vazio caso ocorra algum erro
                return [];
            }
        }
    }
?>