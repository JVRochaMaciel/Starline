// Função chamada ao clicar em um dos cards de Destino
function selecionarDestino(elemento, nome, valor, imagem) 
{
    // Desmarca todos os outros cards de destino e reseta os botões
    const todosDestinos = document.querySelectorAll('.destino');
    todosDestinos.forEach(function(d) 
    {
        d.classList.remove('selecionado');
        const btn = d.querySelector('button');
        if (btn) btn.innerText = 'Selecionar';
    });

    // Marca o card clicado
    elemento.classList.add('selecionado');
    const btnClicado = elemento.querySelector('button');
    if (btnClicado) btnClicado.innerText = 'Selecionado';

    // Formata o valor número para Moeda (R$)
    const valorFormatado = Number(valor).toLocaleString('pt-BR', 
    { 
        style: 'currency', 
        currency: 'BRL' 
    });

    // Atualiza os inputs escondidos que vão via POST pro PHP
    document.getElementById('campoLocal').value = nome;
    document.getElementById('campoValor').value = valor;

    // Atualiza os textos da tela em tempo real
    document.getElementById('exibicaoValor').textContent = valorFormatado;
    document.getElementById('nomeDestino').textContent = nome;
    document.getElementById('imagemDestino').src = imagem;
    document.getElementById('valorTotal').textContent = valorFormatado;
}

// Evento disparado quando a página carrega para controlar as opções de pagamento
document.addEventListener('DOMContentLoaded', function() 
{
    const opcoesPagamento = document.querySelectorAll('.pagamento');

    opcoesPagamento.forEach(function(opcao) 
    {
        opcao.addEventListener('click', function() 
        {
            // Remove o destaque de todas as opções
            opcoesPagamento.forEach(p => p.classList.remove('selecionado'));

            // Adiciona o destaque na opção selecionada
            this.classList.add('selecionado');

            // Marca o radio button interno
            const radio = this.querySelector('input[type="radio"]');
            if (radio) {
                radio.checked = true;
            }
        });
    });
});