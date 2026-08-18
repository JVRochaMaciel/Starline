<?php
    namespace Projeto\starline\DAO;

    // Importa a classe de conexão com o banco de dados
    require_once('conexao.php');

    use Projeto\starline\DAO\Conexao;

    //Classe responsável por realizar o registro de novas compras/reservas no banco de dados.
    class CadastrarCompra
    {
        public function cadastrarCompra(Conexao $conexao, string $pagamento, float $valor, string $localViagem, int $id_usuarios)
        {
            try 
            {
                // Abre a conexão com o banco de dados
                $conn = $conexao->conectar();

                // Instrução SQL usando Prepared Statement para garantir segurança
                $sql = "insert into compra (pagamento, valor, localViagem, id_usuarios) values (?, ?, ?, ?)";

                // Prepara a consulta SQL no MySQL
                $stmt = mysqli_prepare($conn, $sql);

                // Vincula os parâmetros: "s" = string, "d" = double/float, "i" = integer
                mysqli_stmt_bind_param($stmt, "sdsi", $pagamento, $valor, $localViagem, $id_usuarios);

                // Executa a instrução preparada
                $resultado = mysqli_stmt_execute($stmt);

                // Fecha a declaração (statement) e a conexão com o banco de dados
                mysqli_stmt_close($stmt);
                mysqli_close($conn);

                // Verifica se a gravação foi realizada com sucesso
                if ($resultado) 
                {
                    return "cadastrado";
                }

                return "erro";

            } 
            catch (\Exception $erro) 
            {
                // Retorna "erro" em caso de exceção/falha durante o processo
                return "erro";
            }
        }
    }
?>