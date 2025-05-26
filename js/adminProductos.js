 // Toggle sidebar on mobile
 document.addEventListener('DOMContentLoaded', function() {
    // Inicializar animaciones y efectos visuales
    const animateElements = document.querySelectorAll('.animate-card');
    animateElements.forEach((el, index) => {
        el.style.opacity = '0';
        el.style.animationDelay = `${0.1 * index}s`;
        setTimeout(() => {
            el.style.opacity = '1';
        }, 100);
    });
    
    
    // Ajustar layout basado en el tamaño de la ventana
    function adjustLayout() {
        if (window.innerWidth < 768) {
            sidebar.classList.remove('mobile-active');
        }
    }
    
    window.addEventListener('resize', adjustLayout);
    adjustLayout();
});


function eliminarProducto(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¿Deseas eliminar este producto?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirigir al controlador de eliminación
            window.location.href = `../controllers/EliminarProducto.php?id=${id}`;
        }
    });
}

function restaurarProducto(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        html: "<strong>¿Deseas restaurar este producto?</strong><br>El producto no se restaurará si el stock es 0.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, restaurar',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirigir al controlador de restauración
            window.location.href = `../controllers/restaurarProducto.php?id=${id}`;
        }
    });
}