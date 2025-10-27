<?php
require_once './modulos/main.php';
require_once './modulos/inventario/inventarioMain.php';
?>
<section class="section">
  <div class="container-fluid">
    <div class="title-wrapper pt-30">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="title mb-30">
            <h2>REGISTRAR PRODUCTO / SERVICIO</h2>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-12">
      <div class="card-style settings-card-2 mb-30">
        <form id="formulario" autocomplete="off" class="row">
          <div class="col-md-6">
            <div class="mb-3">
              <label class="form-label text-dark">TIPO DE PRODUCTO:</label>
              <select class="form-select form-select-lg text-bold" name="IDTipoInv" required>
                <option value="" selected>SELECCIONE</option>
                <?php foreach (inventarioTiposProductos() as $row): ?>
                  <option value="<?= encriptar($row['IDTipoInv']); ?>">
                    <?= $row['DescripcionTipoInv']; ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <?= renderInput('CODIGO DEL PRODUCTO / SERVICIO:', 'codigoInv', 'text', '', true); ?>
          </div>
          <div class="col-md-6">
            <?= renderInput('DSCRIPCION DEL PRODUCTO / SERVICIO:', 'descripcionInv', 'text', '', true); ?>
          </div>
          <div class="col-md-6">
            <?= renderInput('PRECIO DEL PRODUCTO / SERVICIO:', 'precioInv', 'number', '', true, 3, 'step="0.01"'); ?>
          </div>
          <div class="col-md-12">
            <div class="text-center">
              <button type="submit" class="main-btn primary-btn btn-hover m-1">
                <strong>REGISTRAR</strong>
              </button>
              <button type="reset" class="main-btn danger-btn btn-hover m-1">
                <strong>CANCELAR</strong>
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<script>
  inventarioMain.classList.add('active')
  inventarioReg.classList.add('active')

  formulario.addEventListener('submit', (e) => {
    e.preventDefault()
    Swal.fire({
      title: '¿ESTA SEGURO?',
      text: 'EL PRODUCTO / SERVICIO SERA REGISTRADO',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'ACEPTAR',
      cancelButtonText: 'CANCELAR'
    }).then((result) => {
      if (result.isConfirmed) {
        ajaxFormularioPOST('modulos/inventario/inventarioRegistrar.php')
      }
    })
  })
</script>