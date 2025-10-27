<?php
require_once './modulos/main.php';
require_once './modulos/servicios/serviciosMain.php';
require_once './modulos/empresas/empresasMain.php';
?>
<section class="table-components">
  <div class="container-fluid">
    <div class="title-wrapper pt-30">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="title mb-30">
            <h2>MOVIMIENTO DE INVENTARIO</h2>
          </div>
        </div>
      </div>
    </div>
    <div class="tables-wrapper">
      <div class="row">
        <div class="col-lg-12">
          <div class="card-style mb-30">
            <div class="row">
              <div class="col-md-3">
                <?= renderInput('DEL:', '', 'date', '', true, 3, 'id="d" onchange="actualizarTablaTemp()"'); ?>
              </div>
              <div class="col-md-3">
                <?= renderInput('HASTA:', '', 'date', '', true, 3, 'id="h" onchange="actualizarTablaTemp()"'); ?>
              </div>
              <div class="col-md-3">
                <div class="mb-3">
                  <label class="form-label text-dark">CENTROS DE COSTO:</label>
                  <select class="form-select form-select-lg text-bold" id="IDCentroCosto"
                    onchange="actualizarTablaTemp()" required>
                    <option value="" selected>SELECCIONE</option>
                    <?php foreach (empresasListaCentroCosto() as $row) : ?>
                    <option value="<?= encriptar($row['IDCentroCosto']); ?>">
                      <?= $row['DescripcionCentroCosto']; ?>
                    </option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="mb-3">
                  <label class="form-label text-dark">TIPO DE SERVICIO:</label>
                  <select class="form-select form-select-lg text-bold" id="IDTipoServicio"
                    onchange="actualizarTablaTemp()" required>
                    <option value="" selected>SELECCIONE</option>
                    <?php foreach (serviciosListaTipos() as $row) : ?>
                    <option value="<?= encriptar($row['IDTipoServicio']); ?>">
                      <?= $row['DescripcionTipoServicio']; ?>
                    </option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <hr>
              <div class="col-md-12">
                <div class="table-wrapper table-responsive">
                  <table class="table text-center" id="tablaMain">
                    <thead>
                      <tr>
                        <th>
                          <h6 class="text-center">TIPO DE SERVICIO</h6>
                        </th>
                        <th>
                          <h6 class="text-center">FECHA DEL SERVICIO</h6>
                        </th>
                        <th>
                          <h6 class="text-center">TASA REFERENCIAL</h6>
                        </th>
                        <th>
                          <h6 class="text-center">NRO DE NOTA</h6>
                        </th>
                        <th>
                          <h6 class="text-center">MONTO TOTAL <br><strong>(USD)</strong></h6>
                        </th>
                        <th>
                          <h6 class="text-center">MONTO TOTAL <br><strong>(BS)</strong></h6>
                        </th>
                        <th>
                          <h6 class="text-center">EMPRESA <br><strong>(PROPIETARIA DEL VEHICULO)</strong></h6>
                        </th>
                        <th>
                          <h6 class="text-center">CENTRO DE COSTO</h6>
                        </th>
                        <th>
                          <h6 class="text-center">VEHICULO</h6>
                        </th>
                        <th>
                          <h6 class="text-center">RECIBE CONFORME</h6>
                        </th>
                        <th>
                          <h6 class="text-center">OBSERVACION</h6>
                        </th>
                        <th>
                          <h6 class="text-center">RESPONSABLE</h6>
                        </th>
                        <th>
                          <h6 class="text-center">NOTA DEL SERVICIO</h6>
                        </th>
                        <th>
                          <h6 class="text-center">ANULAR</h6>
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
    </div>
  </div>
</section>

<script>
serviciosMain.classList.add('active')
serviciosReportMain.classList.add('active')
serviciosReportRealizados.classList.add('active')

d.value = fechaHoy()
h.value = fechaHoy()

const tablaTempList = async () => {
  await ajaxTablaGET('modulos/servicios/reportServiciosRealizados.php?d=' + d.value + '&h=' + h.value +
    '&IDCentroCosto=' + IDCentroCosto.value + '&IDTipoServicio=' + IDTipoServicio.value, )
}

const actualizarTablaTemp = async () => {
  dataTable.destroy()
  await tablaTempList()
}

tablaTempList()
</script>