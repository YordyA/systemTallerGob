<section class="table-components">
  <div class="container-fluid">
    <div class="title-wrapper pt-30">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="title mb-30">
            <h2>LISTA DE PRODUCTOS</h2>
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
                      <h6 class="text-center">CODGIO DEL PRODUCTO</h6>
                    </th>
                    <th>
                      <h6 class="text-center">DESCRIPCION DEL PRODUCTO</h6>
                    </th>
                    <th>
                      <h6 class="text-center">PRECIO DEL PRODUCTO</h6>
                    </th>
                    <th>
                      <h6 class="text-center">EXISTENCIA DEL PRODUCTO</h6>
                    </th>
                    <th>
                      <h6 class="text-center">RELLENAR</h6>
                    </th>
                    <th>
                      <h6 class="text-center">RETIRAR</h6>
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

<div class="modal fade" id="modalRellenar" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
  role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitleId">
          RELLENAR EXISTENCIA
        </h5>
      </div>
      <form id="formRellenar">
        <div class="modal-body">
          <?= renderInput('CANTIDAD A INGRESAR:', 'cant', 'number', '', true, 3, 'step="0.01"'); ?>
          <?= renderInput('COSTO UNITARIO:', 'costoU', 'number', '', true, 3, 'step="0.01"'); ?>
          <?= renderInput('CONCEPTO DEL INGRESO:', 'concepto', 'textarea', '', true, 3); ?>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-danger form-control" data-bs-dismiss="modal">
            CERRAR
          </button>
          <button type="submit" class="btn btn-primary form-control">
            RELLENAR
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalRetirar" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
  aria-labelledby="modalTitleId" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitleId">
          RETIRAR EXISTENCIA
        </h5>
      </div>
      <form id="formRetirar">
        <div class="modal-body">
          <?= renderInput('CANTIDAD A RETIRAR:', 'cant', 'number', '', true, 3, 'step="0.01"'); ?>
          <?= renderInput('CONCEPTO DEL EGRESO:', 'concepto', 'textarea', '', true, 3); ?>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-danger form-control" data-bs-dismiss="modal">
            CERRAR
          </button>
          <button type="submit" class="btn btn-primary form-control">
            RETIRAR
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
inventarioMain.classList.add('active')
inventarioServiciosList.classList.add('active')

let IDTemporal
const url = 'modulos/inventario/inventarioLista.php?id=<?= encriptar(2); ?>'
$(document).on('click', '.btnEliminar', function() {
  Swal.fire({
    title: '¿ESTA SEGURO?',
    text: 'EL PRODUCTO / SERVICIO SERA ELIMINADO',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'ACEPTAR',
    cancelButtonText: 'CANCELAR'
  }).then((result) => {
    if (result.isConfirmed) {
      ajaxGET('modulos/inventario/inventarioEliminar.php?id=' + this.value)
    }
  })
})

const enviarMovInfo = async (url, form, modal) => {
  const respuesta = await peticionAjaxPOST(url, form)
  alertas(respuesta)
  if (respuesta.tipo === 'success') {
    form.reset()
    $(modal).modal('hide')
  }
}

$(document).on('click', '.btnRellenar', function() {
  IDTemporal = this.value
  $('#modalRellenar').modal('show')
})

$(document).on('click', '.btnRetirar', function() {
  IDTemporal = this.value
  $('#modalRetirar').modal('show')
})

formRellenar.addEventListener('submit', (e) => {
  e.preventDefault()
  Swal.fire({
    title: '¿ESTA SEGURO?',
    text: 'LA CANTIDAD SERA INGRESADA AL INVENTARIO',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'ACEPTAR',
    cancelButtonText: 'CANCELAR'
  }).then((result) => {
    if (result.isConfirmed) {
      enviarMovInfo('modulos/inventario/inventarioExistenciaRellenar.php?id=' + IDTemporal, formRellenar,
        '#modalRellenar')
    }
  })
})

formRetirar.addEventListener('submit', (e) => {
  e.preventDefault()
  Swal.fire({
    title: '¿ESTA SEGURO?',
    text: 'LA CANTIDAD SERA INGRESADA AL INVENTARIO',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'ACEPTAR',
    cancelButtonText: 'CANCELAR'
  }).then((result) => {
    if (result.isConfirmed) {
      enviarMovInfo('modulos/inventario/inventarioExistenciaRetirar.php?id=' + IDTemporal, formRetirar,
        '#modalRetirar')
    }
  })
})

ajaxTablaGET(url)
</script>