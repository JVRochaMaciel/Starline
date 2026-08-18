// Variável que define o modo atual do formulário
let modo = "";

// Guarda o ID do usuário que está sendo editado
let idEditando = null;


// Função responsável por editar um usuário
function editarUsuario(id)
{
    // Procura o usuário pelo ID
    const usuario = usuarios.find(
        item => parseInt(item.id_usuarios) === parseInt(id)
    );

    // Verifica se o usuário foi encontrado
    if (!usuario)
    {
        alert("Usuário não encontrado.");
        return;
    }

    // Define o modo como edição
    modo = "edicao";

    // Guarda o ID do usuário que está sendo editado
    idEditando = id;

    // Exibe o formulário
    document.getElementById("formulario").style.display = "block";

    // Preenche o ID do usuário
    document.getElementById("idUsuario").value = usuario.id_usuarios;

    // Preenche o nome
    document.getElementById("nomeUsuario").value = usuario.nome;

    // Preenche o CPF
    document.getElementById("cpfUsuario").value = usuario.cpf;

    // Preenche o telefone
    document.getElementById("telefoneUsuario").value = usuario.telefone;

    // Preenche o login
    document.getElementById("loginUsuario").value = usuario.login;

    // Preenche o status
    document.getElementById("statusUsuario").value = usuario.statu;

    // Rola suavemente até o formulário
    document.getElementById("formulario").scrollIntoView({
        behavior: "smooth"
    });
}


// Função responsável por fechar o formulário
function fecharFormulario()
{
    // Oculta o formulário
    document.getElementById("formulario").style.display = "none";
}


// Função responsável por salvar o novo status do usuário
function salvarStatusUsuario()
{
    // Pega o ID do usuário
    const idUsuario = document.getElementById("idUsuario").value;

    // Pega o status selecionado
    const status = document.getElementById("statusUsuario").value;

    // Verifica se os campos foram preenchidos
    if (!idUsuario || !status)
    {
        alert("Selecione um status.");
        return;
    }

    // Cria os dados que serão enviados ao PHP
    const dados = new FormData();

    // Adiciona o ID aos dados
    dados.append("id", idUsuario);

    // Adiciona o status aos dados
    dados.append("status", status);

    // Envia os dados para o arquivo PHP responsável pela atualização
    fetch("../DAO/atualizarStatusUsuario.php", 
    {
        method: "POST",
        body: dados
    })

    // Converte a resposta para JSON
    .then(response => response.json())

    // Recebe o resultado da atualização
    .then(resposta =>
    {
        // Verifica se a atualização foi realizada com sucesso
        if (resposta.sucesso)
        {
            // Procura a linha do usuário na tabela
            const linha = document.querySelector(
                'tr[data-id="' + resposta.id + '"]'
            );

            // Verifica se a linha foi encontrada
            if (linha)
            {
                // Procura o elemento que mostra o status
                const badge = linha.children[6].querySelector("span");

                // Verifica se o novo status é Ativo
                if (resposta.status === "Ativo")
                {
                    // Atualiza o texto do status
                    badge.textContent = "Ativo";

                    // Altera a classe para o estilo de ativo
                    badge.className = "ativo";
                }
                else
                {
                    // Atualiza o texto do status
                    badge.textContent = "Desativado";

                    // Altera a classe para o estilo de desativado
                    badge.className = "desativado";
                }
            }

            // Procura o usuário dentro da lista de usuários
            const usuario = usuarios.find(
                item => parseInt(item.id_usuarios) === parseInt(resposta.id)
            );

            // Verifica se o usuário foi encontrado
            if (usuario)
            {
                // Atualiza o status do usuário na lista
                usuario.statu = resposta.status;
            }

            // Informa que a atualização foi realizada
            alert("Status do usuário atualizado com sucesso!");

            // Fecha o formulário
            fecharFormulario();
        }
        else
        {
            // Informa que não foi possível atualizar
            alert("Não foi possível atualizar o status do usuário.");
        }
    })

    // Trata erros na requisição
    .catch(erro =>
    {
        // Mostra o erro no console
        console.error(erro);

        // Informa que ocorreu um erro
        alert("Erro ao atualizar o status do usuário.");
    });
}