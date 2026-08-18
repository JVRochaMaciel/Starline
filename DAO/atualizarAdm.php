<?php
    namespace Projeto\starline\DAO;
    require_once("conexao.php");
    use Projeto\starline\DAO\Conexao;
    // Classe responsável por gerenciar a atualização de dados dos administradores no banco de dados
    class AtualizarAdm
    {
        // Atualiza todos os dados (nome, login e senha) de um administrador específico
        public function atualizarTudo(Conexao $conexao, int $id_adm, string $nome, string $login, string $senha): bool 
        {
            try 
            {
                // Abre a conexão com o banco de dados
                $conn = $conexao->conectar();
                // Monta a instrução SQL para atualizar os campos do administrador
                $sql = "update adm set nome = '$nome', login = '$login', senha = '$senha' where id_adm = '$id_adm'";
                // Executa a consulta SQL no banco de dados
                $resultado = mysqli_query($conn, $sql);
                // Retorna true se a consulta foi executada com sucesso, ou false caso contrário
                return $resultado ? true : false;
            } 
            catch (\Exception $erro) 
            {
                // Captura eventuais exceções/erros e retorna false em caso de falha
                return false;
            }
        }
        // Atualiza um campo específico dinamicamente de um administrador
        public function atualizarCampo(Conexao $conexao, int $id_adm, string $campo, mixed $novoDado): bool 
        {
            try 
            {
                // Abre a conexão com o banco de dados
                $conn = $conexao->conectar();
                // Monta a instrução SQL dinâmica definindo o campo e o novo valor
                $sql = "update adm set $campo = '$novoDado' where id_adm = '$id_adm'";
                // Executa a consulta SQL no banco de dados
                $resultado = mysqli_query($conn, $sql);
                // Retorna true se a consulta foi executada com sucesso, ou false caso contrário
                return $resultado ? true : false;
            } 
            catch (\Exception $erro) 
            {
                // Captura eventuais exceções/erros e retorna false em caso de falha
                return false;
            }
        }
    }
?>