// Função responsável por abrir o formulário para cadastrar um novo voo
function novoVoo() 
{

    // Altera o título do formulário
    document.getElementById("tituloFormulario").innerText = "Cadastrar Novo Voo";

    // Limpa o ID oculto do voo
    document.getElementById("idVooHidden").value = "";

    // Limpa o campo visual do ID
    document.getElementById("idVooDisplay").value = "";

    // Limpa o campo de origem
    document.getElementById("origem").value = "";

    // Limpa o campo de destino
    document.getElementById("destino").value = "";

    // Limpa a data de partida
    document.getElementById("dataPartida").value = "";

    // Limpa a data de chegada
    document.getElementById("dataChegada").value = "";

    // Limpa o ID da nave
    document.getElementById("idNave").value = "";

    // Limpa o ID do piloto
    document.getElementById("idPiloto").value = "";

    // Busca o elemento do formulário
    const formulario = document.getElementById("formulario");

    // Exibe o formulário
    formulario.style.display = "block";

    // Rola a página suavemente até o formulário
    formulario.scrollIntoView({ behavior: "smooth" });
}


// Função responsável por abrir o formulário para editar um voo
function editarVoo(idVoo, origem, destino, dataPartida, dataChegada, idNave, idPiloto) 
{

    // Altera o título do formulário mostrando o ID do voo
    document.getElementById("tituloFormulario").innerText = "Atualizar Voo #" + idVoo;

    // Preenche o ID oculto do voo
    document.getElementById("idVooHidden").value = idVoo;

    // Exibe o ID do voo no campo visual
    document.getElementById("idVooDisplay").value = "#" + idVoo;

    // Preenche a origem do voo
    document.getElementById("origem").value = origem;

    // Preenche o destino do voo
    document.getElementById("destino").value = destino;

    // Preenche a data de partida
    document.getElementById("dataPartida").value = dataPartida;

    // Preenche a data de chegada
    document.getElementById("dataChegada").value = dataChegada;

    // Preenche o ID da nave
    document.getElementById("idNave").value = idNave;

    // Preenche o ID do piloto
    document.getElementById("idPiloto").value = idPiloto;

    // Busca o elemento do formulário
    const formulario = document.getElementById("formulario");

    // Exibe o formulário
    formulario.style.display = "block";

    // Rola a página suavemente até o formulário
    formulario.scrollIntoView({ behavior: "smooth" });
}


// Função responsável por fechar o formulário
function fecharFormulario() 
{

    // Oculta o formulário
    document.getElementById("formulario").style.display = "none";
}