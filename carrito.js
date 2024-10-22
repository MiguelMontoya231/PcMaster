let carrito = loadCarritoFromStorage();
console.log("Carrito inicial:", carrito);

function formatPrice(price) {
    return new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(price);
}

function loadCarritoFromStorage() {
    const savedCarrito = localStorage.getItem('carrito');
    console.log("Carrito cargado:", savedCarrito);
    return savedCarrito ? JSON.parse(savedCarrito) : [];
}

function saveCarritoToStorage(carrito) {
    console.log("Guardando carrito:", carrito);
    localStorage.setItem('carrito', JSON.stringify(carrito));
}

function agregarAlCarrito(producto) {
    console.log("Agregando al carrito:", producto);
    let index = carrito.findIndex(item => item.idproductos === producto.idproductos);
    if (index !== -1) {
        carrito[index].cantidad = (carrito[index].cantidad || 1) + 1;
    } else {
        producto.cantidad = 1;
        carrito.push(producto);
    }
    saveCarritoToStorage(carrito);
    actualizarCarritoUI();
    console.log("Carrito actualizado:", carrito);
}

function eliminarDelCarrito(index) {
    carrito.splice(index, 1);
    saveCarritoToStorage(carrito);
    actualizarCarritoUI();
}

function actualizarCarritoUI() {
    console.log("Actualizando UI del carrito");
    let carritoElement = document.querySelector('.cart');
    if (!carritoElement) {
        console.log("Elemento del carrito no encontrado");
        return;
    }

    carritoElement.innerHTML = '';
    
    let total = 0;
    carrito.forEach((item, index) => {
        total += item.precio * item.cantidad;
        carritoElement.innerHTML += `
            <div class="cart-item">
                <p>${item.nombre} (x${item.cantidad})</p>
                <p>Precio: ${formatPrice(item.precio * item.cantidad)}</p>
                <button onclick="eliminarDelCarrito(${index})">Eliminar</button>
            </div>
        `;
    });

    carritoElement.innerHTML += `
        <div class="cart-total">
            <p>Total: ${formatPrice(total)}</p>
            <button onclick="finalizarCompra()">Finalizar Compra</button>
        </div>
    `;
    console.log("UI del carrito actualizada");
}

function finalizarCompra() {
    const carrito = loadCarritoFromStorage();
    if (carrito.length === 0) {
        alert('El carrito está vacío.');
        return;
    }
    // Redirigir a la página de finalización de compra
    window.location.href = 'finalizar_compra.html';
}

window.onload = function() {
    console.log("Página cargada, actualizando UI del carrito");
    actualizarCarritoUI();
};