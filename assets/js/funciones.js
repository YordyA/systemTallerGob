const alertas = alerta => {
  if (alerta.alerta === 'simple') {
    swal.fire({
      icon: alerta.tipo,
      title: alerta.titulo,
      text: alerta.texto,
    })
  } else if (alerta.alerta == 'limpiar') {
    Swal.fire({
      icon: alerta.tipo,
      title: alerta.titulo,
      text: alerta.texto,
      showCancelButton: false,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'ACEPTAR',
    }).then(result => {
      if (result.isConfirmed) {
        formulario.reset()
      }
    })
  } else if (alerta.alerta == 'redireccionar') {
    Swal.fire({
      icon: alerta.tipo,
      title: alerta.titulo,
      text: alerta.texto,
      showCancelButton: false,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'ACEPTAR',
    }).then(result => {
      if (result.isConfirmed) {
        window.location.href = alerta.url
      }
    })
  } else if (alerta.alerta == 'recargar') {
    Swal.fire({
      icon: alerta.tipo,
      title: alerta.titulo,
      text: alerta.texto,
      showCancelButton: false,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'ACEPTAR',
    }).then(result => {
      if (result.isConfirmed) {
        window.location.reload()
      }
    })
  } else if (alerta.alerta == 'actualizacion') {
    if (alerta.modal !== '') {
      $(alerta.modal).modal('hide')
    }
    Swal.fire({
      icon: alerta.tipo,
      title: alerta.titulo,
      text: alerta.texto,
      showCancelButton: false,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'ACEPTAR',
    }).then(result => {
      if (result.isConfirmed) {
        dataTable.destroy()
        ajaxTablaGET(url)
      }
    })
  } else if (alerta.alerta == 'volver') {
    Swal.fire({
      icon: alerta.tipo,
      title: alerta.titulo,
      text: alerta.texto,
      showCancelButton: false,
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'ACEPTAR',
    }).then(result => {
      if (result.isConfirmed) {
        window.location.href = document.referrer
      }
    })
  } else if (alerta.alerta == 'temp') {
    Swal.fire({
      position: 'center',
      icon: alerta.tipo,
      title: alerta.texto,
      showConfirmButton: false,
      timer: 1900,
    })
  }
}

//* PETICIÓN AJAX ENVIAR DATOS POST
const ajaxFormularioPOST = async url => {
  const datos = new FormData(formulario)
  const peticion = await fetch(url, {
    method: 'POST',
    body: datos,
  })
  const respuesta = await peticion.json()
  return alertas(respuesta)
}

//* PETICIÓN AJAX RECUPERAR DATOS
const ajaxTablaGET = async url => {
  const peticion = await fetch(url)
  const respuesta = await peticion.json()
  tablaInfo.innerHTML = respuesta
  dataTable = new DataTable('#tablaMain', {
    dom: 'Bfrtip',
    buttons: ['copy', 'excel', 'pdf', 'print'],
    pageLength: 120,
    destroy: true,
    language: {
      decimal: '',
      emptyTable: 'No hay información',
      info: 'Mostrando _START_ a _END_ de _TOTAL_ Entradas',
      infoEmpty: 'Mostrando 0 de 0 de 0 Entradas',
      infoFiltered: '(Filtrado de _MAX_ total entradas)',
      infoPostFix: '',
      thousands: ',',
      lengthMenu: 'Mostrar _MENU_ Entradas',
      loadingRecords: 'Cargando...',
      processing: 'Procesando...',
      search: 'Buscar:',
      zeroRecords: 'Sin resultados encontrados',
      paginate: {
        first: 'Primero',
        last: 'Ultimo',
        next: 'Siguiente',
        previous: 'Anterior',
      },
    },
  })
}

//* PETICIÓN AJAX PETICIÓN GET
const ajaxGET = async url => {
  const peticion = await fetch(url)
  const respuesta = await peticion.json()
  return alertas(respuesta)
}

//* GENERAR FECHA DEL DIA
function fechaHoy() {
  var d = new Date($.now())
  var year = d.getFullYear()
  var mes_temporal = d.getMonth() + 1
  var mes = mes_temporal < 10 ? '0' + mes_temporal : mes_temporal
  var dia = d.getDate() < 10 ? '0' + d.getDate() : d.getDate()
  return year + '-' + mes + '-' + dia
}

//* FUNCIÓN VOLVER ATRÁS
function volver() {
  window.location.href = document.referrer
}

//* PETICION AJAX GET SENCILLA
const peticionAjaxGET = async url => {
  const peticion = await fetch(url)
  const respuesta = await peticion.json()
  return respuesta
}

//* PETICION AJAX POST SENCILLA
const peticionAjaxPOST = async (url, form) => {
  const peticion = await fetch(url, {
    method: 'POST',
    body: new FormData(form),
  })
  const respuesta = await peticion.json()
  return respuesta
}

function crearGrafico(id, label, datos) {
  new Chart(document.getElementById(id), {
    type: 'bar',
    data: {
      labels: ["SI", "NO"],
      datasets: [{
        label: label,
        data: datos,
        backgroundColor: ['rgba(54, 162, 235, 0.5)', 'rgba(255, 99, 132, 0.5)'],
        borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
}
