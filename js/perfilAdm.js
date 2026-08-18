// Aguarda o carregamento completo da página
document.addEventListener("DOMContentLoaded", function () 
{
    // Seleciona o modal de sucesso
    const modalSucesso = document.getElementById("modalSucesso");
    // Seleciona o botão para fechar o modal
    const btnFecharModal = document.getElementById("btnFecharModal");
    // Verifica se o botão e o modal existem
    if (btnFecharModal && modalSucesso) {
        // Adiciona um evento de clique no botão
        btnFecharModal.addEventListener("click", function () 
        {
            // Oculta o modal
            modalSucesso.style.display = "none";
        });
    }
});
// Função responsável por mostrar ou ocultar a senha
function mostrarSenha() 
{
    // Seleciona o campo de senha
    const senha = document.getElementById("senha");
    // Seleciona o ícone da senha
    const icone = document.getElementById("iconeSenha");
    // Verifica se a senha está escondida
    if (senha.type === "password") 
    {
        // Mostra a senha
        senha.type = "text";
        // Remove o ícone de olho
        icone.classList.remove("fa-eye");
        // Adiciona o ícone de olho riscado
        icone.classList.add("fa-eye-slash");
    } 
    else
    {
        // Esconde a senha
        senha.type = "password";
        // Remove o ícone de olho riscado
        icone.classList.remove("fa-eye-slash");
        // Adiciona o ícone de olho normal
        icone.classList.add("fa-eye");
    }
}
// Função responsável por voltar para a página anterior
function voltar() 
{
    // Volta uma página no histórico do navegador
    history.back();
}