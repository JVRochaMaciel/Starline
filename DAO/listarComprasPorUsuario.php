<?php
    namespace Projeto\starline\DAO;
    require_once('conexao.php');
    use Projeto\starline\DAO\Conexao;

    // Classe responsável por listar todas as compras de um usuário específico.
    class ListarComprasPorUsuario
    {
        function listar(Conexao $conexao, int $id_usuarios): string
        {
            try
            {
                $conn = $conexao->conectar();

                // Busca todas as compras realizadas pelo usuário
                $sql = "select * from compra where id_usuarios = ? order by id_compras desc";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "i", $id_usuarios);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                // ========================================
                // NENHUMA COMPRA
                // ========================================
                if (mysqli_num_rows($result) === 0)
                {
                    return "
                        <div class='sem-compras'>
                            <div class='icone-sem-compras'>
                                <i class='fa-solid fa-rocket'></i>
                            </div>
                            <h2>Você ainda não possui reservas</h2>
                            <p>
                                Parece que você ainda não realizou nenhuma compra.
                                Explore nossos destinos e encontre sua próxima aventura!
                            </p>
                            <a href='destinosUsuario.php' class='btn-comprar'>
                                <i class='fa-solid fa-earth-americas'></i>
                                Explorar destinos
                            </a>
                        </div>
                    ";
                }

                // ========================================
                // EXISTEM COMPRAS
                // ========================================
                $html = "";
                while ($dados = mysqli_fetch_assoc($result))
                {
                    // Imagem do destino
                    $imagem = match (strtolower(trim($dados['localViagem'])))
                    {
                        'lua' => 'lua.jpg',
                        'marte' => 'marte.jpg',
                        'estação espacial',
                        'estacao espacial' => 'estacao.jpg',
                        default => 'default.jpg'
                    };

                    // Ícone do pagamento
                    $iconePagamento = match (strtolower(trim($dados['pagamento'])))
                    {
                        'pix' => 'fa-brands fa-pix',
                        'boleto',
                        'boleto bancário',
                        'boleto bancario' => 'fa-solid fa-barcode',
                        default => 'fa-solid fa-credit-card'
                    };

                    // Classe do status
                    $classeStatus = strtolower(trim($dados['statu']));

                    // ========================================
                    // MONTA O CARD
                    // ========================================
                    $html .= "
                        <article class='compra-card'>
                            <div class='compra-destino'>
                                <img src='/starline/img/$imagem' alt='".$dados['localViagem']."'>
                                <div>
                                    <h3>".$dados['localViagem']."</h3>
                                    <p>
                                        Código:
                                        <strong>".$dados['id_compras']."</strong>
                                    </p>
                                </div>
                            </div>
                            <div class='local'>
                                <i class='fa-solid fa-location-dot'></i>
                                <span>
                                    ".$dados['localViagem']."
                                </span>
                            </div>
                            <div class='valor'>
                                <strong>
                                    R$ ".number_format(
                                        $dados['valor'],
                                        2,
                                        ',',
                                        '.'
                                    )."
                                </strong>
                            </div>
                            <div class='pagamento'>
                                <i class='$iconePagamento'></i>
                                <span>
                                    ".$dados['pagamento']."
                                </span>
                            </div>
                            <div class='status $classeStatus'>
                                ".$dados['statu']."
                            </div>
                        </article>
                    ";
                }
                mysqli_stmt_close($stmt);
                return $html;
            }
            catch (\Exception $erro)
            {
                return "
                    <div class='sem-compras erro'>
                        <div class='icone-sem-compras'>
                            <i class='fa-solid fa-triangle-exclamation'></i>
                        </div>
                        <h2>Não foi possível carregar suas reservas</h2>
                        <p>
                            Ocorreu um problema ao consultar suas compras.
                            Tente novamente mais tarde.
                        </p>
                    </div>
                ";
            }
        }

        function ultimaCompra(Conexao $conexao, int $id_usuarios)
        {
            try
            {
                $conn = $conexao->conectar();

                // Corrigido: ORDER BY e $id_usuarios
                $sql = "select * from compra where id_usuarios = ? order by id_compras desc limit 1";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "i", $id_usuarios);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) === 0)
                {
                    return null;
                }

                return mysqli_fetch_assoc($result);
            }
            catch (\Exception $erro)
            {
                return null;
            }
        }
    }
?>