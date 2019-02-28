<?php

require_once "models/conexion.php";
class AfiliateModels{
	public function mostrarPortadaAfiliateModel($tabla){

    $sql = "SELECT *
    FROM $tabla";

    $stmt = Conexion::conectar()->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
		$stmt->close();
  }
  public function mostrarContenidoAfiliateModel($tabla){

    $sql = "SELECT *
    FROM $tabla";

    $stmt = Conexion::conectar()->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
		$stmt->close();
  }
  public function mostrarPreguntasAfiliateModel($tabla){

    $sql = "SELECT *
    FROM $tabla";

    $stmt = Conexion::conectar()->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
		$stmt->close();
  }
  public function mostrarPreguntasSubtitulosAfiliateModel($tabla){

    $sql = "SELECT *
    FROM $tabla";

    $stmt = Conexion::conectar()->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
		$stmt->close();
  }
  public function mostrarBeneficiosAfiliateModel($tabla){

    $sql = "SELECT *
    FROM $tabla";

    $stmt = Conexion::conectar()->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
		$stmt->close();
  }
  public function mostrarBeneficiosSubtitulosAfiliateModel($tabla){

    $sql = "SELECT *
    FROM $tabla";

    $stmt = Conexion::conectar()->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
		$stmt->close();
  }
}