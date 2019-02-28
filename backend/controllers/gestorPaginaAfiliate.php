<?php

class Afiliate{
	public function PortadaAfiliateController(){
    $respuesta = AfiliateModels::mostrarPortadaAfiliateModel("afiliate_portada");
    //$respuesta2 = ComoPedirModels::seleccionarDosComoPedirModel("como_pedir", "pasos");
		foreach ($respuesta as $row => $item){
      echo '
      <div class="containerAccionesPaginaAfiliate">
        <a class="fa fa-edit btnEditarProducto" data-id="'.$item["id"].'" id="btnEditarProducto"></a>
        <a href="#" class="fa fa-trash btnEliminarProducto" id="btnEliminarProducto"></a>
      </div>
      <img src="'.$item['imagen'].'" alt="" class="afilitate__img">
      <div class="presentacion-content">
        <h6 class="presentacion__title">'.$item['titulo'].'</h6>
        <p class="presentacion__subtitle">'.$item['subtitulo'].'</p>
      </div>';
    }

  }
  public function mostrarContenidoAfiliateController(){
    $respuesta = AfiliateModels::mostrarContenidoAfiliateModel("afiliate_contenido");
    //$respuesta2 = ComoPedirModels::seleccionarDosComoPedirModel("como_pedir", "pasos");
		foreach ($respuesta as $row => $item){
      echo '
      <div class="containerAccionesPaginaAfiliate">
        <a class="fa fa-edit btnEditarProducto" data-id="'.$item["id"].'" id="btnEditarProducto"></a>
        <a href="#" class="fa fa-trash btnEliminarProducto" id="btnEliminarProducto"></a>
      </div>
      <div class="afiliate__info-video">
        <div class="video-responsive">
          <iframe src="'.$item['video'].'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen ></iframe>
        </div>
      </div>
      <div class="afilitate-info__content">
        <h1 class="afilitate-title">'.$item['titulo'].'</h1>
        <p class="afilitate-info__parrafo">'.$item['contenido'].'</p>
      </div>
      ';
    }

  }
  public function mostrarPreguntasAfiliateController(){
    $respuesta = AfiliateModels::mostrarPreguntasAfiliateModel("afiliate_preguntas");
    $respuesta2 = AfiliateModels::mostrarPreguntasSubtitulosAfiliateModel("afiliate_preguntas_subtitulos");
    //$respuesta2 = ComoPedirModels::seleccionarDosComoPedirModel("como_pedir", "pasos");
		foreach ($respuesta as $row => $item){
      echo '
      <div class="containerAccionesPaginaAfiliate">
        <a class="fa fa-edit btnEditarProducto" data-id="'.$item["id"].'" id="btnEditarProducto"></a>
        <a href="#" class="fa fa-trash btnEliminarProducto" id="btnEliminarProducto"></a>
      </div>
      <h5>'.$item['titulo'].'</h5>';
      foreach ($respuesta2 as $row => $item2){
        echo '
        <div class="contentPreguntas"
          <h6>'.$item2['subtitulo'].'</h6>
          <p>'.$item2['contenido'].'</p>
        <div>';
      }
    }

  }
  public function mostrarBeneficiosAfiliateController(){
    $respuesta = AfiliateModels::mostrarBeneficiosAfiliateModel("afiliate_beneficios");
    $respuesta2 = AfiliateModels::mostrarBeneficiosSubtitulosAfiliateModel("afiliate_beneficios_subtitulos");
    //$respuesta2 = ComoPedirModels::seleccionarDosComoPedirModel("como_pedir", "pasos");
		foreach ($respuesta as $row => $item){
      echo '
      <div class="containerAccionesPaginaAfiliate">
        <a class="fa fa-edit btnEditarProducto" data-id="'.$item["id"].'" id="btnEditarProducto"></a>
        <a href="#" class="fa fa-trash btnEliminarProducto" id="btnEliminarProducto"></a>
      </div>
      <h5>'.$item['titulo'].'</h5>';
      foreach ($respuesta2 as $row => $item2){
        echo '
        <div class="contentPreguntasSubtitle"
          <h6>'.$item2['subtitulo'].'</h6>
          <p>'.$item2['contenido'].'</p>
        <div>';

      }
    }

	}

}