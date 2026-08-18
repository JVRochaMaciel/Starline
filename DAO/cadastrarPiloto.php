<?php
    namespace Projeto\starline\DAO;

    // Importa a classe de conexão com o banco de dados
    require_once('conexao.php');
    use Projeto\starline\DAO\Conexao;

    // Classe responsável por realizar o cadastro de novos pilotos no banco de dados.
    class CadastrarPiloto
    {
        public function cadastrarPiloto(Conexao $conexao, string $nome, int $identificacao, string $formacao, string $email)
        {
            try
            {
                // Abre a conexão com o banco de dados
                $conn = $conexao->conectar();

                // Instrução SQL para inserção dos dados do piloto
                $sql = "insert into piloto(nome, identificacao, formacao, email) values ('$nome', '$identificacao', '$formacao', '$email')";
                
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