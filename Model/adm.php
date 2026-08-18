<?php
    namespace Projeto\starline\Model;

    class Adm
    {
        //criando os encapsulamentos
        private int $codigo;
        private string $login;
        private string $senha;
        private string $nome;
        //Criando o construtor
        public function __construct(int $codigo, string $login, string $senha, string $nome)
        {
            $this->codigo = $codigo;
            $this->login = $login;
            $this->senha = $senha;
            $this->nome = $nome;
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