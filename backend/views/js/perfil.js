/* Boton para abrir y cerrar formulario modales */

const btnRegistrarNuevoMiembro = document.getElementById('btnRegistrarNuevoMiembro'),
  btnEditarNuevoMiembro = document.getElementById('btnEditarNuevoMiembro'),
  btnRegistrarNuevoAfiliado = document.getElementById('btnRegistrarNuevoAfiliado'),
  btnCerrarFormModalNuevoMiembro = document.getElementById('btnCerrarFormModalNuevoMiembro'),
  btnCerrarFormModalEditarMiembro = document.getElementById('btnCerrarFormModalEditarMiembro'),
  btnCerrarFormModalNuevoAfiliado = document.getElementById('btnCerrarFormModalNuevoAfiliado')

function openCloseFormModal($btn, $form){
  if ( $btn ){
    $btn.addEventListener('click', function(e){
      e.preventDefault()
      let formModalNuevoMiembro = document.getElementById($form)
      if ( formModalNuevoMiembro.style.display == "none" ){
        formModalNuevoMiembro.style.display = "flex"
      }else{
        formModalNuevoMiembro.style.display = "none"
      }
    })
  }
}

openCloseFormModal(btnRegistrarNuevoMiembro, 'formModalNuevoMiembro')
openCloseFormModal(btnCerrarFormModalNuevoMiembro, 'formModalNuevoMiembro')

openCloseFormModal(btnRegistrarNuevoAfiliado, 'formModalNuevoAfiliado')
openCloseFormModal(btnCerrarFormModalNuevoAfiliado, 'formModalNuevoAfiliado')

openCloseFormModal(btnEditarNuevoMiembro, 'formModalEditarMiembro')
openCloseFormModal(btnCerrarFormModalEditarMiembro, 'formModalEditarMiembro')




/* -------------------------------------------------------------------- */

const perfilesContent = document.querySelector('.perfiles-content'),
  contenidoEditPerfil = document.querySelector('.containerEditPerfil')

if ( perfilesContent ){
  const btns = perfilesContent.querySelectorAll('#btnEditPerfil')
  btns.forEach(function(btn){
    btn.addEventListener('click', function(e){
      //console.log(e.target.dataset.id)
      e.preventDefault()
      let data = new FormData(),
        idPerfil = e.target.dataset.id
      data.append('perfil_id', idPerfil)

      fetch('views/modules/app.php', {
        body: data,
        method: 'post'
      })
        .then(res =>{
          return(res.ok)
            ? res.text()
            : Promise.reject({ status: res.status, statusText: res.statusText })
        })
        .then(res => {
          contenidoEditPerfil.innerHTML = `${res}`
        })
        .catch(err =>{
          let mensaje = mensaje_error(`Parece que hay un problema. Error ${err.status}: ${err.statusText}`)
          console.log(mensaje)
        })

    })
  })
}



/*=============================================
=            constantes            =
=============================================*/

const tableAfiliados = document.querySelector('.afiliados-content'),
  respuestaAfiliados = document.querySelector('.respuestaAfiliados'),
  tableClientes = document.querySelector('#clientes-content'),
  respuestaClientes = document.querySelector('.respuestaClientes')


/*=====  End of constantes  ======*/


const mensaje_error = msg => `
    <p class="section center  red  darken-1  white-text  Messages" >
      ${msg}
      <br>
      <i class="material-icons">no hecho</i>
    </p>
  `

const mensaje_ok = msg => `
    <p class="section center  green  darken-1  white-text  Messages" >
      ${msg}
      <br>
      <i class="material-icons">hecho</i>
    </p>
  `

/*=============================================
=            funciones            =
=============================================*/
function tableVer(btn, idDato, respuesta){
  btn.addEventListener('click', function(e){
    e.preventDefault()
    let data = new FormData(),
      id = e.target.dataset.id
    data.append(idDato, id)

    fetch('views/modules/app.php', {
      body: data,
      method: 'post'
    })
      .then(res =>{
        return(res.ok)
          ? res.text()
          : Promise.reject({ status: res.status, statusText: res.statusText })
      })
      .then(res => {
        //console.log(res)
        //console.log('start')
        respuesta.innerHTML = `${res}`
      })
      .catch(err =>{
        let mensaje = mensaje_error(`Parece que hay un problema. Error ${err.status}: ${err.statusText}`)
        console.log(mensaje)
      })
  })
}

function formEventoSubmit(resp){
  resp.addEventListener('submit', function(e) {
    if (e.target.matches('form')) {
      e.preventDefault()
      let data = new FormData(e.target)

      fetch('views/modules/app.php', {
        body: data,
        method: 'post'
      })
        .then(res => {
          //c(res)
          return (res.ok)
            ? res.json()
            : Promise.reject({ status: res.status, statusText: res.statusText })
        })
        .then(res => {
          //console.log(res)
          //let mensaje

          if (res.err) {
            //mensaje_error(res.msg)
          } else {
            //mensaje = console.log(res)
            //mensaje_ok(res.msg)
            location.reload()
          }
        })
        .catch(err => {
          let mensaje = `Parece que hay un problema. Error ${err.status}: ${err.statusText}`
        })
    }
  })
}

/*=====  End of funciones  ======*/



/*=============================================
=            mostrar Afiliados            =
=============================================*/

if ( tableAfiliados ){
  let btnVerAfiliados = tableAfiliados.querySelectorAll("#verAfiliado")
  btnVerAfiliados.forEach(function(btn){
    tableVer(btn, 'id_afiliado', respuestaAfiliados)
  })
}

if ( tableAfiliados ){
  let btnVerAfiliados = tableAfiliados.querySelectorAll("#editAfiliado")
  btnVerAfiliados.forEach(function(btn){
    tableVer(btn, 'id_editAfiliado', respuestaAfiliados)
  })
}

if ( respuestaAfiliados ){
  formEventoSubmit(respuestaAfiliados)
}

/*=====  End of mostrar Afiliados  ======*/



/*=============================================
=            mostrar Cliente            =
=============================================*/

if ( tableClientes ){
  let btnVerClientes = tableClientes.querySelectorAll("#verClientes")
  btnVerClientes.forEach(function(btn){
    tableVer(btn, 'id_cliente', respuestaClientes)
  })
}


if ( tableClientes ){
  let btnVerClientes = tableClientes.querySelectorAll("#editClientes")
  btnVerClientes.forEach(function(btn){
    tableVer(btn, 'id_editCliente', respuestaClientes)
  })
}

if ( respuestaClientes ){
  formEventoSubmit(respuestaClientes)
}

/*=====  End of mostrar Cliente  ======*/








