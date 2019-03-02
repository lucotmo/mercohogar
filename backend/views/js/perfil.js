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
    console.log(e.target)
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
          if(res.ok) {
            return res.json()
          } else {
              throw "Error en la llamada Ajax";
          }

        })
        .then(res => {

          if (res.err) {
            mensaje_error(res.msg)
          } else {

            location.reload()
          }
        })
        .catch(err => {
          let mensaje = `Parece que hay un problema. Error ${err.status}: ${err.statusText}`
          console.log(mensaje)
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




/*=============================================
=            Nuestros clientes            =
=============================================*/

const contentFormEditarNuestroCliente = document.querySelector('.vistaContenidosPaginaClientes')
const respuestaFormEditarNuestroCliente = document.querySelector('.vistaFormEditarNuestrosClientes')
const formGuardarNuestrosClientes = document.querySelector('.formGuardarNuestrosClientes')

if ( contentFormEditarNuestroCliente ){
  let btnVerform = contentFormEditarNuestroCliente.querySelectorAll("#btnEditarNuestrosClientes")
  btnVerform.forEach(function(btn){
    tableVer(btn, 'id_editNuestroCliente', respuestaFormEditarNuestroCliente)
  })
}

if ( respuestaFormEditarNuestroCliente ){
  formEventoSubmit(respuestaFormEditarNuestroCliente)
}

if ( formGuardarNuestrosClientes ){
  formEventoSubmit(formGuardarNuestrosClientes)
}


if ( contentFormEditarNuestroCliente ){
  let btnVerform = contentFormEditarNuestroCliente.querySelectorAll("#btnEliminarNuestrosClientes")
  btnVerform.forEach(function(btn){
    btn.addEventListener('click', function(e){
      e.preventDefault()
      let data = new FormData(),
        id = e.target.dataset.id
      data.append('id_eliminar_nuestros_clientes', id)

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
          location.reload()
        })
        .catch(err =>{
          let mensaje = mensaje_error(`Parece que hay un problema. Error ${err.status}: ${err.statusText}`)
          console.log(mensaje)
        })
    })
  })
}

//console.log(document.querySelector('.formGuardarNuestrosClientes'))

/*=====  End of Nuestros clientes  ======*/



/*=============================================
=            Como pedir            =
=============================================*/

const contentFormEditarComoPedir = document.querySelector('.pedir-container')
const respuestaFormEditarComoPedir = document.querySelector('.containerFormComoPedir')

if ( contentFormEditarComoPedir ){
  let btnVerform = contentFormEditarComoPedir.querySelectorAll("#btnEditarComoPedir")
  btnVerform.forEach(function(btn){
    tableVer(btn, 'id_editComoPedir', respuestaFormEditarComoPedir)
  })
}

if ( contentFormEditarComoPedir ){
  let btnVerform = contentFormEditarComoPedir.querySelectorAll("#btnEliminarComoPedir")
  btnVerform.forEach(function(btn){
    btn.addEventListener('click', function(e){
      e.preventDefault()
      let data = new FormData(),
        id = e.target.dataset.id
      data.append('id_eliminar_como_pedir', id)

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
          //respuestaFormEditarComoPedir.innerHTML = `${res}`
          location.reload()
        })
        .catch(err =>{
          let mensaje = mensaje_error(`Parece que hay un problema. Error ${err.status}: ${err.statusText}`)
          console.log(mensaje)
        })
    })
  })
}


/*=====  End of Como pedir  ======*/




/*=============================================
=            Pagina Afiliate            =
=============================================*/
const respuestaFormFormulariosAfiliate = document.querySelector('.respuestaFormulariosAfiliate')
const contentFormEditarAfiliatePortada = document.querySelector('.containerPortadaAfiliate')
const contentFormEditarAfiliateContenido = document.querySelector('.containerContenidoAfiliate')
const contentFormEditarAfiliatePreguntas = document.querySelector('.containerPreguntasAfiliate')
const contentFormEditarAfiliateBeneficios = document.querySelector('.containerBeneficiosAfiliate')

if ( contentFormEditarAfiliatePortada ){
  let btnVerform = contentFormEditarAfiliatePortada.querySelectorAll("#btnEditarAfiliatePortada")
  btnVerform.forEach(function(btn){
    tableVer(btn, 'id_afiliate_portada', respuestaFormFormulariosAfiliate)
  })
}

if ( contentFormEditarAfiliateContenido ){
  let btnVerform = contentFormEditarAfiliateContenido.querySelectorAll("#btnEditarAfiliateContenido")
  btnVerform.forEach(function(btn){
    tableVer(btn, 'id_afiliate_contenido', respuestaFormFormulariosAfiliate)
  })
}


if ( contentFormEditarAfiliateContenido ){
  let btnVerform = contentFormEditarAfiliateContenido.querySelectorAll("#btnEliminarAfiliateContenido")
  btnVerform.forEach(function(btn){
    btn.addEventListener('click', function(e){
      e.preventDefault()
      let data = new FormData(),
        id = e.target.dataset.id
      data.append('id_eliminar_afiliate_content', id)

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
          location.reload()
        })
        .catch(err =>{
          let mensaje = mensaje_error(`Parece que hay un problema. Error ${err.status}: ${err.statusText}`)
          console.log(mensaje)
        })
    })
  })
}

if ( contentFormEditarAfiliatePreguntas ){
  let btnVerform = contentFormEditarAfiliatePreguntas.querySelectorAll("#btnEditarAfiliatePreguntas")
  btnVerform.forEach(function(btn){
    tableVer(btn, 'id_afiliate_preguntas', respuestaFormFormulariosAfiliate)
  })
}
if ( contentFormEditarAfiliateBeneficios ){
  let btnVerform = contentFormEditarAfiliateBeneficios.querySelectorAll("#btnEditarAfiliateBeneficios")
  btnVerform.forEach(function(btn){
    tableVer(btn, 'id_afiliate_beneficios', respuestaFormFormulariosAfiliate)
  })
}

if ( respuestaFormFormulariosAfiliate ){
  formEventoSubmit(respuestaFormFormulariosAfiliate)
}
/* agregado de nuevas preguntas o beneficios */

const btnAgregarNuevaPregunta = document.querySelector('.btnAgregarNuevaPregunta')

if ( respuestaFormFormulariosAfiliate ){
  respuestaFormFormulariosAfiliate.addEventListener('click', function(e){
    if ( e.target.className === 'btnAgregar btnAgregarNuevaPregunta' ){
      e.preventDefault()
      let listaDePreguntas = document.querySelector('.listaDePreguntas'),
        templatePreguntas = `<div class="contentInputsPasos">
        <a href="#" class="fa fa-trash btnEliminarProducto btnEliminarPregunta" ></a>
        <div class="inpSelect-content" style="display:flex; flex-direction:column">
          <label class="labelText" for="subtituloAfiliatePreguntas">Subtitulo</label>
          <input type="hidden" name="idSubtituloAfiliatePreguntas[]" value="">
          <input class="inpText" name="subtituloAfiliatePreguntas[]" id="subtituloAfiliatePreguntas" value="" rows="" placeholder="Subtitulo">
        </div>
        <div class="inpSelect-content" style="display:flex; flex-direction:column">
          <label class="labelText" for="contenidoSubtituloAfiliatePreguntas">Contenido</label>
          <textarea class="inpText" name="contenidoSubtituloAfiliatePreguntas[]" id="contenidoSubtituloAfiliatePreguntas" cols="30" rows="" placeholder="Contenido"></textarea>
        </div>
      </div>`
      listaDePreguntas.insertAdjacentHTML( 'beforeend', templatePreguntas)
    }

    if ( e.target.className === 'btnAgregar btnAgregarNuevoBeneficio' ){
      e.preventDefault()
      //console.log(e.target)
      let listaDeBeneficios = document.querySelector('.listaDeBeneficios'),
      templateBeneficios = `<div class="contentInputsPasos" style="display:flex">
        <a href="#" class="fa fa-trash btnEliminarProducto btnEliminarBeneficios"></a>
        <div class="inpSelect-content" style="display:flex; flex-direction:column">
          <label class="labelText" for="numeroSubtituloAfiliateBeneficios">Subtitulo</label>
          <input type="hidden" name="idSubtituloAfiliateBeneficios[]" value="">
          <input class="inpText" name="numeroSubtituloAfiliateBeneficios[]" id="numeroSubtituloAfiliateBeneficios" value="" cols="1" rows="" placeholder="Subtitulo">
        </div>
        <div class="inpSelect-content" style="display:flex; flex-direction:column">
          <label class="labelText" for="contenidoSubtituloAfiliateBeneficios">Contenido</label>
          <textarea class="inpText" name="contenidoSubtituloAfiliateBeneficios[]" id="contenidoSubtituloAfiliateBeneficios" cols="30" rows="" placeholder="Contenido"></textarea>
        </div>
      </div>`
      listaDeBeneficios.insertAdjacentHTML( 'beforeend', templateBeneficios)
    }

    if ( e.target.className === 'fa fa-trash btnEliminarProducto btnEliminarPregunta' ){
      if(e.target.dataset.id != undefined) {
        let seElimina = confirm(`¿Estás seguro de eliminar ${e.target.dataset.id}?`)
        if (seElimina) {
          let data = new FormData()
          data.append('id_eliminar_pregunta', e.target.dataset.id )

          fetch('views/modules/app.php', {
            body: data,
            method: 'post'
          })
            .then(res => {
              if(res.ok) {
                return res.json()
              } else {
                  throw "Error en la llamada Ajax";
              }

            })
            .then(res => {
              console.log(res)
              if (res.err) {
                console.log('ya casi')
              } else {
                e.target.parentElement.remove()
              }

            })
            .catch(err => {
              let mensaje = `Parece que hay un problema. Error ${err.status}: ${err.statusText}`
              console.log(mensaje)
            })
        } else {
          return false
        }
      } else {
        e.target.parentElement.remove()
      }
    }
    if ( e.target.className === 'fa fa-trash btnEliminarProducto btnEliminarBeneficios' ){
      if(e.target.dataset.id != undefined) {
        let seElimina = confirm(`¿Estás seguro de eliminar ${e.target.dataset.id}?`)
        if (seElimina) {
          let data = new FormData()
          data.append('id_eliminar_beneficio', e.target.dataset.id )

          fetch('views/modules/app.php', {
            body: data,
            method: 'post'
          })
            .then(res => {
              if(res.ok) {
                return res.json()
              } else {
                  throw "Error en la llamada Ajax";
              }
            })
            .then(res => {
              console.log(res)
              if (res.err) {
                console.log('ya casi')
              } else {
                e.target.parentElement.remove()
              }
            })
            .catch(err => {
              let mensaje = `Parece que hay un problema. Error ${err.status}: ${err.statusText}`
              console.log(mensaje)
            })
        } else {
          return false
        }
      } else {
        e.target.parentElement.remove()
      }

    }
  })
}

/* Fin agregado de nuevas preguntas o beneficios */

/*=====  End of Pagina Afiliate  ======*/


//console.log(document.querySelector('.btnAgregarNuevoContenidoComoPedir'))
const btnAgregarNuevoContenidoComoPedir = document.querySelector('.btnAgregarNuevoContenidoComoPedir')
if ( btnAgregarNuevoContenidoComoPedir ){
  btnAgregarNuevoContenidoComoPedir.addEventListener('click', function(e){
    console.log(e.target)
    respuestaFormEditarComoPedir.innerHTML = `
    <div class="formModal-container">
      <form class="formModal-content" method="post" enctype="multipart/form-data">
        <a class="btnCerrarFormModal" href="" >X</a>
        <h3 class="form-titulo">Editar Contenido</h3>
        <div class="inpText-container">
          <div class="inpText-content">
            <label class="labelText" for="tituloNuevoPasosComoPedir">Titulo</label>
            <input type="text" class="inpText" name="tituloNuevoPasosComoPedir" value="" id="tituloNuevoPasosComoPedir" placeholder="Titulo">
          </div>
        </div>
        <div class="inpText-content">
          <label class="labelText" for="videoNuevoPasosComoPedir">Url Video</label>
          <input type="url" class="inpText" name="videoNuevoPasosComoPedir" value="" id="videoNuevoPasosComoPedir" placeholder="url video">
        </div>
        <h3 class="form-titulo">Pasos</h3>
        <div class="btnAgregar-content">
          <button class="btnAgregar btnAgregarNuevoPaso" style="width:50%">Nuevo Paso</button>
        </div>
        <div class="containerInputsPasos ListaDePasos">
          <div class="contentInputsPasos" style="display:flex">
            <a href="#" class="fa fa-trash btnEliminarProducto btnEliminarPaso"></a>
            <div class="inpSelect-content" style="display:flex; flex-direction:column">
              <label class="labelText" for="numeroNuevoPasosComoPedir">No.</label>
              <input class="inpText" name="numeroNuevoPasosComoPedir[]" id="numeroNuevoPasosComoPedir" value="" cols="1" rows="" placeholder="No." style="width:20%">
            </div>
            <div class="inpSelect-content" style="display:flex; flex-direction:column">
              <label class="labelText" for="contenidosNuevoPasosComoPedir">Contenido</label>
              <textarea class="inpText" name="contenidoNuevoPasosComoPedir[]" id="contenidoNuevoPasosComoPedir" cols="30" rows="" placeholder="Contenido"></textarea>
            </div>
          </div>
          </div>
          <div class="inpText-container">
            <div class="inpSubmit-content">
              <input type="submit" class="inpSubmit" value="Guardar">
            </div>
          </div>

        </form>
      </div>
    `


  })
}

if ( respuestaFormEditarComoPedir ) {
  respuestaFormEditarComoPedir.addEventListener('click', function(e){
    if ( e.target.className === 'btnAgregar btnAgregarNuevoPaso' ){
      e.preventDefault()
      //console.log(e.target)
      let ListaDePasos = document.querySelector('.ListaDePasos'),
      templatePasos = `<div class="contentInputsPasos" style="display:flex">
        <a href="#" class="fa fa-trash btnEliminarProducto btnEliminarPaso"></a>
        <div class="inpSelect-content" style="display:flex; flex-direction:column">
          <label class="labelText" for="numeroNuevoPasosComoPedir">No.</label>
          <input class="inpText" name="numeroNuevoPasosComoPedir[]" id="numeroNuevoPasosComoPedir" value="" cols="1" rows="" placeholder="No." style="width:20%">
        </div>
        <div class="inpSelect-content" style="display:flex; flex-direction:column">
          <label class="labelText" for="contenidosNuevoPasosComoPedir">Contenido</label>
          <textarea class="inpText" name="contenidoNuevoPasosComoPedir[]" id="contenidoNuevoPasosComoPedir" cols="30" rows="" placeholder="Contenido"></textarea>
        </div>
      </div>`
      ListaDePasos.insertAdjacentHTML( 'beforeend', templatePasos)
    }
    if ( e.target.className === 'btnAgregar btnAgregarNuevoEditarPaso' ){
      e.preventDefault()
      let idComoPedir = e.target.parentElement.nextElementSibling.querySelector('#idComoPedirPasosComoPedir').value
      let ListaDePasos = document.querySelector('.ListaDePasos'),
      templatePasos = `<div class="contentInputsPasos" style="display:flex">
      <a href="#" class="fa fa-trash btnEliminarProducto btnEliminarPaso" ></a>
      <div class="inpSelect-content" style="display:flex; flex-direction:column">
        <label class="labelText" for="numeroPasosComoPedir">No.</label>
        <input type="hidden" name="idPasosComoPedir[]"  value="" >
        <input type="hidden" name="idComoPedirPasosComoPedir[]" id="idComoPedirPasosComoPedir"  value="${idComoPedir}" >
        <input class="inpText" name="numeroPasosComoPedir[]" id="numeroPasosComoPedir" value="" cols="1" rows="" placeholder="No." style="width:20%">
      </div>
      <div class="inpSelect-content" style="display:flex; flex-direction:column">
        <label class="labelText" for="contenidoPasosComoPedir">Contenido</label>
        <textarea class="inpText" name="contenidoPasosComoPedir[]" id="contenidoPasosComoPedir" cols="30" rows="" placeholder="Contenido"></textarea>
      </div>
    </div>`
      ListaDePasos.insertAdjacentHTML( 'beforeend', templatePasos)
    }

    if ( e.target.className === 'fa fa-trash btnEliminarProducto btnEliminarPaso' ){
      if(e.target.dataset.id != undefined) {
        e.preventDefault()
        let seElimina = confirm(`¿Estás seguro de eliminar ${e.target.dataset.id}?`)
        if (seElimina) {
          let data = new FormData()
          data.append('id_eliminar_paso', e.target.dataset.id )

          fetch('views/modules/app.php', {
            body: data,
            method: 'post'
          })
            .then(res => {
              if(res.ok) {
                return res.json()
              } else {
                  throw "Error en la llamada Ajax";
              }

            })
            .then(res => {
              console.log(res)
              if (res.err) {
                console.log('ya casi')
              } else {
                e.target.parentElement.remove()
              }

            })
            .catch(err => {
              let mensaje = `Parece que hay un problema. Error ${err.status}: ${err.statusText}`
              console.log(mensaje)
            })
        } else {
          return false
        }

      } else {
        e.target.parentElement.remove()
      }
    }
  })
}

if ( respuestaFormEditarComoPedir ){
  formEventoSubmit(respuestaFormEditarComoPedir)
}


//console.log(document.querySelector('.formGuardarNuestrosClientes'))




/* como PEDIR */


/* fin como pedir */

const btnAgregarNuevoAfiliateContenido = document.querySelector('.btnAgregarNuevoAfiliateContenido')

if ( btnAgregarNuevoAfiliateContenido ){
  btnAgregarNuevoAfiliateContenido.addEventListener('click', function(e){
    console.log(e.target)
    respuestaFormFormulariosAfiliate.innerHTML = `
    <div class="formModal-container">
      <form class="formModal-content" method="post" enctype="multipart/form-data">
        <a class="btnCerrarFormModal" href="" >X</a>
        <h3 class="form-titulo">Nuevo Contenido</h3>
        <div class="inpText-container">
          <div class="inpText-content">
            <label class="labelText" for="tituloAfiliateContenido">Titulo</label>
            <input type="hidden" class="inpText" name="idNuevoAfiliateContenido" value="">
            <input type="text" class="inpText" name="tituloNuevoAfiliateContenido" value="" id="tituloAfiliateContenido" placeholder="Titulo">
          </div>
        </div>
        <div class="inpSelect-content" style="display:flex; flex-direction:column">
          <label class="labelText" for="contenidoAfiliateContenido">Contenido</label>
          <textarea class="inpText" name="contenidoNuevoAfiliateContenido" id="contenidoAfiliateContenido" cols="30" rows="10" placeholder="Contenido..."></textarea>
        </div>
        <div class="inpText-content">
          <label class="labelText" for="videoAfiliateContenido">Url Video</label>
          <input type="url" class="inpText" name="videoNuevoAfiliateContenido" value="" id="videoAfiliateContenido" placeholder="url video">
        </div>
        <div class="inpText-container">
          <div class="inpSubmit-content">
            <input type="submit" class="inpSubmit" value="Guardar">
          </div>
        </div>

      </form>
    </div>
    `
  })
}


console.log('probandoooooo con lucho')