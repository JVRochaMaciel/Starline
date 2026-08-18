// Função responsável por abrir o formulário de edição do usuário
function editarUsuario(id) 
{
    // Exibe o formulário
    document.getElementById("formulario").style.display = "block";
    // Preenche o ID do usuário
    document.getElementById("idUsuario").value = id;
    // Verifica se o usuário possui ID 1
    if (id == 1) {
        // Preenche os dados do usuário
        document.getElementById("nome").value = "João Silva";
        document.getElementById("cpf").value = "123.456.789-00";
        document.getElementById("telefone").value = "(11) 99999-9999";
        document.getElementById("login").value = "joao";
        document.getElementById("senha").value = "123456";
        document.getElementById("dataNascimento").value = "2008-05-15";
    }
    // Verifica se o usuário possui ID 2
    if (id == 2) 
    {
        // Preenche os dados do usuário
        document.getElementById("nome").value = "Maria Silva";
        document.getElementById("cpf").value = "987.654.321-00";
        document.getElementById("telefone").value = "(11) 98888-8888";
        document.getElementById("login").value = "maria";
        document.getElementById("senha").value = "123456";
        document.getElementById("dataNascimento").value = "2007-08-20";
    }
    // Rola a página suavemente até o formulário
    document.getElementById("formulario").scrollIntoView({
        behavior: "smooth"
    });
} 
// Função responsável por fechar o formulário
function fecharFormulario() 
{
    document.getElementById("formulario").style.display = "none";
}
// Função responsável por salvar as alterações do usuário
function salvarUsuario() 
{ 
    // Exibe uma mensagem informando que o usuário foi atualizado
    alert("Usuário atualizado com sucesso!");
    // Fecha o formulário
    fecharFormulario();
}