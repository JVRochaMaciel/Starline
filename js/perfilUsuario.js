document.addEventListener("DOMContentLoaded", function () 
{
    const senhaInput = document.getElementById("senha");
    const mostrarSenha = document.getElementById("mostrarSenha");

    if (mostrarSenha && senhaInput) 
    {
        mostrarSenha.addEventListener("click", function () 
        {
            if (senhaInput.type === "password") 
            {
                senhaInput.type = "text";
                mostrarSenha.classList.remove("fa-eye");
                mostrarSenha.classList.add("fa-eye-slash");
            } 
            else 
            {
                senhaInput.type = "password";
                mostrarSenha.classList.remove("fa-eye-slash");
                mostrarSenha.classList.add("fa-eye");
            }
        });
    }

    const modalSucesso = document.getElementById("modalSucesso");
    const btnFecharModal = document.getElementById("btnFecharModal");

    if (btnFecharModal) 
    {
        btnFecharModal.addEventListener("click", function () 
        {
            window.location.href = "../View/menuUsuario.php";
        });
    }

    const formPerfil = document.getElementById("formPerfil");

    if (formPerfil) 
    {
        formPerfil.addEventListener("submit", function (event) 
        {
            event.preventDefault();
            const mensagem = document.getElementById("mensagem");
            const formData = new FormData(this);

            fetch('../Control/usuarioControl.php', 
            {
                method: 'POST',
                body: formData
            })
            .then(async response => 
            {
                const text = await response.text();
                try 
                {
                    return JSON.parse(text);
                } 
                catch (err) 
                {
                    console.error("Resposta do servidor:", text);
                    throw new Error("Resposta inválida do servidor.");
                }
            })
            .then(data => 
            {
                if (data.sucesso) 
                {
                    const nomeHeader = document.querySelector('.usuario strong');
                    const novoNome = document.getElementById('nome')?.value;

                    if (nomeHeader && novoNome) 
                    {
                        nomeHeader.textContent = novoNome;
                    }

                    if (modalSucesso) 
                    {
                        modalSucesso.style.display = "flex";
                    }
                } else {
                    if (mensagem) 
                    {
                        mensagem.textContent = data.mensagem;
                        mensagem.style.color = "#dc3545";
                    }
                }
            })
            .catch(error => 
            {
                console.error("Erro no Fetch:", error);
                if (mensagem) 
                {
                    mensagem.textContent = "Não foi possível atualizar os seus dados.";
                    mensagem.style.color = "#dc3545";
                }
            });
        });
    }
});