// Captura os elementos HTML do ícone do olho e do campo de input da senha pelos seus IDs
const olho = document.getElementById("mostrarSenha");
const senha = document.getElementById("senha");

// Adiciona um ouvinte de evento para executar uma função toda vez que o ícone do olho for clicado
olho.addEventListener("click", () => 
{
    // Verifica se a senha está atualmente oculta (tipo 'password')
    if (senha.type === "password") 
    {
        // Altera o tipo do input para 'text', tornando a senha visível
        senha.type = "text";
        
        // Troca o ícone de olho aberto para o ícone de olho cortado (FontAwesome)
        olho.classList.remove("fa-eye");
        olho.classList.add("fa-eye-slash");
    }
    else 
    {
        // Caso a senha já esteja visível, altera o tipo de volta para 'password' para ocultá-la
        senha.type = "password";
        
        // Troca o ícone de olho cortado de volta para o olho aberto
        olho.classList.remove("fa-eye-slash");
        olho.classList.add("fa-eye");
    }
});