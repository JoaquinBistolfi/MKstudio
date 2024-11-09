function marcarRespondida(idPregunta) {
    fetch('marcar_respondida.php?id=' + idPregunta)
        .then(response => response.text())
        .then(data => {
            if (data === 'success') {
                location.reload(); 
            } else {
                alert('Error al marcar como respondida.');
            }
        })
        .catch(error => console.error('Error:', error));
}
