
const table = document.querySelector('.responsivePedido-table')

/* if ( table ){
  let btnVerPedido = table.querySelectorAll("#verPedido")
  btnVerPedido.forEach(function(btn){
    btn.addEventListener('click', function(e){
      let base = e.target.parentElement.parentElement,
        idPedido = base.querySelector("#pedidoId").textContent
      console.log(idPedido)
    })
  })
} */
//console.log(document.querySelector('.responsivePedido-table'))

const respondiendo = document.querySelector('.respuestaPedido')

if ( table ){
  let btnVerPedido = table.querySelectorAll("#verPedido")
  btnVerPedido.forEach(function(btn){
    btn.addEventListener('click', function(e){
      e.preventDefault()
      let data = new FormData(),
        base = e.target.parentElement.parentElement,
        idPedido = base.querySelector("#pedidoId").textContent
      data.append('id', idPedido)

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
          console.log('start')
          respondiendo.innerHTML = `${res}`
        })
        .catch(err =>{
          let mensaje = mensaje_error(`Parece que hay un problema. Error ${err.status}: ${err.statusText}`)
          console.log(mensaje)
        })
    })
  })
}

//console.log('probando')

//console.log(document.querySelector('.vistaRespuesta'))

const btnCerrarVistaPedido = document.querySelector('.btnCerrarVistaPedido')

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
}



