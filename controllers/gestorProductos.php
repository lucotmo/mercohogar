<?php

class Productos{
	public function seleccionarProductosController(){
    $respuesta = ProductosModels::seleccionarProductosModel("producto", "categoria");
		foreach ($respuesta as $row => $item){
      /* if ( $item["producto_id"] % 10 == 0){

        echo '
        <div class="product-container '.$item["promocion"].' '.$item["nombre_categoria"].'" data-item="'.$item["titulo"].'">
          <div class="product-content">
            <a class="product__img-'.$item["promocion"].'" href=""><img src="./views/imagenes/'.$item["imagen"].'" alt="'.$item["titulo"].'"></a>
            <span class="product__title">'.$item["titulo"].'</span>
            <span class="product__medida">'.$item["medida"].'</span>
            '; if ( $item["precio_viejo"] == 0 ){
              echo ' <div class="product__valor">
              <span class="product__valor-actual">'.$item["precio_actual"].'</span>
            </div> ';
            }else {
              echo '<div class="product__valor">
                <span class="product__valor-anterior">'.$item["precio_viejo"].'</span>
                <span class="product__valor-actual">'.$item["precio_actual"].'</span>
              </div>';
            }
            echo '<div class="product__cantidad">
              <div class="form-cantidad" name="busqueda" action="" method="get">
                <a type="submit" class="icon-l fa fa-minus"></a>
                <input class="cantidad" id="'.$item["producto_id"].'" type="text" size="1" name="busqueda" value="'.$item["cantidad"].'">
                <a type="submit" class="icon-r fa fa-plus"></a>
            </div>
            </div>
            <div class="promos">
              <span class="product__'.$item["promocion"].'">'.$item["promocion"].'</span>'; if ( $item["precio_viejo"] == 0 ){
                echo '';
              }else if ( $item["promocion"] == 'nuevo' ){
                echo '';
              }else {
                echo '<span class="product__desc-'.$item["promocion"].'">'.ceil((($item["precio_viejo"] - $item["precio_actual"]) / $item["precio_viejo"]) * 100) .'</span>';
              }

          echo '</div>
          </div>
        </div>';



        echo '
        <div class="product-container" data-item="">
          <div class="product-content">

            <span class="product__title">Promociones</span>';
          echo '</div>
          </div>
        </div>';
      }else {
         echo '
        <div class="product-container '.$item["promocion"].' '.$item["nombre_categoria"].'" data-item="'.$item["titulo"].'">
          <div class="product-content">
            <a class="product__img-'.$item["promocion"].'" href=""><img src="./views/imagenes/'.$item["imagen"].'" alt="'.$item["titulo"].'"></a>
            <span class="product__title">'.$item["titulo"].'</span>
            <span class="product__medida">'.$item["medida"].'</span>
            '; if ( $item["precio_viejo"] == 0 ){
              echo ' <div class="product__valor">
              <span class="product__valor-actual">'.$item["precio_actual"].'</span>
            </div> ';
            }else {
              echo '<div class="product__valor">
                <span class="product__valor-anterior">'.$item["precio_viejo"].'</span>
                <span class="product__valor-actual">'.$item["precio_actual"].'</span>
              </div>';
            }
            echo '<div class="product__cantidad">
              <div class="form-cantidad" name="busqueda" action="" method="get">
                <a type="submit" class="icon-l fa fa-minus"></a>
                <input class="cantidad" id="'.$item["producto_id"].'" type="text" size="1" name="busqueda" value="'.$item["cantidad"].'">
                <a type="submit" class="icon-r fa fa-plus"></a>
            </div>
            </div>
            <div class="promos">
              <span class="product__'.$item["promocion"].'">'.$item["promocion"].'</span>'; if ( $item["precio_viejo"] == 0 ){
                echo '';
              }else if ( $item["promocion"] == 'nuevo' ){
                echo '';
              }else {
                echo '<span class="product__desc-'.$item["promocion"].'">'.ceil((($item["precio_viejo"] - $item["precio_actual"]) / $item["precio_viejo"]) * 100) .'</span>';
              }

          echo '</div>
          </div>
        </div>';
      }; */
      echo '
        <div class="product-container '.$item["promocion"].' '.$item["nombre_categoria"].'" data-item="'.$item["titulo"].'">
          <div class="product-content">
            <a class="product__img-'.$item["promocion"].'" href=""><img src="./backend/'.$item["imagen"].'" alt="'.$item["titulo"].'"></a>
            <span class="product__title">'.$item["titulo"].'</span>
            <span class="product__medida">'.$item["medida"].'</span>
            '; if ( $item["precio_viejo"] == 0 ){
              echo ' <div class="product__valor">
              <span class="product__valor-actual">'.$item["precio_actual"].'</span>
            </div> ';
            }else {
              echo '<div class="product__valor">
                <span class="product__valor-anterior">'.$item["precio_viejo"].'</span>
                <span class="product__valor-actual">'.$item["precio_actual"].'</span>
              </div>';
            }
            echo '<div class="product__cantidad">
              <div class="form-cantidad" name="busqueda" action="" method="get">
                <a type="submit" class="icon-l fa fa-minus"></a>
                <input class="cantidad" id="'.$item["producto_id"].'" type="text" size="1" name="busqueda" value="0">
                <a type="submit" class="icon-r fa fa-plus"></a>
            </div>
            </div>
            <div class="promos">
              <span class="product__'.$item["promocion"].'">'.$item["promocion"].'</span>'; if ( $item["precio_viejo"] == 0 ){
                echo '';
              }else if ( $item["promocion"] == 'nuevo' ){
                echo '';
              }else {
                echo '<span class="product__desc-'.$item["promocion"].'">'.ceil((($item["precio_viejo"] - $item["precio_actual"]) / $item["precio_viejo"]) * 100) .'</span>';
              }

          echo '</div>
          </div>
        </div>';
		}

	}

}