<?php
    namespace Projeto\starline\DAO;
    require_once("conexao.php");
    use Projeto\starline\DAO\Conexao;
    // Classe responsável por gerenciar as operações de atualização de dados de compras no banco de dados
    class AtualizarCompra
    {
        // Atualiza todos os dados de um registro de compra específico
        public function atualizarTudo(Conexao $conexao, int $idCompra, int $idUsuario, string $localViagem, string $pagamento,  float $valor, string $status): bool
        {
            // Abre a conexão com o banco de dados
            $conn = $conexao->conectar();
            // Valida se a conexão foi estabelecida com sucesso
            if (!$conn)
            {
                return false;
            }
            // Define a instrução SQL para atualização completa do registro
            $sql = "update compra set id_usuarios = ?, localViagem = ?, pagamento = ?, valor = ?, statu = ? where id_compras = ?";
            // Prepara a query SQL para evitar SQL Injection
            $stmt = mysqli_prepare($conn, $sql);
            // Verifica se a preparação da query falhou
            if (!$stmt)
            {
                mysqli_close($conn);
                return false;
            }
            // Vincula os parâmetros aos marcadores (?) da consulta preparada
            mysqli_stmt_bind_param($stmt, "issdsi", $idUsuario, $localViagem, $pagamento, $valor, $status, $idCompra);
            // Executa a instrução preparada no banco de dados
            $resultado = mysqli_stmt_execute($stmt);
            // Libera a memória do statement e encerra a conexão
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            // Retorna true se a execução foi bem-sucedida ou false caso contrário
            return $resultado;
        }
        // Atualiza apenas o status de uma compra específica
        public function atualizarStatus(Conexao $conexao, int $idCompra, string $status): bool
        {
            // Abre a conexão com o banco de dados
            $conn = $conexao->conectar();
            // Valida se a conexão foi estabelecida com sucesso
            if (!$conn)
            {
                return false;
            }
            // Define a instrução SQL para alterar somente o campo status
            $sql = "update compra set statu = ? where id_compras = ?";
            // Prepara a query SQL para execução segura
            $stmt = mysqli_prepare($conn, $sql);
            // Verifica se a preparação da query falhou
            if (!$stmt)
            {
                mysqli_close($conn);
                return false;
            }
            // Vincula o status (string) e a ID da compra (integer) à consulta
            mysqli_stmt_bind_param($stmt, "si", $status, $idCompra);
            // Executa a instrução preparada no banco de dados
            $resultado = mysqli_stmt_execute($stmt);
            // Libera a memória do statement e encerra a conexão
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            // Retorna true se a execução foi bem-sucedida ou false caso contrário
            return $resultado;
        }
    }
?>