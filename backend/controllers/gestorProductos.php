<?php

class GestorProductos{

  public function mostrarImagenController($datos){
    list($ancho, $alto) = getImagesize($datos);

    if ( $ancho < 188 || $alto < 188 ){
      echo 0;
    }else{
      $aleatorio = mt_rand(100, 999);
      $ruta = "../../views/imagenes/productos/temp/producto".$aleatorio.".jpg";
      if ( exif_imagetype($datos) == IMAGETYPE_PNG) {
        $origen = imagecreatefrompng($datos);
      }else{
        $origen = imagecreatefromjpeg($datos);
      }
			$destino = imagecrop($origen, ["x"=>($ancho - 188) / 2, "y"=>($alto - 188) / 2, "width"=>188, "height"=>188]);
			imagejpeg($destino, $ruta);

			echo $ruta;
    }
  }
  public function guardarProductoController(){

    if ( isset($_POST['tituloProducto']) ){
      $imagen = $_FILES["imagen"]["tmp_name"];
      $name = $_FILES["imagen"]["name"];
      $imagedetails = getimagesize($_FILES['imagen']['tmp_name']);
      $width = $imagedetails[0];
      $height = $imagedetails[1];
      $resultname = explode('.',$name);
      /* echo $height;
      echo $width;


      //list($ancho, $alto) = getImagesize($prueba);

      echo "<pre>";
      print_r($name);
      echo "</pre>"; */

      $borrar = glob("views/imagenes/productos/temp/*");
      foreach($borrar as $file){
				unlink($file);
      }
      $aleatorio = mt_rand(100, 999);
			//$ruta = "views/imagenes/productos/producto".$aleatorio.".jpg";
			$ruta = "views/imagenes/productos/".$resultname[0]."".$aleatorio.".jpg";
			$origen = imagecreatefromjpeg($imagen);
			$destino = imagecrop($origen, ["x"=>($width - 188) / 2, "y"=>($height - 188) / 2, "width"=>188, "height"=>188]);
      imagejpeg($destino, $ruta);
      $datosController = array("imagen"=>$ruta,
                             "titulo"=>$_POST["tituloProducto"],
				                     "medida"=>$_POST["medidaProducto"],
				                     "precio_viejo"=>$_POST["precioProductoViejo"],
				                     "precio_actual"=>$_POST["precioProductoActual"],
				                     "promocion"=>$_POST["promocion"],
				                     "id_ciudad"=>$_POST["ciudad"],
                             "id_categoria"=>$_POST["categoria"]);

      $respuesta = GestorProductosModel::guardarProductoModel($datosController, "producto");

      if ( $respuesta == 'ok' ){
        echo '<script>
					swal({
						  title: "¡OK!",
						  text: "¡El Producto ha sido creado correctamente!",
						  type: "success",
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
					},
					function(isConfirm){
							 if (isConfirm) {
							    window.location = "productos";
							  }
          });
				</script>';
      }else{
        echo $respuesta;
      }
    }
  }

  public function mostrarProductoController(){
    $respuesta = GestorProductosModel::mostrarProductoModel("producto", "categoria");
    foreach ($respuesta as $row => $item){
      echo '
        <div class="product-container '.$item["promocion"].' '.$item["nombre_categoria"].'" data-item="'.$item["titulo"].'" id="'.$item["producto_id"].'">
          <div class="product-content">
            <a class="product__img-'.$item["promocion"].'" href=""><img src="'.$item["imagen"].'" alt="'.$item["titulo"].'"></a>
            <span class="product__title">'.$item["titulo"].'</span>
            <span class="product__medida">'.$item["medida"].'</span>
            '; if ( $item["precio_viejo"] == 0 ){
              echo ' <div class="product__valor">
              <span class="product__valor-anterior" style="display:none">'.$item["precio_viejo"].'</span>
              <span class="product__valor-actual">'.$item["precio_actual"].'</span>
            </div>
            <input type="hidden" value="'.$item["promocion"].'" id="product__promocion">
            <input type="hidden" value="'.$item["id_ciudad"].'" id="product__ciudad">
            <input type="hidden" value="'.$item["id_categoria"].'" id="product__categoria">';
            }else {
              echo '<div class="product__valor">
                <span class="product__valor-anterior">'.$item["precio_viejo"].'</span>
                <span class="product__valor-actual">'.$item["precio_actual"].'</span>
              </div>
              <input type="hidden" value="'.$item["promocion"].'" id="product__promocion">
              <input type="hidden" value="'.$item["id_ciudad"].'" id="product__ciudad">
              <input type="hidden" value="'.$item["id_categoria"].'" id="product__categoria">';
            }
           echo '
            <div>
              <a class="fa fa-edit btnEditarProducto" id="btnEditarProducto"></a>
              <a href="index.php?action=productos&idBorrar='.$item["producto_id"].'&rutaImagen='.$item["imagen"].'" class="fa fa-trash btnEliminarProducto" id="btnEliminarProducto"></a>
            </div>

          </div>
        </div>';


		}
  }

  # BORRAR PRODUCTO
  #-----------------------------------------------
  public function borrarProductoController(){
    if ( isset($_GET['idBorrar']) ){
      unlink($_GET["rutaImagen"]);
      $datosController = $_GET['idBorrar'];

      $respuesta = GestorProductosModel::borrarProductoModel($datosController, "producto");

      if ( $respuesta == 'ok' ){
        echo '<script>
					swal({
						  title: "¡OK!",
						  text: "¡El Producto ha sido borrado correctamente!",
						  type: "success",
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
					},
					function(isConfirm){
							 if (isConfirm) {
							    window.location = "productos";
							  }
          });
				</script>';
      }else{
        echo $respuesta;
      }
    }
  }
  # EDITAR PRODUCTO
  #-----------------------------------------------
  public function editarProductoController(){
    $ruta = "views/imagenes/producto.jpg";
    if ( isset($_POST["editartituloProducto"]) ){
      if ( isset($_FILES["editarImagen"]["tmp_name"]) ){
        $imagen = $_FILES["editarImagen"]["tmp_name"];
        $imagedetails = getimagesize($_FILES['editarImagen']['tmp_name']);
        $width = $imagedetails[0];
        $height = $imagedetails[1];
        $name = $_FILES["editarImagen"]["name"];
        $resultname = explode('.',$name);
        $aleatorio = mt_rand(100, 999);
        $ruta = "views/imagenes/productos/".$resultname[0]."".$aleatorio.".jpg";
				$origen = imagecreatefromjpeg($imagen);
				$destino = imagecrop($origen, ["x"=>($width - 188) / 2, "y"=>($height - 188) / 2, "width"=>188, "height"=>188]);
				imagejpeg($destino, $ruta);
				//Imagedestroy($destino, $ruta);
				$borrar = glob("views/imagenes/productos/temp/*");
				foreach($borrar as $file){
					unlink($file);
				}
      }
      if ( $ruta == "views/imagenes/producto.jpg" ){
        $ruta = $_POST["fotoAntigua"];
      }else{
				unlink($_POST["fotoAntigua"]);
      }

      $datosController = array("producto_id"=>$_POST["editarproducto_id"],
                             "imagen"=>$ruta,
                             "titulo"=>$_POST["editartituloProducto"],
				                     "medida"=>$_POST["editarmedidaProducto"],
				                     "precio_viejo"=>$_POST["editarprecioProductoViejo"],
				                     "precio_actual"=>$_POST["editarprecioProductoActual"],
				                     "promocion"=>$_POST["editarpromocion"],
				                     "id_ciudad"=>$_POST["editarciudad"],
                             "id_categoria"=>$_POST["editarcategoria"]);

      $respuesta = GestorProductosModel::editarProductoModel($datosController, "producto");

      if ( $respuesta == 'ok' ){
        echo '<script>
					swal({
						  title: "¡OK!",
						  text: "¡El Producto ha sido actualizado correctamente!",
						  type: "success",
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
					},
					function(isConfirm){
							 if (isConfirm) {
							    window.location = "productos";
							  }
          });
				</script>';
      }else{
        echo $respuesta;
      }
    }
  }

  # FILTRAR PRODUCTO
  #-----------------------------------------------
  public function filtrarProductoController(){
    if ( isset($_GET['filtar']) ){
      $datosController = $_GET['filtar'];
      $respuesta = GestorProductosModel::filtarProductoModel($datosController, "producto");
    }
  }
}