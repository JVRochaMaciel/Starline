<?php
    namespace Projeto\starline\Control;
    require_once '../DAO/conexao.php';
    require_once '../DAO/cadastrarNave.php';
    require_once '../DAO/consultarNave.php';
    require_once '../DAO/atualizarNave.php';
    require_once '../Model/nave.php';
    use Projeto\starline\DAO\Conexao;
    use Projeto\starline\DAO\CadastrarNave;
    use Projeto\starline\DAO\ConsultarNave;
    use Projeto\starline\DAO\AtualizarNave;
    use Projeto\starline\Model\Nave;
    // Classe responsável pela regência das ações e regras de negócio relacionadas às naves
    class ControlNave
    {
        private Conexao $conexao;
        // Construtor que inicializa o objeto de conexão com o banco de dados
        public function __construct()
        {
            $this->conexao = new Conexao();
        }
        // Valida os dados e executa o cadastro de uma nova nave
        public function cadastrar(string $nome, int $assentos): string
        {
            // Valida se o nome está preenchido e se a quantidade de assentos é maior que zero
            if (empty($nome) || $assentos <= 0) 
            {
                return "Preencha todos os campos corretamente.";
            }
            // Instancia a classe DAO para persistir os dados da nave no banco
            $cadastrar = new CadastrarNave();
            return $cadastrar->cadastrarNave($this->conexao, $nome, $assentos);
        }
        // Retorna a listagem de todas as naves registradas
        public function consultarTodas(): array
        {
            // Instancia a classe DAO responsável por buscar todas as naves
            $consultar = new ConsultarNave();
            return $consultar->consultarTodas($this->conexao);
        }
        // Busca os dados de uma nave específica pelo seu ID
        public function consultarPorId(int $idNave): array|bool
        {
            // Instancia a classe DAO para realizar a consulta filtrada pelo ID
            $consultar = new ConsultarNave();
            return $consultar->consultarPorId($this->conexao, $idNave);
        }
        // Valida e atualiza as informações de uma nave existente
        public function atualizarTudo(int $codigo, string $nome, int $assentos): bool
        {
            // Valida se o ID, nome e quantidade de assentos cumprem os requisitos mínimos
            if ($codigo <= 0 || empty($nome) || $assentos <= 0) 
            {
                return false;
            }

            // Instancia a classe DAO responsável por aplicar a atualização no banco
            $atualizar = new AtualizarNave();
            return $atualizar->atualizarTudo($this->conexao, $codigo, $nome, $assentos);
        }
    }
?>