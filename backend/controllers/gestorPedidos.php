<?php

class Pedidos{

	public function seleccionarPedidosController(){
    $respuesta = PedidosModels::seleccionarPedidosModel("pedido", "cliente", "ciudades");
    if ( $_GET['action'] === "pendientes" ){
      $btn = "Hecho";
    }else if ( $_GET['action'] === "realizados" ){
      $btn = "Realizado";
    }else if ( $_GET['action'] === "enviados" ){
      $btn = "Enviado";
    }else if ( $_GET['action'] === "ventas" ){
      $btn = "Venta";
    }

    echo '<tr>
      <th>No. Pedido</th>
      <th>Cliente</th>
      <th>Celular</th>
      <th>fecha</th>
      <th>Ciudad</th>
      <th>Precio</th>
      <th>Acciones</th>
      <th></th>
    </tr>';

    foreach ($respuesta as $row => $item){
      echo '
      <tr>
        <td id="pedidoId">'.$item["id"].'</td>
        <td>'.$item["nombre"].' '.$item["apellidos"].'</td>
        <td>'.$item["celular_cliente"].'</td>
        <td>'.$item["fecha"].'</td>
        <td>'.$item["ciudad"].'</td>
        <td>$'.$item["total_valor_pedido"].'</td>
        <td>
          <a href="#" class="fa fa-eye btn__perfilDatos" id="verPedido"></a>
          <a href="#" class="btnRealizadoPedido">'.$btn.'</a>
          <a href="#" class="fa fa-trash btn__perfilDatos"></a>
        </td>
      </tr>';
    }

  }
}