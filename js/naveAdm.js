// Função responsável por abrir o formulário para cadastrar uma nova nave
function novaNave() 
{
    // Altera o título do formulário
    document.getElementById("tituloFormulario").innerHTML = "Cadastrar nave";
    // Limpa o ID oculto da nave
    document.getElementById("idNaveHidden").value = "";
    // Limpa o ID visual da nave
    document.getElementById("idNave").value = "";
    // Limpa o nome da nave
    document.getElementById("nome").value = "";
    // Limpa a quantidade de assentos
    document.getElementById("assentos").value = "";
    // Exibe o formulário
    document.getElementById("formulario").style.display = "block";
    // Rola suavemente até o formulário
    document.getElementById("formulario").scrollIntoView({ behavior: "smooth" });
}
// Função responsável por abrir o formulário para editar uma nave
function editarNave(id, nome, assentos) 
{
    // Altera o título do formulário
    document.getElementById("tituloFormulario").innerHTML = "Atualizar nave";
    // Preenche o ID oculto da nave
    document.getElementById("idNaveHidden").value = id;
    // Preenche o ID visual da nave
    document.getElementById("idNave").value = id;
    // Preenche o nome da nave
    document.getElementById("nome").value = nome;
    // Preenche a quantidade de assentos
    document.getElementById("assentos").value = assentos;
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