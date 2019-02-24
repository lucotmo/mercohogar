
const table = document.querySelector('.responsivePedido-table')

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




/*=============================================
=            Aprobar pedido            =
=============================================*/

//console.log(document.querySelector('.btnRealizadoPedido'))
//console.log(document.querySelector('.responsivePedido-table'))
const tablePedido = document.querySelector('.responsivePedido-table')

if ( tablePedido ){
  let btnAprobarPedido = tablePedido.querySelectorAll(".btnRealizadoPedido")
  btnAprobarPedido.forEach(function(btn){
	  btn.addEventListener('click', function(e){
      e.preventDefault()
	  var r = confirm("¿El pedido ha sido aprobado?");
		if (r == true) {
			let data = new FormData(),
	        idPedido = e.target.dataset.id
	        data.append('id_cambio', idPedido)
	        fetch('views/modules/app.php', {
		        body: data,
		        method: 'post'
	        }).then(res =>{
	          console.log(res)
	          return(res.ok)
	            ? res.text()
	            : Promise.reject({ status: res.status, statusText: res.statusText })
	        }).then(res => {
	          console.log(res)
	          location.reload()
	        }).catch(err =>{
	          console.log(err)
	          let mensaje = mensaje_error(`Parece que hay un problema. Error ${err.status}: ${err.statusText}`)
	          console.log(mensaje)
	        })
		} 
    })
  })
}


/*=====  End of Aprobar pedido  ======*/

