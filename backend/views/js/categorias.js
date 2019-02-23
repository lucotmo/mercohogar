/*=========================================
=            gestor CATEGORIAS            =
=========================================*/
const btnAgregarCategorias = document.getElementById('btnAgregarCategorias'),
  formGuardarCategoriasContainer = document.getElementById('formGuardarCategorias-container'),
  formGuardarCategorias = document.getElementById('formGuardarCategorias'),
  btnEditarCategorias = document.getElementById('tableCategoria')

if ( btnAgregarCategorias ){
  btnAgregarCategorias.addEventListener('click', function(){
    if ( formGuardarCategoriasContainer.style.display == "none" ){
      formGuardarCategoriasContainer.style.display = "block"
    }else{
      formGuardarCategoriasContainer.style.display = "none"
    }
  })
}


if ( btnEditarCategorias ){
  btnEditarCategorias.querySelectorAll('#btnEditarCategoria').forEach(function(btn){
    btn.addEventListener('click', function(e){
      const base = e.target.parentElement.parentElement,
        idCategoria = base.querySelector('.categoriaId').id,
        nombreCategoria = base.querySelector('.tabla__item__categoria').textContent,
        comisionCategoria = base.querySelector('.tabla__item__comision').textContent,
        templateEditarCategoria = `
        <div class="formGuardar-content">
          <h3 class="title-form">Editar Categoria</h3>
          <form method="post" class="formGuardar">
            <div class="inpsGuardar-container">
              <div class="inpGuardar-content">
                <label class="labelText" for="">Categoria</label>
                <input type="text" class="inpGuardar" name="updateCategoria" value="${nombreCategoria}" placeholder="Categoria">
              </div>
              <div class="inpGuardar-content">
                <label class="labelText" for="">Comision</label>
                <input type="text" class="inpGuardar" name="updateComision" value="${comisionCategoria}" placeholder="Comision">
              </div>
              <input type="hidden" name="updateId" value="${idCategoria}">
            </div>
            <div class="btnInputGuardar-content">
              <input class="btnInputGuardar" type="submit" value="Guardar">
            </div>
          </form>
        </div>
        `
      e.preventDefault()
      document.querySelector('.formsResets').innerHTML = templateEditarCategoria
    })
  })
}

/*=====  End of gestor CATEGORIAS  ======*/
