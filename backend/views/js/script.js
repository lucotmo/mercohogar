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
                  <option value="${promocionProducto}" >promo...</option>
                  <option value="oferta">Oferta</option>
                  <option value="nuevo">Nuevo</option>
                  <option value="" >Ninguno</option>
                </select>
              </div>
              <div>
                <select class="selectProducto" type="text"  required name="editarciudad">
                  <option value="${ciudadProducto}" >Ciudad...</option>
                  <option value="1">Bucaramanga</option>
                  <option value="2">Bogota</option>
                </select>
              </div>
              <div>
                <select class="selectProducto" type="text" required name="editarcategoria">
                  <option value="${categoriaProducto}" >categoria</option>
                  <option value="1">fruta</option>
                  <option value="2">verduras</option>
                  <option value="3">hortalizas</option>
                  <option value="4">pulpas</option>
                  <option value="5">emprendedores</option>
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