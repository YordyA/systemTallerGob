<?php
require_once './modulos/main.php';
require_once './modulos/inventario/inventarioMain.php';
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
              <div class="col-md-4">
                <?= renderInput('DEL:', '', 'date', '', true, 3, 'id="d" onchange="actualizarTablaTemp()"'); ?>
              </div>
              <div class="col-md-4">
                <?= renderInput('HASTA:', '', 'date', '', true, 3, 'id="h" onchange="actualizarTablaTemp()"'); ?>
              </div>
              <div class="col-md-4">
                <div class="mb-3">
                  <label class="form-label text-dark">TIPO DE MOVIMIENTO:</label>
                  <select class="form-select form-select-lg text-bold" id="IDTipoMov" onchange="actualizarTablaTemp()"
                    required>
                    <option value="" selected>SELECCIONE</option>
                    <?php foreach (inventarioMovimientoLista() as $row): ?>
                    <option value="<?= encriptar($row['IDTipoMov']); ?>"><?= $row['DescripcionMovimiento']; ?></option>
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
                          <h6 class="text-center">FECHA DEL MOVIMIENTO</h6>
                        </th>
                        <th>
                          <h6 class="text-center">TIPO DE MOVIMIENTO</h6>
                        </th>
                        <th>
                          <h6 class="text-center">CODGIO DEL PRODUCTO</h6>
                        </th>
                        <th>
                          <h6 class="text-center">DESCRIPCION DEL PRODUCTO</h6>
                        </th>
                        <th>
                          <h6 class="text-center">EXISTENCIA ANTERIOR</h6>
                        </th>
                        <th>
                          <h6 class="text-center">MOVIMIENTO</h6>
                        </th>
                        <th>
                          <h6 class="text-center">EXISTENCIA FINAL</h6>
                        </th>
                        <th>
                          <h6 class="text-center">CONCEPTO DEL MOVIMIENTO</h6>
                        </th>
                        <th>
                          <h6 class="text-center">RESPONSABLE</h6>
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
inventarioMain.classList.add('active')
inventarioReportMain.classList.add('active')
inventarioReportMov.classList.add('active')

d.value = fechaHoy()
h.value = fechaHoy()

const tablaTempList = async () => {
  await ajaxTablaGET('modulos/inventario/reportInventarioMovimiento.php?d=' + d.value + '&h=' + h.value + '&id=' +
    IDTipoMov.value)
}

const actualizarTablaTemp = async () => {
  dataTable.destroy()
  await tablaTempList()
}

tablaTempList()
</script>