<?php
    namespace Projeto\starline\DAO;
    require_once 'conexao.php';
    require_once '../Model/voos.php';
    use Projeto\starline\DAO\Conexao;
    use Projeto\starline\Model\Voo;
    class CadastrarVoo
    {
        public function cadastrar(Conexao $conexao, Voo $voo): string
        {
            $conn = $conexao->conectar();

            if (!$conn) 
            {
                return "Erro de conexão com o banco de dados.";
            }
            $sql = "insert into voo (origem, destino, dataPartida, dataChegada, id_nave, id_piloto) values (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            if ($stmt) 
            {
                $origem = $voo->__get('origem');
                $destino = $voo->__get('destino');
                $dataPartida = $voo->__get('dataPartida');
                $dataChegada = $voo->__get('dataChegada');
                $id_nave = $voo->__get('id_nave');
                $id_piloto = $voo->__get('id_piloto');
                mysqli_stmt_bind_param($stmt, "ssssii", $origem, $destino, $dataPartida, $dataChegada, $id_nave, $id_piloto);
                if (mysqli_stmt_execute($stmt)) 
                {
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);
                    return "Inserido com sucesso!";
                }
                $erro = mysqli_stmt_error($stmt);
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                return "Erro ao cadastrar: " . $erro;
            }
            mysqli_close($conn);
            return "Erro ao preparar a instrução SQL.";
        }
    }
?>