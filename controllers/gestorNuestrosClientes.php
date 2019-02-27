<?php

class NuestrosClientes{
	public function seleccionarNuestrosClientesController(){
    $respuesta = NuestrosClientesModels::seleccionarNuestrosClientesModel("nuestros_clientes");
		foreach ($respuesta as $row => $item){
      echo '
      <div class="nuestros-clientes-container">
        <div class="nuestros-clientes-content">
          <h6 class="clientes__title">'.$item['titulo'].'</h6>
          <p class="nuestros__parrafo">'.$item['contenido'].'</p>
        </div>
        <div class="nuestros-clientes-video">
          <a href="baackend/'.$item['video'].'" class="modal-vimeo">
            <img src="backend/'.$item['imagen'].'" alt="">
            <i class="fa fa-play-circle"></i>
          </a>
        </div>
      </div>';
		}

	}

}