<?php
require_once "backend/models/conexion.php";


/*productoPedido=  producto_pedido_id	id_producto	id_pedido	precio_actual	cantidad	precio_total */
/*Pedido= id	fecha	celular_cliente	celular_referido	valor_pedido	id_ciudad	barrio	direccion	valor_domicilio	total_valor_pedido	pendiente	realizado	enviado	finalizado */
/*cliente = id_cliente	celular	nombre	apellidos	id_referido	id_ciudad	id_ciudad2	barrio	barrio2	direccion	direccion2	cantidad_pedidos */
/*afiliado = id	celular	nombre	apellidos	ciudad	barrio	direccion	tipo_doc	documento	cuenta_bancaria	banco	tipo_cuenta	correo	contraseña	id_cliente	comision	pedidos  */

class PedidosModel{
  /* public function registroPedidosModel($datos, $tabla){
    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (celular_cliente, celular_referido, id_ciudad, barrio, direccion, valor_pedido, valor_domicilio, total_valor_pedido)
      VALUES (:celular, :referido, :ciudad, :barrio, :direccion, :valorPedido, :domicilio, :valorTotal)");

		$stmt -> bindParam(":celular", $datos["celular"], PDO::PARAM_STR);
		$stmt -> bindParam(":referido", $datos["referido"], PDO::PARAM_STR);
    $stmt -> bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
    $stmt -> bindParam(":barrio", $datos["barrio"], PDO::PARAM_STR);
    $stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
    $stmt -> bindParam(":valorPedido", $datos["valorPedido"], PDO::PARAM_STR);
    $stmt -> bindParam(":domicilio", $datos["domicilio"], PDO::PARAM_STR);
    $stmt -> bindParam(":valorTotal", $datos["valorTotal"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";
		}
		else{

			return "error";
		}

		$stmt->close();
  } */
  /* public function registroPedidoModel($datos, $tabla){
    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (celular_cliente, celular_referido, id_ciudad, barrio, direccion, valor_pedido, valor_domicilio, total_valor_pedido)
      VALUES (:celular, :referido, :ciudad, :barrio, :direccion, :valorPedido, :domicilio, :valorTotal)");

		$stmt -> bindParam(":celular", $datos["celular"], PDO::PARAM_STR);
		$stmt -> bindParam(":referido", $datos["referido"], PDO::PARAM_STR);
    $stmt -> bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
    $stmt -> bindParam(":barrio", $datos["barrio"], PDO::PARAM_STR);
    $stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
    $stmt -> bindParam(":valorPedido", $datos["valorPedido"], PDO::PARAM_STR);
    $stmt -> bindParam(":domicilio", $datos["domicilio"], PDO::PARAM_STR);
    $stmt -> bindParam(":valorTotal", $datos["valorTotal"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";
		}
		else{

			return "error";
		}

		$stmt->close();
  } */

  public function registroClienteModel($datos, $tabla){
    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (celular, nombre, apellidos, id_referido, id_ciudad, id_ciudad2, barrio, barrio2, direccion, direccion2)
      VALUES ( :celular, :nombre, :apellidos, :id_referido, :id_ciudad, :id_ciudad2, :barrio, :barrio2, :direccion, :direccion2 )");

    $stmt -> bindParam(":celular", $datos["celular"], PDO::PARAM_STR);
    $stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
    $stmt -> bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
    $stmt -> bindParam(":id_referido", $datos["referido"], PDO::PARAM_STR);
    $stmt -> bindParam(":id_ciudad", $datos["ciudad"], PDO::PARAM_STR);
    $stmt -> bindParam(":id_ciudad2", $datos["ciudad2"], PDO::PARAM_STR);
    $stmt -> bindParam(":barrio", $datos["barrio"], PDO::PARAM_STR);
    $stmt -> bindParam(":barrio2", $datos["barrio2"], PDO::PARAM_STR);
    $stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
    $stmt -> bindParam(":direccion2", $datos["direccion2"], PDO::PARAM_STR);

    $stmt->execute();
  }

  public function registroPedidoModel($datos, $tabla){
    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (fecha,	celular_cliente, celular_referido, valor_pedido, id_ciudad,	barrio,	direccion, valor_domicilio, total_valor_pedido)
      VALUES ( NOW(),	:celular_cliente, :celular_referido, :valor_pedido, :id_ciudad,	:barrio,	:direccion, :valor_domicilio, :total_valor_pedido )");

    $stmt -> bindParam(":celular_cliente", $datos["celular"], PDO::PARAM_STR);
    $stmt -> bindParam(":celular_referido", $datos["referido"], PDO::PARAM_STR);
    $stmt -> bindParam(":valor_pedido", $datos["valorPedido"], PDO::PARAM_STR);
    $stmt -> bindParam(":id_ciudad", $datos["ciudad"], PDO::PARAM_STR);
    $stmt -> bindParam(":barrio", $datos["barrio"], PDO::PARAM_STR);
    $stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
    $stmt -> bindParam(":valor_domicilio", $datos["domicilio"], PDO::PARAM_STR);
    $stmt -> bindParam(":total_valor_pedido", $datos["valorTotal"], PDO::PARAM_STR);

    $stmt->execute();
  }

  public function registroProductoPedidoModel($numPedido, $datos, $tabla){
    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_producto, id_pedido, precio_actual, cantidad, precio_total)
      VALUES ( :id_producto, :id_pedido, :precio_actual, :cantidad, :precio_total )");

    $stmt -> bindParam(":id_producto", $datos["id_product"], PDO::PARAM_STR);
    $stmt -> bindParam(":id_pedido", $numPedido);
    $stmt -> bindParam(":precio_actual", $datos["valor_product"], PDO::PARAM_STR);
    $stmt -> bindParam(":cantidad", $datos["cantidad_product"], PDO::PARAM_STR);
    $stmt -> bindParam(":precio_total", $datos["precio_total"], PDO::PARAM_STR);

    $stmt->execute();
  }
}
