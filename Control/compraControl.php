<?php
    namespace Projeto\starline\ControlCompra;

    require_once('../DAO/conexao.php');
    require_once('../DAO/atualizarCompra.php');
    require_once('../Model/compra.php');

    use Projeto\starline\DAO\Conexao;
    use Projeto\starline\DAO\AtualizarCompra;
    use Projeto\starline\Model\Compra;

    class ControlCompra
    {
        private Compra $compra;
        private Conexao $conexao;


        public function __construct(Compra $compra)
        {
            $this->compra = $compra;
            $this->conexao = new Conexao();
        }


        // CONSULTAR COMPRA
        public function consultarCompra(): string
        {
            return "
            <div class='card-adm'>

                <h2>Compra</h2>

                <p>
                    <strong>Código:</strong>
                    {$this->compra->id_compras}
                </p>

                <p>
                    <strong>Pagamento:</strong>
                    {$this->compra->pagamento}
                </p>

                <p>
                    <strong>Valor:</strong>
                    {$this->compra->valor}
                </p>

                <p>
                    <strong>Local da Viagem:</strong>
                    {$this->compra->localViagem}
                </p>

                <p>
                    <strong>Status:</strong>
                    {$this->compra->statu}
                </p>

                <p>
                    <strong>ID do Usuário:</strong>
                    {$this->compra->id_usuarios}
                </p>

            </div>";
        }


        // ATUALIZAR COMPRA COMPLETA
        public function atualizarTudo(
            string $pagamento,
            float $valor,
            string $localViagem,
            string $statu,
            int $idUsuario
        ): bool
        {
            if (
                empty($pagamento) ||
                $valor <= 0 ||
                empty($localViagem) ||
                empty($statu) ||
                $idUsuario <= 0
            )
            {
                return false;
            }

            $atualizar = new AtualizarCompra();

            $sucesso = $atualizar->atualizarTudo(
                $this->conexao,
                $this->compra->id_compras,
                $idUsuario,
                $localViagem,
                $pagamento,
                $valor,
                $statu
            );

            if ($sucesso)
            {
                $this->compra->pagamento = $pagamento;
                $this->compra->valor = $valor;
                $this->compra->localViagem = $localViagem;
                $this->compra->statu = $statu;
                $this->compra->id_usuarios = $idUsuario;
            }

            return $sucesso;
        }


        // ATUALIZAR SOMENTE STATUS
        public function atualizarStatus(string $statu): bool
        {
            if (empty($statu))
            {
                return false;
            }

            $atualizar = new AtualizarCompra();

            $sucesso = $atualizar->atualizarStatus(
                $this->conexao,
                $this->compra->id_compras,
                $statu
            );

            if ($sucesso)
            {
                $this->compra->statu = $statu;
            }

            return $sucesso;
        }


        // ATUALIZAR UM CAMPO
        public function atualizarCampo(
            string $campo,
            mixed $novoDado
        ): bool
        {
            if (empty($campo) || empty($novoDado))
            {
                return false;
            }

            $atualizar = new AtualizarCompra();

            $sucesso = $atualizar->atualizarCampo(
                $this->conexao,
                $this->compra->id_compras,
                $campo,
                $novoDado
            );

            if ($sucesso)
            {
                $this->compra->$campo = $novoDado;
            }

            return $sucesso;
        }
    }
?>