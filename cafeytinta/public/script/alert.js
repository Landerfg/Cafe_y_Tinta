document.querySelector('#logout-link').addEventListener('click', function(e) {
    e.preventDefault();
   
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¿Quieres cerrar la sesión?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, cerrar sesión!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '../../src/CerrarSesion.php';
        }
    })
});