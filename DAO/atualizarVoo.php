<?php
    // Define o namespace da classe
    namespace Projeto\starline\DAO;
    // Importa os arquivos necessários
    require_once 'conexao.php';
    require_once '../Model/voos.php';
    // Importa as classes que serão utilizadas
    use Projeto\starline\DAO\Conexao;
    use Projeto\starline\Model\Voo;
    // Classe responsável por atualizar os dados de um voo
    class AtualizarVoo
    {
        // Método responsável por atualizar um voo
        public function atualizar(Conexao $conexao, Voo $voo): string
        {
            // Cria a conexão com o banco de dados
            $conn = $conexao->conectar();
            // Verifica se a conexão foi realizada
            if (!$conn)
            {
                return "Erro de conexão com o banco de dados.";
            }

            // Comando SQL para atualizar os dados do voo
            $sql = "update voo set origem = ?, destino = ?, dataPartida = ?, dataChegada = ?, id_nave = ?, id_piloto = ? where id_voo = ?";
            // Prepara o comando SQL
            $stmt = mysqli_prepare($conn, $sql);
            // Verifica se o comando foi preparado corretamente
            if (!$stmt)
            {
                // Pega o erro ocorrido no banco
                $erro = mysqli_error($conn);
                // Fecha a conexão
                mysqli_close($conn);
                return "Erro ao preparar a instrução SQL: " . $erro;
            }
            // Pega os dados do objeto Voo
            $idVoo = $voo->__get('idVoo');
            $origem = $voo->__get('origem');
            $destino = $voo->__get('destino');
            $dataPartida = $voo->__get('dataPartida');
            $dataChegada = $voo->__get('dataChegada');
            $id_nave = $voo->__get('id_nave');
            $id_piloto = $voo->__get('id_piloto');
            // Liga os valores aos ? da consulta SQL
            mysqli_stmt_bind_param($stmt, "ssssiii", $origem, $destino, $dataPartida, $dataChegada, $id_nave, $id_piloto, $idVoo);
            // Executa o comando de atualização
            if (mysqli_stmt_execute($stmt))
            {
                // Fecha o comando
                mysqli_stmt_close($stmt);
                // Fecha a conexão com o banco
                mysqli_close($conn);
                return "Atualizado com sucesso!";
            }
            // Pega o erro caso a atualização falhe
            $erro = mysqli_stmt_error($stmt);
            // Fecha o comando
            mysqli_stmt_close($stmt);
            // Fecha a conexão
            mysqli_close($conn);
            // Retorna a mensagem de erro
            return "Erro ao atualizar: " . $erro;
        }
    }
?>