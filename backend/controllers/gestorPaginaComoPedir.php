<?php

class ComoPedir{
	public function seleccionarComoPedirController(){
    $respuesta = ComoPedirModels::seleccionarComoPedirModel("como_pedir", "pasos");
    $respuesta2 = ComoPedirModels::seleccionarDosComoPedirModel("como_pedir", "pasos");

		foreach ($respuesta as $row => $item){
      echo '
      <div class="pedir-content" data-id="'.$item['id'].'">
        <div class="containerAccionesPaginaAfiliate">
          <a class="fa fa-edit btnEditarProducto" data-id="'.$item["id"].'" id="btnEditarProducto"></a>
          <a href="#" class="fa fa-trash btnEliminarProducto" id="btnEliminarProducto"></a>
        </div>
        <div class="pedir__video-container">
          <div class="pedir__video">
            <div class="video-responsive">
              <iframe src="'.$item['video'].'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen ></iframe>
            </div>
          </div>
        </div>
        <div class="pedir__title-content">
          <h1 class="pedir__title">'.$item['titulo'].'</h1>
        </div>

        <div class="pedir__pasos-content">
          <div class="pedir__pasos__title-content">
            <h6 class="pedir__pasos__title">Pasos</h6>
          </div>
          <div class="pedir__pasos__parrafo-container">';
      foreach ( $respuesta2 as $row => $item2 ){
        echo '
        <div class="pedir__pasos__parrafo-content">
          <h6 class="pedir__pasos__number">'.$item2['numero_paso'].'</h6>
          <p class="pedir__pasos__parrafo">'.$item2['contenido_paso'].'</p>
        </div>';
      }
      echo '</div>
        </div>
      </div>';
    }

	}

}