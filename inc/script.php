<script src="./assets/js/main.js"></script>
<script>
  btnCerrarSesion.addEventListener('click', (e) => {
    e.preventDefault()
    Swal.fire({
      title: '¿ESTA SEGURO?',
      text: 'EL USUARIO SALDRA DEL SISTEMA',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'CERRAR SESION',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = './inc/logout.php'
      }
    })
  })
</script>