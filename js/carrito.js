let totalCarrito = document.querySelector("#total-carrito");
let totalOculto = document.querySelector("#totalOculto");
let inputProductosOcultos = document.querySelector("#productos_ocultos");
let productosOcultos = [];

document.addEventListener("DOMContentLoaded", function () {
    cargarCarrito();
    document.querySelector(".btn-comprar");
    document
        .querySelector(".btn-seguir-comprando")
        .addEventListener("click", function () {
            window.location.href = "productos.html";
        });
    localStorage.removeItem("Console");
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
                                <label class="carrito-item-stock">Stock:</label>
                                <p class="carrito-item-descripcion" id="stockProducto${producto.id
                }">${producto.stock
                }</p>
                                <p class="carrito-item-precio" id="precioProducto${producto.id
                }">${nomenclaturaPrecio(producto.precio)}</p>
                                <div class="carrito-item-acciones">
                                    <div class="cantidad-control">
                                        <button class="cantidad-btn btn-disminuir" id="btnDisminuir${producto.id
                }" onclick='disminuirCantidad(${JSON.stringify(
                    producto
                )})' data-id="${producto.id}">-</button>
                                        <p class="cantidad-numero" id="cantidadProducto${producto.id
                }">${producto.cantidad}</p>
                                        <button class="cantidad-btn btn-aumentar" onclick='aumentarCantidad(${JSON.stringify(
                    producto
                )})' data-id="${producto.id}">+</button>
                                    </div>
                                    <button class="eliminar-btn" onclick="eliminarProducto(${producto.id
                })" data-id="${producto.id
                }">Eliminar</button>
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
    let stockProducto = document.getElementById(`stockProducto${producto.id}`);
    let stock = parseInt(stockProducto.textContent);
    let cantidadProducto = document.querySelector(
        `#cantidadProducto${producto.id}`
    );
    let productoAlmacenado = localStorage.getItem(producto.id);
    if(cantidadProducto.textContent >= stock) {
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
    
    Toast.fire({
        icon: 'warning',
        title: 'Stock limitado alcanzado'
    });
        console.log("No se puede agregar más productos, el stock es limitado.");
        return;
    }
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
            if (producto.cantidad === 0) {
                quitarProducto(producto);
            }
        }
    }
}
function quitarProducto(producto) {
    Swal.fire({
        icon: "warning",
        title: "¿Quieres Eliminar El Producto?",
        text: `Pusiste la cantidad del producto en 0, por lo que se eliminará de la lista de productos. ¿Estás seguro de eliminar '${producto.nombre}' de la lista?`,
        showCancelButton: true,
        confirmButtonText: "Eliminar Producto",
        cancelButtonText: "Cancelar",
        allowOutsideClick: true,
        allowEscapeKey: true,
        allowClose: true
    }).then((result) => {
        if (result.isConfirmed) {
            eliminarProducto(producto.id);
        } else {
            aumentarCantidad(producto);
        }
    });
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

function calcularTotalModal() {
    let total = 0;
    let productos = Object.values(localStorage);
    productos.forEach((producto) => {
        producto = JSON.parse(producto);
        let subtotal = producto.precio * producto.cantidad;
        total += subtotal;
    });
    return total;
}

function eliminarProducto(idProducto) {
    localStorage.removeItem(idProducto);
    location.reload();
}

function nomenclaturaPrecio(precio) {
    return `$${parseFloat(precio).toLocaleString("es-CL")}`;
}

function finalizarCompra() {
    const direccionCliente = document
        .getElementById("direccionCliente")
        .value.trim();
    document.getElementById("direccion_envio").value = direccionCliente;

    if (!direccionCliente) {
        Swal.fire({
            title: "Falta un campo!",
            text: "Llena el campo de dirección",
            icon: "error",
        });
        return;
    }

    // Validación para dirección con al menos 5 caracteres
    if (direccionCliente.length < 5) {
        Swal.fire({
            title: "Dirección no válida!",
            text: "La dirección debe tener al menos 5 caracteres",
            icon: "error",
        });
        return;
    }
    // Validación para caracteres no permitidos
    else if (!/^[a-zA-ZÀ-ÿ0-9\s\-,.#°ª]+$/.test(direccionCliente)) {
        Swal.fire({
            title: "Dirección no válida!",
            text: "La dirección contiene caracteres no permitidos",
            icon: "error",
        });
        return;
    }
    // Solo si pasa todas las validaciones
    Swal.fire({
        title: "¡Pedido exitoso!",
        text: "Tu pedido ha sido procesado correctamente",
        icon: "success",
    });
    localStorage.clear();
    document.querySelector("#formFactura").submit();
}

// Función para formatear números como moneda
function formatoPrecio(value) {
    return "$" + new Intl.NumberFormat("es-CO").format(value);
}

// Función para cargar los productos en la factura
function cargarProductosFactura() {
    let productosCarrito = Object.values(localStorage);
    let facturaCarrito = [];
    productosCarrito.forEach((productoJson) => {
        let producto = JSON.parse(productoJson);
        facturaCarrito.push(producto);
    });
    const facturaItems = document.getElementById("facturaItems");
    facturaItems.innerHTML = "";

    let subtotal = 0;

    productosCarrito.forEach((producto) => {
        producto = JSON.parse(producto);
        const tr = document.createElement("tr");
        if (producto.cantidad > 0) {
            productosOcultos.push(producto);
            tr.innerHTML = `
                    <td><img src="../img/${producto.imagen}" alt="${producto.nombre
                }" class="producto-imagen"></td>
                    <td class="producto-nombre">${producto.nombre}</td>
                    <td class="cantidad">${producto.cantidad}</td>
                    <td class="precio">${formatoPrecio(producto.precio)}</td>
                    <td class="subtotal">${formatoPrecio(
                    producto.precio * producto.cantidad
                )}</td>
                `;
            facturaItems.appendChild(tr);
            subtotal += producto.precio * producto.cantidad;
        }
    });
    inputProductosOcultos.value = JSON.stringify(productosOcultos);
    productosOcultos = [];

    const impuesto = 2000; // Valor fijo del impuesto
    const total = subtotal + impuesto;

    totalOculto.value = total;

    document.getElementById("facturaSubtotal").textContent =
        formatoPrecio(subtotal);
    document.getElementById("facturaImpuesto").textContent =
        formatoPrecio(impuesto);
    document.getElementById("facturaTotal").textContent = formatoPrecio(total);

    // Actualizar fecha actual
    const hoy = new Date();
    document.getElementById("fechaActual").textContent =
        hoy.toLocaleDateString("es-CO");
}

document
    .getElementById("cerrarModalBtn")
    .addEventListener("click", function () {
        document.getElementById("modalFactura").style.display = "none";
    });

document.getElementById("volverBtn").addEventListener("click", function () {
    document.getElementById("modalFactura").style.display = "none";
});

document.getElementById("confirmarBtn").addEventListener("click", function () {
    finalizarCompra();
});


document
    .getElementById("verFacturaBtn")
    .addEventListener("click", function (event) {
        let precio = calcularTotalModal();
        if (!precio || isNaN(precio) || Number(precio) <= 0) {
            event.preventDefault(); // Detiene la acción de abrir el modal
            Swal.fire({
                icon: "error",
                title: "No hay productos",
                text: "Debes agregar productos para continuar con la compra",
            });
        } else {
            cargarProductosFactura();
            document.getElementById("modalFactura").style.display = "flex";
        }
    });
