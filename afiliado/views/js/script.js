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
    	//const items = document.querySelector('.containerDatosClientesReferido').querySelectorAll('.datosCliente-container');
        var tableReg =document.querySelectorAll('.table-responsive');     
    	var searchText = search.value.toLowerCase().trim();
    	
    	for(var searching=0; searching < tableReg.length ; searching++) {
    		var cellsOfRow="";
    		var found=false;
    		var compareWith="";
    		for (var i = 1; i < tableReg[searching].rows.length; i++) {
    			cellsOfRow = tableReg[searching].rows[i].getElementsByTagName('td');
    			found = false;
    			for (var j = 0; j < cellsOfRow.length && !found; j++){
    				compareWith = cellsOfRow[j].innerHTML.toLowerCase();
    				// Buscamos el texto en el contenido de la celda
    				if (searchText.length == 0 || (compareWith.indexOf(searchText) > -1)){
    					found = true;
    				}
    			}
    			//console.log(found)
    			//console.log(tableReg[searching].parentElement.parentElement)
    			if(found){
    				tableReg[searching].parentElement.parentElement.style.display = '';
    			} else {
    				// si no ha encontrado ninguna coincidencia, esconde la
    				// fila de la tabla
    				tableReg[searching].parentElement.parentElement.style.display = 'none';
    			}
    		}
    	}
    })
  }
})();
