<?php

class PedidoController{

	/* public function registroPedidosController(){

		if(isset($_POST["celular_cliente"])){

      if(preg_match('/^[0-9\s]+$/', $_POST["celular_cliente"]) &
         preg_match('/^[0-9\s]+$/', $_POST["celular_referido"]) &
         preg_match('/^[0-9\s]+$/', $_POST["id_ciudad"]) &
         preg_match('/^[a-zA-Z\s]+$/', $_POST["barrio"]) &
         preg_match('/^[a-zA-Z\s]+$/', $_POST["direccion"]) &
         preg_match('/^[0-9\s]+$/', $_POST["valor_pedido"]) &
         preg_match('/^[0-9\s]+$/', $_POST["valor_domicilio"]) &
			   preg_match('/^[0-9\s]+$/', $_POST["total_valor_pedido"])){

        $datosPedidoController = array(
          "celular"=>$_POST["celular_cliente"],
          "referido"=>$_POST["celular_referido"],
          "ciudad"=>$_POST["id_ciudad"],
          "barrio"=>$_POST["barrio"],
          "direccion"=>$_POST["direccion"],
          "valorPedido"=>$_POST["valor_pedido"],
          "domicilio"=>$_POST["valor_domicilio"],
          "valorTotal"=>$_POST["total_valor_pedido"]
        );
        print_r($respuesta = PedidosModel::registroPedidosModel($datosPedidoController, "pedido"));
      }
		}

  } */

  public function registroClienteController(){
    if ( $datos["celular"] &
         $datos["nombre"] &
         $datos["apellidos"] &
         $datos["referido"] &
         $datos["ciudad"] &
         $datos["ciudad2"] &
         $datos["barrio"] &
         $datos["barrio2"] &
         $datos["direccion"] &
         $datos["direccion2"] ){

      $datosClienteController = array(
        "celular"=> $datos["celular"],
        "nombre"=> $datos["nombre"],
        "apellidos"=> $datos["apellidos"],
        "id_referido"=> $datos["referido"],
        "id_ciudad"=> $datos["ciudad"],
        "id_ciudad2"=> $datos["ciudad2"],
        "barrio"=> $datos["barrio"],
        "barrio2"=> $datos["barrio2"],
        "direccion"=> $datos["direccion"],
        "direccion2"=> $datos["direccion2"]
      );

      $respuesta = PedidosModel::registroClienteModel($datosClienteController, "cliente");
    }
  }

  public function registroPedidoController(){

  }

  public function registroProductoPedidoController(){

  }
}