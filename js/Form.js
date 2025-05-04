document.addEventListener('DOMContentLoaded', function() {
    // Initialize elements
    const form = document.getElementById('productoForm');
    const imageInput = document.getElementById('imagen');
    const imagePreview = document.getElementById('imagePreview');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    const btnSpinner = document.getElementById('btnSpinner');
    const volverBtn = document.getElementById('volverBtn');
    const resultToast = new bootstrap.Toast(document.getElementById('resultToast'));
    const toastMessage = document.getElementById('toastMessage');
    const toastIcon = document.getElementById('toastIcon');
    
    // Image preview functionality
    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            
            reader.addEventListener('load', function() {
                imagePreview.innerHTML = `<img src="${this.result}" alt="Vista previa">`;
            });
            
            reader.readAsDataURL(file);
        } else {
            imagePreview.innerHTML = `
                <div class="image-preview-placeholder">
                    <i class="bi bi-image fs-1"></i>
                    <p>Vista previa de la imagen</p>
                </div>
            `;
        }
    });
    
    // Form validation and submission
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        
        if (!form.checkValidity()) {
            event.stopPropagation();
            form.classList.add('was-validated');
            showToast('Por favor, completa todos los campos requeridos.', 'error');
            return;
        }
        
        // Show loading state
        submitBtn.disabled = true;
        btnText.textContent = 'Procesando...';
        btnSpinner.classList.remove('d-none');
        
        // Simulate API call
        setTimeout(() => {
            // Reset loading state
            submitBtn.disabled = false;
            btnText.textContent = 'Añadir Producto';
            btnSpinner.classList.add('d-none');
            
            // Show success message
            showToast('¡Producto añadido correctamente!', 'success');
            
            // Reset form
            form.reset();
            form.classList.remove('was-validated');
            imagePreview.innerHTML = `
                <div class="image-preview-placeholder">
                    <i class="bi bi-image fs-1"></i>
                    <p>Vista previa de la imagen</p>
                </div>
            `;
        }, 1500);
    });
    
    // Volver button functionality
    volverBtn.addEventListener('click', function() {
        // In a real implementation, this would navigate back or message the parent frame
        if (window.parent !== window) {
            window.parent.postMessage({ action: 'volver' }, '*');
        } else {
            showToast('Acción de volver (prototipo)', 'info');
        }
    });
    
    // Toast notification helper
    function showToast(message, type) {
        const toastElement = document.getElementById('resultToast');
        toastElement.className = 'toast';
        
        if (type === 'success') {
            toastElement.classList.add('toast-success');
            toastIcon.className = 'bi bi-check-circle-fill me-2';
        } else if (type === 'error') {
            toastElement.classList.add('toast-error');
            toastIcon.className = 'bi bi-exclamation-circle-fill me-2';
        } else {
            toastIcon.className = 'bi bi-info-circle-fill me-2';
        }
        
        toastMessage.textContent = message;
        resultToast.show();
    }
});