<section class="table-components">
  <div class="container-fluid">
    <div class="title-wrapper pt-30">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="title mb-30">
            <h2>LISTA DE USUARIOS</h2>
          </div>
        </div>
      </div>
    </div>
    <div class="tables-wrapper">
      <div class="row">
        <div class="col-lg-12">
          <div class="card-style mb-30">
            <div class="table-wrapper table-responsive">
              <table class="table text-center" id="tablaMain">
                <thead>
                  <tr>
                    <th>
                      <h6 class="text-center">NOMBRE USUARIO</h6>
                    </th>
                    <th>
                      <h6 class="text-center">USUARIO</h6>
                    </th>
                    <th>
                      <h6 class="text-center">PRIVILEGIO</h6>
                    </th>
                    <th>
                      <h6 class="text-center">ACTUALIZAR</h6>
                    </th>
                    <th>
                      <h6 class="text-center">ELIMINAR</h6>
                    </th>
                  </tr>
                </thead>
                <tbody id="tablaInfo"></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  usuariosMain.classList.add('active')
  usuariosList.classList.add('active')

  const url = 'modulos/usuarios/usuariosLista.php'
  $(document).on('click', '.btnEliminar', function() {
    Swal.fire({
      title: '¿ESTA SEGURO?',
      text: 'EL USUARIO HA SIDO ELIMINADO CON EXITO',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'ACEPTAR',
      cancelButtonText: 'CANCELAR'
    }).then((result) => {
      if (result.isConfirmed) {
        ajaxGET('modulos/usuarios/usuariosEliminar.php?id=' + this.value)
      }
    })
  })

  ajaxTablaGET(url)
</script>