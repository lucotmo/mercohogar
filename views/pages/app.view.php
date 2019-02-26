<?php

require_once "../../backend/models/conexion.php";
require_once "../../models/conexion.php";

function db_query ( $sql, $data = array(), $is_search = false, $search_one = false ) {
  $db = Conexion::conectar();
  $mysql = $db->prepare( $sql );
  $mysql->execute( $data );
  if ( $is_search ) {
    if ( $search_one ) {
      $result = $mysql->fetch(PDO::FETCH_ASSOC);
    } else {
      $result = $mysql->fetchAll(PDO::FETCH_ASSOC);
    }
    $db = null;
    return $result;
  } else {
    $db = null;
    return true;
  }
}

function obtener_valorDomicilio ($ciudad) {
  $sql = "SELECT * FROM ciudades WHERE ciudad_id = ?";
  $data = array($ciudad);
  $result = db_query($sql, $data, true);

  $html = '';
  foreach ($result as $row){
    $html .= '
      <span class="domi-text">Domicilio $</span>
      <input type="text" name="domicilio" class="domi-valor" name="domicilio" value="'.$row['domicilio'].'" required>
    ';
  }
  echo $html;
}

if ( isset($_POST['ciudad_id']) )  obtener_valorDomicilio($_POST['ciudad_id']);

function existe_cliente($celularCliente){
  $sql = "SELECT * FROM cliente WHERE celular = ?";

  $data = array($celularCliente);

  $result = db_query($sql, $data, true, true);
  return $result;
}


if(isset( $_POST['cel'] ) ) {
  $cel = $_POST['cel'];
  $sql = "SELECT * FROM cliente WHERE celular = ?";
  $data = array($cel);
  
  $result =  array();
  $result['res']['ok'] = true;
  $result['res']['status'] = 200;

  $r = db_query($sql, $data, true, true);
  $result['res']['statusText'] = $r;

  if(!$r) {
    $result['res']['ok'] = false;
    $result['res']['status'] = 400;
  }

  echo json_encode($result);
}
/* function registrar_cliente($celular, $nombre, $apellidos, $id_referido, $id_ciudad, $id_ciudad2, $barrio, $barrio2, $direccion, $direccion2){
  $registrado = existe_cliente($celular);
  if ( !$registrado ){
    $sql = 'INSERT INTO cliente (celular, nombre, apellidos, id_referido, id_ciudad, id_ciudad2, barrio, barrio2, direccion, direccion2)
    VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )';
    $data = array(
      $celular,
      $nombre,
      $apellidos,
      $id_referido,
      $id_ciudad,
      $id_ciudad2,
      $barrio,
      $barrio2,
      $direccion,
      $direccion2
    );

    $result = db_query($sql, $data);
    if ( $result ){
      $res = array(
        'err' => false,
        'msg' => 'Registro exitoso'
      );
    }else{
      $res = array(
        'err' => true,
        'msg' => 'Ocurrio un problema al insertar los datos'
      );
    }

  }else{
    //echo 'el usuario ya ha sido registrado';
    $sql = 'UPDATE cliente
      SET nombre = ?, apellidos = ?, id_referido = ?, id_ciudad = ?, id_ciudad2 = ?, barrio = ?, barrio2 = ?, direccion = ?, direccion2 = ?
      WHERE celular = ?';
    $data = array(
      $nombre,
      $apellidos,
      $id_referido,
      $id_ciudad,
      $id_ciudad2,
      $barrio,
      $barrio2,
      $direccion,
      $direccion2,
      $celular
    );

    $result = db_query($sql, $data);

    if ( $result ){
      $res = array(
        'err' => false,
        'msg' => 'el usuario ya ha sido actualizado'
      );
    }else{
      $res = array(
        'err' => true,
        'msg' => 'error al actualizar'
      );
    }

  }
  //header( 'content-type: aplication/json' );
  echo json_encode($res);
} */

function registrar_cliente($celular, $nombre, $apellidos, $id_referido, $id_ciudad, $barrio, $direccion){
  $registrado = existe_cliente($celular);
  if ( !$registrado ){
    $sql = "INSERT INTO cliente (celular, nombre, apellidos, id_referido, id_ciudad, barrio, direccion)
    VALUES ( ?, ?, ?, ?, ?, ?, ? )";
    $data = array(
      $celular,
      $nombre,
      $apellidos,
      $id_referido,
      $id_ciudad,
      $barrio,
      $direccion
    );

    $result = db_query($sql, $data);
    if ( $result ){
      $res = array(
        'cliente' => false,
        'msg' => 'Registro exitoso.'
      );
    }else{
      $res = array(
        'cliente' => true,
        'msg' => 'Ocurrio un problema al insertar los datos.'
      );
    }

  }else{
    //echo 'el usuario ya ha sido registrado';
    $sql = "UPDATE cliente
      SET nombre = ?, apellidos = ?, id_referido = ?, id_ciudad = ?, barrio = ?, direccion = ?
      WHERE celular = ?";
    $data = array(
      $nombre,
      $apellidos,
      $id_referido,
      $id_ciudad,
      $barrio,
      $direccion,
      $celular
    );

    $result = db_query($sql, $data);

    if ( $result ){
      $res = array(
        'cliente' => false,
        'msg' => 'El usuario ya ha sido actualizado.'
      );
    }else{
      $res = array(
        'cliente' => true,
        'msg' => 'Error al actualizar el usuario.'
      );
    }

  }
  //header( 'content-type: aplication/json' );
  return $res;
}

/*if ( isset($_POST["celular"]) )
  registrar_cliente(
  $_POST["celular"],
  $_POST["nombre"],
  $_POST["apellidos"],
  $_POST["referido"],
  $_POST["ciudad"],
  $_POST["ciudad2"],
  $_POST["barrio"],
  $_POST["barrio2"],
  $_POST["direccion"],
  $_POST["direccion2"]
);*/

/* echo '<pre>';
var_dump(registrar_cliente('3163800888', 'luis manuel', 'otero diaz', '31688', 1, 3, 'alonso', 'pie', 'cll', 'cra'));
echo '</pre>'; */

if ( isset($_POST["celular"]) ){
	
	//echo "<pre>".print_r($_POST,1)."</pre>";
	//exit;
	
  $celular = $_POST["celular"];
  $nombre = $_POST["nombre"];
  $apellidos = $_POST["apellidos"];
  $referido = $_POST["referido"];
  
  $valorPedido = $_POST["valorPedido"];
  $domicilio = $_POST["domicilio"];
  $valorTotal = $_POST["valorTotal"];

  $id_product = $_POST["id_product"];
  $valor_product = $_POST["valor_product"];
  $cantidad_product = $_POST["cantidad_product"];
  $precio_total = $_POST["precio_total"];
  
  if( !empty( $_POST['checkedOtro']) ) {
  	$ciudad = $_POST["ciudad2"];
  	$barrio = $_POST["barrio2"];
  	$direccion = $_POST["direccion2"];
  } else {
  	$ciudad = $_POST["ciudad"];
  	$barrio = $_POST["barrio"];
  	$direccion = $_POST["direccion"];
  }
  
  /*secho $ciudad;
  echo "<br>";
  echo $barrio;
  echo "<br>";
  echo $direccion;
  echo "<br>";
  exit;*/
  
  $json = registrar_cliente(
  		$celular,
  		$nombre,
  		$apellidos,
  		$referido,
  		$ciudad,
  		//$ciudad2,
  		$barrio,
  		//$barrio2,
  		$direccion
  		//,$direccion2
  		);

  if( !$json['cliente'] ) {
	  $pedido = "INSERT INTO pedido (id, fecha,	celular_cliente, celular_referido, valor_pedido, id_ciudad,	barrio,	direccion, valor_domicilio, total_valor_pedido, estado_pedido) VALUES";
	
	  $pedido .="('null', NOW(), '".$celular."', '".$referido."', '".$valorPedido."', '".$ciudad."', '".$barrio."', '".$direccion."', '".$domicilio."', '".$valorTotal."', 1 )";
	  /* if ( isset($ciudad2) && isset($barrio2) && isset($direccion2) ){
	    $pedido .="('null', NOW(), '".$celular."', '".$referido."', '".$valorPedido."', '".$ciudad2."', '".$barrio2."', '".$direccion2."', '".$domicilio."', '".$valorTotal."', 0, 0, 0, 0 )";
	  }else{
	    $pedido .="('null', NOW(), '".$celular."', '".$referido."', '".$valorPedido."', '".$ciudad."', '".$barrio."', '".$direccion."', '".$domicilio."', '".$valorTotal."', 0, 0, 0, 0 )";
	  } */
	
	
	  if ( $mysqli->query($pedido) ){
	    $numPedido = $mysqli->insert_id;
	    $cadena = "INSERT INTO producto_pedido (id_producto, id_pedido, precio_actual, cantidad, precio_total) VALUES ";
	    for ( $i = 0; $i < count($id_product); $i++ ){
	      $cadena.="('".$id_product[$i]."', '".$numPedido."', '".$valor_product[$i]."', '".$cantidad_product[$i]."', '".$precio_total[$i]."'),";
	    }
	    $cadena_final = substr($cadena, 0, -1);
	    $cadena_final.= ";";
	    if ( $mysqli->query($cadena_final) ){
	    	$json['pedido'] = false;
	    }
	  }else{
	  	$json['pedido'] = true;
	  }
	
	  $mysqli->close();
	  
	  echo json_encode($json);
  }
}


/* function registrar_pedido($fecha,	$celular_cliente, $celular_referido, $valor_pedido, $id_ciudad,	$barrio,	$direccion, $valor_domicilio, $total_valor_pedido, $pendiente, $realizado, $enviado, $finalizado){
  $sql = "INSERT INTO pedido
    (fecha,	celular_cliente, celular_referido, valor_pedido, id_ciudad,	barrio,	direccion, valor_domicilio, total_valor_pedido, pendiente, realizado, enviado, finalizado)
    VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )";
  $data = array(
    $fecha,
    $celular_cliente,
    $celular_referido,
    $valor_pedido,
    $id_ciudad,
    $barrio,
    $direccion,
    $valor_domicilio,
    $total_valor_pedido,
    $pendiente,
    $realizado,
    $enviado,
    $finalizado
  );

  $result = db_query($sql, $data);

  if ( $result ){
    $res = array(
      'err' => false,
      'msg' => 'el pedido ha sido registrado'
    );
  }else{
    $res = array(
      'err' => true,
      'msg' => 'error al registrar pedido'
    );
  }
  //header( 'content-type: aplication/json' );
  echo json_encode($res);
}

if ( isset($_POST["celular"]) )
  registrar_pedido(
    NOW(),
    $_POST["celular"],
    $_POST["referido"],
    $_POST["valorPedido"],
    $_POST["ciudad"],
    $_POST["barrio"],
    $_POST["direccion"],
    $_POST["domicilio"],
    $_POST["valorTotal"],
    0,
    0,
    0,
    0
  ); */

/* echo '<pre>';
var_dump(registrar_pedido( '', '31588888', '324', '250', '2',	'SAN',	'CLL', '2000', '2250', 0 , 0, 0, 0));
echo '</pre>'; */

/* function registrar_productos_pedidos($id_product, $numPedido, $valor_product, $cantidad_product, $precio_total){
  $db = Conexion::conectar();
  $sql = "INSERT INTO producto_pedido (id_producto, id_pedido, precio_actual, cantidad, precio_total) VALUES ";
  for ( $i = 0; $i < count($id_product); $i++ ){
    $sql.="('".$id_product[$i]."', '".$numPedido."', '".$valor_product[$i]."', '".$cantidad_product[$i]."', '".$precio_total[$i]."'),";
  }
  $sql_final = substr($cadena, 0, -1);
  $sql_final.= ";";

  $mysql = $db->prepare( $sql_final );
  $mysql->execute();

} */

/* if ( isset($_POST["id_product"]) )
  registrar_productos_pedidos(
    $_POST["id_product"],
    '2',
    $_POST["valor_product"],
    $_POST["cantidad_product"],
    $_POST["precio_total"]
  ); */



/* echo '<pre>';
var_dump(registrar_productos_pedidos( null , '2', '2500', '2', '5000'));
echo '</pre>'; */


/* function registrar_productos_pedidos($id_product, $numPedido, $valor_product, $cantidad_product, $precio_total){
  $db = Conexion::conectar();
  $sql = "INSERT INTO producto_pedido (id_producto, id_pedido, precio_actual, cantidad, precio_total) VALUES";

  for($i = 0; $i < sizeOf($fields); $i++){
      $sql .= "( ?, ?, ?, ?, ? ),";
  }
  $sql = rtrim($sql, ',');
  $stmt = $db->prepare($sql);

  $count = 1;
  foreach ($fields as $field) {
    $db->bindParam($count, $field);
    $count++;
  }

  $stmt->execute();

} */



/* for ($i = 0; $i < count($_POST['fk_examen_laboratorio']); $i++) {
  $sql=$DB_con->prepare("INSERT INTO examenes_laboratorio_pacientes (fk_cedula,fk_examen_laboratorio,fecha) VALUES
    (:fk_cedula, :fk_examen_laboratorio, :fecha)");
  $sql->bindParam(':fk_cedula',$_POST['fk_cedula']);
  $sql->bindParam(':fk_examen_laboratorio',$_POST['fk_examen_laboratorio'][$i]);
  $sql->bindParam(':fecha',$_POST['fecha']);
  $sql->execute();
} */


/* function registrar_productos_pedidos($id_product, $numPedido, $valor_product, $cantidad_product, $precio_total){
  $db = Conexion::conectar();

  for($i = 0; $i < count($id_product); $i++){
    $sql = $db->prepare("INSERT INTO producto_pedido (id_producto, id_pedido, precio_actual, cantidad, precio_total)
      VALUES ( ?, ?, ?, ?, ? )");
  }
  $data = array(
    $id_product[$i],
    $numPedido,
    $valor_product[$i],
    $cantidad_product[$i],
    $precio_total[$i]
  );

  $sql->execute($data);

}

if ( isset($_POST["id_product"]) )
  $numPedido = Conexion::conectar()->insert_id;
  registrar_productos_pedidos(
    $_POST["id_product"],
    $numPedido,
    $_POST["valor_product"],
    $_POST["cantidad_product"],
    $_POST["precio_total"]
  ); */

/* if ( isset($_POST["id_product"]) ){
  $id_product = $_POST["id_product"];
  $valor_product = $_POST["valor_product"];
  $cantidad_product = $_POST["cantidad_product"];
  $precio_total = $_POST["precio_total"];

  //$numPedido = $mysqli->insert_id;
  $numPedido = 2;
  $cadena = "INSERT INTO producto_pedido (id_producto, id_pedido, precio_actual, cantidad, precio_total) VALUES ";
  for ( $i = 0; $i < count($id_product); $i++ ){
    $cadena.="('".$id_product[$i]."', '".$numPedido."', '".$valor_product[$i]."', '".$cantidad_product[$i]."', '".$precio_total[$i]."'),";
  }
  $cadena_final = substr($cadena, 0, -1);
  $cadena_final.= ";";
  if ( $mysqli->query($cadena_final) ){
    echo json_encode(array('error' => false));
  }else{
    echo json_encode(array('error' => true));
  }
  $mysqli->close();
} */
