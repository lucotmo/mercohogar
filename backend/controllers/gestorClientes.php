<?php
class GestorClientes{
	#GUARDAR PERFIL
	#------------------------------------------------------------
	/* public function guardarPerfilController(){
		$ruta = "";
		if(isset($_POST["usuario"])){
			if( isset($_FILES["nuevaImagen"]["tmp_name"]) ){
        $imagen = $_FILES["nuevaImagen"]["tmp_name"];
        $imagedetails = getimagesize($_FILES['nuevaImagen']['tmp_name']);
        $width = $imagedetails[0];
        $height = $imagedetails[1];
				$aleatorio = mt_rand(100, 999);
        $ruta = "views/imagenes/perfiles/perfil".$aleatorio.".jpg";
        if ( $imagen == "" ){
          $ruta = "views/imagenes/photo.jpg";
        }else{
          $origen = imagecreatefromjpeg($imagen);
          $destino = imagecrop($origen, ["x"=>($width - 188) / 2, "y"=>($height - 188) / 2, "width"=>188, "height"=>188]);
          imagejpeg($destino, $ruta);
        }
			}
			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["usuario"])&&
         preg_match('/^[a-zA-Z0-9]+$/', $_POST["pass"]) &&
         preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["emailNuevo"])){
				$encriptar = crypt($_POST["pass"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				$datosController = array("usuario"=>$_POST["usuario"],
                     "photo"=> $ruta,
										 "rol"=>$_POST["perfil"],
										 "id_ciudad"=>$_POST["ciudad"],
										 "password"=>$encriptar,
                     "correo"=>$_POST["emailNuevo"]);

        $respuesta = GestorPerfilesModel::guardarPerfilModel($datosController, "usuario");

				if($respuesta == "ok"){
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
			}
			else{
				echo '<div class="alert alert-warning"><b>¡ERROR!</b> No ingrese caracteres especiales</div>';
			}
		}
	} */

	#VISUALIZAR LOS PERFILES
	#------------------------------------------------------------
	public function verClientesController(){
		$respuesta = GestorClientesModel::verClientesModel("cliente");
		foreach($respuesta as $row => $item){
      echo '
        <tr>
          <td>'.$item["celular"].'</td>
          <td>'.$item["nombre"].' '.$item["apellidos"].'</td>
          <td></td>
          <td>
            <a href="#" data-id="'.$item["id_cliente"].'" class="fa fa-eye btn__perfilDatos" id="verClientes"></a>
            <a href="#" data-id="'.$item["id_cliente"].'" class="fa fa-edit btn__perfilDatos" id="editClientes"></a>
          </td>
        </tr>';

    }
    //id_cliente, celular, nombre, apellidos

	}
	#EDITAR PERFIL
	#------------------------------------------------------------
	/* public function editarPerfilController(){
		$ruta = "";
		if(isset($_POST["editarUsuario"])){
      if ( isset($_FILES["updateImagen"]["tmp_name"]) ){
        //echo "probando";
        $imagen = $_FILES["updateImagen"]["tmp_name"];
				$aleatorio = mt_rand(100, 999);
        $ruta = "views/imagenes/perfiles/perfil".$aleatorio.".jpg";
        if ( $imagen == "" ){
          $ruta = $_POST["cargadoImagen"];
        }else{
          $imagedetails = getimagesize($_FILES['updateImagen']['tmp_name']);
          $width = $imagedetails[0];
          $height = $imagedetails[1];
          $origen = imagecreatefromjpeg($imagen);
          $destino = imagecrop($origen, ["x"=>($width - 188) / 2, "y"=>($height - 188) / 2, "width"=>188, "height"=>188]);
          imagejpeg($destino, $ruta);
        }

        //echo $ruta;

      }

      if ( $ruta != $_POST["cargadoImagen"] ){
        unlink($_POST["cargadoImagen"]);
      }

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarUsuario"])&&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editarEmailNuevo"])){
				 $encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

        $datosController = array("perfil_id"=>$_POST["idPerfil"],
                                "usuario"=>$_POST["editarUsuario"],
                                "photo"=> $ruta,
                                "rol"=>$_POST["editarPerfil"],
                                "id_ciudad"=>$_POST["editarCiudad"],
                                "password"=>$encriptar,
                                "correo"=>$_POST["editarEmailNuevo"]);

        $respuesta = GestorPerfilesModel::editarPerfilModel($datosController, "usuario");

				if($respuesta == "ok"){
					if(isset($_POST["actualizarSesion"])){
						$_SESSION["perfil_id"] = $_POST["idPerfil"];
						$_SESSION["usuario"] = $_POST["editarUsuario"];
						$_SESSION["photo"] = $ruta;
						$_SESSION["rol"] = $_POST["editarPerfil"];
						$_SESSION["id_ciudad"] = $_POST["editarCiudad"];
						$_SESSION["password"] = $encriptar;
						$_SESSION["correo"] = $_POST["editarEmailNuevo"];
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
	} */
}