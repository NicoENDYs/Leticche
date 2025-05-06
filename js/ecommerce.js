// Función para simular la funcionalidad de añadir al carrito
document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function() {
        const productTitle = this.closest('.product-card').querySelector('.product-title').textContent;
        alert(`¡${productTitle} añadido al carrito!`);
        
        // Actualizar el contador del carrito (simulación)
        const cartCount = document.querySelector('.cart-count');
        cartCount.textContent = parseInt(cartCount.textContent) + 1;
    });
});