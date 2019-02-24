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



/*====================================================
=            cerrar segundo editar perfil            =
====================================================*/

/* let probandoEstaJoda = document.querySelector('#intento45')

if ( probandoEstaJoda ){
  probandoEstaJoda.addEventListener('click', function(e){
    console.log(e.target)
  })
} */

/* document.addEventListener('click', function(e){
  console.log(document.getElementById("intento45"))
  if ( e.target == document.getElementById("Editar2Miembro") ){
    let form = document.getElementById('formModalEditarMiembros')
    if ( form.style.display == "none" ){
      form.style.display = "flex"
    }else{
      form.style.display = "none"
    }
  }
}) */

/*=====  End of cerrar segundo editar perfil  ======*/




/*=============================================
=            mostrar Afiliados            =
=============================================*/

const tableAfiliados = document.querySelector('.afiliados-content')

const respuestaAfiliados = document.querySelector('.respuestaAfiliados')
//console.log(document.querySelector('.respuestaAfiliados'))
if ( tableAfiliados ){
  let btnVerAfiliados = tableAfiliados.querySelectorAll("#verAfiliado")
  btnVerAfiliados.forEach(function(btn){
    btn.addEventListener('click', function(e){
      e.preventDefault()
      let data = new FormData(),
        idAfiliado = e.target.dataset.id
      data.append('id_afiliado', idAfiliado)

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
          respuestaAfiliados.innerHTML = `${res}`
        })
        .catch(err =>{
          let mensaje = mensaje_error(`Parece que hay un problema. Error ${err.status}: ${err.statusText}`)
          console.log(mensaje)
        })
    })
  })
}

/*=====  End of mostrar Afiliados  ======*/



/*=============================================
=            mostrar Afiliados            =
=============================================*/

const tableClientes = document.querySelector('#clientes-content')

const respuestaClientes = document.querySelector('.respuestaClientes')
console.log(respuestaClientes)
//console.log(document.querySelector('.respuestaAfiliados'))
if ( tableClientes ){
  let btnVerClientes = tableClientes.querySelectorAll("#verClientes")
  btnVerClientes.forEach(function(btn){
    btn.addEventListener('click', function(e){
      e.preventDefault()
      let data = new FormData(),
        idCliente = e.target.dataset.id
      data.append('id_cliente', idCliente)

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
          console.log(res)
          //console.log('start')
          respuestaClientes.innerHTML = `${res}`
        })
        .catch(err =>{
          let mensaje = mensaje_error(`Parece que hay un problema. Error ${err.status}: ${err.statusText}`)
          console.log(mensaje)
        })
    })
  })
}


console.log('luchooooo')

/*=====  End of mostrar Afiliados  ======*/