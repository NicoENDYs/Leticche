//obtenemos las llaves de los productos comprados para obtener el total del carrito
let productosComprados = Object.keys(localStorage);
let totalCarrito = 0;
let iniciarSesion = document.querySelector("#iniciarSesion") ?? null;

totalCarrito = productosComprados.length;

let contadorCarrito = document.querySelector(".cart-count");
if (iniciarSesion != null) {
  if (iniciarSesion.textContent == "Iniciar Sesión") {
    contadorCarrito.textContent = 0;
    localStorage.clear();
  }
}
else {
  contadorCarrito.textContent = totalCarrito;
}


// obtenemos el producto en formato de objeto
function almacenarProductoStorage(producto) {
  let stock = parseInt(document.getElementById(`stock${producto.id}`).textContent);
  //si el producto ya existe en el localStorage, obtenemos su cantidad y la aumentamos
  let productoAlmacenado = localStorage.getItem(producto.id);
  let cantidadProducto = document.getElementById(`cantidad-en-carrito${producto.id}`);
  let obtenerCantidad = parseInt(cantidadProducto.textContent);
  if (obtenerCantidad == stock) {
      Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'warning',
        title: 'Stock limitado alcanzado',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });
    console.log("No se puede agregar más productos, el stock es limitado.");
    return;
  }
  if (productoAlmacenado) {
    let existente = JSON.parse(productoAlmacenado);
    producto.cantidad = existente.cantidad + 1;
  }

  //guardamos en el localStorage
  localStorage.setItem(producto.id, JSON.stringify(producto));

  //aumentamos el contador del carrito:
  contadorCarrito.textContent = parseInt(localStorage.length);
  cantidadProducto.textContent = parseInt(cantidadProducto.textContent) + 1;
}

function nomenclaturaPrecio(precio) {
  return `$${parseFloat(precio).toLocaleString("es-CL")}`;
}

document.addEventListener("DOMContentLoaded", function () {
  const precios = document.querySelectorAll('.current-price');

  precios.forEach(span => {
    const rawPrecio = span.dataset.precio;
    span.innerText = nomenclaturaPrecio(rawPrecio);
  });
});

document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".product-controls").forEach(control => {
    let id = control.getAttribute("data-id");
    let producto = localStorage.getItem(id);
    if (producto) {
      let obj = JSON.parse(producto);
      let cantidadDiv = control.querySelector(".cantidad-en-carrito");
      if (cantidadDiv) {
        cantidadDiv.textContent = obj.cantidad;
      }
    }
  });
});