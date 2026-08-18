// Rola a página suavemente até a seção de destinos populares quando o usuário clica no botão "Explorar Destinos" do banner principal. //
function explorarDestinos() 
{
    document.querySelector(".destinos").scrollIntoView(
    {
        behavior: "smooth" // Animação de rolagem suave
    });
}

/** Exibe um alerta simples confirmando a seleção do destino clicado.
@param {string} destino - Nome do destino retornado pelo botão (ex: 'Lua', 'Marte'). */
function reservar(destino) 
{
    alert("Você selecionou uma viagem para " + destino + ".");
}

// Exibe os detalhes da reserva ativa do usuário.
function verReserva() 
{
    alert("Aqui serão exibidos os detalhes da sua reserva.");
}
// Seleciona todos os links/itens navegáveis do menu lateral
const itensMenu = document.querySelectorAll(".menu-item");

// Percorre cada item do menu para adicionar o evento de clique
itensMenu.forEach(function(item) 
{
    item.addEventListener("click", function() 
    {

        // Remove a classe 'ativo' de todos os outros itens para desmarcá-los
        itensMenu.forEach(function(outroItem) {
            outroItem.classList.remove("ativo");
        });

        // Adiciona a classe 'ativo' apenas ao item que acabou de ser clicado
        item.classList.add("ativo");

    });

});