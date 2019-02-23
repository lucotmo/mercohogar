<?php

require_once "../../controllers/gestorProductos.php";
//require_once "../../models/gestorProductos.php";

#CLASE Y MÉTODOS
#-------------------------------------------------------------
class Ajax{
	#SUBIR LA IMAGEN DEL ARTICULO
	#----------------------------------------------------------
	public $imagenTemporal;
	public function gestorProductosAjax(){
		$datos = $this->imagenTemporal;
		$respuesta = GestorProductos::mostrarImagenController($datos);
		echo $respuesta;
		//echo $datos;
  }

	#ACTUALIZAR ORDEN
	#---------------------------------------------
	/* public $actualizarOrdenArticulos;
	public $actualizarOrdenItem;
	public function actualizarOrdenAjax(){
		$datos = array("ordenArticulos" => $this->actualizarOrdenArticulos,
			           "ordenItem" => $this->actualizarOrdenItem);
		$respuesta = GestorArticulos::actualizarOrdenController($datos);
		echo $respuesta;
	} */
}

#OBJETOS
#-----------------------------------------------------------

if(isset($_FILES["imagen"]["tmp_name"])){

	$a = new Ajax();
	$a -> imagenTemporal = $_FILES["imagen"]["tmp_name"];
	$a -> gestorProductosAjax();

}

/* if(isset($_POST["actualizarOrdenArticulos"])){

	$b = new Ajax();
	$b -> actualizarOrdenArticulos = $_POST["actualizarOrdenArticulos"];
	$b -> actualizarOrdenItem = $_POST["actualizarOrdenItem"];
	$b -> actualizarOrdenAjax();

} */