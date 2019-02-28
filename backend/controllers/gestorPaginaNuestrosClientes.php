<?php

class NuestrosClientes{
	public function seleccionarNuestrosClientesController(){
    $respuesta = NuestrosClientesModels::seleccionarNuestrosClientesModel("nuestros_clientes");
		foreach ($respuesta as $row => $item){
      echo '
      <div class="containerPaginaCliente">
        <div class="containerAccionesPaginaCliente">
          <a class="fa fa-edit btnEditarProducto" data-id="'.$item["id"].'" id="btnEditarNuestrosClientes"></a>
          <a href="#" class="fa fa-trash btnEliminarProducto" id="btnEliminarProducto"></a>
        </div>
        <div class="videoPaginaCliente-content">
          <div class="video-responsive">
          <iframe src="'.$item['video'].'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen ></iframe>
          </div>
        </div>
        <div class="containerTituloContenidoPaginaCliente">
          <div class="tituloPaginaCliente-content">
            <h6 class="tituloPaginaCliente">'.$item['titulo'].'</h6>
          </div>
          <div class="contenidoPaginaCliente-content">
            <p class="contenidoPaginaCliente">'.$item['contenido'].'</p>
          </div>
        </div>

      </div>';
		}

	}

}