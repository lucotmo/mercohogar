const btnPerfil = document.querySelector('.btn__perfil'),
  btnContentEditarProducto = document.querySelectorAll('#btnEditarProducto')

function validarIngreso(){
	let expresion = /^[a-zA-Z0-9]*$/
	if(!expresion.test($("#usuarioIngreso").val())){
		return false;
	}
	if(!expresion.test($("#passwordIngreso").val())){
		return false;
	}
	return true;
}

if ( btnPerfil ){
  btnPerfil.addEventListener('click', function(){
    document.querySelector('.perfil-options').classList.toggle('active__perfil-options')
  })
}






/* CONTENT PRODUCTOS */


/*===========================================
=            Filtro search input            =
===========================================*/

(function(){
  const search = document.getElementById('search-item');
  if ( search ){
    search.addEventListener('keyup', function(){
      let value = search.value.toLowerCase().trim();
      const items = document.querySelector('.list-product-exits').querySelectorAll('.product-container');
      items.forEach( (item) => {
        let type = item.dataset.item;
        let length = value.length;

        let match = type.slice(0, length);

        if ( value === match ){
          item.style.display = 'block';
        }
        else{
          item.style.display = 'none';
        }
      })
    })
  }
})();

/*=====  End of Filtro search input  ======*/





/*=========================================
=            Filtro Categorias            =
=========================================*/

(function(e){
  const filterBtn =  document.querySelectorAll('.categorias__items');
  filterBtn.forEach( (btn) => {
    btn.addEventListener('click', (e) => {
    e.preventDefault();
    const value = e.target.dataset.filter;

    const items = document.querySelector('.list-product-exits').querySelectorAll('.product-container');

    items.forEach( (item) =>{
      if ( value === 'all' ){
        item.style.display = 'block';
      }else{
        if ( item.classList.contains(value) ){
          item.style.display = 'block';
        }else{
          item.style.display = 'none';
        }
      }
    })
    })
  })
})();

/*=====  End of Filtro Categorias  ======*/

/*==========================================
=            checked categorias            =
==========================================*/

/* const btnCategoriasProductos = document.querySelectorAll('.categorias__items'),
  inpSearchCategorias = document.getElementById('search-item')

if ( btnCategoriasProductos ){
  btnCategoriasProductos.forEach(function(btn){
    btn.addEventListener('click', function(e){
      e.preventDefault()
      let hijoChequeado = Array.from(btn.parentElement.children).filter(el => el.className === 'categorias__items is-checked');
      hijoChequeado[0].classList.value = 'categorias__items'
      btn.classList.add('is-checked')
      document.querySelector('.categorias-content-admin').classList.toggle('active-categorias')
    })
  })
} */

/*=====  End of checked categorias  ======*/


$("#btnAgregarProducto").click(function(){

	$("#formNuevoProducto").toggle(100);

})

/*=============================================
Subir Imagen a través del Input
=============================================*/
$("#subirFoto").change(function(){
  imagen = this.files[0];

	//Validar tamaño de la imagen
	imagenSize = imagen.size;
  if(Number(imagenSize) > 2000000){
		$("#infoTamañoImagen").before('<div class="">El archivo excede el peso permitido, 200kb</div>')
	}else{
		$(".alerta").remove();
  }

  // Validar tipo de la imagen
	imagenType = imagen.type;
	if(imagenType == "image/jpeg" || imagenType == "image/png"){
		$(".alerta").remove();
	}
	else{
		$("#infoTamañoImagen").before('<div class="">El archivo debe ser formato JPG o PNG</div>')
  }

  /*=============================================
	Mostrar imagen con AJAX
	=============================================*/
	if(Number(imagenSize) < 2000000 && imagenType == "image/jpeg" || imagenType == "image/png"){
		var datos = new FormData();
		datos.append("imagen", imagen);
		$.ajax({
			url:"views/ajax/gestorProductos.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			/* beforeSend: function(){
					$("#infoTamañoImagen").before('<img src="views/imagenes/status.gif" id="status">');
			}, */
			success: function(respuesta){
        console.log(respuesta)
        $("#status").remove();
        if(respuesta == 0){
          $("#infoTamañoImagen").before('<div class="">La imagen es inferior a 188px * 188px</div>')
        }else{
          $("#arrastreImagenProducto").html('<img src="'+respuesta.slice(6)+'" class="img-thumbnail"><i class="fa fa-camera icon-camera"></i>');
        }
			}
		})
	}
})

/*=============================================
Editar Producto
=============================================*/

if ( btnContentEditarProducto ){
  btnContentEditarProducto.forEach( function(btn){
    btn.addEventListener('click', function(e){
      let base = e.target.parentElement.parentElement,
        idProducto = base.parentElement.id,
        rutaImagen = base.querySelector('img').src,
        titleProducto = base.querySelector('.product__title').textContent,
        medidaProducto = base.querySelector('.product__medida').textContent,
        precioViejoProducto = base.querySelector('.product__valor-anterior').textContent,
        precioActualProducto = base.querySelector('.product__valor-actual').textContent,
        promocionProducto = base.querySelector('#product__promocion').value,
        ciudadProducto = base.querySelector('#product__ciudad').value,
        categoriaProducto = base.querySelector('#product__categoria').value,
        templateEditarProducto = `
        <div class="form" id="formEditarProducto" style="display:flex">
        <div class="title">
          <h6 >Editar producto</h6>
        </div>
        <form method="post" enctype="multipart/form-data">
          <div class="content-subirFoto">
            <input type="file" name class="imagenProducto" id="cambiarFoto">
            <label for="cambiarFoto" class="input" id="cambiarImagenProducto">
              <img src="views${rutaImagen.split("views")[1]}" alt="">
              <i class="fa fa-camera icon-camera"></i>
            </label>
          </div>
          <div><input name="editartituloProducto" type="text" placeholder="Título..." class="formTitle" value="${titleProducto}" required></div>
          <div><input name="editarmedidaProducto" type="text" placeholder="Medida..." class="formMedida" value="${medidaProducto}" required></div>
          <div><input name="editarprecioProductoViejo" type="text" placeholder="Precio Viejo..." class="formPrecioViejo" value="${precioViejoProducto}"></div>
          <div><input name="editarprecioProductoActual" type="text" placeholder="Precio..." class="formPrecioActual" value="${precioActualProducto}" required></div>
          <div>
            <select class="selectProducto" type="text" name="editarpromocion">
              <option value="">promo...</option>
              <option ${promocionProducto == "oferta" ? 'selected' : ''} value="oferta">Oferta</option>
              <option ${promocionProducto == "nuevo" ? 'selected' : ''} value="nuevo">Nuevo</option>
            </select>
          </div>
          <div>
            <select class="selectProducto" type="text"  required name="editarciudad">
              <option >Ciudad...</option>
              <option ${ciudadProducto == "1" ? 'selected' : ''} value="1">Bucaramanga</option>
              <option ${ciudadProducto == "2" ? 'selected' : ''} value="2">Bogota</option>
            </select>
          </div>
          <div>
            <select class="selectProducto" type="text" required name="editarcategoria">
              <option value="${categoriaProducto}" >categoria</option>
              <option ${categoriaProducto == "1" ? 'selected' : ''} value="1">fruta</option>
              <option ${categoriaProducto == "2" ? 'selected' : ''} value="2">verduras</option>
              <option ${categoriaProducto == "3" ? 'selected' : ''} value="3">hortalizas</option>
              <option ${categoriaProducto == "4" ? 'selected' : ''} value="4">pulpas</option>
              <option ${categoriaProducto == "5" ? 'selected' : ''} value="5">emprendedores</option>
            </select>
          </div>
          <input name="editarproducto_id" type="hidden" value="${idProducto}">
          <input name="fotoAntigua" type="hidden" value="views${rutaImagen.split("views")[1]}">
          <div class="content-btnGuardarProduct">
            <input class="btnGuardarProducto" type="submit" id="updateProducto" value="Guardar" >
          </div>
        </form>
        <div id="infoTamañoImagen"></div>
      </div>
        `
      document.querySelector('.formEditContent').innerHTML = templateEditarProducto

      $("body, html").animate({
        scrollTop:$("body").offset().top
      }, 500)

      let btnCambiarFoto = document.querySelector('#cambiarFoto');

      if ( btnCambiarFoto ){
        btnCambiarFoto.addEventListener('click', function(e){
          console.log('probando')
          $("#cambiarFoto").attr("name", "editarImagen")
          $("#cambiarFoto").attr("required", true)

          btnCambiarFoto.addEventListener('change', function(){
            imagen = this.files[0];

            //Validar tamaño de la imagen
            imagenSize = imagen.size;
            if(Number(imagenSize) > 2000000){
              $("#infoTamañoImagen").before('<div class="">El archivo excede el peso permitido, 200kb</div>')
            }else{
              $(".alerta").remove();
            }

            // Validar tipo de la imagen
            imagenType = imagen.type;
            if(imagenType == "image/jpeg" || imagenType == "image/png"){
              $(".alerta").remove();
            }
            else{
              $("#infoTamañoImagen").before('<div class="">El archivo debe ser formato JPG o PNG</div>')
            }
            /*=============================================
            Mostrar imagen con AJAX
            =============================================*/
            if(Number(imagenSize) < 2000000 && imagenType == "image/jpeg" || imagenType == "image/png"){
              var datos = new FormData();
              datos.append("imagen", imagen);
              $.ajax({
                url:"views/ajax/gestorProductos.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success: function(respuesta){
                  console.log(respuesta)
                  $("#status").remove();
                  if(respuesta == 0){
                    $("#infoTamañoImagen").before('<div class="">La imagen es inferior a 188px * 188px</div>')
                  }else{
                    $("#cambiarImagenProducto").html('<img src="'+respuesta.slice(6)+'" class="img-thumbnail"><i class="fa fa-camera icon-camera"></i>');
                  }
                }
              })
            }
          })
        })
      }
    })
  })
}
//console.log('lucho')


const productContainer = document.querySelector('.product-container')
if ( productContainer ){
  btnEliminarProducto = productContainer.querySelectorAll('#btnEliminarProducto')
  btnEliminarProducto.forEach(function(btn){
    btn.addEventListener('click', function(e){
      e.preventDefault()
      confirm("deseas eliminar este producto")
      console.log(e.target)
    })
  })

}


console.log('kljdsflkdjfkj')

/* <div class="form" id="formEditarProducto" style="display:flex">
            <div class="title">
              <h6 >Editar producto</h6>
            </div>
            <form method="post" enctype="multipart/form-data">
              <div class="content-subirFoto">
                <input type="file" name class="imagenProducto" id="cambiarFoto">
                <label for="cambiarFoto" class="input" id="cambiarImagenProducto">
                  <img src="views${rutaImagen.split("views")[1]}" alt="">
                  <i class="fa fa-camera icon-camera"></i>
                </label>
              </div>
              <div><input name="editartituloProducto" type="text" placeholder="Título..." class="formTitle" value="${titleProducto}" required></div>
              <div><input name="editarmedidaProducto" type="text" placeholder="Medida..." class="formMedida" value="${medidaProducto}" required></div>
              <div><input name="editarprecioProductoViejo" type="text" placeholder="Precio Viejo..." class="formPrecioViejo" value="${precioViejoProducto}"></div>
              <div><input name="editarprecioProductoActual" type="text" placeholder="Precio..." class="formPrecioActual" value="${precioActualProducto}" required></div>
              <div>
                <select class="selectProducto" type="text" name="editarpromocion">
                  <option value="">promo...</option>
                  <option ${promocionProducto == "oferta" ? 'selected' : ''} value="oferta">Oferta</option>
                  <option ${promocionProducto == "nuevo" ? 'selected' : ''} value="nuevo">Nuevo</option>
                </select>
              </div>
              <div>
                <select class="selectProducto" type="text"  required name="editarciudad">
                  <option >Ciudad...</option>
                  <option ${ciudadProducto == "1" ? 'selected' : ''} value="1">Bucaramanga</option>
                  <option ${ciudadProducto == "2" ? 'selected' : ''} value="2">Bogota</option>
                </select>
              </div>
              <div>
                <select class="selectProducto" type="text" required name="editarcategoria">
                  <option value="${categoriaProducto}" >categoria</option>
                  <option ${categoriaProducto == "1" ? 'selected' : ''} value="1">fruta</option>
                  <option ${categoriaProducto == "2" ? 'selected' : ''} value="2">verduras</option>
                  <option ${categoriaProducto == "3" ? 'selected' : ''} value="3">hortalizas</option>
                  <option ${categoriaProducto == "4" ? 'selected' : ''} value="4">pulpas</option>
                  <option ${categoriaProducto == "5" ? 'selected' : ''} value="5">emprendedores</option>
                </select>
              </div>
              <input name="editarproducto_id" type="hidden" value="${idProducto}">
              <input name="fotoAntigua" type="hidden" value="views${rutaImagen.split("views")[1]}">
              <div class="content-btnGuardarProduct">
                <input class="btnGuardarProducto" type="submit" id="updateProducto" value="Guardar" >
              </div>
            </form>
            <div id="infoTamañoImagen"></div>
          </div> */



/* <div class="form" id="formEditarProducto" style="display:flex">
          <div class="title" style="font-size:2.5em">
            <h6 >Editar producto</h6>
          </div>
          <form method="post" enctype="multipart/form-data">
          <div class="" style="width: 100%">
        <div class="inpText-container" style="display:flex; justify-content:space-between; align-items:center">
          <div class="content-subirFoto">
            <input type="file" name class="imagenProducto" id="cambiarFoto">
            <label for="cambiarFoto" class="input" id="cambiarImagenProducto">
              <img src="views${rutaImagen.split("views")[1]}" alt="" style="width:48px; heigth: 48px">
              <i class="fa fa-camera icon-camera"></i>
            </label>
          </div>
          <div class="inpText-content">
            <label class="labelText" for="">Titulo</label>
            <input type="hidden" name="idProducto" value="${idProducto}">
            <input class="inpText" name="tituloProducto" value="${titleProducto}" type="text" placeholder="Título..." class="formTitle" required></div>
          <div class="inpText-content">
            <label class="labelText" for="">Medida</label>
            <select class="inpSelect" type="text" name="medidaProducto" required>
            <option ${medidaProducto == "und" ? 'selected' : ''} value="und">und</option>
            <option ${medidaProducto == "lb" ? 'selected' : ''} value="lb">lb</option>
            <option ${medidaProducto == "cabeza" ? 'selected' : ''} value="cabeza">cabeza</option>
            <option ${medidaProducto == "bandeja" ? 'selected' : ''} value="bandeja">bandeja</option>
            <option ${medidaProducto == "atado 500gr" ? 'selected' : ''} value="atado 500gr">atado 500gr</option>
            <option ${medidaProducto == "atado 200gr" ? 'selected' : ''} value="atado 200gr">atado 200gr</option>
            <option ${medidaProducto == "band 500gr" ? 'selected' : ''} value="band 500gr">band 500gr</option>
            <option ${medidaProducto == "band 350gr" ? 'selected' : ''} value="band 350gr">band 350gr</option>
            <option ${medidaProducto == "band x 4" ? 'selected' : ''} value="band x 4">band x 4</option>
            </select>
          </div>
        </div>
        <div class="inpText-container">
          <div class="inpText-content">
            <label class="labelText" for="">Precio Viejo</label>
            <input class="inpText price" name="precioProductoViejo" value="${precioViejoProducto}" type="text" placeholder="Precio Viejo..." class="formPrecioViejo">
          </div>
          <div class="inpText-content">
            <label class="labelText" for="">Precio</label>
            <input class="inpText price" name="precioProductoActual" value="${precioActualProducto}" type="text" placeholder="Precio..." class="formPrecioActual" required>
          </div>
          <div class="inpText-content">
            <label class="labelText" for="">Promocion</label>
            <select class="inpSelect" type="text" name="promocion">
              <option value="">promo...</option>
              <option ${promocionProducto == "oferta" ? 'selected' : ''} value="oferta">Oferta</option>
              <option ${promocionProducto == "nuevo" ? 'selected' : ''} value="nuevo">Nuevo</option>
            </select>
          </div>
          <div class="inpText-content">
            <label class="labelText" for="">Ciudad</label>
            <select class="inpSelect" type="text" required name="ciudad">
              <option value="">Ciudad...</option>
              <option ${ciudadProducto == "1" ? 'selected' : ''} value="1">Bucaramanga</option>
              <option ${ciudadProducto == "2" ? 'selected' : ''} value="2">Bogota</option>
            </select>
          </div>
          <div class="inpText-content">
            <label class="labelText" for="">Categoria</label>
            <select class="inpText" type="text" required name="categoria">
              <option value="">Categoria</option>
              <option ${categoriaProducto == "1" ? 'selected' : ''} value="1">fruta</option>
              <option ${categoriaProducto == "2" ? 'selected' : ''} value="2">verduras</option>
              <option ${categoriaProducto == "3" ? 'selected' : ''} value="3">hortalizas</option>
              <option ${categoriaProducto == "4" ? 'selected' : ''} value="4">pulpas</option>
              <option ${categoriaProducto == "5" ? 'selected' : ''} value="5">emprendedores</option>
            </select>
          </div>
        </div>
        <input name="editarproducto_id" type="hidden" value="${idProducto}">
        <input name="fotoAntigua" type="hidden" value="views${rutaImagen.split("views")[1]}">
        <div class="inpSubmit-content">
          <input class="inpSubmit" type="submit" id="guardarProducto" value="Guardar" >
        </div>
      </div>
    </form>
    <div id="infoTamañoImagen"></div>
  </div> */