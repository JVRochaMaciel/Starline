<?php
    namespace Projeto\starline\Model;

    class Compra
    {
        private int $id_compras;
        private string $pagamento;
        private float $valor;
        private string $localViagem;
        private string $statu;
        private int $id_usuarios;

        public function __construct(int $id_compras, string $pagamento, float $valor, string $localViagem, string $statu, int $id_usuarios)
        {
            $this->id_compras = $id_compras;
            $this->pagamento = $pagamento;
            $this->valor = $valor;
            $this->localViagem = $localViagem;
            $this->statu = $statu;
            $this->id_usuarios = $id_usuarios;
        }
        // GET
        public function __get(string $dados): mixed
        {
            return $this->$dados;
        }
        // SET
        public function __set(string $variavel, mixed $novoDado): void
        {
            $this->$variavel = $novoDado;
        }
    }
?>