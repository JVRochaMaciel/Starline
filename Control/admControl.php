<?php
    namespace Projeto\starline\Control;

    require_once('../DAO/conexao.php');
    require_once('../DAO/atualizarAdm.php');
    require_once('../Model/adm.php');

    use Projeto\starline\DAO\Conexao;
    use Projeto\starline\DAO\AtualizarAdm;
    use Projeto\starline\Model\Adm;

    // Classe responsável por controlar as ações e gerenciar os dados do administrador
    class ControlAdm
    {
        private Adm $adm;
        private Conexao $conexao;

        // Construtor que recebe a Model do Administrador e inicializa a conexão com o banco
        public function __construct(Adm $adm)
        {
            $this->adm = $adm;
            $this->conexao = new Conexao();
        }

        // Gera o HTML estilizado do card de perfil do administrador com seus dados
        public function consultarAdm(): string
        {
            return "
            <div class='card-adm'>
                <h2>Perfil do Administrador</h2>
                <p><strong>Código:</strong> {$this->adm->codigo}</p>
                <p><strong>Nome:</strong> {$this->adm->nome}</p>
                <p><strong>Login:</strong> {$this->adm->login}</p>
                <p><strong>Senha:</strong> <span id='senha' data-senha='{$this->adm->senha}'>••••••••</span></p>
                <button type='button' class='btn-senha' onclick='mostrarSenha()'>Mostrar senha</button>
            </div>";
        }

        // Valida e atualiza todos os campos do administrador no banco de dados e no objeto local
        public function atualizarTudo(string $nome, string $login, string $senha): bool
        {
            // Verifica se algum dos campos obrigatórios está vazio
            if (empty($nome) || empty($login) || empty($senha)) 
            {
                return false;
            }

            // Instancia o DAO e realiza a atualização no banco de dados
            $atualizar = new AtualizarAdm();
            $sucesso = $atualizar->atualizarTudo($this->conexao, $this->adm->codigo, $nome, $login, $senha);

            // Se a atualização no banco for bem-sucedida, atualiza as propriedades da Model
            if ($sucesso) 
            {
                $this->adm->nome = $nome;
                $this->adm->login = $login;
                $this->adm->senha = $senha;
            }

            return $sucesso;
        }

        // Valida e atualiza um campo específico do administrador no banco de dados e no objeto local
        public function atualizarCampo(string $campo, mixed $novoDado): bool
        {
            // Verifica se o nome do campo ou o novo dado estão vazios
            if (empty($campo) || empty($novoDado)) 
            {
                return false;
            }

            // Instancia o DAO e executa a alteração do campo específico no banco
            $atualizar = new AtualizarAdm();
            $sucesso = $atualizar->atualizarCampo($this->conexao, $this->adm->codigo, $campo, $novoDado);

            // Se o banco for atualizado com sucesso, reflete a alteração dinamicamente na Model
            if ($sucesso) 
            {
                $this->adm->$campo = $novoDado;
            }

            return $sucesso;
        }
    }
?>