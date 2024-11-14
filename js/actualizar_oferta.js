function actualizarOferta() {

    const ofertaActual = document.getElementById("oferta_actual");
    const ofertaUsuario = document.getElementById("oferta_usuario");

    if (ofertaActual && ofertaUsuario) {
        fetch('obtener_oferta_lote.php?id=' + loteId)
            .then(response => response.json())
            .then(data => {
                let montoMaximo = data.monto;
                let esUsuario = data.es_usuario;

                if (montoMaximo !== "No hay ofertas") {
                    ofertaActual.innerHTML = `La mayor oferta es: ${montoMaximo}`;
                } else {
                    ofertaActual.innerHTML = "No hay ofertas aún.";
                }

                if (esUsuario) {
                    ofertaActual.innerHTML += " (Fue hecha por usted)";
                }
            })
            .catch(error => console.log('Error al obtener la oferta:', error));
    } else {
        console.log('Los elementos no existen en el DOM');
    }
}

window.onload = function() {
    setInterval(actualizarOferta, 5000); 
    actualizarOferta(); 
};
