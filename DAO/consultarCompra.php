<?php
    namespace Projeto\starline\DAO;

    require_once('conexao.php');
    use Projeto\starline\DAO\Conexao;

    class ConsultarCompra
    {
        function consultarCompra(Conexao $conexao, int $codigo)
        {
            try
            {
                // Estabelece a conexão com o MySQL
                $conn = $conexao->conectar();

                // Instrução SQL para buscar a compra específica
                $sql = "select * from compra where id_compras = '$codigo'";
                $result = mysqli_query($conn, $sql);

                // Percorre os resultados retornados do banco de dados
                while($dados = mysqli_fetch_array($result))
                {
                    // Garante que o código retornado seja exatamente o mesmo solicitado
                    if($dados['id_compras'] == $codigo)
                    {
                        // Retorna o card HTML estilizado com os dados da compra
                        return "
                        <div class='card-compra'>
                            <h2>Compra</h2>
                            
                            <p>
                                <strong>Código:</strong>
                                ".$dados['id_compras']."
                            </p>
                            
                            <p>
                                <strong>Destino:</strong>
                                ".$dados['localViagem']."
                            </p>
                            
                            <p>
                                <strong>Pagamento:</strong>
                                ".$dados['pagamento']."
                            </p>
                            
                            <p>
                                <strong>Valor:</strong>
                                R$ ".number_format($dados['valor'], 2, ',', '.')."
                            </p>
                            
                            <p>
                                <strong>Status:</strong>
                                ".$dados['statu']."
                            </p>
                        </div>";
                    }
                }
            }
            catch(\Exception $erro)
            {
                // Tratamento de exceção em caso de falha de banco ou consulta
                echo "Algo deu errado <br><br> $erro";
            }
        }
        function listarCompras(Conexao $conexao)
        {
            $compras = [];
            try
            {
                $conn = $conexao->conectar();

                $sql = "select compra.*, usuarios.nome as nomeUsuario from compra inner join usuarios on compra.id_usuarios = usuarios.id_usuarios order by compra.id_compras";
                $result = mysqli_query($conn, $sql);

                while ($dados = mysqli_fetch_assoc($result))
                {
                    $compras[] = $dados;
                }
            }
            catch (\Exception $erro)
            {
                echo "Algo deu errado <br><br> $erro";
            }

            return $compras;
        }
    }
?>