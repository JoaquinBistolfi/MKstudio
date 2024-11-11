document.addEventListener("DOMContentLoaded", function() {
    function actualizarOferta() {
        const filas = document.querySelectorAll('tr[data-lote-id]');
        filas.forEach(function(fila) {
            const idLote = fila.dataset.loteId;
            const montoUsuario = parseFloat(fila.dataset.montoUsuario);
            const ofertaUsuarioElem = document.getElementById(`oferta_usuario_${idLote}`);
            const ofertaActualElem = document.getElementById(`oferta_actual_${idLote}`);

            if (ofertaUsuarioElem && ofertaActualElem) {
                fetch('obtener_oferta_lote.php?id=' + idLote)
                    .then(response => response.json())
                    .then(data => {
                        const montoMaximo = parseFloat(data.monto);

                        ofertaActualElem.innerHTML = montoMaximo ? montoMaximo : 'N/A';
                        ofertaUsuarioElem.innerHTML = montoUsuario || 'N/A';

                        if (montoUsuario < montoMaximo) {
                            ofertaUsuarioElem.style.color = "red";
                        } else if (montoUsuario === montoMaximo) {
                            ofertaUsuarioElem.style.color = "green";
                        } else {
                            ofertaUsuarioElem.style.color = "black";
                        }

                        if (montoMaximo === montoUsuario) {
                            ofertaActualElem.style.color = "green";
                        } else {
                            ofertaActualElem.style.color = "black";
                        }
                    })
                    .catch(error => {
                        console.log('Error al obtener la oferta:', error);
                    });
            }
        });
    }

    setInterval(actualizarOferta, 5000);
    actualizarOferta();
});
