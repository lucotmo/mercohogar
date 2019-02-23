<?php

require_once "backend/models/conexion.php";
class CategoriasModels{
	public function seleccionarCategoriasModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT categoria_id, nombre_categoria FROM $tabla ORDER BY categoria_id ASC");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();

	}

}