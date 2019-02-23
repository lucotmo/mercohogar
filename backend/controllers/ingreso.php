<?php
class Ingreso{
  public function ingresoController(){
    if(isset($_POST["usuarioIngreso"])){
      if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["usuarioIngreso"])&&
          preg_match('/^[a-zA-Z0-9]+$/', $_POST["passwordIngreso"])){

        $encriptar = crypt($_POST["passwordIngreso"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
        $datosController = array("usuario"=>$_POST["usuarioIngreso"],
                              "password"=>$encriptar);
        $respuesta = IngresoModels::ingresoModel($datosController, "usuario");
        $intentos = $respuesta["intentos"];
        $usuarioActual = $_POST["usuarioIngreso"];
        $maximoIntentos = 2;
        if($intentos < $maximoIntentos){
          if($respuesta["usuario"] == $_POST["usuarioIngreso"] && $respuesta["password"] == $encriptar){
            $intentos = 0;
            $datosController = array("usuarioActual"=>$usuarioActual, "actualizarIntentos"=>$intentos);
            $respuestaActualizarIntentos = IngresoModels::intentosModel($datosController, "usuario");
            session_start();
            $_SESSION["validar"] = true;
            $_SESSION["perfil_id"] = $respuesta["perfil_id"];
            $_SESSION["usuario"] = $respuesta["usuario"];
            $_SESSION["photo"] = $respuesta["photo"];
            $_SESSION["rol"] = $respuesta["rol"];
            $_SESSION["id_ciudad"] = $respuesta["id_ciudad"];
            $_SESSION["password"] = $respuesta["password"];
            $_SESSION["email"] = $respuesta["email"];
            $_SESSION["intentos"] = $respuesta["intentos"];
            header("location:productos");
          }
          else{
            ++$intentos;
            $datosController = array("usuarioActual"=>$usuarioActual, "actualizarIntentos"=>$intentos);
            $respuestaActualizarIntentos = IngresoModels::intentosModel($datosController, "usuario");
            echo '<div class="alert alert-danger">Error al ingresar</div>';
          }
        }
        else{
          $intentos = 0;
          $datosController = array("usuarioActual"=>$usuarioActual, "actualizarIntentos"=>$intentos);
          $respuestaActualizarIntentos = IngresoModels::intentosModel($datosController, "usuario");
          echo '<div class="alert alert-danger">Ha fallado 3 veces, demuestre que no es un robot</div>';
        }
      }
    }
  }
}

