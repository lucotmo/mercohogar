<?php

require_once "conexion.php";

class GestorAfiliadosModel{

  //id	celular	nombre	apellidos	ciudad	barrio	direccion	tipo_doc	documento	cuenta_bancaria	banco	tipo_cuenta	correo	contraseña	id_cliente	comision	pedidos

	#GUARDAR PERFIL
	#------------------------------------------------------------
	public function guardarAfiliadoModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla ( celular ,nombre ,apellidos ,password ) VALUES ( :celular ,:nombre ,:apellidos ,:password )");

		$stmt -> bindParam(":celular", $datosModel["celular"], PDO::PARAM_STR);
		$stmt -> bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":apellidos", $datosModel["apellidos"], PDO::PARAM_STR);
		$stmt -> bindParam(":password", $datosModel["password"], PDO::PARAM_STR);

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
	public function verAfiliadosModel($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT id, celular, nombre, apellidos FROM $tabla");
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();

	}

	#ACTUALIZAR PERFIL
	#---------------------------------------------------
	/* public function editarPerfilModel($datosModel, $tabla){
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
	} */

	#BORRAR PERFIL
	#-----------------------------------------------------
	public function borrarAfiliadoModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);
		if($stmt->execute()){
			return "ok";
		}
		else{
			return "error";
		}
		$stmt->close();
	}
}