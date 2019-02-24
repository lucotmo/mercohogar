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


function cambiar_estado_pedido($idPedido) {

  $sql = "UPDATE pedido
  SET estado_pedido = estado_pedido + 1
  WHERE id = ?";

  $data = array($idPedido);

  $result = db_query($sql, $data);
  
  if( empty($result) ) {
  	$result[]= "No existen pedidos para $idPerfil";
  }else{
    return $result;
  }
  
  echo json_decode($result);
}

if ( isset($_POST['id_cambio']) )  cambiar_estado_pedido($_POST['id_cambio']);




function ver_afiliado ($idAfiliado) {
  $sql = "SELECT *
    FROM afiliado
    WHERE id = ?";

  $data = array($idAfiliado);

  $result = db_query($sql, $data, true);

  echo '<div class="vistaRespuesta">
  <div class="vistaDelPedido">
    <a class="btnCerrarVistaPedido" href="">X</a>
    <h1 class="title__titulo">Datos</h1>';
  echo '<table class="table-responsive">
    <thead>
      <tr>
        <th>Celular</th>
        <th>Nombre</th>
        <th>Ciudad</th>
        <th>Barrio</th>
        <th>Direccion</th>
        <th></th>
      </tr>
    </thead>';
    if ( count($result) == 0 ){
    echo "No existen pedidos para $idAfiliado";
    }else{
    foreach ($result as $row) {
    echo '<tbody>
      <tr>
        <td>'.$row['celular'].'</td>
        <td>'.$row['nombre'].' '.$row['apellidos'].'</td>
        <td>'.$row['ciudad'].'</td>
        <td>'.$row['barrio'].'</td>
        <td>'.$row['direccion'].'</td>
      </tr>
    </tbody>';
    }
    }
    echo '</table><br>';


    echo '<table class="table-responsive">
    <thead>
      <tr>
        <th>Tipo Docuento</th>
        <th>Documento</th>
        <th>Cuenta Bancaria</th>
        <th>Banco</th>
        <th>Tipo cuenta</th>
        <th>Correo</th>
        <th></th>
      </tr>
    </thead>';
  if ( count($result) == 0 ){
  echo "No existen pedidos para $idAfiliado";
  }else{
    foreach ($result as $row) {
    echo '<tbody>
      <tr>
        <td>'.$row['tipo_doc'].'</td>
        <td>'.$row['documento'].'</td>
        <td>'.$row['cuenta_bancaria'].'</td>
        <td>'.$row['banco'].'</td>
        <td>'.$row['tipo_cuenta'].'</td>
        <td>'.$row['correo'].'</td>
      </tr>
    </tbody>';
    }
  }
    echo '</table><br>';
  echo ' </div>
  </div>';
}

if ( isset($_POST['id_afiliado']) )  ver_afiliado($_POST['id_afiliado']);


function ver_cliente ($idCliente) {
  $sql = "SELECT *
    FROM cliente
    WHERE id_cliente = ?";

  $data = array($idCliente);

  $result = db_query($sql, $data, true);

  echo '<div class="vistaRespuesta">
  <div class="vistaDelPedido">
    <a class="btnCerrarVistaPedido" href="">X</a>
    <h1 class="title__titulo">Datos</h1>';
  echo '<table class="table-responsive">
    <thead>
      <tr>
        <th>Celular</th>
        <th>Nombre</th>
        <th>Ciudad</th>
        <th>Barrio</th>
        <th>Direccion</th>
        <th></th>
      </tr>
    </thead>';
  if ( count($result) == 0 ){
    echo "No existen pedidos para $idCliente";
  }else{
    foreach ($result as $row) {
      echo '<tbody>
        <tr>
          <td>'.$row['celular'].'</td>
          <td>'.$row['nombre'].' '.$row['apellidos'].'</td>
          <td>'.$row['id_ciudad'].'</td>
          <td>'.$row['barrio'].'</td>
          <td>'.$row['direccion'].'</td>
        </tr>
      </tbody>';
    }
  }
    echo '</table><br>';



  echo ' </div>
  </div>';
}

if ( isset($_POST['id_cliente']) )  ver_cliente($_POST['id_cliente']);


function form_afiliado ($idAfiliado) {
  $sql = "SELECT *
    FROM afiliado
    WHERE id = ?";

  $data = array($idAfiliado);

  $result = db_query($sql, $data, true);

  if ( count($result) == 0 ){
    echo "No existen pedidos para $idAfiliado";
  }else{
    foreach ($result as $row) {
      echo '
      <div class="formModal-container" id="formModalEditarCliente">
        <form class="formModal-content" method="post">
          <a class="btnCerrarFormModal" href="" >X</a>
          <h3 class="form-titulo">Editar Cliente</h3>
          <div class="inpText-container">
            <div class="inpText-content">
              <label class="labelText" for="celular">Celular</label>
              <input type="text" class="inpText" name="celular" value="'.$row['celular'].'" id="celular" placeholder="Celular">
            </div>
            <div class="inpText-content">
              <label class="labelText" for="nombre">Nombre</label>
              <input type="text" class="inpText" name="nombre" value="'.$row['nombre'].'" id="nombre" placeholder="Nombre">
            </div>
          </div>
          <div class="inpText-container">
            <div class="inpSelect-content">
              <select type="text" class="inpSelect" name="ciudad" value="'.$row['ciudad'].'" id="ciudad" placeholder="Ciudad">
                <option value="">Seleciona una ciudad</option>
                <option value="1">Bucaramanga</option>
                <option value="2">Giron</option>
                <option  value="3">Floridablanca</option>
                <option value="4">Piedecuesta</option>
              </select>
            </div>
            <div class="inpText-content">
              <label class="labelText" for="barrio">Barrio</label>
              <input type="text" class="inpText" name="barrio" value="'.$row['barrio'].'" id="barrio" placeholder="Barrio">
            </div>
          </div>
          <div class="inpText-container">
            <div class="inpText-content">
              <label class="labelText" for="direccion">Direccion</label>
              <input type="text" class="inpText" name="direccion" value="'.$row['direccion'].'" id="direccion" placeholder="Direccion">
            </div>
          </div>
          <div class="inpText-container">
            <div class="inpSelect-content">
              <select class="inpSelect" name="tipoDoc">
                <option value="">Seleccion</option>
                <option  value="1">C.C</option>
                <option  value="2">T.I</option>
              </select>
            </div>
            <div class="inpText-content">
              <label class="labelText" for="documento">Documento</label>
              <input type="text" class="inpText" name="documento" value="'.$row['documento'].'" id="documento" placeholder="Documento">
            </div>
            <div class="inpText-content">
              <label class="labelText" for="cuenta_bancaria">Cuenta Bancaria</label>
              <input type="text" class="inpText" name="cuenta_bancaria" value="'.$row['cuenta_bancaria'].'" id="cuenta_bancaria" placeholder="Cuenta Bancaria">
            </div>
          </div>
          <div class="inpText-container">
            <div class="inpText-content">
              <label class="labelText" >Banco</label>
              <select class="inpSelect" name="Banco" >
                <option value="">Seleccion</option>
                <option  value="1">Bancolombia</option>
                <option value="2">BBVA</option>
                <option value="3">Caja Social</option>
                <option value="4">Davivienda</option>
                <option value="5">AV villas</option>
              </select>
            </div>
            <div class="inpText-content">
              <label class="labelText" >Tipo de cuenta</label>
              <select class="inpSelect" name="Tipo de cuenta" >
                <option value="">Seleccion</option>
                <option value="1">Ahorro</option>
                <option value="2">Corriente</option>
              </select>
          </div>
          <div class="inpText-content">
            <label class="labelText" for="correo">Correo</label>
            <input type="text" class="inpText" name="correo" value="'.$row['correo'].'" id="correo" placeholder="Correo">
          </div>
          <div class="inpText-container">
            <div class="inpSubmit-content">
              <input type="submit" class="inpSubmit" value="Guardar">
            </div>
          </div>

        </form>
      </div>';
    }
  }
}

if ( isset($_POST['id_editAfiliado']) )  form_afiliado($_POST['id_editAfiliado']);


function form_cliente ($idCliente) {
  $sql = "SELECT *
    FROM cliente
    WHERE id_cliente = ?";

  $data = array($idCliente);

  $result = db_query($sql, $data, true);

  if ( count($result) == 0 ){
    echo "No existen pedidos para $idCliente";
  }else{
    foreach ($result as $row) {
      echo '<div class="formModal-container" id="formModalEditarCliente">
      <form class="formModal-content" method="post">
        <a class="btnCerrarFormModal" href="" >X</a>
        <h3 class="form-titulo">Editar Cliente</h3>
        <div class="inpText-content">
          <label for="celularCliente" class="labelText">Celular</label>
          <input type="text" class="inpText" name="celularCliente" value="'.$row['celular'].'" id="celularCliente" placeholder="Celular">
        </div>
        <div class="inputText-container">
          <div class="inpText-content">
            <label for="nombreCliente" class="labelText">Nombre</label>
            <input type="text" class="inpText" name="nombreCliente" value="'.$row['nombre'].'" id="nombreCliente" placeholder="Nombre">
          </div>
          <div class="inpText-content">
            <label for="apellidosCliente" class="labelText">Apellidos</label>
            <input type="text" class="inpText" name="apellidosCliente" value="'.$row['apellidos'].'" id="apellidosCliente" placeholder="Nombre">
          </div>
        </div>
        <div class="inputText-container">
          <div class="inpText-content">
            <label for="ciudadCliente" class="labelText">Ciudad</label>
            <input type="text" class="inpText" name="ciudadCliente" value="'.$row['id_ciudad'].'" id="ciudadCliente" placeholder="Nombre">
          </div>
          <div class="inpText-content">
            <label for="barrioCliente" class="labelText">Barrio</label>
            <input type="text" class="inpText" name="barrioCliente" value="'.$row['barrio'].'" id="barrioCliente" placeholder="Nombre">
          </div>
        </div>

        <div class="inpText-content">
          <label for="direccionCliente" class="labelText">Direccion</label>
          <input type="text" class="inpText" name="direccionCliente" value="'.$row['direccion'].'" id="direccionCliente" placeholder="Contraseña">
        </div>
        <div class="inpSubmit-content">
          <input type="submit" class="inpSubmit" value="Guardar">
        </div>
      </form>
    </div>';
    }
  }
}

if ( isset($_POST['id_editCliente']) )  form_cliente($_POST['id_editCliente']);


