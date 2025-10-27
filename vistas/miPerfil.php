<section class="section">
  <div class="container-fluid">
    <div class="title-wrapper pt-30">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="title mb-30">
            <h2>ACTUALIZAR: <i><?= $_SESSION['systemHato']['nombreUsuario']; ?></i></h2>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-12">
      <div class="card-style settings-card-2 mb-30">
        <form autocomplete="off" id="formulario">
          <div class="row">
            <div class="col-md-6">
              <?= renderInput('NOMBRE DEL USUARIO:', 'nombreUsuario', 'text', $_SESSION['systemHato']['nombreUsuario'], true); ?>
            </div>
            <div class="col-md-6">
              <?= renderInput('USUARIO:', 'usuario', 'text', $_SESSION['systemHato']['usuario'], true); ?>
            </div>
            <div class="col-md-12">
              <p class="text-center text-bold text-dark m-3">
                Si desea actualizar la clave de este usuario por favor llene los 2 campos. Si NO desea actualizar la
                clave deje los campos vacíos.
              </p>
            </div>
            <div class="col-md-6">
              <?= renderInput('INGRESE LA CONTRASEÑA:', 'clave1', 'password', '', false); ?>
            </div>
            <div class="col-md-6">
              <?= renderInput('CONFIRME LA CONTRASEÑA:', 'clave2', 'password', '', false); ?>
            </div>
          </div>
          <div class="text-center">
            <button class="main-btn primary-btn btn-hover m-1">
              <strong>ACTUALIZAR</strong>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<script>
  formulario.addEventListener('submit', (e) => {
    e.preventDefault()
    Swal.fire({
      title: '¿ESTA SEGURO?',
      text: 'TU PERFIL SERA ACTUALIZADO',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'ACEPTAR',
      cancelButtonText: 'CANCELAR'
    }).then((result) => {
      if (result.isConfirmed) {
        ajaxFormularioPOST(
          'modulos/usuarios/usuariosActualizar.php?id=<?= encriptar($_SESSION['systemHato']['IDUsuario']); ?>')
      }
    })
  })
</script>