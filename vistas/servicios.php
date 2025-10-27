<section class="section">
  <div class="container-fluid">
    <div class="title-wrapper pt-30">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="title mb-30">
            <h2>CARGAR <i>SERVICIO / PRODUCTO</i></h2>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-12">
      <div class="card-style settings-card-2 mb-30">
        <div class="row">
          <div class="col-md-6">
            <div class="mb-3">
              <button type="submit" id="btnCompletar" class="btn btn-primary form-control">
                COMPLETAR
              </button>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <button type="submit" id="btnCancelar" class="btn btn-danger form-control">
                CANCELAR
              </button>
            </div>
          </div>
          <hr>
          <div class="col-md-12">
            <h1 class="mb-3"><strong>TOTALES</strong></h1>
            <div class="mb-3 d-flex flex-column align-items-end">
              <p class="h2 text-bold">$ <span id="montoUsd">0,00</span></p>
              <p class="h2 text-bold">Bs <span id="montoBs">0,00</span></p>
            </div>
          </div>
          <hr>
          <div class="col-md-12">
            <?= renderInput('BUSCAR PRODUCTO / SERVICIO:', '', 'text', '', false, 3, 'id="buscador"'); ?>
          </div>
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
                      <h6 class="text-center">DISPONIBILIDAD DE PRODUCTO</h6>
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

<div class="modal fade" id="modalProducto" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
  role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitleId">
          CANTIDAD PRODUCTO / SERVICIO
        </h5>
      </div>
      <form id="formCant">
        <div class="modal-body">
          <?= renderInput('CANTIDAD:', 'cant', 'number', '', true, 3, 'step="0.01"'); ?>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-danger form-control" data-bs-dismiss="modal">
            CERRAR
          </button>
          <button type="submit" class="btn btn-primary form-control">
            INGRESAR
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
serviciosMain.classList.add('active')
serviciosReg.classList.add('active')

let IDTemporal
const tablaTempList = async () => {
  const respuesta = await peticionAjaxGET('modulos/servicios/serviciosLista.php')
  tablaInfo.innerHTML = respuesta.tabla
  montoUsd.innerHTML = respuesta.montoUsd
  montoBs.innerHTML = respuesta.montoBs
}

const peticionesPostServicios = async (url, form, modal) => {
  const respuesta = await peticionAjaxPOST(url, form)
  alertas(respuesta)
  if (respuesta.tipo === 'success') {
    form.reset()
    $(modal).modal('hide')
    tablaTempList()
  }
}

const peticionGetServicios = async (url) => {
  const respuesta = await peticionAjaxGET(url)
  alertas(respuesta)
  if (respuesta.tipo === 'success') {
    tablaTempList()
  }
}

$(document).ready(function() {
  $('#buscador').autocomplete({
    source: function(request, response) {
      $.ajax({
        url: 'modulos/servicios/serviciosBuscarProductos.php',
        data: {
          buscador: request.term
        },
        dataType: 'JSON',
        success: function(data) {
          response(data)
        }
      })
    },
    minLength: 1,
    select: function(event, ui) {
      IDTemporal = ui.item.value
      buscador.value = ''
      $('#modalProducto').modal('show')
      $('#modalProducto').on('shown.bs.modal', function() {
        formCant.cant.focus()
      })
      return false
    }
  })
})

formCant.addEventListener('submit', (e) => {
  e.preventDefault()
  Swal.fire({
    title: '¿ESTA SEGURO?',
    text: 'EL PRODUCTO / SERVICIO SERA AGREGADO',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'ACEPTAR',
    cancelButtonText: 'CANCELAR'
  }).then((result) => {
    if (result.isConfirmed) {
      peticionesPostServicios('modulos/servicios/serviciosAgregar.php?id=' + IDTemporal, formCant,
        '#modalProducto')
    }
  })
})

$(document).on('click', '.btnCant', function() {
  IDTemporal = this.value
  $('#modalProducto').modal('show')
  $('#modalProducto').on('shown.bs.modal', function() {
    formCant.cant.focus()
  })
})

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
      peticionGetServicios('modulos/servicios/serviciosEliminar.php?id=' + this.value)
    }
  })
})

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

btnCompletar.addEventListener('click', (e) => {
  e.preventDefault()
  Swal.fire({
    title: '¿ESTA SEGURO?',
    text: 'LA CARGA DE SERVICIO / PRODUCTO SERA COMPLETADA',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'ACEPTAR',
    cancelButtonText: 'CANCELAR'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = 'serviciosTerminar'
    }
  })
})

tablaTempList()
</script>