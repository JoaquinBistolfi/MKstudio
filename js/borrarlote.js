function borrarlote(idlote) {
    console.log("ID de lote para borrar:", idlote); // Depuración
    fetch('borrar_lote.php?id=' + idlote)
        .then(response => response.text())
        .then(data => {
            if (data === 'success') {
                location.reload();
            } else {
                alert('Error al borrar lotes.');
            }
        })
        .catch(error => console.error('Error:', error));
}
