<?php

require_once "conexion.php";

class GestorPerfilesModel{

	#GUARDAR PERFIL
	#------------------------------------------------------------
	public function guardarPerfilModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla ( usuario, photo, rol, id_ciudad, password, email ) VALUES (:usuario, :photo, :rol, :id_ciudad, :password, :email)");

		$stmt -> bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
		$stmt -> bindParam(":photo", $datosModel["photo"], PDO::PARAM_STR);
		$stmt -> bindParam(":rol", $datosModel["rol"], PDO::PARAM_INT);
		$stmt -> bindParam(":id_ciudad", $datosModel["id_ciudad"], PDO::PARAM_STR);
		$stmt -> bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
    $stmt -> bindParam(":email", $datosModel["correo"], PDO::PARAM_STR);




		if($stmt->execute()){
			return "ok";
		}
		else{
			return "error";
		}
		$stmt->close();
	}

	#VISUALIZAR PERFILES
	#------------------------------------------------------
	public function verPerfilesModel($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT perfil_id, usuario, photo, rol, id_ciudad, password, email FROM $tabla");
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();

	}

	#ACTUALIZAR PERFIL
	#---------------------------------------------------
	public function editarPerfilModel($datosModel, $tabla){
		$query = "UPDATE $tabla SET usuario = :usuario,
				rol = :rol, id_ciudad = :id_ciudad, 
				email = :email 
				WHERE perfil_id = :perfil_id";
		
		if( !is_null($datosModel["password"]) && !is_null($datosModel["photo"]) ) {
			$query="UPDATE $tabla SET usuario = :usuario,
			photo = :photo, rol = :rol, id_ciudad = :id_ciudad,
			password = :password, email = :email
			WHERE perfil_id = :perfil_id";
		} else if( !is_null($datosModel["password"])  ) {
			$query="UPDATE $tabla SET usuario = :usuario,
			rol = :rol, id_ciudad = :id_ciudad,
			password = :password, email = :email
			WHERE perfil_id = :perfil_id";
		} else if( !is_null($datosModel["photo"])  ) {
			$query="UPDATE $tabla SET usuario = :usuario,
			photo = :photo, rol = :rol, id_ciudad = :id_ciudad,
			email = :email
			WHERE perfil_id = :perfil_id";
		}
		
		$stmt = Conexion::conectar()->prepare($query);
		$stmt -> bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
		$stmt -> bindParam(":rol", $datosModel["rol"], PDO::PARAM_INT);
		$stmt -> bindParam(":id_ciudad", $datosModel["id_ciudad"], PDO::PARAM_INT);
		
		if( !is_null($datosModel["password"]) && !is_null($datosModel["photo"])  ) {
			$stmt -> bindParam(":photo", $datosModel["photo"], PDO::PARAM_STR);
			$stmt -> bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
		} else if ( !is_null($datosModel["password"])  ) {
			$stmt -> bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
		} else if ( !is_null($datosModel["photo"])  ) {
			$stmt -> bindParam(":photo", $datosModel["photo"], PDO::PARAM_STR);
		}
		
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