<?php
    namespace Projeto\starline\Control;
    require_once '../DAO/conexao.php';
    require_once '../Model/voo.php';
    use Projeto\starline\DAO\Conexao;
    use Projeto\starline\Model\Voo;
    // Classe responsável pela regra de negócio e controle dos dados de voos
    class ControlVoo
    {
        private Conexao $conexao;
        // Construtor que inicializa a instância da classe Conexao
        public function __construct()
        {
            $this->conexao = new Conexao();
        }
        // CADASTRAR VOO
        // Cadastra um novo voo associando origem, destino, datas, nave e piloto
        public function cadastrar(string $origem, string $destino, string $dataPartida, string $dataChegada, int $id_nave, int $id_piloto): string
        {
            // Estabelece a conexão com o banco de dados
            $conn = $this->conexao->conectar();
            // Valida se a conexão foi estabelecida com sucesso
            if (!$conn)
            {
                return "Erro de conexão com o banco de dados.";
            }
            // Define a query SQL para inserção do novo registro
            $sql = "insert into voo (origem, destino, dataPartida, dataChegada, id_nave, id_piloto) values (?, ?, ?, ?, ?, ?)";
            // Prepara a consulta para prevenir SQL Injection
            $stmt = mysqli_prepare($conn, $sql);
            if ($stmt)
            {
                // Vincula os valores informados aos parâmetros da query (4 strings e 2 inteiros)
                mysqli_stmt_bind_param($stmt, "ssssii", $origem, $destino, $dataPartida, $dataChegada, $id_nave, $id_piloto);
                // Executa a instrução preparada
                if (mysqli_stmt_execute($stmt))
                {
                    // Libera os recursos e encerra a conexão
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);
                    return "cadastrado";
                }
                // Captura a mensagem de erro caso a execução falhe
                $erro = mysqli_stmt_error($stmt);
                // Libera recursos antes de retornar a falha
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                return $erro;
            }
            // Fecha a conexão se a preparação do statement falhar
            mysqli_close($conn);
            return "Erro ao preparar a consulta.";
        }
        // CONSULTAR TODOS OS VOOS
        // Retorna a lista de todos os voos cadastrados com dados das naves e pilotos associados
        public function consultarTodas(): array
        {
            // Estabelece a conexão com o banco de dados
            $conn = $this->conexao->conectar();
            $vetor = [];
            // Valida a conexão antes de prosseguir
            if (!$conn)
            {
                return $vetor;
            }
            // Define a busca combinando tabelas (INNER JOIN) para trazer nomes da nave e do piloto
            $sql = "select v.id_voo, v.origem, v.destino, v.dataPartida, v.dataChegada, v.id_nave, n.nome AS nome_nave, v.id_piloto,
                    p.nome AS nome_piloto from voo v inner join nave n on v.id_nave = n.id_nave inner join piloto p on v.id_piloto = p.id_piloto
                    order by v.id_voo DESC";
            // Executa a consulta direta no banco de dados
            $result = mysqli_query($conn, $sql);
            if ($result)
            {
                // Percorre todos os registros retornados e os armazena no vetor
                while ($linha = mysqli_fetch_assoc($result))
                {
                    $vetor[] = $linha;
                }
            }
            // Encerra a conexão com o banco de dados
            mysqli_close($conn);

            return $vetor;
        }
        // ATUALIZAR VOO COMPLETO
        // Atualiza todas as informações de um voo existente com base no seu código (ID)
        public function atualizarTudo(int $codigo, string $origem, string $destino, string $dataPartida, string $dataChegada, int $idNave, int $idPiloto): bool
        {
            // Estabelece a conexão com o banco de dados
            $conn = $this->conexao->conectar();
            // Valida se a conexão foi aberta corretamente
            if (!$conn)
            {
                return false;
            }
            // Define a query SQL para atualizar os campos do voo
            $sql = "update voo set origem = ?, destino = ?, dataPartida = ?, dataChegada = ?, id_nave = ?, id_piloto = ? where id_voo = ?";
            // Prepara a instrução SQL
            $stmt = mysqli_prepare($conn, $sql);
            if (!$stmt)
            {
                mysqli_close($conn);

                return false;
            }
            // Vincula os parâmetros à consulta (4 strings e 3 inteiros)
            mysqli_stmt_bind_param($stmt, "ssssiii", $origem, $destino, $dataPartida, $dataChegada, $idNave, $idPiloto, $codigo);
            // Executa a instrução preparada de atualização
            $sucesso = mysqli_stmt_execute($stmt);
            // Libera a memória do statement e encerra a conexão
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            // Retorna true se a alteração deu certo ou false se falhou
            return $sucesso;
        }
    }
?>