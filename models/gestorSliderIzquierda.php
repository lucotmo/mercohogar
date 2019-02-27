<?php

require_once "backend/models/conexion.php";
class SlidersIzquierdaModels{
	public function seleccionarSliderIzquierdaModel($tabla){
    $sql = "SELECT *
    FROM slides_izquierda";

    $stmt = Conexion::conectar()->prepare($sql);
    $stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

}