document.addEventListener("DOMContentLoaded", function () {
    const senha = document.getElementById("senha");
    const confirmar = document.getElementById("confirmarSenha");

    const olhoSenha = document.getElementById("mostrarSenha");
    const olhoConfirmar = document.getElementById("mostrarConfirmar");

    // ALTERNAR VISIBILIDADE DA SENHA
    if (olhoSenha && senha) {
        olhoSenha.addEventListener("click", () => {
            if (senha.type === "password") {
                senha.type = "text";
                olhoSenha.classList.remove("fa-eye");
                olhoSenha.classList.add("fa-eye-slash");
            } else {
                senha.type = "password";
                olhoSenha.classList.remove("fa-eye-slash");
                olhoSenha.classList.add("fa-eye");
            }
        });
    }

    // ALTERNAR VISIBILIDADE DA CONFIRMAÇÃO DE SENHA (se existir na tela)
    if (olhoConfirmar && confirmar) {
        olhoConfirmar.addEventListener("click", () => {
            if (confirmar.type === "password") {
                confirmar.type = "text";
                olhoConfirmar.classList.remove("fa-eye");
                olhoConfirmar.classList.add("fa-eye-slash");
            } else {
                confirmar.type = "password";
                olhoConfirmar.classList.remove("fa-eye-slash");
                olhoConfirmar.classList.add("fa-eye");
            }
        });
    }

    // REDIRECIONAR AO CLICAR NO BOTÃO DO MODAL DE SUCESSO
    const btnIrLogin = document.getElementById("btnIrLogin");
    if (btnIrLogin) {
        btnIrLogin.addEventListener("click", function () {
            window.location.href = "../index.php";
        });
    }
});