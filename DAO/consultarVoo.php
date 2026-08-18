<?php
    // Define o namespace da classe
    namespace Projeto\starline\DAO;
    // Importa o arquivo de conexão
    require_once 'conexao.php';
    // Importa a classe de conexão
    use Projeto\starline\DAO\Conexao;
    // Classe responsável por consultar os voos
    class ConsultarVoo
    {
        // Consulta todos os voos, junto com os nomes da nave e do piloto
        public function consultarTodos(Conexao $conexao): array
        {
            // Abre a conexão com o banco
            $conn = $conexao->conectar();
            // Cria um vetor vazio para armazenar os voos
            $vetor = [];
            // Verifica se a conexão foi realizada
            if (!$conn) 
            {
                return $vetor;
            }
            // Consulta os voos utilizando JOIN para buscar os dados relacionados
            $sql = "select v.id_voo, v.origem, v.destino, v.dataPartida, v.dataChegada, v.id_nave, n.nome as nome_nave, v.id_piloto, p.nome as nome_piloto from voo v inner join nave n on v.id_nave = n.id_nave inner join piloto p on v.id_piloto = p.id_piloto order by v.id_voo desc";
            // Executa a consulta
            $result = mysqli_query($conn, $sql);
            // Verifica se a consulta foi executada corretamente
            if ($result) 
            {
                // Percorre os resultados encontrados
                while ($linha = mysqli_fetch_assoc($result)) 
                {
                    // Adiciona cada voo ao vetor
                    $vetor[] = $linha;
                }
            }
            // Fecha a conexão
            mysqli_close($conn);
            // Retorna os voos encontrados
            return $vetor;
        }
        // Consulta apenas um voo específico pelo ID
        public function consultarPorId(Conexao $conexao, int $id_voo): ?array
        {
            // Abre a conexão com o banco
            $conn = $conexao->conectar();
            // Verifica se a conexão foi realizada
            if (!$conn) 
            {
                return null;
            }
            // Define a consulta para buscar o voo pelo ID
            $sql = "select id_voo, origem, destino, dataPartida, dataChegada, id_nave, id_piloto from voo where id_voo = ?";
            // Prepara a consulta
            $stmt = mysqli_prepare($conn, $sql);
            // Verifica se a consulta foi preparada corretamente
            if ($stmt) 
            {
                // Associa o ID ao parâmetro da consulta
                mysqli_stmt_bind_param($stmt, "i", $id_voo);

                // Executa a consulta
                mysqli_stmt_execute($stmt);

                // Obtém o resultado da consulta
                $result = mysqli_stmt_get_result($stmt);

                // Obtém os dados do voo
                $dados = mysqli_fetch_assoc($result);

                // Fecha o comando preparado
                mysqli_stmt_close($stmt);

                // Fecha a conexão
                mysqli_close($conn);

                // Retorna os dados encontrados ou null
                return $dados ? $dados : null;
            }
            // Fecha a conexão caso a consulta não tenha sido preparada
            mysqli_close($conn);
            // Retorna null caso não encontre o voo
            return null;
        }
    }
?>