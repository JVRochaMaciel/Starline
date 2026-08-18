<?php
    namespace Projeto\starline\DAO;

    // Importa a classe de conexão com o banco de dados
    require_once('conexao.php');
    use Projeto\starline\DAO\Conexao;

    //Classe responsável por realizar o cadastro de novos usuários no banco de dados.
    class CadastrarUsuario
    {
        public function cadastrarUsuario(Conexao $conexao, string $nome, string $cpf, string $telefone, string $login, string $senha, string $dataNascimento)
        {
            try
            {
                // Abre a conexão com o banco de dados
                $conn = $conexao->conectar();
                
                // Define o ID do administrador padrão responsável pelo cadastro
                $id_adm = 1;

                // Instrução SQL para inserção dos dados do usuário
                $sql = "insert into usuarios(nome, cpf, telefone, login, senha, dataNascimento, id_adm) values ('$nome', '$cpf', '$telefone', '$login', '$senha', '$dataNascimento', '$id_adm')";
                
                // Executa a query no MySQL
                $resultado = mysqli_query($conn, $sql);
                
                // Fecha a conexão com o banco de dados
                mysqli_close($conn);

                // Verifica se a gravação foi bem-sucedida
                if($resultado)
                {
                    return "cadastrado";
                }
                return "erro";
            }
            catch(\Exception $erro)
            {
                // Retorna "erro" caso ocorra qualquer exceção na execução
                return "erro";
            }
        }
    }
?>