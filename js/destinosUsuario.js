// Obtém o campo de busca pelo ID
const campoBusca = document.getElementById("campoBusca"); 
// Executa o filtro sempre que o usuário digitar
campoBusca.addEventListener("input",function()
{
    filtrarDestinos();
}); 
// Função responsável por filtrar os destinos
function filtrarDestinos()
{
    // Obtém o texto digitado e transforma em letras minúsculas
    const busca = campoBusca.value.toLowerCase();
    // Obtém o tipo de destino selecionado
    const tipo = document.getElementById("tipoDestino").value;
    // Obtém todos os cards de destinos
    const cards = document.querySelectorAll(".card-destino");
    // Percorre cada card
    cards.forEach(function(card)
    {
        // Obtém o nome e o tipo do destino
        const nome = card.dataset.nome;
        const tipoCard = card.dataset.tipo;
        // Verifica se o nome corresponde à busca
        const encontrouNome = nome.includes(busca);
        // Verifica se o tipo corresponde ao filtro
        const encontrouTipo = tipo === "todos" || tipo === tipoCard;
        // Exibe o card quando os dois filtros forem atendidos
        if(encontrouNome && encontrouTipo)
        {
            card.style.display = "block";
        }
        else
        {
            // Oculta o card quando não corresponder
            card.style.display = "none";
        }
    });
} 
// Função responsável por informar qual destino foi selecionado
function verDestino(destino)
{
    alert("Você selecionou o destino: " + destino);
} 
// Função responsável por informar sobre o consultor
function falarConsultor()
{
    alert("Em breve você poderá falar com um consultor StarLine.");
}