<?php
    namespace Projeto\starline\DAO;
    require_once 'conexao.php';
    use Projeto\starline\DAO\Conexao;
    class CadastrarNave
    {
        public function cadastrarNave(Conexao $conexao, string $nome, int $assentos): string 
        {
            try 
            {
                $conn = $conexao->conectar();
                $sql = "insert into nave (nome, assentos) values (?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("si", $nome, $assentos);
                if ($stmt->execute()) 
                {
                    return "cadastrado";
                }
                return "Erro ao cadastrar no banco.";
            } 
            catch (\Exception $e) 
            {
                return "Erro: " . $e->getMessage();
            }
        }
    }
?>