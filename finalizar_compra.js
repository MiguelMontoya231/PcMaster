document.addEventListener('DOMContentLoaded', function() {
    const carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    const resumenCarrito = document.getElementById('resumenCarrito');
    const metodoPago = document.querySelector('select[name="metodoPago"]');
    const datosTarjeta = document.getElementById('datosTarjeta');
    const compraForm = document.getElementById('compraForm');

    // Mostrar resumen del carrito
    let total = 0;
    carrito.forEach(item => {
        const subtotal = item.precio * item.cantidad;
        total += subtotal;
        resumenCarrito.innerHTML += `
            <p>${item.nombre} x ${item.cantidad} - $${subtotal.toFixed(2)}</p>
        `;
    });
    resumenCarrito.innerHTML += `<strong>Total: $${total.toFixed(2)}</strong>`;

    // Mostrar/ocultar campos de tarjeta
    metodoPago.addEventListener('change', function() {
        datosTarjeta.style.display = this.value === '1' ? 'block' : 'none';
    });

    // Manejar envío del formulario
    compraForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(compraForm);
        formData.append('carrito', JSON.stringify(carrito));

        fetch('procesar_compra_final.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if (data.includes("Compra registrada con éxito")) {
                alert("Compra finalizada con éxito");
                localStorage.removeItem('carrito');
                window.location.href = 'index.html';
            } else {
                alert("Error al procesar la compra: " + data);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ocurrió un error al procesar la compra');
        });
    });
});
