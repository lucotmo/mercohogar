<?php

class ComoPedir{
	public function seleccionarComoPedirController(){
    $respuesta = ComoPedirModels::seleccionarComoPedirModel("como_pedir", "pasos");
		foreach ($respuesta as $row => $item){
      echo '
      <div class="pedir-content">
      <div class="pedir__video-container">
        <div class="pedir__title-content">
          <h1 class="pedir__title">'.$item['titulo'].'</h1>
        </div>
        <div class="pedir__video">
          <div class="video-responsive">
            <iframe src="'.$item['video'].'" frameborder="0" allowfullscreen="allowfullscreen" ></iframe>
          </div>
        </div>
      </div>
      <div class="pedir__pasos-content">
        <div class="pedir__pasos__title-content">
          <h6 class="pedir__pasos__title">Pasos</h6>
        </div>
      <div class="pedir__pasos__parrafo-container">';
      foreach ( $respuesta as $row => $item ){
        echo '<div class="pedir__pasos__parrafo-content">
          <h6 class="pedir__pasos__number">'.$item['numero_paso'].'</h6>
          <p class="pedir__pasos__parrafo">'.$item['contenido_paso'].'</p>
        </div>';
      }
      echo '</div>
        </div>
      </div>';
		}

	}

}