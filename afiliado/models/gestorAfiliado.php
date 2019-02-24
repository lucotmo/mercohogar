<?php 

require_once "../backend/models/conexion.php";

class GestorAfiliadosModel{
	public function updateAfiliado($data){
		$update="UPDATE afiliado SET
				celular = :celular,
				nombre = :nombre,
				apellidos = :apellidos,
				ciudad = :ciudad,
				barrio = :barrio,
				direccion = :direccion,
				tipo_doc=:tipo_doc,
				documento=:documento,
				cuenta_bancaria=:cuenta_bancaria,
				banco=:banco,
				tipo_cuenta=:tipo_cuenta,
				correo=:correo
	 			WHERE id = :id";
		
		if( !empty($data['password']) && !empty($data['password2']) ) {
			$update="UPDATE afiliado SET
				celular = :celular,
				nombre = :nombre,
				apellidos = :apellidos,
				ciudad = :ciudad,
				barrio = :barrio,
				direccion = :direccion,
				tipo_doc=:tipo_doc,
				documento=:documento,
				cuenta_bancaria=:cuenta_bancaria,
				banco=:banco,
				tipo_cuenta=:tipo_cuenta,
				correo=:correo,
				password=:password
	 			WHERE id = :id";
		}
		
		$stmt = Conexion::conectar()->prepare($update);
		
		$stmt -> bindParam(":celular", $data["celular"], PDO::PARAM_STR);
		$stmt -> bindParam(":nombre", $data["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":apellidos", $data["apellidos"], PDO::PARAM_STR);
		$stmt -> bindParam(":ciudad", $data["ciudad"], PDO::PARAM_INT);
		$stmt -> bindParam(":barrio", $data["barrio"], PDO::PARAM_STR);
		$stmt -> bindParam(":direccion", $data["direccion"], PDO::PARAM_STR);
		$stmt -> bindParam(":tipo_doc", $data["tipoDoc"], PDO::PARAM_INT);
		$stmt -> bindParam(":documento", $data["documento"], PDO::PARAM_STR);
		$stmt -> bindParam(":cuenta_bancaria", $data["cuenta_bancaria"], PDO::PARAM_STR);
		$stmt -> bindParam(":banco", $data["banco"], PDO::PARAM_INT);
		$stmt -> bindParam(":tipo_cuenta", $data["tipo_de_cuenta"], PDO::PARAM_INT);
		$stmt -> bindParam(":correo", $data["correo"], PDO::PARAM_STR);
		
		$encriptar =  null;
		if(!empty($data['password']) && !empty($data['password2']) ) {
			$encriptar = crypt($data["password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
			$stmt -> bindParam(":password", $encriptar, PDO::PARAM_STR);
		}
		
		
		
		$stmt->bindParam(":id", $data["id_usario"], PDO::PARAM_INT);
		
		if( $stmt->execute() ) {
			$_SESSION["celular"] = $data["celular"];
			$_SESSION["nombre"] = $data["nombre"];
			$_SESSION["apellidos"] = $data["apellidos"];
			$_SESSION["ciudad"] = $data["ciudad"];
			$_SESSION["barrio"] = $data["barrio"];
			$_SESSION["direccion"] = $data["direccion"];
			$_SESSION["tipo_doc"] = $data["tipoDoc"];
			$_SESSION["documento"] = $data["documento"];
			$_SESSION["banco"] = $data["banco"];
			$_SESSION["cuenta_bancaria"] = $data["cuenta_bancaria"];
			$_SESSION["tipo_cuenta"] = $data["tipo_de_cuenta"];
			$_SESSION["correo"] = $data["correo"];
			
			if(!empty($data['password']) && !empty($data['password2']) ) {
				$_SESSION["password"] = $encriptar;
			}
			
			//echo "<pre>". print_r($_SESSION,1)."</pre>";
		}else{
			echo "<h3>* Error al intentar actualizar la información.</h3>";
		}
	}
}
?>