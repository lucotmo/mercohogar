<?php

require "conexion.php";

$celular = $_POST["celular"];
$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$referido = $_POST["referido"];
$ciudad = $_POST["ciudad"];
$ciudad2 = $_POST["ciudad2"];
$barrio = $_POST["barrio"];
$barrio2 = $_POST["barrio2"];
$direccion = $_POST["direccion"];
$direccion2 = $_POST["direccion2"];


/* function ciudadPedido(){
  if ( isset($_POST["ciudad2"]) ){
    $result = $_POST["ciudad2"];
  }else{
    $result = $_POST["ciudad"];
  }
  return $result;
}

function barrioPedido(){
  if ( isset($_POST["barrio2"]) ){
    $result = $_POST["barrio2"];
  }else{
    $result = $_POST["barrio"];
  }
  return $result;
}

function direccionPedido(){
  if ( isset($_POST["direccion2"]) ){
    $result = $_POST["direccion2"];
  }else{
    $result = $_POST["direccion"];
  }
  return $result;
} */

$valorPedido = $_POST["valorPedido"];
//$valorPedido .= str_replace(',','',$valorPedido);
$domicilio = $_POST["domicilio"];
$valorTotal = $_POST["valorTotal"];
//$valorTotal .= str_replace(',','',$valorTotal);

$id_product = $_POST["id_product"];
$valor_product = $_POST["valor_product"];
$cantidad_product = $_POST["cantidad_product"];
$precio_total = $_POST["precio_total"];

//$numPedido


$cliente = "INSERT INTO cliente (id_cliente, celular, nombre, apellidos, id_referido, id_ciudad, id_ciudad2, barrio, barrio2, direccion, direccion2) VALUES";
$cliente .= "('null','".$celular."', '".$nombre."', '".$apellidos."', '".$referido."', '".$ciudad."', '".$ciudad2."', '".$barrio."', '".$barrio2."', '".$direccion."', '".$direccion2."')";

$pedido = "INSERT INTO pedido (id, fecha,	celular_cliente, celular_referido, valor_pedido, id_ciudad,	barrio,	direccion, valor_domicilio, total_valor_pedido, pendiente, realizado, enviado, finalizado) VALUES";
$pedido .="('null', NOW(), '".$celular."', '".$referido."', '".$valorPedido."', '".$ciudad."', '".$barrio."', '".$direccion."', '".$domicilio."', '".$valorTotal."', 0, 0, 0, 0 )";


$mysqli->query($cliente);

if ( $mysqli->query($pedido) ){
  $numPedido = $mysqli->insert_id;
  $cadena = "INSERT INTO producto_pedido (id_producto, id_pedido, precio_actual, cantidad, precio_total) VALUES ";
  for ( $i = 0; $i < count($id_product); $i++ ){
    $cadena.="('".$id_product[$i]."', '".$numPedido."', '".$valor_product[$i]."', '".$cantidad_product[$i]."', '".$precio_total[$i]."'),";
  }
  $cadena_final = substr($cadena, 0, -1);
  $cadena_final.= ";";
  if ( $mysqli->query($cadena_final) ){
    echo json_encode(array('error' => false));
  }
}else{
  echo json_encode(array('error' => true));
}

$mysqli->close();


