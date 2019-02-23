<?php

require_once "models/conexion.php";
class CategoriasModels{
	public function seleccionarCategoriasModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT categoria_id, nombre_categoria, comision FROM $tabla ORDER BY categoria_id ASC");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();

  }
  public function guardarCategoriasModel($datosModel, $tabla){
    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre_categoria, comision)
      VALUES( :nombre_categoria, :comision )");

    $stmt -> bindParam(":nombre_categoria", $datosModel["nombre_categoria"], PDO::PARAM_STR);
    $stmt -> bindParam(":comision", $datosModel["comision"], PDO::PARAM_STR);

    if($stmt->execute()){
			return "ok";
		}
		else{
			return "error";
		}
		$stmt->close();

  }

  public function borrarCategoriasModel($datosModel, $tabla){
    $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE categoria_id = :categoria_id");
    $stmt->bindParam(":categoria_id", $datosModel, PDO::PARAM_INT);
    if($stmt->execute()){
			return "ok";
		}
		else{
			return "error";
		}
		$stmt->close();
  }
  public function editarCategoriasModel($datosModel, $tabla){
    $stmt = Conexion::conectar()->prepare("UPDATE $tabla
      SET nombre_categoria = :nombre_categoria, comision = :comision
      WHERE categoria_id = :categoria_id");

    $stmt -> bindParam(":nombre_categoria", $datosModel["nombre_categoria"], PDO::PARAM_STR);
    $stmt -> bindParam(":comision", $datosModel["comision"], PDO::PARAM_STR);
    $stmt -> bindParam(":categoria_id", $datosModel["categoria_id"], PDO::PARAM_STR);

    if($stmt->execute()){
			return "ok";
		}
		else{
			return "error";
		}
		$stmt->close();
  }

}




