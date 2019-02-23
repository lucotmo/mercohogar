<?php

class Enlaces{
	public function enlacesController(){

    $rutas = array();
    if ( isset($_GET["action"]) ){
      $rutas = explode("/", $_GET["action"]);
      $enlaces = $rutas[0];
    }else{
      $enlaces = "index";
    }

		$respuesta = EnlacesModels::enlacesModel($enlaces);
		include $respuesta;
	}
}