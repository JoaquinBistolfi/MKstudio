document.addEventListener("DOMContentLoaded", function() {
    const rows = document.querySelectorAll(".fila-enlace");
    rows.forEach(row => {
        row.addEventListener("click", function() {
            window.location.href = row.dataset.href;
        });
    });
});