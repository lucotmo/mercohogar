<?php
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

function obtener_pedido ($idPedido) {
  //$sql = "SELECT * FROM pedido WHERE id = ? ORDER BY id";
  /* $sql = "SELECT p.id, p.fecha, p.id_ciudad, p.barrio, p.direccion, p.celular_cliente, p.total_valor_pedido, p.estado_pedido,
    cl.celular, cl.nombre, cl.apellidos,
    c.ciudad_id, c.nombre as ciudad,
    pp.id_producto, pp.precio_actual, pp.cantidad, pp.precio_total,
    pr.titulo, pr.medida
    FROM pedido as p
    INNER JOIN cliente as cl ON p.celular_cliente = cl.celular
    INNER JOIN ciudades as c ON p.id_ciudad = c.ciudad_id
    INNER JOIN producto_pedido as pp ON p.id = pp.id_pedido
    INNER JOIN producto as pr ON pp.id_producto = pr.producto_id
    WHERE id = ?"; */
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

if ( isset($_POST['id']) )  obtener_pedido($_POST['id']);


function obtener_perfil ($idPerfil){
  $sql = "SELECT *
    FROM usuario
    WHERE perfil_id = ?";

  $data = array($idPerfil);
  $result = db_query($sql, $data, true);

  if ( count($result) == 0 ){
    echo "No existen pedidos para $idPerfil";
  }else{
    foreach ($result as $row) {
      $html= '
      <div class="formModal-container" id="formModalEditarMiembros">
        <form class="formModal-content" method="post" enctype="multipart/form-data">
          <a class="btnCerrarFormModal" href="" id="intento45">X</a>
          <h3 class="form-titulo">Editar Perfil</h3>
          <input name="idPerfil" type="hidden" value="'.$row['perfil_id'].'">
          <div class="inpText-content">
            <label for="editarUsuario" class="labelText">Usuario</label>
            <input type="text" class="inpText" name="editarUsuario" value="'.$row['usuario'].'" id="editarUsuario" placeholder="Usuario">
          </div>
          <div class="inpText-content">
            <label for="editarPassword" class="labelText">Contraseña</label>
            <input type="password" class="inpText" name="editarPassword" id="editarPassword" placeholder="Contraseña">
          </div>
          <div class="inpText-content">
            <img src="'.$row['photo'].'" width="20%" class="img-circle">
            <input type="hidden" value="'.$row['photo'].'" name="cargadoImagen">
            <input type="file" name="updateImagen" value="'.$row['photo'].'" class="btn btn-default" id="cambiarFotoPerfil" style="display:inline-block; margin:10px 0">
          </div>
          <div class="inpSelect-content">
            <select type="text" class="inpSelect" name="editarPerfil">
              <option value="">Perfil</option>
              <option '. ($row['rol'] == '0' ? 'selected' : '')  .' value="0">Administrador</option>
              <option '. ($row['rol'] == '1' ? 'selected' : '' ) .' value="1">Editor</option>
            </select>
          </div>
          <div class="inpSelect-content">
            <select type="text" class="inpSelect" name="editarCiudad">
              <option value="">Ciudad</option>
              <option '. ($row['id_ciudad'] == '1' ? 'selected' : '')  .' value="1">Bucaramanga</option>
              <option '. ($row['id_ciudad'] == '2' ? 'selected' : '')  .' value="2">Bogota</option>
            </select>
          </div>
          <div class="inpText-content">
            <label for="editarEmailNuevo" class="labelText">Email</label>
            <input type="email" class="inpText" value="'.$row['email'].'" name="editarEmailNuevo" id="editarEmailNuevo" placeholder="Email">
          </div>
          <div class="inpSubmit-content">
            <input type="submit" class="inpSubmit" value="Guardar">
          </div>
        </form>
      </div>';
      
      echo $html;
    }
  }
}

if ( isset($_POST['perfil_id']) )  obtener_perfil($_POST['perfil_id']);

/*
let estadoPedido = dataset.id = estado_pedido + 1
let pedidoId = id

//UPDATE pedido SET estado_pedido = 3 WHERE id = 4
//UPDATE pedido SET estado_pedido = estadoPedido WHERE id = pedidoId

*/

/*
//SELECT * FROM pedido WHERE celular_referido = '680004' && estado_pedido = 4

*/

/*
//SELECT * FROM `afiliado` WHERE celular = '3153855955'

*/
