<?php
    namespace Projeto\starline\DAO;

    require_once('conexao.php');
    use Projeto\starline\DAO\Conexao;

    class AtualizarUsuario
    {
        // Método para atualizar todos os dados do perfil do usuário
        public function atualizarPerfil(Conexao $conexao, int $id, string $nome, string $cpf, string $dataNascimento, string $telefone, string $login, string $senha)
        {
            try 
            {
                $conn = $conexao->conectar();

                // SQL ajustado com o nome correto dos campos da tabela usuarios
                $sql = "update usuarios set nome = ?, cpf = ?, dataNascimento = ?, telefone = ?, login = ?, senha = ? where id_usuarios = ?";
                $stmt = mysqli_prepare($conn, $sql);
                if (!$stmt) 
                {
                    return mysqli_error($conn);
                }
                mysqli_stmt_bind_param($stmt, "ssssssi", $nome, $cpf, $dataNascimento, $telefone, $login, $senha, $id);

                $resultado = mysqli_stmt_execute($stmt);

                if ($resultado) 
                {
                    mysqli_stmt_close($stmt);
                    return true;
                }
                else 
                {
                    $erro = mysqli_stmt_error($stmt);
                    mysqli_stmt_close($stmt);
                    return $erro;
                }
            } 
            catch (\Exception $erro) 
            {
                return $erro->getMessage();
            }
        }

        // Método NOVO adicionado para atualizar apenas o status ('statu') do usuário
        public function atualizarStatus(Conexao $conexao, int $id, string $status): bool
        {
            try 
            {
                $conn = $conexao->conectar();

                // Coluna 'statu' (conforme DDL do seu banco) e ID 'id_usuarios'
                $sql = "update usuarios set statu = ? where id_usuarios = ?";
                $stmt = mysqli_prepare($conn, $sql);
                
                if (!$stmt) {
                    return false;
                }

                mysqli_stmt_bind_param($stmt, "si", $status, $id);
                $resultado = mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                return $resultado ? true : false;
            } 
            catch (\Exception $erro) 
            {
                return false;
            }
        }
    }
?>