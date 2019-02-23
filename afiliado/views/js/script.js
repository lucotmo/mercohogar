const btnPerfil = document.querySelector('.icon-admin')

if (  btnPerfil ){
  btnPerfil.addEventListener('click', function(e){
    e.preventDefault()
    let perfilOpciones = document.querySelector('.perfil-options')
    if ( perfilOpciones.style.display = "none" ){
      perfilOpciones.style.display = "flex"
    }else{
      perfilOpciones.style.display = "none"
    }
  })
}

//console.log(document.querySelector('.perfil-options'))