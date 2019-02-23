<?php

/* $celular = $_POST['celular'];
$codigo = $_POST['codigo'];
$nombre = $_POST['nombre'];

$id = $_POST['id'];
$id_celular = $_POST['id_celular'];
$producto = $_POST['producto'];
$valor_producto = $_POST['valor_producto'];

echo "INSERT cliente VALUES(".$celular.", ".$codigo.", ".$nombre.")";

for ($i = 0; $i<sizeof($producto); ++$i){
    echo "<br>" . "INSERT productos VALUES(".($i+1)." , '".$id[$i]."' , '".$celular."', '".$codigo."' , '".$producto[$i]."', '".$valor_producto[$i]."')";
}
 */



$celular = $_POST['celular'];
$referido = $_POST['referido'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$ciudad = $_POST['ciudad'];
$barrio = $_POST['barrio'];
$direccion = $_POST['direccion'];
$valorPedido = $_POST['valorPedido'];
$domicilio = $_POST['domicilio'];
$valorTotal = $_POST['valorTotal'];


$id_product = $_POST['id_product'];
$valor_product = $_POST['valor_product'];
$cantidad_product = $_POST['cantidad_product'];
$precio_total = $_POST['precio_total'];


echo "INSERT cliente VALUES(".$celular.", ".$nombre.", ".$apellidos.", ".$referido.", ".$ciudad.", ".$barrio.", ".$direccion.")";

for ($i = 0; $i < sizeof($id_product); $i++){
  echo "<br>" . "INSERT productos VALUES(".($i+1).", '".$celular."', '".$id_product[$i]."' , '".$valor_product[$i]."', '".$cantidad_product[$i]."', '".$precio_total[$i]."')";
};

/* id_cliente	celular	nombre	apellidos	id_referido	id_ciudad	barrio	dirección	cantidad_pedidos */
