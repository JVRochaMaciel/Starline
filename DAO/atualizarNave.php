<?php
    namespace Projeto\starline\DAO;

    require_once 'conexao.php';

    use Projeto\starline\DAO\Conexao;

    class AtualizarNave
    {
        // Atualiza todos os dados da nave de uma só vez
        public function atualizarTudo(Conexao $conexao, int $codigo, string $nome, int $assentos): bool 
        {
            try {
                $conn = $conexao->conectar();
                $sql = "update nave set nome = ?, assentos = ? where id_nave = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sii", $nome, $assentos, $codigo);

                return $stmt->execute();
            } 
            catch (\Exception $e) 
            {
                return false;
            }
        }
        // Atualiza um campo individual dinamicamente
        public function atualizarCampo(Conexao $conexao, int $codigo, string $campo, mixed $novoDado): bool 
        {
            try 
            {
                $conn = $conexao->conectar();
                $camposPermitidos = ['nome', 'assentos'];

                if (!in_array($campo, $camposPermitidos)) 
                {
                    return false;
                }

                $sql = "update nave set {$campo} = ? where id_nave = ?";
                $stmt = $conn->prepare($sql);

                if (is_int($novoDado)) 
                {
                    $stmt->bind_param("ii", $novoDado, $codigo);
                } 
                else 
                {
                    $stmt->bind_param("si", $novoDado, $codigo);
                }

                return $stmt->execute();
            } 
            catch (\Exception $e) 
            {
                return false;
            }
        }
    }
?>