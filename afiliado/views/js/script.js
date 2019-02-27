const btnPerfil = document.querySelector('.icon-admin')

if (  btnPerfil ){
  btnPerfil.addEventListener('click', function(e){
    e.preventDefault()
    let perfilOpciones = document.querySelector('.perfil-options')
    perfilOpciones.classList.toggle('active__perfil-options2')
  })
}


/* const btnCerrarVistaPedido = document.querySelector('.btnCerrarVistaPedido')

if ( btnCerrarVistaPedido ){
  btnCerrarVistaPedido.addEventListener('click', function(e){
    e.preventDefault()
    let vista = document.querySelector('.vistaRespuesta')
    if ( vista.style.display == "none" ){
      vista.style.display = "flex"
    }else{
      vista.style.display = "none"
    }
  })
} */

//console.log(document.querySelector('.containerDatosClientesReferido'))

const table = document.querySelector('.containerDatosClientesReferido'),
  respondiendo = document.querySelector('.respuestaPedido')

if ( table ){
  let btnVerPedido = table.querySelectorAll("#verPedido")
  btnVerPedido.forEach(function(btn){
    btn.addEventListener('click', function(e){
      //console.log(e.target.dataset.id)
      e.preventDefault()
      let data = new FormData(),
        idPedido = e.target.dataset.id
      data.append('id_ver_pedido', idPedido)

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
          respondiendo.innerHTML = `${res}`
        })
        .catch(err =>{
          let mensaje = `Parece que hay un problema. Error ${err.status}: ${err.statusText}`
          console.log(mensaje)
        })
    })
  })
}

const search = document.getElementById('search-item');

(function(){
  if ( search ){
    search.addEventListener('keyup', function(){
      let value = search.value.toLowerCase().trim();
      const items = document.querySelector('.containerDatosClientesReferido').querySelectorAll('.datosCliente-container');
      let length = value.length;

      if(  length > 0 ) {
        items.forEach( (item) => {
          let type = item.dataset.item;

          let match = type.slice(0, length);
          //console.log(type, length, search.value)

          if ( value === match ){
          }
          else{
            item.style.display = 'none';
          }
        })

       } else {
        items.forEach( (item) => { item.style.display = ''})
       }

    })
  }
})();
