let totalCarrito = document.querySelector("#total-carrito");
let totalOculto = document.querySelector("#totalOculto");
let inputProductosOcultos = document.querySelector("#productos_ocultos");
let productosOcultos = [];
document.addEventListener("DOMContentLoaded", function () {
    cargarCarrito();
    document
        .querySelector(".btn-comprar")
    document
        .querySelector(".btn-seguir-comprando")
        .addEventListener("click", function () {
            window.location.href = "productos.html";
        });
});

function cargarCarrito() {
    const contenedor = document.getElementById("contenedor-carrito");
    let carritoHTML = "";
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

        productos.forEach((producto) => {
            producto = JSON.parse(producto);
            const subtotal =
                parseFloat(producto.precio) * parseInt(producto.cantidad);
            total += subtotal;

            carritoHTML += `
                        <div class="carrito-item" data-id="${producto.id}">
                            <img class="carrito-item-imagen" src="../img/${producto.imagen
                }" alt="${producto.nombre}">
                            <div class="carrito-item-detalles">
                                <h3 class="carrito-item-nombre">${producto.nombre
                }</h3>
                                <p class="carrito-item-precio" id="precioProducto${producto.id
                }">${nomenclaturaPrecio(producto.precio)}</p>
                                <div class="carrito-item-acciones">
                                    <div class="cantidad-control">
                                        <button class="cantidad-btn btn-disminuir" id="btnDisminuir${producto.id}" onclick='disminuirCantidad(${JSON.stringify(
                    producto
                )})' data-id="${producto.id}">-</button>
                                        <p class="cantidad-numero" id="cantidadProducto${producto.id
                }">${producto.cantidad}</p>
                                        <button class="cantidad-btn btn-aumentar" onclick='aumentarCantidad(${JSON.stringify(
                    producto
                )})' data-id="${producto.id}">+</button>
                                    </div>
                                    <button class="eliminar-btn" onclick="eliminarProducto(${producto.id
                })" data-id="${producto.id}">Eliminar</button>
                                </div>
                            </div>
                            <div class="carrito-item-subtotal" id="idTotalProducto${producto.id
                }">${nomenclaturaPrecio(subtotal)}</div>
                        </div>
                    `;
        });

        carritoHTML += "</div>";
    }

    contenedor.innerHTML = carritoHTML;
    totalCarrito.textContent = `${nomenclaturaPrecio(total)}`;
}

function aumentarCantidad(producto) {
    let cantidadProducto = document.querySelector(
        `#cantidadProducto${producto.id}`
    );
    let productoAlmacenado = localStorage.getItem(producto.id);
    if (productoAlmacenado) {
        let existente = JSON.parse(productoAlmacenado);
        producto.cantidad = existente.cantidad + 1;
    }
    cantidadProducto.textContent = parseInt(cantidadProducto.textContent) + 1;
    localStorage.setItem(producto.id, JSON.stringify(producto));

    formatearPrecio(
        `idTotalProducto${producto.id}`,
        producto.cantidad,
        producto.precio
    );
}

function disminuirCantidad(producto) {
    let btnDisminuir = document.querySelector(`#btnDisminuir${producto.id}`);
    let cantidadProducto = document.querySelector(
        `#cantidadProducto${producto.id}`
    );
    let productoAlmacenado = localStorage.getItem(producto.id);

    if (cantidadProducto.textContent >= 1) {
        if (productoAlmacenado) {
            let existente = JSON.parse(productoAlmacenado);
            producto.cantidad = existente.cantidad - 1;
            cantidadProducto.textContent = parseInt(cantidadProducto.textContent) - 1;
            localStorage.setItem(producto.id, JSON.stringify(producto));
            formatearPrecio(
                `idTotalProducto${producto.id}`,
                producto.cantidad,
                producto.precio
            );
        }
    }
}

function formatearPrecio(idTotalProducto, cantidadProducto, precioProducto) {
    let subtotalProducto = document.querySelector(`#${idTotalProducto}`);
    subtotalProducto.textContent = nomenclaturaPrecio(
        cantidadProducto * precioProducto
    );

    calcularTotal();
}

function calcularTotal() {
    let total = 0;
    let productos = Object.values(localStorage);
    productos.forEach((producto) => {
        producto = JSON.parse(producto);
        let subtotal = producto.precio * producto.cantidad;
        total += subtotal;
    });

    totalCarrito.textContent = `${nomenclaturaPrecio(total)}`;
}

function eliminarProducto(idProducto) {
    localStorage.removeItem(idProducto);
    location.reload();
}

function nomenclaturaPrecio(precio) {
    return `$${parseFloat(precio).toLocaleString("es-CL")}`;
}

function finalizarCompra(){
    // Set the address in the hidden field
    document.getElementById('direccion_envio').value = direccionCliente;
    const direccionCliente = document.getElementById('DireccionCliente').value.trim();
    
    if (!direccionCliente) {
        Swal.fire({
        title: "Falta un campo!",
        text: "Llena el campo de dirección",
        icon: "error"
        });
        return;
    }
    localStorage.clear();
    document.querySelector("#formFactura").submit();
}

// Función para formatear números como moneda
function formatoPrecio(value) {
    return '$' + new Intl.NumberFormat('es-CO').format(value);
}

// Función para cargar los productos en la factura
function cargarProductosFactura() {
    let productosCarrito = Object.values(localStorage);
    let facturaCarrito = [];
    productosCarrito.forEach(productoJson => {
        let producto = JSON.parse(productoJson);
        facturaCarrito.push(producto);
    })
    const facturaItems = document.getElementById('facturaItems');
    facturaItems.innerHTML = '';

    let subtotal = 0;

    productosCarrito.forEach(producto => {
        producto = JSON.parse(producto);
        const tr = document.createElement('tr');
        if (producto.cantidad > 0) {
            productosOcultos.push(producto);
            tr.innerHTML = `
                    <td><img src="../img/${producto.imagen}" alt="${producto.nombre}" class="producto-imagen"></td>
                    <td class="producto-nombre">${producto.nombre}</td>
                    <td class="cantidad">${producto.cantidad}</td>
                    <td class="precio">${formatoPrecio(producto.precio)}</td>
                    <td class="subtotal">${formatoPrecio(producto.precio * producto.cantidad)}</td>
                `;
        facturaItems.appendChild(tr);
        subtotal += producto.precio * producto.cantidad;
        }
    });
    console.log(JSON.stringify(productosOcultos));
    inputProductosOcultos.value = JSON.stringify(productosOcultos);
    productosOcultos = [];

    const impuesto = subtotal * 0.19;
    const total = subtotal + impuesto;

    totalOculto.value = total;

    document.getElementById('facturaSubtotal').textContent = formatoPrecio(subtotal);
    document.getElementById('facturaImpuesto').textContent = formatoPrecio(impuesto);
    document.getElementById('facturaTotal').textContent = formatoPrecio(total);

    // Actualizar fecha actual
    const hoy = new Date();
    document.getElementById('fechaActual').textContent = hoy.toLocaleDateString('es-CO');
}

// Eventos para abrir y cerrar el modal
document.getElementById('verFacturaBtn').addEventListener('click', function () {
    cargarProductosFactura();
    document.getElementById('modalFactura').style.display = 'flex';
});

document.getElementById('cerrarModalBtn').addEventListener('click', function () {
    document.getElementById('modalFactura').style.display = 'none';
});

document.getElementById('volverBtn').addEventListener('click', function () {
    document.getElementById('modalFactura').style.display = 'none';
});

document.getElementById('confirmarBtn').addEventListener('click', function () {
    finalizarCompra();
});

// Inicializar
window.addEventListener('load', function () {
    cargarProductosFactura();
});
