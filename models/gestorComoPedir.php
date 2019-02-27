<?php

require_once "backend/models/conexion.php";
class ComoPedirModels{
	public function seleccionarComoPedirModel($tabla, $tabla2){
    $sql = "SELECT cp.id, cp.titulo, cp.video,
    p.id_pasos, p.contenido_paso
    FROM $tabla as cp
    LEFT JOIN $tabla2 as p ON cp.id = p.id_como_pedir";

    $stmt = Conexion::conectar()->prepare($sql);
    $stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

}