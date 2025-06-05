let btnCambiarEstado = document.getElementById("btnCambiarEstado");

btnCambiarEstado.addEventListener("click", (e) =>{
    e.preventDefault();
    advertencia();
});

function advertencia() {
    let dataId = btnCambiarEstado.dataset.id
    let estadoPedido = document.getElementById(`estado_pedido${dataId}`).value;

    if (estadoPedido === "cancelado") {
        Swal.fire({
            title: '¿Estás seguro de cancelar el pedido?',
            text: 'los cambios son irreversibles, una vez cancelado el pedido, la cantidad de los productos reestableceran su stock correspondiente',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, continuar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
               
                Swal.fire(
                    '¡Hecho!',
                    'Los cambios han sido aplicados.',
                    'success'
                )
                .then(() =>{
                    let formulario = document.getElementById("formularioEstado");
                    formulario.submit();
                })
            }
        })
    }
    else{
        Swal.fire({
            title: '¿Estás seguro de cambiar el estado?',
            text: `El pedido #${dataId} pasara al estado "${estadoPedido}"`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, continuar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    '¡Hecho!',
                    'Los cambios han sido aplicados.',
                    'success'
                )
                .then(() =>{
                    let formulario = document.getElementById("formularioEstado");
                    formulario.submit();
                })
            }
        })
    }
}