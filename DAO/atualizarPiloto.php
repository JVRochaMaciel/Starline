<?php
    namespace Projeto\starline\DAO;
    require_once('conexao.php');
    use Projeto\starline\DAO\Conexao;
    class AtualizarPiloto
    {
        public function atualizarPiloto(Conexao $conexao, int $idPiloto, string $campo, mixed $novoDado)
        {
            try 
            {
                $conn = $conexao->conectar();
                $sql = "update piloto set {$campo} = '{$novoDado}' where id_piloto = {$idPiloto}";
                $resultado = mysqli_query($conn, $sql);
                mysqli_close($conn);

                return (bool)$resultado;
            } catch (\Exception $erro) 
            {
                return false;
            }
        }
        // Método específico para atualizar apenas o status do piloto
        public function atualizarStatus(Conexao $conexao, int $idPiloto, string $status)
        {
            try {
                $conn = $conexao->conectar();
                $sql = "update piloto set statu = '{$status}' where id_piloto = {$idPiloto}";
                $resultado = mysqli_query($conn, $sql);
                mysqli_close($conn);
                return (bool)$resultado;
            } catch (\Exception $erro) 
            {
                return false;
            }
        }
    }
?>