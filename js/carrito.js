let totalCarrito = document.querySelector("#total-carrito");
document.addEventListener('DOMContentLoaded', function () {
    cargarCarrito();
    document.querySelector('.btn-comprar').addEventListener('click', finalizarCompra);
    document.querySelector('.btn-seguir-comprando').addEventListener('click', function () {
        window.location.href = 'productos.html'; // Cambia esto según tu estructura
    });
});

function cargarCarrito() {
    const contenedor = document.getElementById('contenedor-carrito');
    let carritoHTML = '';
    let total = 0;

    let productos = Object.values(localStorage);

    if (productos.length === 0) {
        carritoHTML = `
                    <div class="carrito-vacio">
                        <h2>Tu carrito está vacío</h2>
                        <p>Agrega productos para comenzar tu compra</p>
                    </div>
                `;
    } else {
        carritoHTML = '<div class="carrito-items">';



        productos.forEach(producto => {
            producto = JSON.parse(producto);
            const subtotal = parseFloat(producto.precio) * parseInt(producto.cantidad);
            total += subtotal;

            carritoHTML += `
                        <div class="carrito-item" data-id="${producto.id}">
                            <img class="carrito-item-imagen" src="../img/${producto.imagen}" alt="${producto.nombre}">
                            <div class="carrito-item-detalles">
                                <h3 class="carrito-item-nombre">${producto.nombre}</h3>
                                <p class="carrito-item-precio" id="precioProducto${producto.id}">${nomenclaturaPrecio(producto.precio)}</p>
                                <div class="carrito-item-acciones">
                                    <div class="cantidad-control">
                                        <button class="cantidad-btn btn-disminuir" onclick='disminuirCantidad(${JSON.stringify(producto)})' data-id="${producto.id}">-</button>
                                        <p class="cantidad-numero" id="cantidadProducto${producto.id}">${producto.cantidad}</p>
                                        <button class="cantidad-btn btn-aumentar" onclick='aumentarCantidad(${JSON.stringify(producto)})' data-id="${producto.id}">+</button>
                                    </div>
                                    <button class="eliminar-btn" onclick="eliminarProducto(${producto.id})" data-id="${producto.id}">Eliminar</button>
                                </div>
                            </div>
                            <div class="carrito-item-subtotal" id="idTotalProducto${producto.id}">${nomenclaturaPrecio(subtotal)}</div>
                        </div>
                    `;
        });

        carritoHTML += '</div>';
    }

    contenedor.innerHTML = carritoHTML;
    totalCarrito.textContent = `${nomenclaturaPrecio(total)}`;
}


function aumentarCantidad(producto) {
    let cantidadProducto = document.querySelector(`#cantidadProducto${producto.id}`);
    let productoAlmacenado = localStorage.getItem(producto.id)
    if (productoAlmacenado) {
        let existente = JSON.parse(productoAlmacenado);
        producto.cantidad = existente.cantidad + 1;
    }
    cantidadProducto.textContent = parseInt(cantidadProducto.textContent) + 1;
    localStorage.setItem(producto.id, JSON.stringify(producto));

    formatearPrecio(`idTotalProducto${producto.id}`, producto.cantidad, producto.precio);
}

function disminuirCantidad(producto) {
    let cantidadProducto = document.querySelector(`#cantidadProducto${producto.id}`);
    let productoAlmacenado = localStorage.getItem(producto.id)
    if (productoAlmacenado) {
        let existente = JSON.parse(productoAlmacenado);
        producto.cantidad = existente.cantidad - 1;
    }
    cantidadProducto.textContent = parseInt(cantidadProducto.textContent) - 1;
    localStorage.setItem(producto.id, JSON.stringify(producto));

    formatearPrecio(`idTotalProducto${producto.id}`, producto.cantidad, producto.precio);
}

function formatearPrecio(idTotalProducto, cantidadProducto, precioProducto) {
    let subtotalProducto = document.querySelector(`#${idTotalProducto}`);
    subtotalProducto.textContent = nomenclaturaPrecio(cantidadProducto * precioProducto);

    calcularTotal();
}

function calcularTotal() {
    let total = 0;
    let productos = Object.values(localStorage);
    productos.forEach(producto => {
        producto = JSON.parse(producto);
        let subtotal = producto.precio * producto.cantidad;
        total += subtotal;
    })
    
    totalCarrito.textContent = `${nomenclaturaPrecio(total)}`;
}

function eliminarProducto(idProducto) {
    localStorage.removeItem(idProducto);
    location.reload();
}

function finalizarCompra() {
    //añadir a la base de datos
}

function nomenclaturaPrecio(precio) {
    return `$${parseFloat(precio).toLocaleString('es-CL')}`;
}
