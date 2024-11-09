function actualizarOferta() {
    fetch('obtener_oferta_lote.php?id=' + loteId)
        .then(response => response.json())
        .then(data => {
            let montoMaximo = data.monto;
            if (montoMaximo !== "No hay ofertas") {
                document.getElementById("oferta_actual").innerHTML = `${montoMaximo}`;
            } 

            if (montoUsuario < montoMaximo) {
                document.getElementById("oferta_usuario").style.color = "red";
            } else if (montoUsuario == montoMaximo) {
                document.getElementById("oferta_usuario").style.color = "green";
            }

            document.getElementById("oferta_usuario").innerHTML = `Tu oferta: ${montoUsuario || 'N/A'}`;
        })
        .catch(error => console.log('Error al obtener la oferta:', error));
}

setInterval(actualizarOferta, 5000);

actualizarOferta();
