<?php

require_once "models/conexion.php";
class NuestrosClientesModels{
	public function seleccionarNuestrosClientesModel($tabla){
    $sql = "SELECT *
    FROM nuestros_clientes";

    $stmt = Conexion::conectar()->prepare($sql);
    $stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

}