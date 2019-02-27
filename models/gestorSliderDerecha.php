<?php

require_once "backend/models/conexion.php";
class SlidersDerechaModels{
	public function seleccionarSlidersDerechaModel($tabla){
    $sql = "SELECT *
    FROM slides_derecha";

    $stmt = Conexion::conectar()->prepare($sql);
    $stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

}