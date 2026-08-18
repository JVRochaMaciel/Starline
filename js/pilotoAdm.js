// Função responsável por abrir o formulário para cadastrar um novo piloto
function novoPiloto() 
{

    // Altera o título do formulário
    document.getElementById("tituloFormulario").innerHTML = "Cadastrar piloto";

    // Limpa o ID oculto do piloto
    document.getElementById("idPilotoHidden").value = "";

    // Limpa o campo visual do ID
    document.getElementById("idPiloto").value = "";

    // Limpa o nome
    document.getElementById("nome").value = "";

    // Limpa a identificação
    document.getElementById("identificacao").value = "";

    // Limpa a formação
    document.getElementById("formacao").value = "";

    // Limpa o e-mail
    document.getElementById("email").value = "";

    // Define o status padrão como Ativo
    document.getElementById("status").value = "Ativo";

    // Exibe o formulário
    document.getElementById("formulario").style.display = "block";

    // Rola suavemente até o formulário
    document.getElementById("formulario").scrollIntoView({ behavior: "smooth" });
}


// Função responsável por abrir o formulário para editar um piloto
function editarPiloto(id, nome, identificacao, formacao, email, status) 
{

    // Altera o título do formulário
    document.getElementById("tituloFormulario").innerHTML = "Atualizar piloto";

    // Preenche o ID oculto do piloto
    document.getElementById("idPilotoHidden").value = id;

    // Preenche o ID visual do piloto
    document.getElementById("idPiloto").value = id;

    // Preenche o nome
    document.getElementById("nome").value = nome;

    // Preenche a identificação
    document.getElementById("identificacao").value = identificacao;

    // Preenche a formação
    document.getElementById("formacao").value = formacao;

    // Preenche o e-mail
    document.getElementById("email").value = email;
    
    // Verifica se existe um status informado
    if (status) 
    {

        // Seleciona o status do piloto
        document.getElementById("status").value = status;
    }

    // Exibe o formulário
    document.getElementById("formulario").style.display = "block";

    // Rola suavemente até o formulário
    document.getElementById("formulario").scrollIntoView({ behavior: "smooth" });
}


// Função responsável por fechar o formulário
function fecharFormulario() 
{

    // Oculta o formulário
    document.getElementById("formulario").style.display = "none";
}