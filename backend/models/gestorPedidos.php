<?php

require_once "models/conexion.php";
class PedidosModels{
	/* public function seleccionarPedidosModel($tabla, $tabla2, $tabla3){

    $sql = "SELECT id, fecha, $tabla.id_ciudad, celular_cliente, total_valor_pedido, estado_pedido,
      $tabla2.celular, $tabla2.nombre, $tabla2.apellidos,
      $tabla3.ciudad_id, $tabla3.nombre as ciudad
      FROM $tabla
      INNER JOIN $tabla2 ON $tabla.celular_cliente = $tabla2.celular
      INNER JOIN $tabla3 ON $tabla.id_ciudad = $tabla3.ciudad_id";

    if ( $_GET["action"] === "pendientes" ){
      $estado = 1;
    }else if ( $_GET["action"] === "realizados" ){
      $estado = 2;
    }else if ( $_GET["action"] === "enviados" ){
      $estado = 3;
    }else if ( $_GET["action"] === "finalizados" ){
      $estado = 4;
    }else if ( $_GET["action"] === "ventas" ){
      $estado = 5;
    }

    $sql .= " WHERE estado_pedido = $estado ORDER BY fecha ASC ";

    $stmt = Conexion::conectar()->prepare($sql);
    $stmt->execute();
		return $stmt->fetchAll();
    $stmt->close();

  } */
  public function seleccionarPedidosModel($tabla, $tabla2, $tabla3){

    $sql = "SELECT id, fecha, $tabla.id_ciudad, celular_cliente, total_valor_pedido, estado_pedido,
      $tabla2.celular, $tabla2.nombre, $tabla2.apellidos,
      $tabla3.ciudad_id, $tabla3.nombre as ciudad
      FROM $tabla
      INNER JOIN $tabla2 ON $tabla.celular_cliente = $tabla2.celular
      INNER JOIN $tabla3 ON $tabla.id_ciudad = $tabla3.ciudad_id";

    if ( $_GET["action"] === "pendientes" ){
      $estado = 1;
    }else if ( $_GET["action"] === "realizados" ){
      $estado = 2;
    }else if ( $_GET["action"] === "enviados" ){
      $estado = 3;
    }else if ( $_GET["action"] === "finalizados" ){
      $estado = 4;
    }else if ( $_GET["action"] === "ventas" ){
      $estado = 5;
    }

    $sql .= " WHERE estado_pedido = $estado ORDER BY fecha ASC ";

    if ( isset($_POST['consulta']) ){
      $sql = "SELECT id, fecha, $tabla.id_ciudad, celular_cliente, total_valor_pedido, estado_pedido,
        $tabla2.celular, $tabla2.nombre, $tabla2.apellidos,
        $tabla3.ciudad_id, $tabla3.nombre as ciudad
        FROM $tabla
        INNER JOIN $tabla2 ON $tabla.celular_cliente = $tabla2.celular
        INNER JOIN $tabla3 ON $tabla.id_ciudad = $tabla3.ciudad_id";

      if ( $_GET["action"] === "pendientes" ){
        $estado = 1;
      }else if ( $_GET["action"] === "realizados" ){
        $estado = 2;
      }else if ( $_GET["action"] === "enviados" ){
        $estado = 3;
      }else if ( $_GET["action"] === "finalizados" ){
        $estado = 4;
      }else if ( $_GET["action"] === "ventas" ){
        $estado = 5;
      }

      $sql .= " WHERE estado_pedido = $estado
        LIKE '%$q%' OR $tabla.id
        LIKE '%$q%' OR $tabla2.celular
        LIKE '%$q%' OR $tabla2.nombre
        LIKE '%$q%' OR $tabla2.apellidos
        LIKE '%$q%' OR ciudad
        LIKE '$q' ";
    }


    $stmt = Conexion::conectar()->prepare($sql);
    $stmt->execute();
		return $stmt->fetchAll();
    $stmt->close();

  }

}
