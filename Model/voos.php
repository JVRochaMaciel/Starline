<?php
    namespace Projeto\starline\Model;

    class Voo
    {
        // Criando os encapsulamentos
        private int $idVoo;
        private string $origem;
        private string $destino;
        private string $dataPartida;
        private string $dataChegada;
        private int $id_nave;
        private int $id_piloto;

        // Criando o construtor
        public function __construct(int $idVoo, string $origem, string $destino, string $dataPartida, string $dataChegada, int $id_nave, int $id_piloto)
        {
            $this->idVoo = $idVoo;
            $this->origem = $origem;
            $this->destino = $destino;
            $this->dataPartida = $dataPartida;
            $this->dataChegada = $dataChegada;
            $this->id_nave = $id_nave;
            $this->id_piloto = $id_piloto;
        }
        // Criando Get
        public function __get(string $dados): mixed
        {
            return $this->$dados;
        }
        // Criando Set
        public function __set(string $variavel, mixed $novoDado): void
        {
            $this->$variavel = $novoDado;
        }
    }
?>