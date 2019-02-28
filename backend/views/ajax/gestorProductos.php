<?php

require_once "../../controllers/gestorProductos.php";
require_once "../../models/conexion.php";

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
}

#OBJETOS
#-----------------------------------------------------------

if(isset($_FILES["imagen"]["tmp_name"])){

	$a = new Ajax();
	$a -> imagenTemporal = $_FILES["imagen"]["tmp_name"];
	$a -> gestorProductosAjax();

}

#PAGAR RESULTADOS OBTENIDOS A LOS AFILIADOS.
#------------------------------------------------------------

if(isset( $_POST['p'] ) ) {
	$array = explode(',', $_POST['p']);
	$count =  count($array);
	$item= 0;
	for ($i=0; $i<$count; $i++) {
		$stmt = Conexion::conectar()->prepare("UPDATE pedido SET pago = true, fecha_pago = now() WHERE id =:id");
		$stmt -> bindParam(":id", $array[$i], PDO::PARAM_INT);
		if($stmt->execute()){
			$item++;
		}
		//$stmt->close();
	}

	if($count == $item) {
		echo  true;
	} else{
		echo false;
	}
}