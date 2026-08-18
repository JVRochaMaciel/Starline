// ============================================================================
// --- ALTERAR STATUS DA COMPRA (ATIVAR / DESATIVAR VIA FETCH) ---
// ============================================================================
function alterarStatus(id, elementoClicado) 
{
    const botao = elementoClicado.closest("button");

    if (!botao) 
    {
        console.error("Botão não encontrado.");
        return;
    }

    // Verifica se o botão clicado é o verde (ativar) ou o vermelho (desativar)
    const eParaAtivar = botao.classList.contains("ativar");
    const novoStatus = eParaAtivar ? "Ativo" : "Desativado";
    const acaoTexto = eParaAtivar ? "ativar" : "desativar";

    // Confirmação com o usuário
    if (!confirm(`Deseja realmente ${acaoTexto} esta compra?`)) 
    {
        return;
    }

    const parametros = new URLSearchParams();
    parametros.append("id", id);
    parametros.append("status", novoStatus);

    fetch("../DAO/atualizarStatus.php", 
    {
        method: "POST",
        headers: 
        { 
            "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8" 
        },
        body: parametros.toString()
    })
    .then(async (response) => 
    {
        const texto = await response.text();

        if (!response.ok) 
        {
            throw new Error(`Erro no servidor (${response.status}): ${texto}`);
        }

        try 
        {
            return JSON.parse(texto);
        } 
        catch (e) 
        {
            throw new Error("Resposta do servidor não é um JSON válido:\n" + texto);
        }
    })
    .then((dados) => 
    {
        if (dados.sucesso) 
        {
            alert(`Status alterado com sucesso para "${novoStatus}"!`);
            location.reload();
        } 
        else 
        {
            alert(dados.mensagem || "Não foi possível alterar o status da compra.");
        }
    })
    .catch((erro) => 
    {
        console.error("Erro na requisição:", erro);
        alert("Ocorreu um erro ao tentar alterar o status:\n" + erro.message);
    });
}

// ============================================================================
// --- ABRIR E PREENCHER O FORMULÁRIO DE EDIÇÃO ---
// ============================================================================
function editarCompra(idCompra) 
{
    if (typeof compras === "undefined" || !Array.isArray(compras)) 
    {
        alert("Erro ao carregar a lista de compras.");
        return;
    }

    const compra = compras.find(c => parseInt(c.id_compras) === parseInt(idCompra));

    if (!compra) 
    {
        alert("Compra não encontrada!");
        return;
    }

    // Preenche os inputs do formulário com os dados da compra selecionada
    document.getElementById("idCompra").value = compra.id_compras;
    document.getElementById("idUsuario").value = compra.id_usuarios;
    
    // Suporta tanto id "local" quanto id "localViagem" no HTML
    const inputLocal = document.getElementById("local") || document.getElementById("localViagem");
    if (inputLocal) {
        inputLocal.value = compra.localViagem;
    }

    document.getElementById("pagamento").value = compra.pagamento;
    document.getElementById("valor").value = compra.valor;
    document.getElementById("status").value = compra.statu;

    // Exibe o formulário e faz a rolagem suave até ele
    const formulario = document.getElementById("formulario");
    if (formulario) 
    {
        formulario.style.display = "block";
        formulario.scrollIntoView({ behavior: "smooth" });
    }
}

// ============================================================================
// --- FECHAR O FORMULÁRIO DE EDIÇÃO ---
// ============================================================================
function fecharFormulario() 
{
    const formulario = document.getElementById("formulario");
    if (formulario) {
        formulario.style.display = "none";
    }
}

// ============================================================================
// --- SALVAR ALTERAÇÕES DO FORMULÁRIO COMPLETO ---
// ============================================================================
function salvarCompra() 
{
    if (!confirm("Deseja realmente atualizar as informações desta compra?")) 
    {
        return;
    }

    // Captura os valores dos campos
    const idCompra = document.getElementById("idCompra").value;
    const idUsuario = document.getElementById("idUsuario").value;
    
    // Busca o valor do campo de local independentemente se o id é 'local' ou 'localViagem'
    const inputLocal = document.getElementById("local") || document.getElementById("localViagem");
    const localViagem = inputLocal ? inputLocal.value : "";
    
    const pagamento = document.getElementById("pagamento").value;
    const valor = document.getElementById("valor").value;
    const status = document.getElementById("status").value;

    // Validação básica dos campos obrigatórios
    if (!idCompra || !idUsuario || !valor) 
    {
        alert("Por favor, preencha todos os campos obrigatórios.");
        return;
    }

    // Monta os parâmetros para envio via POST
    const parametros = new URLSearchParams();
    parametros.append("idCompra", idCompra);
    parametros.append("idUsuario", idUsuario);
    parametros.append("localViagem", localViagem); // Nome alinhado com o PHP
    parametros.append("pagamento", pagamento);
    parametros.append("valor", valor);
    parametros.append("status", status);

    // Faz a chamada Fetch para o endpoint correto no backend PHP
    fetch("../DAO/atualizarDadosCompra.php", 
    {
        method: "POST",
        headers: 
        { 
            "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8" 
        },
        body: parametros.toString()
    })
    .then(async (response) => 
    {
        const texto = await response.text();

        if (!response.ok) 
        {
            throw new Error(`Erro no servidor (${response.status}): ${texto}`);
        }

        try 
        {
            return JSON.parse(texto);
        } 
        catch (e) 
        {
            throw new Error("Erro na resposta do servidor:\n" + texto);
        }
    })
    .then((dados) => 
    {
        if (dados.sucesso) 
        {
            alert("Compra atualizada com sucesso!");
            location.reload();
        } 
        else 
        {
            alert(dados.mensagem || "Erro ao salvar as alterações.");
        }
    })
    .catch((erro) => 
    {
        console.error("Erro ao salvar:", erro);
        alert("Falha ao salvar alterações:\n" + erro.message);
    });
}