<?php
require_once "../backend/models/conexion.php";
class IngresoModels{
	public function ingresoModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE celular = :celular");
		$stmt -> bindParam(":celular", $datosModel["celular"], PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetch();
		$stmt -> close();
	}
	public function intentosModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET intentos = :intentos WHERE celular = :celular");
		$stmt -> bindParam(":intentos", $datosModel["actualizarIntentos"], PDO::PARAM_INT);
		$stmt -> bindParam(":celular", $datosModel["celularActual"], PDO::PARAM_STR);
		if($stmt -> execute()){
			return "ok";
		}
		else{
			return "error";
		}
	}
}