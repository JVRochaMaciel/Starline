// ========================================
// FILTROS DAS RESERVAS
// ========================================

const filtros = document.querySelectorAll(".filtro");
const compras = document.querySelectorAll(".compra-card");

filtros.forEach(function(filtro) 
{
    filtro.addEventListener("click", function() 
    {
        // Remove ativo dos outros filtros
        filtros.forEach(function(outroFiltro) 
        {
            outroFiltro.classList.remove("ativo");
        });

        // Ativa o filtro clicado
        filtro.classList.add("ativo");

        // Pega o texto do botão em minúsculo
        const filtroSelecionado = filtro.textContent.trim().toLowerCase();

        compras.forEach(function(compra) 
        {
            // Pega o status do card em minúsculo
            const statusElem = compra.querySelector(".status");
            const status = statusElem ? statusElem.textContent.trim().toLowerCase() : "";

            // TODAS
            if (filtroSelecionado === "todas") 
            {
                compra.style.display = "grid";
            }
            // ATIVAS
            else if (filtroSelecionado === "ativas") 
            {
                if (status.includes("ativ") && !status.includes("desativ")) 
                {
                    compra.style.display = "grid";
                } 
                else 
                {
                    compra.style.display = "none";
                }
            }
            // CANCELADAS (inclui Desativado)
            else if (filtroSelecionado === "canceladas") 
            {
                if (status.includes("cancelad") || status.includes("desativad")) 
                {
                    compra.style.display = "grid";
                } 
                else 
                {
                    compra.style.display = "none";
                }
            }
            // CONCLUÍDAS
            else if (filtroSelecionado === "concluídas" || filtroSelecionado === "concluidas") 
            {
                if (status.includes("conclu")) 
                {
                    compra.style.display = "grid";
                } 
                else 
                {
                    compra.style.display = "none";
                }
            }
        });
    });
});