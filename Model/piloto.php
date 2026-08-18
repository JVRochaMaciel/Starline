<?php
    namespace Projeto\starline\Model;

    class Piloto
    {
        // Criando os atributos encapsulados
        private int $codigo;
        private string $nome;
        private int $identificacao;
        private string $formacao;
        private string $email;

        // Criando o construtor
        public function __construct(int $codigo, string $nome, int $identificacao, string $formacao, string $email)
        {
            $this->codigo = $codigo;
            $this->nome = $nome;
            $this->identificacao = $identificacao;
            $this->formacao = $formacao;
            $this->email = $email;
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