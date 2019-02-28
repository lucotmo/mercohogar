<?php
class GestorAfiliados{
	#GUARDAR PERFIL
	#------------------------------------------------------------
	public function guardarAfiliadoController(){
		$ruta = "";
		if(isset($_POST["celularAfiliadoNuevo"])){

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["celularAfiliadoNuevo"]) &&
         preg_match('/^[a-zA-Z0-9]+$/', $_POST["nombreAfiliadoNuevo"]) &&
         preg_match('/^[a-zA-Z0-9]+$/', $_POST["apellidosAfiliadoNuevo"]) &&
         preg_match('/^[a-zA-Z0-9]+$/', $_POST["passAfiliadoNuevo"])){
				$encriptar = crypt($_POST["passAfiliadoNuevo"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				$datosController = array("celular"=>$_POST["celularAfiliadoNuevo"],
                     "nombre"=> $_POST["nombreAfiliadoNuevo"],
										 "apellidos"=>$_POST["apellidosAfiliadoNuevo"],
										 "password"=>$encriptar);
        $respuesta = GestorAfiliadosModel::guardarAfiliadoModel($datosController, "afiliado");
				if($respuesta == "ok"){
					echo'<script>
						swal({
							  title: "¡OK!",
							  text: "¡El Afiliado ha sido creado correctamente!",
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

	#VISUALIZAR LOS PERFILES
	#------------------------------------------------------------
	public function verAfiliadoController(){
		$respuesta = GestorAfiliadosModel::verAfiliadosModel("afiliado");
		foreach($respuesta as $row => $item){
			
			$pagado = GestorAfiliadosModel::getPagado($item["celular"]);
			$p_total = 0;
			foreach ($pagado as $p){
				$p_total +=$p['pagado'];
			}
			
			$nopagado = GestorAfiliadosModel::getNoPagado($item["celular"]);
			$n_total = 0;
			$n_total_id = null;
			foreach ($nopagado as $np){
				$n_total += $np['nopagado'];
				$n_total_id.= ','.$np['id'];
			}
			
			$n_explode = explode(',',$n_total_id);
			$n_result = array_unique($n_explode);
			$n_implode  = implode(",",$n_result);
			
			$disabled= (empty($n_implode)) ? 'pointer-events:none;background-color:gray' : '';
			
      echo '
        <tr>
          <td>'.$item["nombre"].' '.$item["apellidos"].'</td>
          <td>'.$item["celular"].'</td>
		  <td>'.$p_total.'</td>
		  <td>'.$n_total.'</td>
          <td>
            <a href="#" class="fa fa-eye btn__perfilDatos" data-id="'.$item["id"].'" id="verAfiliado"></a>
            <a href="#" class="fa fa-edit btn__perfilDatos" data-id="'.$item["id"].'" id="editAfiliado"></a>
            <a href="#" style="'.$disabled.'" class="fa fa-money btn__perfilDatos pagoAfiliado" data-id="'.trim($n_implode, ',').'" id="pagoAfiliado"></a>
          </td>
        </tr>';
      //<a href="index.php?action=perfil&idBorrarAfiliado='.$item["id"].'" class="fa fa-trash btn__perfilDatos"></a>
		}

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
	} */

	#BORRAR PERFIL
	#------------------------------------------------------------
	public function borrarAfiliadoController(){
		if(isset($_GET["idBorrarAfiliado"])){
			$datosController = $_GET["idBorrarAfiliado"];
			$respuesta = GestorAfiliadosModel::borrarAfiliadoModel($datosController, "afiliado");
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