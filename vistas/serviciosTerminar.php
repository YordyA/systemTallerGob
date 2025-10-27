<?php
if (!isset($_SESSION['systemTaller']['servicios']['detalle'])) {
  exit('<script>window.location.href = document.referrer</script>');
}

require_once './modulos/main.php';
require_once './modulos/empresas/empresasMain.php';
require_once './modulos/servicios/serviciosMain.php';

$html = [];
$html['tabla'] = '';
foreach ($_SESSION['systemTaller']['servicios']['detalle'] as $row) {
  $html['tabla'] .= '<tr>';
  $html['tabla'] .= '<td>' . $row['codigo'] . '</td>';
  $html['tabla'] .= '<td>' . $row['descripcion'] . '</td>';
  $html['tabla'] .= '<td>' . number_format($row['cantidad'], 2, ',', '.') . '</td>';
  $html['tabla'] .= '<td>' . number_format($row['precio'], 2, ',', '.') . '</td>';
  $html['tabla'] .= '<td>' . number_format($row['precio'] * $row['cantidad'], 2, ',', '.') . '</td>';
  $html['tabla'] .= '</tr>';
}
?>
<section class="section">
  <div class="container-fluid">
    <div class="title-wrapper pt-30">
      <div class="row align-items-center">
        <div class="col-md-10">
          <div class="title mb-30">
            <h2>CARGAR <i>SERVICIO / PRODUCTO</i></h2>
          </div>
        </div>
        <div class="col-md-2">
          <div class="d-flex mb-30">
            <a class="btn btn-warning form-control" onclick="volver()">ATRAS</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-12">
      <div class="card-style settings-card-2 mb-30">
        <div class="row">
          <form id="formDatos" class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <button type="submit" id="btnRegistrar" class="btn btn-primary form-control">
                  REGISTRAR
                </button>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <button type="reset" id="btnCancelar" class="btn btn-danger form-control">
                  CANCELAR
                </button>
              </div>
            </div>
            <hr>
            <div class="col-md-6">
              <?= renderInput('FECHA DEL SERVICIO:', 'fechaServicio', 'date', '', true); ?>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label text-dark">TIPO DE SERVICIO:</label>
                <select class="form-select form-select-lg text-bold" name="IDTipoServicio" required>
                  <option value="" selected>SELECCIONE</option>
                  <?php foreach (serviciosListaTipos() as $row) : ?>
                  <option value="<?= encriptar($row['IDTipoServicio']); ?>">
                    <?= $row['DescripcionTipoServicio']; ?>
                  </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label text-dark">CENTRO DE COSTO:</label>
                <select class="form-select form-select-lg text-bold" name="IDCentroCosto"
                  onchange="consultarVehiculos()" required>
                  <option value="" selected>SELECCIONE</option>
                  <?php foreach (empresasListaCentroCosto() as $rowCentroCosto): ?>
                  <option value="<?= encriptar($rowCentroCosto['IDEmpresa']); ?>">
                    <?= $rowCentroCosto['DescripcionEmpresa']; ?>
                  </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label text-dark">VEHICULO:</label>
                <select class="form-select form-select-lg text-bold" name="IDVehiculo" required>
                  <option selected>SELECCIONE</option>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <?= renderInput('CEDULA RECIBE:', 'recibeCedula', 'text', '', true); ?>
            </div>
            <div class="col-md-4">
              <?= renderInput('RECIBE CONFORME:', 'recibeConforme', 'text', '', true); ?>
            </div>
            <div class="col-md-4">
              <?= renderInput('OBSERVACION:', 'observacion', 'textarea', '', true, 3); ?>
            </div>
          </form>
          <hr>
          <div class="col-md-12">
            <div class="table-wrapper table-responsive">
              <table class="table text-center table-sm">
                <thead>
                  <tr>
                    <th>
                      <h6 class="text-center">CODGIO PRODUCTO / SERVICIO</h6>
                    </th>
                    <th>
                      <h6 class="text-center">DESCRIPCION PRODUCTO / SERVICIO</h6>
                    </th>
                    <th>
                      <h6 class="text-center">CANTIDAD</h6>
                    </th>
                    <th>
                      <h6 class="text-center">PRECIO UNITARIO</h6>
                    </th>
                    <th>
                      <h6 class="text-center">SUBTOTAL</h6>
                    </th>
                  </tr>
                </thead>
                <tbody id="tablaInfo">
                  <?= $html['tabla']; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
serviciosMain.classList.add('active')

const consultarVehiculos = async () => {
  const respuesta = await peticionAjaxGET('modulos/vehiculos/selectVehiculosXCentroCosto.php?id=' + formDatos
    .IDCentroCosto.value)
  formDatos.IDVehiculo.innerHTML = respuesta
}

const peticionesPostServicios = async (url, form, modal) => {
  const respuesta = await peticionAjaxPOST(url, form)
  alertas(respuesta)
  if (respuesta.tipo === 'success') {
    form.reset()
    window.open(respuesta.url, '_blank')
    setTimeout(() => {
      window.location.href = 'servicios'
    }, 1950);
  }
}

const peticionGetServicios = async (url) => {
  const respuesta = await peticionAjaxGET(url)
  alertas(respuesta)
  if (respuesta.tipo === 'success') {
    window.location.href = document.referrer
  }
}

btnCancelar.addEventListener('click', (e) => {
  e.preventDefault()
  Swal.fire({
    title: '¿ESTA SEGURO?',
    text: 'LA CARGA DE SERVICIO / PRODUCTO SERA CANCELADA',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'ACEPTAR',
    cancelButtonText: 'CANCELAR'
  }).then((result) => {
    if (result.isConfirmed) {
      peticionGetServicios('modulos/servicios/serviciosCancelar.php')
    }
  })
})

formDatos.addEventListener('submit', (e) => {
  e.preventDefault()
  Swal.fire({
    title: '¿ESTA SEGURO?',
    text: 'LA CARGA DE SERVICIO / PRODUCTO SERA REGISTRADA',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'ACEPTAR',
    cancelButtonText: 'CANCELAR'
  }).then((result) => {
    if (result.isConfirmed) {
      peticionesPostServicios('modulos/servicios/serviciosRegistrar.php', formDatos)
    }
  })
})
</script>