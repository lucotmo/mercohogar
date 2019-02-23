<?php
class GestorPerfiles{
	#GUARDAR PERFIL
	#------------------------------------------------------------
	public function guardarPerfilController(){
		$ruta = "";
		if( isset($_POST["usuario"]) ) {
			if( preg_match('/^[a-zA-Z0-9]+$/', $_POST["usuario"]) &&
		        preg_match('/^[a-zA-Z0-9]+$/', $_POST["pass"]) &&
		        preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["emailNuevo"])
			){
				
				if( !empty ($_FILES["nuevaImagen"]["tmp_name"]) ) {
					$imagen = $_FILES["nuevaImagen"]["tmp_name"];
					$imagedetails = getimagesize($_FILES['nuevaImagen']['tmp_name']);
					$width = $imagedetails[0];
					$height = $imagedetails[1];
					$aleatorio = mt_rand(100, 999);
					$ruta = "views/imagenes/perfiles/perfil".$aleatorio.".jpg";
					//if ( $imagen == "" ){
						//$ruta = "views/imagenes/photo.jpg";
					//}else{
					$origen = imagecreatefromjpeg($imagen);
					$destino = imagecrop($origen, ["x"=>($width - 188) / 2, "y"=>($height - 188) / 2, "width"=>188, "height"=>188]);
					imagejpeg($destino, $ruta);
					//}
				} else {
					$ruta = "views/imagenes/photo.jpg";
				} 
				
				$encriptar = crypt($_POST["pass"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				$datosController = array(
						"usuario"=>$_POST["usuario"],
                     	"photo"=> $ruta,
						"rol"=>$_POST["perfil"],
						"id_ciudad"=>$_POST["ciudad"],
						"password"=>$encriptar,
                     	"correo"=>$_POST["emailNuevo"]
				);

        		$respuesta = GestorPerfilesModel::guardarPerfilModel($datosController, "usuario");

				if( $respuesta == "ok" ) {
					echo'<script>
						swal({
							  title: "¡OK!",
							  text: "¡El usuario ha sido creado correctamente!",
							  type: "success",
							  confirmButtonText: "Cerrar",
							  closeOnConfirm: false
						},
						function(isConfirm){
								 if (isConfirm) {
								    window.location = "perfil";
								  }
						});
					</script>';
				}
			} else{
				echo '<div class="alert alert-warning"><b>¡ERROR!</b> No ingrese caracteres especiales</div>';
			}
		}
	}

	#VISUALIZAR LOS PERFILES
	#------------------------------------------------------------
	public function verPerfilesController(){
		$respuesta = GestorPerfilesModel::verPerfilesModel("usuario");
		//echo "<pre>".print_r($respuesta,1)."</pre>";
		$rol = "";
		foreach($respuesta as $row => $item){
			if( $item["rol"] == 0){
				$rol = "Administrador";
		  	}else{
		    	$rol = "Editor";
		  	}
	      	echo '
	        <tr>
	          <td>'.$item["usuario"].'</td>
	          <td>'.$rol.'</td>
	          <td>'.$item["email"].'</td>
	          <td>
	            <a href="#" class="fa fa-edit btn__perfilDatos" data-id="'.$item["perfil_id"].'" id="btnEditPerfil" ></a>
	          </td>
	        </tr>';
	      	//<a href="index.php?action=perfil&idBorrar='.$item["perfil_id"].'&borrarImg='.$item["photo"].'" class="fa fa-trash btn__perfilDatos"></a>
		}

	}
	#EDITAR PERFIL
	#------------------------------------------------------------
	public function editarPerfilController(){
		$ruta = null;
		if(isset($_POST["editarUsuario"])){
			//echo "<pre>", print_r($_POST,1)."</pre>";
			//echo "<pre>", print_r($_FILES,1)."</pre>";
			//exit;

			if( preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarUsuario"]) &&
			   //preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editarEmailNuevo"])
			){
				
				if ( !empty($_FILES["updateImagen"]["tmp_name"]) ){
					$imagen = $_FILES["updateImagen"]["tmp_name"];
					$aleatorio = mt_rand(100, 999);
					$ruta = "views/imagenes/perfiles/perfil".$aleatorio.".jpg";
					//Eliminamos imagen vieja
					unlink($_POST["cargadoImagen"]);
					$imagedetails = getimagesize($_FILES['updateImagen']['tmp_name']);
					$width = $imagedetails[0];
					$height = $imagedetails[1];
					$origen = imagecreatefromjpeg($imagen);
					$destino = imagecrop($origen, ["x"=>($width - 188) / 2, "y"=>($height - 188) / 2, "width"=>188, "height"=>188]);
					imagejpeg($destino, $ruta);
					
					if(isset($_POST["actualizarSesion"])) {
						$_SESSION["photo"] = $ruta;
					}
				}
				
				
				$encriptar =  (!empty($_POST["editarPassword"])) ? crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$') : null;
        		$datosController = array(
        			"perfil_id"=>$_POST["idPerfil"],
                    "usuario"=>$_POST["editarUsuario"],
                    "photo"=> $ruta,
                    "rol"=>$_POST["editarPerfil"],
                    "id_ciudad"=>$_POST["editarCiudad"],
        			"password"=>$encriptar,
                    "correo"=>$_POST["editarEmailNuevo"]
        		);

        		$respuesta = GestorPerfilesModel::editarPerfilModel($datosController, "usuario");

				if($respuesta == "ok"){
					if(isset($_POST["actualizarSesion"])){
						$_SESSION["perfil_id"] = $_POST["idPerfil"];
						$_SESSION["usuario"] = $_POST["editarUsuario"];
						//$_SESSION["photo"] = $ruta;
						$_SESSION["rol"] = $_POST["editarPerfil"];
						$_SESSION["id_ciudad"] = $_POST["editarCiudad"];
						
						if( !is_null($encriptar) ) {
							$_SESSION["password"] = $encriptar;
						}
						$_SESSION["email"] = $_POST["editarEmailNuevo"];
					}
					echo'<script>
						swal({
							  title: "¡OK!",
							  text: "¡El usuario ha sido editado correctamente!",
							  type: "success",
							  confirmButtonText: "Cerrar",
							  closeOnConfirm: false
						},
						function(isConfirm){
								 if (isConfirm) {
								    window.location = "perfil";
								  }
						});
					</script>';
				}
			}
			else{
				echo '<div class="alert alert-warning"><b>¡ERROR!</b> No ingrese caracteres especiales</div>';
			}
		}
	}

	#BORRAR PERFIL
	#------------------------------------------------------------
	public function borrarPerfilController(){
		if(isset($_GET["idBorrar"])){
			$datosController = $_GET["idBorrar"];
			unlink($_GET["borrarImg"]);
			$respuesta = GestorPerfilesModel::borrarPerfilModel($datosController, "usuario");
			if($respuesta == "ok"){
					echo'<script>
					swal({
						  title: "¡OK!",
						  text: "¡El usuario se ha borrado correctamente!",
						  type: "success",
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
					},
					function(isConfirm){
							 if (isConfirm) {
							    window.location = "perfil";
							  }
					});
				</script>';
			}
		}
	}
}