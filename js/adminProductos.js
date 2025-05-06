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