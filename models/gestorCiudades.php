<?php

require_once "backend/models/conexion.php";
class CiudadesModels{
	public function seleccionarCiudadesModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT ciudad_id, nombre, domicilio FROM $tabla ORDER BY ciudad_id ASC");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();

	}

}