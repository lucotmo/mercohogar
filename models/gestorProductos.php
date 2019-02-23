<?php

require_once "backend/models/conexion.php";
class ProductosModels{
	public function seleccionarProductosModel($tabla, $tabla2){

    $stmt = Conexion::conectar()->prepare("SELECT producto_id, imagen, titulo, medida, precio_viejo, precio_actual, promocion, id_ciudad, id_categoria, $tabla2.nombre_categoria FROM $tabla INNER JOIN $tabla2 ON $tabla.id_categoria = $tabla2.categoria_id ORDER BY titulo ASC");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();

	}

}