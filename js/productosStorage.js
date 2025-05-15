//obtenemos las llaves de los productos comprados para obtener el total del carrito
let productosComprados = Object.keys(localStorage);
let totalCarrito = 0;

totalCarrito = productosComprados.length;

let contadorCarrito = document.querySelector(".cart-count");
contadorCarrito.textContent = totalCarrito;

// obtenemos el producto en formato de objeto
function almacenarProductoStorage(producto) {
  //si el producto ya existe en el localStorage, obtenemos su cantidad y la aumentamos
  let productoAlmacenado = localStorage.getItem(producto.id);
  if (productoAlmacenado) {
    let existente = JSON.parse(productoAlmacenado);
    producto.cantidad = existente.cantidad + 1;
  }

  //guardamos en el localStorage
  localStorage.setItem(producto.id, JSON.stringify(producto));

  //aumentamos el contador del carrito:
  contadorCarrito.textContent = parseInt(localStorage.length);
}
