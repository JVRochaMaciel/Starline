<?php
    namespace Projeto\starline\Model;

    class Nave
    {
        // Criando os atributos encapsulados
        private int $codigo;
        private string $nome;
        private int $assentos;

        // Criando o construtor
        public function __construct(int $codigo, string $nome, int $assentos)
        {
            $this->codigo = $codigo;
            $this->nome = $nome;
            $this->assentos = $assentos;
        } // fim do construtor

        // Criando Get mágico
        public function __get(string $dados): mixed
        {
            return $this->$dados;
        } // fim do get

        // Criando Set mágico
        public function __set(string $variavel, mixed $novoDado): void
        {
            $this->$variavel = $novoDado;
        } // fim do set
    } // fim da classe
?>