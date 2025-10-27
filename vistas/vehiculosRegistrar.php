<?php
require_once './modulos/main.php';
require_once './modulos/empresas/empresasMain.php';
?>
<section class="section">
  <div class="container-fluid">
    <div class="title-wrapper pt-30">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="title mb-30">
            <h2>REGISTRAR VEHICULO</h2>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-12">
      <div class="card-style settings-card-2 mb-30">
        <form id="formulario" autocomplete="off" class="row">
          <div class="col-md-12">
            <div class="mb-3">
              <label class="form-label text-dark">CENTRO DE COSTO:</label>
              <select class="form-select form-select-lg text-bold" name="IDCentroCosto" required>
                <option selected>SELECCIONE</option>
                <?php foreach (empresasListaCentroCosto() as $rowCentroCosto): ?>
                  <option value="<?= encriptar($rowCentroCosto['IDEmpresa']); ?>">
                    <?= $rowCentroCosto['DescripcionEmpresa']; ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <?= renderInput('CODIGO DEL VEHICULO:', 'codigoVehiculo', 'text', '', true); ?>
          </div>
          <div class="col-md-3">
            <?= renderInput('AÑO DEL VEHICULO:', 'yearVehiculo', 'number', '', true); ?>
          </div>
          <div class="col-md-3">
            <?= renderInput('MARCA DEL VEHICULO:', 'marcaVehiculo', 'text', '', true); ?>
          </div>
          <div class="col-md-3">
            <?= renderInput('MODELO DEL VEHICULO:', 'modeloVehiculo', 'text', '', true); ?>
          </div>
          <div class="col-md-4">
            <?= renderInput('SERIAL DEL VEHICULO:', 'serialVehiculo', 'text', '', true); ?>
          </div>
          <div class="col-md-4">
            <?= renderInput('PLACA DEL VEHICULO:', 'placaVehiculo', 'text', '', true); ?>
          </div>
          <div class="col-md-4">
            <?= renderInput('COLOR DEL VEHICULO:', 'colorVehiculo', 'text', '', true); ?>
          </div>
          <div class="col-md-12">
            <div class="mb-3">
              <label class="form-label text-dark">FOTO DEL VEHICULO:</label>
              <input type="file" class="form-control" name="fotoVehiculo" accept=".png, .jpg, .jpeg">
            </div>
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
  vehiculosMain.classList.add('active')
  vehiculosReg.classList.add('active')

  formulario.addEventListener('submit', (e) => {
    e.preventDefault()
    Swal.fire({
      title: '¿ESTA SEGURO?',
      text: 'EL VEHICULO SERA REGISTRADO',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'ACEPTAR',
      cancelButtonText: 'CANCELAR'
    }).then((result) => {
      if (result.isConfirmed) {
        ajaxFormularioPOST('modulos/vehiculos/vehiculosRegistrar.php')
      }
    })
  })
</script>