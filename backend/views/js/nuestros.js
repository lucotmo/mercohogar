console.log('luchoooooo')

//console.log(document.getElementById('btnAgregarNuevoCliente'))
//console.log(document.getElementById('formEditarNuestrosClientes'))

const btnAgregarNuevoCliente = document.getElementById('btnAgregarNuevoCliente')

if ( btnAgregarNuevoCliente ){
  btnAgregarNuevoCliente.addEventListener('click', function(e){
    e.preventDefault()
    const formulario = document.querySelector('.formGuardarNuestrosClientes')
    if( formulario.style.display == 'none'  ){
      //console.log('probando')
      formulario.style.display = 'block'
    }else{
      formulario.style.display = 'none'
    }
  })
}

//console.log(document.querySelector('.formGuardarNuestrosClientes'))