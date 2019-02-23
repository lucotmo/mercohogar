<?php

require_once "conexion.php";

class GestorClientesModel{



	#VISUALIZAR PERFILES
	#------------------------------------------------------
	public function verClientesModel($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT id_cliente, celular, nombre, apellidos FROM $tabla");
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();

	}

	#ACTUALIZAR PERFIL
	#---------------------------------------------------
	public function editarPerfilModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET usuario = :usuario, photo = :photo, rol = :rol, id_ciudad = :id_ciudad, password = :password, email = :email WHERE perfil_id = :perfil_id");

		$stmt -> bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
		$stmt -> bindParam(":photo", $datosModel["photo"], PDO::PARAM_STR);
		$stmt -> bindParam(":rol", $datosModel["rol"], PDO::PARAM_INT);
		$stmt -> bindParam(":id_ciudad", $datosModel["id_ciudad"], PDO::PARAM_INT);
		$stmt -> bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
		$stmt -> bindParam(":email", $datosModel["correo"], PDO::PARAM_STR);
		$stmt -> bindParam(":perfil_id", $datosModel["perfil_id"], PDO::PARAM_INT);

		if($stmt->execute()){
			return "ok";
		}
		else{
			return "error";
		}
		$stmt->close();
	}

	#BORRAR PERFIL
	#-----------------------------------------------------
	public function borrarPerfilModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE perfil_id = :perfil_id");
		$stmt->bindParam(":perfil_id", $datosModel, PDO::PARAM_INT);
		if($stmt->execute()){
			return "ok";
		}
		else{
			return "error";
		}
		$stmt->close();
	}
}