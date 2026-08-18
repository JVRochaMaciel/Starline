<?php
    // Define o namespace da classe
    namespace Projeto\starline\DAO;
    // Importa o arquivo de conexão
    require_once 'conexao.php';
    // Importa a classe de conexão
    use Projeto\starline\DAO\Conexao;
    // Classe responsável por consultar naves
    class ConsultarNave
    {
        // Consulta todas as naves cadastradas
        public function consultarTodas(Conexao $conexao): array
        {
            try 
            {
                // Abre a conexão com o banco
                $conn = $conexao->conectar();
                // Define a consulta das naves
                $sql = "select id_nave, assentos, nome from nave order by id_nave desc";
                // Executa a consulta
                $result = $conn->query($sql);
                // Cria um vetor para armazenar as naves
                $naves = [];
                // Verifica se existem naves cadastradas
                if ($result && $result->num_rows > 0) 
                {
                    // Percorre os resultados encontrados
                    while ($linha = $result->fetch_assoc()) 
                    {
                        // Adiciona cada nave ao vetor
                        $naves[] = $linha;
                    }
                }
                // Retorna a lista de naves
                return $naves;
            } 
            catch (\Exception $e) 
            {
                // Retorna um vetor vazio caso ocorra algum erro
                return [];
            }
        }
        // Consulta uma nave específica pelo ID
        public function consultarPorId(Conexao $conexao, int $idNave): array|bool
        {
            try 
            {
                // Abre a conexão com o banco
                $conn = $conexao->conectar();
                // Define a consulta para buscar a nave pelo ID
                $sql = "select id_nave, assentos, nome from nave where id_nave = ?";
                // Prepara a consulta
                $stmt = $conn->prepare($sql);
                // Define o ID da nave como parâmetro
                $stmt->bind_param("i", $idNave);
                // Executa a consulta
                $stmt->execute();
                // Obtém o resultado
                $result = $stmt->get_result();
                // Verifica se a nave foi encontrada
                if ($result && $result->num_rows > 0) 
                {
                    // Retorna os dados da nave
                    return $result->fetch_assoc();
                }
                // Retorna falso caso a nave não seja encontrada
                return false;
            } 
            catch (\Exception $e) 
            {
                // Retorna falso caso ocorra algum erro
                return false;
            }
        }
    }
?>