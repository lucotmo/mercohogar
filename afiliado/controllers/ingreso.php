<?php
class Ingreso{
  public function ingresoController(){
    if(isset($_POST["celularIngreso"])){
      if(preg_match('/^[0-9]+$/', $_POST["celularIngreso"])&&
          preg_match('/^[a-zA-Z0-9]+$/', $_POST["passwordIngreso"])){

        $encriptar = crypt($_POST["passwordIngreso"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
        $datosController = array("celular"=>$_POST["celularIngreso"],
                              "password"=>$encriptar);
        $respuesta = IngresoModels::ingresoModel($datosController, "afiliado");
        $intentos = $respuesta["intentos"];
        $usuarioActual = $_POST["celularIngreso"];
        $maximoIntentos = 2;
        if($intentos < $maximoIntentos){
          if($respuesta["celular"] == $_POST["celularIngreso"] && $respuesta["password"] == $encriptar){
            $intentos = 0;
            $datosController = array("celularActual"=>$usuarioActual, "actualizarIntentos"=>$intentos);
            $respuestaActualizarIntentos = IngresoModels::intentosModel($datosController, "afiliado");
            $encriptar = crypt($respuesta["password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
            session_start();
            $_SESSION["validar"] = true;
            $_SESSION["id"] = $respuesta["id"];
            $_SESSION["celular"] = $respuesta["celular"];
            $_SESSION["nombre"] = $respuesta["nombre"];
            $_SESSION["apellidos"] = $respuesta["apellidos"];
            $_SESSION["ciudad"] = $respuesta["ciudad"];
            $_SESSION["barrio"] = $respuesta["barrio"];
            $_SESSION["direccion"] = $respuesta["direccion"];
            $_SESSION["tipo_doc"] = $respuesta["tipo_doc"];
            $_SESSION["documento"] = $respuesta["documento"];
            $_SESSION["cuenta_bancaria"] = $respuesta["cuenta_bancaria"];
            $_SESSION["banco"] = $respuesta["banco"];
            $_SESSION["tipo_cuenta"] = $respuesta["tipo_cuenta"];
            $_SESSION["correo"] = $respuesta["correo"];
            $_SESSION["password"] = $encriptar;
            $_SESSION["intentos"] = $respuesta["intentos"];
            header("location:datos");
          }/*

id
celular
nombre
apellidos
ciudad
barrio
direccion
tipo_doc
documento
cuenta_bancaria
banco
tipo_cuenta
correo
password
id_cliente
comision
pedidos
intentos */
          else{
            ++$intentos;
            $datosController = array("celularActual"=>$usuarioActual, "actualizarIntentos"=>$intentos);
            $respuestaActualizarIntentos = IngresoModels::intentosModel($datosController, "afiliado");
            echo '<div class="alert alert-danger">Error al ingresar</div>';
          }
        }
        else{
          $intentos = 0;
          $datosController = array("celularActual"=>$usuarioActual, "actualizarIntentos"=>$intentos);
          $respuestaActualizarIntentos = IngresoModels::intentosModel($datosController, "afiliado");
          echo '<div class="alert alert-danger">Ha fallado 3 veces, demuestre que no es un robot</div>';
        }
      }
    }
  }
}

