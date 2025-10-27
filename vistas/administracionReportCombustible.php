<?php
require_once './modulos/main.php';
require_once './modulos/administracion/administracionMain.php';
?>
<section class="table-components">
  <div class="container-fluid">
    <div class="title-wrapper pt-30">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="title mb-30">
            <h2>REPORTE GASTO DE COMBUSTIBLE</h2>
          </div>
        </div>
      </div>
    </div>
    <div class="tables-wrapper">
      <div class="row">
        <div class="col-lg-12">
          <div class="card-style mb-30">
            <div class="row">
              <div class="col-md-4">
                <?= renderInput('DEL:', '', 'date', '', true, 3, 'id="d" onchange="actualizarTablaTemp()"'); ?>
              </div>
              <div class="col-md-4">
                <?= renderInput('HASTA:', '', 'date', '', true, 3, 'id="h" onchange="actualizarTablaTemp()"'); ?>
              </div>
              <div class="col-md-4">
                <div class="mb-3">
                  <label class="form-label text-dark">TIPO DE COMBUSTIBLE:</label>
                  <select class="form-select form-select-lg text-bold" id="tipoCombustible"
                    onchange="actualizarTablaTemp()" required>
                    <option value="" selected>SELECCIONE</option>
                    <option value="<?= encriptar('GASOLINA'); ?>">GASOLINA</option>
                    <option value="<?= encriptar('GASOIL'); ?>">GASOIL</option>
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
                          <h6 class="text-center">TIPO DE COMBUSTIBLE</h6>
                        </th>
                        <th>
                          <h6 class="text-center">ESTACION DE SERVICIO</h6>
                        </th>
                        <th>
                          <h6 class="text-center">FECHA COMBUSTIBLE</h6>
                        </th>
                        <th>
                          <h6 class="text-center">CONCEPTO</h6>
                        </th>
                        <th>
                          <h6 class="text-center">MONTO TOTAL LITROS</h6>
                        </th>
                        <th>
                          <h6 class="text-center">MONTO TOTAL <br><strong>(BS)</strong></h6>
                        </th>
                        <th>
                          <h6 class="text-center">MONTO TOTAL <br><strong>(USD)</strong></h6>
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
administracionMain.classList.add('active')
administracionReportGastos.classList.add('active')

d.value = fechaHoy()
h.value = fechaHoy()

const tablaTempList = async () => {
  await ajaxTablaGET('modulos/administracion/reportAdministracionGastoCombustible.php?d=' + d.value + '&h=' + h
    .value +
    '&id=' + tipoCombustible.value)
}

const actualizarTablaTemp = async () => {
  dataTable.destroy()
  await tablaTempList()
}

tablaTempList()
</script>