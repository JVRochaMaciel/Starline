<?php
    namespace Projeto\starline\Model;

    class Usuario
    {
        //criando os encapsulamentos
        private int $codigo;
        private string $nome;
        private string $cpf;
        private string $telefone;
        private string $login;
        private string $senha;
        private string $dtNascimento;

        //Criando o construtor
        public function __construct(int $codigo, string $nome, string $cpf, string $telefone, string $login, string $senha, string $dtNascimento)
        {
            $this->codigo = $codigo;
            $this->nome = $nome;
            $this->cpf = $cpf;
            $this->telefone = $telefone;
            $this->login = $login;
            $this->senha = $senha;
            $this->dtNascimento = $dtNascimento;
        }//fim do construtor

        //criando Get
        public function __get(string $dados): mixed
        {
            return $this->$dados;
        }//fim do get

        //criando set
        public function __set(string $variavel, mixed $novoDado): void
        {
            $this->$variavel = $novoDado;
        }//fim do set
    }//fim da classe
?>