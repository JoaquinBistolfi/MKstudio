document.addEventListener("DOMContentLoaded", () => {
    const botones = document.querySelectorAll(".toggle-status");

    botones.forEach(boton => {
        boton.addEventListener("click", (event) => {
            event.preventDefault();

            const idUsuario = boton.getAttribute("data-id");
            const estadoCelda = boton.parentElement.previousElementSibling;

            fetch("../paginas/administrar_usuarios.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "id_usuario=" + encodeURIComponent(idUsuario)
            })
            .then(response => response.text())
            .then(data => {
                estadoCelda.textContent = data;
                boton.textContent = data === "Bloqueado" ? "Desbloquear" : "Bloquear";
                boton.classList.toggle("bloqueado", data === "Bloqueado");
            })
            .catch(error => console.error("Error:", error));
        });
    });
});