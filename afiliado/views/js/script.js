const btnPerfil = document.querySelector('.icon-admin')

if (  btnPerfil ){
  btnPerfil.addEventListener('click', function(e){
    e.preventDefault()
    let perfilOpciones = document.querySelector('.perfil-options')
    perfilOpciones.classList.toggle('active__perfil-options2')
  })
}

//console.log(document.querySelector('.perfil-options'))