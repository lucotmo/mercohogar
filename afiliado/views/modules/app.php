<?php
//require_once "../../../backend/models/conexion.php";
require_once "../backend/models/conexion.php";

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




/* function obtener_pedido ($idPedido) {
 //$sql = "SELECT * FROM pedido WHERE id = ? ORDER BY id";
 $sql = "SELECT p.id, p.fecha, p.id_ciudad, p.barrio, p.direccion, p.celular_cliente, p.total_valor_pedido, p.estado_pedido,
 cl.celular, cl.nombre, cl.apellidos,
 c.ciudad_id, c.nombre as ciudad,
 pp.id_producto, pp.precio_actual, pp.cantidad, pp.precio_total,
 pr.titulo, pr.medida
 FROM pedido as p
 INNER JOIN cliente as cl ON p.celular_cliente = cl.celular
 INNER JOIN ciudades as c ON p.id_ciudad = c.ciudad_id
 INNER JOIN producto_pedido as pp ON p.id = pp.id_pedido
 INNER JOIN producto as pr ON pp.id_producto = pr.producto_id
 WHERE id = ?";
 $sql2 = "SELECT p.id, p.fecha, p.id_ciudad, p.barrio, p.direccion, p.celular_cliente, p.total_valor_pedido, p.estado_pedido,
 cl.celular, cl.nombre, cl.apellidos,
 c.ciudad_id, c.nombre as ciudad
 FROM pedido as p
 INNER JOIN cliente as cl ON p.celular_cliente = cl.celular
 INNER JOIN ciudades as c ON p.id_ciudad = c.ciudad_id
 WHERE id = ?";

 $data = array($idPedido);

 $result = db_query($sql, $data, true);
 $result2 = db_query($sql2, $data, true);

 echo '<div class="vistaRespuesta">
 <div class="vistaDelPedido">
 <a class="btnCerrarVistaPedido" href="">X</a>
 <h1 class="title__titulo">Datos</h1>
 <table class="responsivePedido-table">
 <tr>
 <th>No. Pedido</th>
 <th>Cliente</th>
 <th>Celular</th>
 <th>Ciudad</th>
 <th>Barrio</th>
 <th>Direccion</th>
 <th></th>
 </tr>';
 if ( count($result2) == 0 ){
 echo "No existen pedidos para $idPedido";
 }else{
 foreach ($result2 as $row) {
 echo '<tr>
 <td >'.$row['id'].'</td>
 <td>'.$row['nombre'].' '.$row['apellidos'].'</td>
 <td>'.$row['celular_cliente'].'</td>
 <td>'.$row['ciudad'].'</td>
 <td>'.$row['barrio'].'</td>
 <td>'.$row['direccion'].'</td>
 </tr>';
 }
 }
 echo '</table>';
 echo '<h1 class="title__titulo">Productos</h1>
 <table class="responsivePedido-table">
 <tr>
 <th>Nombre</th>
 <th>Medida</th>
 <th>Cantidad</th>
 <th>Precio</th>
 <th>Precio total</th>
 <th>Acciones</th>
 <th></th>
 </tr>';
 if ( count($result) === 0 ) {
 echo "No existen pedidos para $idPedido";
 } else {
 foreach ($result as $row){
 echo '<tr>
 <td>'.$row['titulo'].'</td>
 <td>'.$row['medida'].'</td>
 <td>'.$row['cantidad'].'</td>
 <td>'.$row['precio_actual'].'</td>
 <td>'.$row['precio_total'].'</td>
 <td>
 <a href="#" class="fa fa-trash btn__perfilDatos"></a>
 </td>
 </tr>';
 }
 }
 echo '</table>';
 echo '
 </div>
 </div>';
 } */

//if ( isset($_POST['id']) )  obtener_pedido($_POST['id']);


/* function obtener_registros () {
 $sql = "SELECT p.email, p.nombre, p.apellidos, p.nacimiento,
 a.bloque, a.disciplina, a.horario, r.fecha
 FROM registros AS r
 INNER JOIN actividades AS a
 ON a.actividad_id = r.actividad
 INNER JOIN participantes AS p
 ON p.email = r.email
 ORDER BY r.fecha, a.bloque, a.disciplina, a.horario";

 $result = db_query($sql, null, true);

 if (count($result) === 0) {
 return 'No existen registros';
 } else {
 //return $result;
 $html = '';

 foreach ( $result as $row ) {
 $html .= '
 <tr>
 <td>' . $row['email'] . '</td>
 <td>' . $row['nombre'] . '</td>
 <td>' . $row['apellidos'] . '</td>
 <td>' . $row['nacimiento'] . '</td>
 <td>' . $row['bloque'] . '</td>
 <td>' . $row['disciplina'] . '</td>
 <td>' . $row['horario'] . '</td>
 <td>' . $row['fecha'] . '</td>
 <td>
 <a href="#" class="btn-floating  lime">
 <i class="material-icons  delete" data-registro="' . $row['email'] . '">delete</i>
 </a>
 </td>
 </tr>
 ';
 }

 return $html;
 }
 } */


/* function obtener_comisiones($celularCliente){
 $sql2 = "SELECT p.id, p.celular_cliente,
 pp.precio_total, pp.id_producto,
 pr.id_categoria, sum(pp.precio_total) as total,
 ca.nombre_categoria, ca.comision
 FROM pedido as p
 INNER JOIN producto_pedido as pp ON p.id = pp.id_pedido
 INNER JOIN producto as pr ON pr.producto_id = pp.id_producto
 INNER JOIN categoria as ca ON pr.id_categoria = ca.categoria_id
 WHERE p.celular_cliente = ? && p.celular_cliente && pr.id_categoria
 GROUP BY pr.id_categoria";
 } */

/* function obtener_clientes_referido($idPedido) {
 $sql = "SELECT p.id, p.celular_cliente, p.celular_referido, count(p.celular_referido) as total, p.valor_pedido,
 cl.nombre as nombreCliente
 FROM pedido as p
 INNER JOIN cliente as cl ON p.celular_cliente = cl.celular
 WHERE celular_referido = ?
 GROUP BY celular_cliente";
 $sql2 = "SELECT p.id, p.celular_cliente,
 pp.precio_total, pp.id_producto,
 pr.id_categoria, sum(pp.precio_total) as total,
 ca.nombre_categoria, ca.comision
 FROM pedido as p
 INNER JOIN producto_pedido as pp ON p.id = pp.id_pedido
 INNER JOIN producto as pr ON pr.producto_id = pp.id_producto
 INNER JOIN categoria as ca ON pr.id_categoria = ca.categoria_id
 WHERE celular_referido = ? && p.celular_cliente && pr.id_categoria
 GROUP BY pr.id_categoria";
 $sql3 = "SELECT p.id,
 pp.precio_total, pp.id_producto,
 pr.id_categoria, sum(pp.precio_total) as total, sum(total) as totalComisionCategorias,
 ca.nombre_categoria, ca.comision
 FROM pedido as p
 INNER JOIN producto_pedido as pp ON p.id = pp.id_pedido
 INNER JOIN producto as pr ON pr.producto_id = pp.id_producto
 INNER JOIN categoria as ca ON pr.id_categoria = ca.categoria_id
 WHERE celular_referido = ? && pr.id_categoria
 GROUP BY pr.id_categoria";


 $data = array($idPedido);
 $result = db_query($sql, $data, true);
 $result2 = db_query($sql2, $data, true);
 $result3 = db_query($sql3, $data, true);




 if (count($result) === 0) {
 return 'No existen registros';
 } else {
 foreach ($result as $row){

 echo '<div class="datosCliente-container">
 <div class="datosCliente-content">
 <table class="table-responsive">
 <thead>
 <tr>
 <th>Celular</th>
 <th>Cliente</th>
 <th>No. Ventas</th>
 <th>Acciones</th>
 <th></th>
 </tr>
 </thead>
 <tbody>
 <tr>
 <td>'.$row['celular_cliente'].'</td>
 <td>'.$row['nombreCliente'].'</td>
 <td>'.$row['total'].'</td>
 <td>
 <a href="#" class="fa fa-eye btn__perfilDatos" data-id="'.$row['celular_cliente'].'" id="verPedido"></a>
 </td>
 </tr>
 </tbody>
 </table>
 </div>';
 echo'<div class="datosComisionCliente">
 <table class="table-responsive-precio">
 <thead>
 <tr>
 <th>Categoria</th>
 <th>Comision</th>
 <th>Valor Total</th>
 <th></th>
 </tr>
 </thead>
 <tbody>';
 foreach ( $result2 as $row ){
 echo '
 <tr>
 <td>'.$row['nombre_categoria'].'</td>
 <td class="comision">'.$row['comision'].'</td>
 <td class="price">'.($row['total']*$row['comision']/100).'</td>';
 echo '</tr>';
 }
 echo '<tr>
 <td></td>
 <td><strong>Total</strong></td>';
 echo '<td>310000</td>';
 echo '</tr>
 </tbody>
 </table>
 </div>';

 echo '</div>';
 }
 }
 } */


function obtener_clientes_referido($idPedido) {
	$sql = "SELECT p.id, p.celular_cliente, p.celular_referido,
	(SELECT count(*) FROM producto_pedido as pp WHERE pp.id_pedido = p.id) as total,
    cl.nombre as nombreCliente
    FROM pedido as p
    INNER JOIN cliente as cl ON p.celular_cliente = cl.celular
    WHERE celular_referido = ? AND p.estado_pedido = 5";
	$data = array($idPedido);
	//echo $sql;
	$result = db_query($sql, $data, true);
	//$result3 = db_query($sql3, $data, true);

	if (count($result) === 0) {
		return 'No existen registros';
	} else {
		foreach ($result as $row){
			$totalGeneral = 0;

			$sql2 = "SELECT p.id, p.celular_cliente,
		pp.precio_total, pp.id_producto,
	    pr.id_categoria, sum(pp.precio_total) as total,
	    ca.nombre_categoria, ca.comision
	    FROM pedido as p
	    INNER JOIN producto_pedido as pp ON p.id = pp.id_pedido
	    INNER JOIN producto as pr ON pr.producto_id = pp.id_producto
	    INNER JOIN categoria as ca ON pr.id_categoria = ca.categoria_id
	    WHERE celular_referido = ? AND p.celular_cliente = ?
		AND p.id  = ?
	    GROUP BY pr.id_categoria";
		$result2 = db_query($sql2, array($row['celular_referido'], $row['celular_cliente'], $row['id']), true);

		echo '<div class="datosCliente-container">
        <div class="datosCliente-content">
          <table class="table-responsive">
            <thead>
              <tr>
                <th>Celular</th>
                <th>Cliente</th>
                <th>No. Ventas</th>
                <th>Acciones</th>
                <th></th>
              </tr>
            </thead>
          <tbody>
            <tr>
              <td>'.$row['celular_cliente'].'</td>
              <td>'.$row['nombreCliente'].'</td>
              <td>'.$row['total'].'</td>
              <td>
                <a href="#" class="fa fa-eye btn__perfilDatos" data-id="'.$row['id'].'" id="verPedido"></a>
              </td>
            </tr>
          </tbody>
          </table>
        </div>';
			echo'<div class="datosComisionCliente">
        <table class="table-responsive-precio">
          <thead>
            <tr>
              <th>Categoria</th>
              <th>Comision</th>
              <th>Valor Total</th>
              <th></th>
            </tr>
          </thead>
          <tbody>';
			foreach ( $result2 as $row2 ){
				echo '
              <tr>
                <td>'.$row2['nombre_categoria'].'</td>
                <td class="comision">'.$row2['comision'].'</td>
                <td class="price">'.($row2['total']*$row2['comision']/100).'</td>';
				echo '</tr>';

				$totalGeneral+=($row2['total']*$row2['comision']/100);
			}
			echo '<tr>
              <td></td>
              <td><strong>Total</strong></td>';
			echo '<td>'.$totalGeneral.'</td>';
			echo '</tr>
          </tbody>
        </table>
        </div>';

			echo '</div>';
		}
	}
}

function comision_no_pagada($afiliado){
	$nopagodo = "SELECT
	ca.nombre_categoria,
	ca.comision,
	(sum(pp.precio_total)*ca.comision/100) as _real
	FROM pedido as p
	INNER JOIN producto_pedido as pp ON p.id = pp.id_pedido
	INNER JOIN producto as pr ON pr.producto_id = pp.id_producto
	INNER JOIN categoria as ca ON pr.id_categoria = ca.categoria_id
	WHERE
	p.celular_referido = ?
	AND p.pago is false
	AND p.estado_pedido = 5
	GROUP BY pr.id_categoria;";

	$data = array($afiliado);

	$r_nopagado= db_query($nopagodo, $data, true);

	return $r_nopagado;
}

function comision_pagada($afiliado){
	$pagado = "SELECT
	ca.nombre_categoria,
	ca.comision,
	(sum(pp.precio_total)*ca.comision/100) as _real
	FROM pedido as p
	INNER JOIN producto_pedido as pp ON p.id = pp.id_pedido
	INNER JOIN producto as pr ON pr.producto_id = pp.id_producto
	INNER JOIN categoria as ca ON pr.id_categoria = ca.categoria_id
	WHERE
	p.celular_referido = ?
	AND p.pago is true
	AND p.estado_pedido = 5
	GROUP BY pr.id_categoria;";

	$data = array($afiliado);

	$r_pagado = db_query($pagado, $data, true);

	return $r_pagado;

}


function select_ciudades(){
	$ciudades = "SELECT
	* FROM ciudades";

	$r_ciudades= db_query($ciudades, array(), true);
	return $r_ciudades;
}

function select_tdoc(){
	$doc = "SELECT
	* FROM tipo_doc";

	$r_doc= db_query($doc, array(), true);
	return $r_doc;
}

function select_banco(){
	$banco = "SELECT
	* FROM banco";

	$r_banco= db_query($banco, array(), true);
	return $r_banco;
}

function select_tcuenta(){
	$tcuenta = "SELECT
	* FROM tipo_cuenta";

	$r_tcuenta= db_query($tcuenta, array(), true);
	return $r_tcuenta;
}
/* SELECT p.id, p.celular_cliente, p.celular_referido, count(p.celular_referido) as total, p.valor_pedido,
 cl.nombre as nombreCliente
 FROM pedido as p
 INNER JOIN cliente as cl ON p.celular_cliente = cl.celular
 WHERE celular_referido = 3153855955
 GROUP BY celular_cliente */


/* SELECT p.id
 FROM pedido as p
 INNER JOIN cliente as cl ON p.celular_cliente = cl.celular
 WHERE celular_referido = 3153855955
 GROUP BY celular_cliente */


 function mostrar_pedido_hecho ($idPedido) {
  $sql = "SELECT p.id,
    pp.id_producto, pp.precio_actual, pp.cantidad, pp.precio_total,
    pr.titulo, pr.medida
    FROM pedido as p
    INNER JOIN producto_pedido as pp ON p.id = pp.id_pedido
    LEFT JOIN producto as pr ON pp.id_producto = pr.producto_id
    WHERE p.id = ?";
  $sql2 = "SELECT p.id, p.fecha, p.id_ciudad, p.barrio, p.direccion, p.celular_cliente, p.total_valor_pedido, p.estado_pedido,
    cl.celular, cl.nombre, cl.apellidos,
    c.ciudad_id, c.nombre as ciudad
    FROM pedido as p
    INNER JOIN cliente as cl ON p.celular_cliente = cl.celular
    INNER JOIN ciudades as c ON p.id_ciudad = c.ciudad_id
    WHERE id = ?";

  $data = array($idPedido);

  $result2 = db_query($sql2, $data, true);
  $result = db_query($sql, $data, true);

  echo '<div class="vistaRespuesta">
  <div class="vistaDelPedido">
    <a class="btnCerrarVistaPedido" href="">X</a>
    <h1 class="title__titulo">Datos</h1>
    <table class="table-responsive">
      <thead>
        <tr>
          <th>No. Pedido</th>
          <th>Cliente</th>
          <th>Celular</th>
          <th>Ciudad</th>
          <th>Barrio</th>
          <th>Direccion</th>
          <th></th>
        </tr>
      </thead>';
  if ( count($result2) == 0 ){
    echo "No existen pedidos para $idPedido";
  }else{
    foreach ($result2 as $row) {
      echo '<tbody>
        <tr>
          <td >'.$row['id'].'</td>
          <td>'.$row['nombre'].' '.$row['apellidos'].'</td>
          <td>'.$row['celular_cliente'].'</td>
          <td>'.$row['ciudad'].'</td>
          <td>'.$row['barrio'].'</td>
          <td>'.$row['direccion'].'</td>
        </tr>
      </tbody>';
    }
  }
  echo '</table><br>';
  echo '<h1 class="title__titulo">Productos</h1>
    <table class="table-responsive-precio">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Medida</th>
          <th>Cantidad</th>
          <th>Precio</th>
          <th>Precio total</th>
          <th></th>
        </tr>
      </thead>';
  if ( count($result) === 0 ) {
    echo "No existen pedidos para $idPedido";
  } else {
    echo '<tbody>';
    foreach ($result as $row2){
      echo '
        <tr>
          <td>'.$row2['titulo'].'</td>
          <td>'.$row2['medida'].'</td>
          <td>'.$row2['cantidad'].'</td>
          <td class="price">'.$row2['precio_actual'].'</td>
          <td class="price">'.$row2['precio_total'].'</td>
        </tr>';
    }
  if ( count($result2) == 0 ){
    echo "No existen pedidos para $idPedido";
  }else{
    foreach ($result2 as $row3) {
      echo '<tr>
      <td></td>
      <td></td>
      <td></td>
      <td>Total</td>
      <td class="priceTotal">'.$row3['total_valor_pedido'].'</td>
    </tr>';
    }
  }
    echo '
    </tbody>';
  }
  echo '</table>';
  echo '
    </div>
  </div>';
}

if ( isset($_POST['id_ver_pedido']) )  mostrar_pedido_hecho($_POST['id_ver_pedido']);