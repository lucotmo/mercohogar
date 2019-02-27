<?php

require_once (dirname(__FILE__) ."/../../../backend/models/conexion.php");

/* funciones generales */

function db_query ( $sql, $data = array(), $is_search = false, $search_one = false ) {

	//echo "<pre>".print_r($data,1)."</pre>";exit;
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


function select_ciudades(){
	$ciudades = "SELECT
	* FROM ciudades";

	$r_ciudades= db_query($ciudades, array(), true);
	return $r_ciudades;
}

function select_ciudad_negocio(){
	$ciudades_negocio = "SELECT
	* FROM ciudad_negocio";

	$r_ciudades_negocio= db_query($ciudades_negocio, array(), true);
	return $r_ciudades_negocio;
}

function select_categorias(){
	$categorias = "SELECT
	* FROM categoria";

	$r_categorias= db_query($categorias, array(), true);
	return $r_categorias;
}

function select_medidas(){
	$medidas = "SELECT
	* FROM medidas";

	$r_medidas= db_query($medidas, array(), true);
	return $r_medidas;
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

/* fin de funciones generales */




/* producto */

function crear_producto($imagen, $titulo, $medida, $precio_viejo, $precio_actual, $promocion, $id_ciudad, $id_categoria) {
  $sql = "INSERT INTO producto
  (imagen, titulo, medida, precio_viejo, precio_actual, promocion, id_ciudad, id_categoria)
  VALUES( ?, ?, ?, ?, ?, ?, ?, ? )";

  $data = array(
    $imagen,
    $titulo,
    $medida,
    $precio_viejo,
    $precio_actual,
    $promocion,
    $id_ciudad,
    $id_categoria);


  $result = db_query($sql, $data);

  if ($result) {
    $res = array(
      'err' => false,
      'msg' => 'el envio fue correcto'
    );
  } else {
    $res = array(
      'err' => true,
      'msg' => 'Ocurrió un error al crear el producto.'
    );
  }

  //header( 'Content-type: application/json' );
  //echo json_encode($res);
}

if ( isset($_POST['tituloProducto']) ){
  if ( isset($_FILES["imagenProducto"]["tmp_name"]) ){
    $imagen = $_FILES["imagenProducto"]["tmp_name"];
    $name = $_FILES["imagenProducto"]["name"];
    $imagedetails = getimagesize($_FILES['imagenProducto']['tmp_name']);
    $width = $imagedetails[0];
    $height = $imagedetails[1];
    $resultname = explode('.',$name);

    $borrar = glob(dirname(__FILE__) ."/../../../backend/views/imagenes/productos/temp/*");
    foreach($borrar as $file){
      unlink($file);
    }

    $aleatorio = mt_rand(100, 999);
    $rutaInicial = dirname(__FILE__) ."/../../../backend/views/imagenes/productos/".$resultname[0]."".$aleatorio.".jpg";
    $ruta = explode("backend/",$rutaInicial)[1];
    $origen = imagecreatefromjpeg($imagen);
    $destino = imagecrop($origen, ["x"=>($width - 188) / 2, "y"=>($height - 188) / 2, "width"=>188, "height"=>188]);
    imagejpeg($destino, $rutaInicial);
  }

  crear_producto(
    $ruta,
    $_POST['tituloProducto'],
    $_POST['medidaProducto'],
    $_POST['precioProductoViejo'],
    $_POST['precioProductoActual'],
    $_POST['promocionProducto'],
    $_POST['ciudadProducto'],
    $_POST['categoriaProducto']
  );
}

function ver_form_editar_producto ($idProducto) {
  $sql = "SELECT *
    FROM producto
    WHERE producto_id = ?";

  $data = array($idProducto);

  $result = db_query($sql, $data, true);

  if ( count($result) == 0 ){
    echo "No existen pedidos para $idProducto";
  }else{
    foreach ($result as $row) {
      echo '
    <div class="formModal-container" id="formModalEditarProduct">
      <form class="formModal-content" method="post" enctype="multipart/form-data">
        <a class="btnCerrarFormModal" href="" >X</a>
        <div class="" style="width: 100%">
          <div class="inpText-container" style="display:flex; justify-content:space-between; align-items:center">
            <div class="content-subirFoto" style="margin-left:.5em">
              <input type="file" name="imagenEditarProducto" value="'.$row['imagen'].'" class="imagenProducto" id="cargarFoto">
              <label for="cargarFoto" class="input" id="arrastrarImagenProducto" >
                <img src="'.$row['imagen'].'" alt="" style="width:60px; heigth: 60px;">
                <i class="fa fa-camera icon-camera"></i>
              </label>
            </div>
            <div class="inpText-content">
              <label class="labelText" for="">Titulo</label>
              <input type="hidden"  name="idEditarProducto" value="'.$row['producto_id'].'" >
              <input class="inpText" name="tituloEditarProducto" value="'.$row['titulo'].'" type="text" placeholder="Título..." class="formTitle" required></div>
            <div class="inpText-content">
              <label class="labelText" for="">Medida</label>
              <select class="inpSelect" type="text" name="medidaEditarProducto" required>
                <option value="">Seleccion</option>';
                $m = select_medidas();
                foreach($m as $medida){
                  echo '<option ';
                  echo ( ( $medida['nombre_medida'] == $row['medida'] ) ? 'selected' : '' );
                  echo ' value="'.$medida['nombre_medida'].'">';
                  echo ( ucwords(strtolower($medida['nombre_medida'])) );
                  echo '</option>';
                }
          echo '</select>
              </div>
            </div>
            <div class="inpText-container">
              <div class="inpText-content">
                <label class="labelText" for="">Precio Viejo</label>
                <input class="inpText" name="precioEditarProductoViejo" value="'.$row['precio_viejo'].'" type="text" placeholder="Precio Viejo..." class="formPrecioViejo">
              </div>
              <div class="inpText-content">
                <label class="labelText" for="">Precio</label>
                <input class="inpText" name="precioEditarProductoActual" value="'.$row['precio_actual'].'" type="text" placeholder="Precio..." class="formPrecioActual" required>
              </div>
              <div class="inpText-content">
                <label class="labelText" for="">Promocion</label>
                <select class="inpSelect" type="text" name="promocionEditarProducto">
                  <option value="">promo...</option>
                  <option '; echo ( ($row['promocion'] == 'oferta') ? 'selected' : '' ); echo ' value="oferta">Oferta</option>
                  <option '; echo ( ($row['promocion'] == 'nuevo') ? 'selected' : '' ); echo ' value="nuevo">Nuevo</option>

                </select>
              </div>
              <div class="inpText-content">
                <label class="labelText" for="">Ciudad</label>
                <select class="inpSelect" type="text" required name="ciudadEditarProducto">
                  <option value="">Ciudad...</option>';
                  $cn = select_ciudad_negocio();
                  foreach($cn as $ciudad){
                    echo '<option ';
                    echo ( ( $ciudad['id_ciudad_negocio'] == $row['id_ciudad'] ) ? 'selected' : '' );
                    echo ' value="'.$ciudad['id_ciudad_negocio'].'">';
                    echo ( ucwords(strtolower($ciudad['nombre_ciudad'])) );
                    echo '</option>';
                  }
            echo '</select>
              </div>
              <div class="inpText-content">
                <label class="labelText" for="">Categoria</label>
                <select class="inpText" type="text" required name="categoriaEditarProducto">
                  <option value="">Categoria</option>';
                  $categorias = select_categorias();
                  foreach($categorias as $categoria){
                    echo '<option ';
                    echo ( ( $categoria['categoria_id'] == $row['id_categoria'] ) ? 'selected' : '' );
                    echo ' value="'.$categoria['categoria_id'].'">';
                    echo ( ucwords(strtolower($categoria['nombre_categoria'])) );
                    echo '</option>';
                  }
            echo '</select>
              </div>
            </div>
            <div class="inpSubmit-content">
              <input name="fotoAntigua" type="hidden" value="'.$row['imagen'].'">
              <input class="inpSubmit" type="submit" id="guardarProducto" value="Guardar" >
            </div>
          </div>
          <div id="infoTamañoImagen"></div>
        </form>
      </div>';
    }
  }
}

if ( isset($_POST['id_producto']) )  ver_form_editar_producto($_POST['id_producto']);


function editar_form_producto ( $imagen, $titulo, $medida, $precio_viejo, $precio_actual, $promocion, $id_ciudad, $id_categoria, $idProducto){
  $sql= "UPDATE producto
	SET  titulo = ?, medida = ?, precio_viejo = ?, precio_actual = ?, promocion = ?, id_ciudad = ?, id_categoria = ?
  WHERE producto_id = $idProducto";
  if( !is_null($imagen) ) {
		$sql= "UPDATE producto
		SET  imagen = ?, titulo = ?, medida = ?, precio_viejo = ?, precio_actual = ?, promocion = ?, id_ciudad = ?, id_categoria = ?
		WHERE producto_id = $idProducto";
  }
  $data =  array();
	if(!is_null(    $imagen )) {
		$data[] = $imagen;
	}
	$data[] = $titulo;
	$data[] = $medida;
	$data[] = $precio_viejo;
	$data[] = $precio_actual;
	$data[] = $promocion;
	$data[] = $id_ciudad;
	$data[] = $id_categoria;
  //echo "<pre>".print_r($data,1)."</pre>";
  //exit;
  $result = db_query($sql, $data);

  if ($result) {
    $res = array(
      'err' => false,
      'msg' => 'Tu registro se efectuó con éxito'
    );
  } else
    $res = array(
      'err' => true,
      'msg' => 'Ocurrió un error'
    );
  }
  //header( 'Content-type: application/json' );
  //echo json_encode($res);


if ( isset($_POST['idEditarProducto'])) {

  if ( isset($_POST['tituloEditarProducto']) ){

    $ruta = null;
    if ( !empty($_FILES["imagenEditarProducto"]["tmp_name"]) ){
      $imagen = $_FILES["imagenEditarProducto"]["tmp_name"];
      $imagedetails = getimagesize($_FILES['imagenEditarProducto']['tmp_name']);

      $width = $imagedetails[0];
      $height = $imagedetails[1];
      $name = $_FILES["imagenEditarProducto"]["name"];

      $resultname = explode('.',$name);

      $aleatorio = mt_rand(100, 999);
      //$rutaInicial = dirname(__FILE__) ."/../backend/views/imagenes/productos/".$resultname[0]."".$aleatorio.".jpg";
      $rutaInicial = dirname(dirname(__FILE__)) ."/imagenes/productos/".$resultname[0]."".$aleatorio.".jpg";
      //echo $rutaInicial;
      //$rutaInicial = dirname(dirname(__FILE__)) ."/imagenes/productos/agraz402139.jpg";
      /* if (file_exists($rutaInicial)) {
      	echo "El fichero $nombre_fichero existe";
      } else {
      	echo "El fichero $nombre_fichero no existe";
      } */
      //exit;
      if ( strpos($rutaInicial, 'backend\\' ) !== false) {
      	$ruta = explode("backend\\",$rutaInicial);
      } else {
      	$ruta = explode("backend/",$rutaInicial);
      }
      //echo $ruta;
      //print_r($ruta);
      //exit;
      $ruta = $ruta[count($ruta)-1];
      //echo $ruta;
      //exit;

      $origen = imagecreatefromjpeg($imagen);
      $destino = imagecrop($origen, ["x"=>($width - 188) / 2, "y"=>($height - 188) / 2, "width"=>188, "height"=>188]);

      imagejpeg($destino, $rutaInicial);
      //Imagedestroy($destino, $ruta);
      //$borrar = glob(dirname(__FILE__) ."/../../../backend/views/imagenes/productos/temp/*");
      $borrar = glob(dirname(dirname(__FILE__)) . "/imagenes/productos/temp/*");
      foreach($borrar as $file){
        unlink($file);
      }
    }

    /* if ( $ruta == "views/imagenes/producto.jpg" || $ruta == $_POST["fotoAntigua"] ){
      $ruta = $_POST["fotoAntigua"];
    }else{
      unlink($_POST["fotoAntigua"]);
    } */
    //echo "<pre>".print_r($ruta,1)."</pre>";
    //exit;
    editar_form_producto(
      $ruta,
      $_POST['tituloEditarProducto'],
      $_POST['medidaEditarProducto'],
      $_POST['precioEditarProductoViejo'],
      $_POST['precioEditarProductoActual'],
      $_POST['promocionEditarProducto'],
      $_POST['ciudadEditarProducto'],
      $_POST['categoriaEditarProducto'],
      $_POST['idEditarProducto']
    );
  }
}

/* fin producto */

/* pedido */

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
      echo '
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
              <option value="">Ciudad</option>';
              $cn = select_ciudad_negocio();
              foreach($cn as $ciudad){
                echo '<option ';
                echo ( ( $ciudad['id_ciudad_negocio'] == $row['id_ciudad'] ) ? 'selected' : '' );
                echo ' value="'.$ciudad['id_ciudad_negocio'].'">';
                echo ( ucwords(strtolower($ciudad['nombre_ciudad'])) );
                echo '</option>';
              }
      echo '</select>
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


/* fin pedido */


/* afiliado */

function ver_afiliado ($idAfiliado) {
  $sql = "SELECT *, a.nombre as nombre_afiliado,
    ci.nombre as nombre_ciudad,
    tp.nombre_tipo,
    b.nombre_banco,
    tc.nombre_tipo_cuenta
    FROM afiliado as a
    LEFT JOIN ciudades as ci ON a.ciudad = ci.ciudad_id
    LEFT JOIN tipo_doc as tp ON a.tipo_doc = tp.nombre_tipo
    LEFT JOIN banco as b ON a.banco = b.banco_id
    LEFT JOIN tipo_cuenta as tc ON a.tipo_cuenta = tc.nombre_tipo_cuenta
    WHERE a.id = ?";

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
        <td>'.$row['nombre_afiliado'].' '.$row['apellidos'].'</td>
        <td>'.$row['nombre_ciudad'].'</td>
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
        <td>'.$row['nombre_tipo'].'</td>
        <td>'.$row['documento'].'</td>
        <td>'.$row['cuenta_bancaria'].'</td>
        <td>'.$row['nombre_banco'].'</td>
        <td>'.$row['nombre_tipo_cuenta'].'</td>
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
      <div class="formModal-container" id="formModalEditarAfiliado">
        <form class="formModal-content" method="post">
          <a class="btnCerrarFormModal" href="" >X</a>
          <h3 class="form-titulo">Editar Afiliado</h3>
          <div class="inpText-container">
            <div class="inpText-content">
              <label class="labelText" for="celular">Celular</label>
              <input type="hidden" class="inpText" name="idAfiliado" value="'.$row['id'].'">
              <input type="text" class="inpText" name="celularAfiliado" value="'.$row['celular'].'" id="celular" placeholder="Celular">
            </div>
            <div class="inpText-content">
              <label class="labelText" for="nombre">Nombre</label>
              <input type="text" class="inpText" name="nombreAfiliado" value="'.$row['nombre'].'" id="nombre" placeholder="Nombre">
            </div>
          </div>
          <div class="inpText-container">
            <div class="inpSelect-content">
              <select type="text" class="inpSelect" name="ciudadAfiliado" id="ciudad" placeholder="Ciudad">
                <option value="">Seleciona una ciudad</option>';
            $c = select_ciudades();
            foreach($c as $ciudad){
              echo '<option ';
              echo ( ( $ciudad['ciudad_id'] == $row['ciudad'] ) ? 'selected' : '' );
              echo ' value="'.$ciudad['ciudad_id'].'">';
              echo ( ucwords(strtolower($ciudad['nombre'])) );
              echo '</option>';
            }
        echo '</select>
            </div>
            <div class="inpText-content">
              <label class="labelText" for="barrio">Barrio</label>
              <input type="text" class="inpText" name="barrioAfiliado" value="'.$row['barrio'].'" id="barrio" placeholder="Barrio">
            </div>
          </div>
          <div class="inpText-container">
            <div class="inpText-content">
              <label class="labelText" for="direccion">Direccion</label>
              <input type="text" class="inpText" name="direccionAfiliado" value="'.$row['direccion'].'" id="direccion" placeholder="Direccion">
            </div>
          </div>
          <div class="inpText-container">
            <div class="inpSelect-content">
              <select class="inpSelect" name="tipoDocAfiliado">
                <option value="">Seleccion</option>';
                $doc = select_tdoc();
			          foreach ($doc as $do){
                  echo '<option ';
                  echo ( ( $do['tipo_doc_id'] == $row['tipo_doc'] ) ? 'selected' : '' );
                  echo ' value="'.$do['tipo_doc_id'].'">';
                  echo ( $do['nombre_tipo'] );
                  echo '</option>';
                }
              echo '</select>
            </div>
            <div class="inpText-content">
              <label class="labelText" for="documento">Documento</label>
              <input type="text" class="inpText" name="documentoAfiliado" value="'.$row['documento'].'" id="documento" placeholder="Documento">
            </div>
            <div class="inpText-content">
              <label class="labelText" for="cuenta_bancaria">Cuenta Bancaria</label>
              <input type="text" class="inpText" name="cuentaBancariaAfiliado" value="'.$row['cuenta_bancaria'].'" id="cuenta_bancaria" placeholder="Cuenta Bancaria">
            </div>
          </div>
          <div class="inpText-container">
            <div class="inpText-content">
              <label class="labelText" >Banco</label>
              <select class="inpSelect" name="bancoAfiliado" >
                <option value="">Seleccion</option>';
                $bancos = select_banco();
			          foreach ($bancos as $banco){
                  echo '<option ';
                  echo ( ( $banco['banco_id'] == $row['banco'] ) ? 'selected' : '' );
                  echo ' value="'.$banco['banco_id'].'">';
                  echo ( ucwords(strtolower($banco['nombre_banco'])) );
                  echo '</option>';
                }
              echo '</select>
            </div>
            <div class="inpText-content">
              <label class="labelText" >Tipo de cuenta</label>
              <select class="inpSelect" name="tipoCuentaAfiliado" >
                <option value="">Seleccion</option>';
                $tcuentas = select_tcuenta();
			          foreach ($tcuentas as $tcuenta){
                  echo '<option ';
                  echo ( ( $tcuenta['tipo_id'] == $row['tipo_cuenta'] ) ? 'selected' : '' );
                  echo ' value="'.$tcuenta['tipo_id'].'">';
                  echo ( ucwords(strtolower($tcuenta['nombre_tipo_cuenta'])) );
                  echo '</option>';
                }
          echo '</select>
          </div>
          <div class="inpText-content">
            <label class="labelText" for="correo">Correo</label>
            <input type="text" class="inpText" name="correoAfiliado" value="'.$row['correo'].'" id="correo" placeholder="Correo">
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

function update_form_afiliados($celular, $nombre, $ciudad, $barrio, $direccion, $tipoDoc, $documento, $cuentaBancaria, $banco, $tipoCuenta, $correo, $id) {
  $sql = "UPDATE afiliado
  SET celular = ?, nombre = ?, ciudad = ?, barrio = ?, direccion = ?, tipo_doc = ?, documento = ?, cuenta_bancaria = ?, banco = ?, tipo_cuenta = ?, correo = ?
  WHERE id = $id";
  $data = array(
    $celular,
    $nombre,
    $ciudad,
    $barrio,
    $direccion,
    $tipoDoc,
    $documento,
    $cuentaBancaria,
    $banco,
    $tipoCuenta,
    $correo
  );

  $result = db_query($sql, $data);

  if ($result) {
    $res = array(
      'err' => false,
      'msg' => 'Tu registro se efectuó con éxito. En breve recibirás un email con la agenda del bloque que elegiste.'
    );

    //$registro = existe_registro($email);
    //enviar_email($registro);
  } else {
    $res = array(
      'err' => true,
      'msg' => 'Ocurrió un error con el registro. Intenta nuevamente.'
    );
  }
  //header( 'Content-type: application/json' );
  //echo json_encode($res);
}

if ( isset($_POST['idAfiliado']) )
  update_form_afiliados(
    $_POST['celularAfiliado'],
    $_POST['nombreAfiliado'],
    $_POST['ciudadAfiliado'],
    $_POST['barrioAfiliado'],
    $_POST['direccionAfiliado'],
    $_POST['tipoDocAfiliado'],
    $_POST['documentoAfiliado'],
    $_POST['cuentaBancariaAfiliado'],
    $_POST['bancoAfiliado'],
    $_POST['tipoCuentaAfiliado'],
    $_POST['correoAfiliado'],
    $_POST['idAfiliado']
);

/* fin afiliado */

/* cliente */

function ver_cliente ($idCliente) {
  $sql = "SELECT *, c.nombre as nombre_cliente,
    ci.nombre as nombre_ciudad
    FROM cliente as c
    LEFT JOIN ciudades as ci ON c.id_ciudad = ci.nombre
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
          <td>'.$row['nombre_cliente'].' '.$row['apellidos'].'</td>
          <td>'.$row['nombre_ciudad'].'</td>
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
      echo '<div class="formModal-container">
      <form class="formModal-content" id="formModalEditarCliente" method="post">
        <a class="btnCerrarFormModal" href="" >X</a>
        <h3 class="form-titulo">Editar Cliente</h3>
        <div class="inpText-content">
          <label for="celularCliente" class="labelText">Celular</label>
          <input type="hidden" class="inpText" name="idCliente" value="'.$row['id_cliente'].'" id="id_cliente">
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
            <label class="labelText" >Ciudad</label>
            <select class="inpSelect" name="ciudadCliente" >
              <option value="">Seleccion</option>';
              $c = select_ciudades();
              foreach($c as $ciudad){
                echo '<option ';
                echo ( ( $ciudad['ciudad_id'] == $row['id_ciudad'] ) ? 'selected' : '' );
                echo ' value="'.$ciudad['ciudad_id'].'">';
                echo ( ucwords(strtolower($ciudad['nombre'])) );
                echo '</option>';
              }
        echo '</select>
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


function update_form_clientes($celular, $nombre, $apellidos, $ciudad, $barrio, $direccion, $id) {
  $sql = "UPDATE cliente
  SET celular = ?, nombre = ?, apellidos = ?, id_ciudad = ?, barrio = ?, direccion = ?
  WHERE id_cliente = $id";
  $data = array(
    $celular,
    $nombre,
    $apellidos,
    $ciudad,
    $barrio,
    $direccion
  );

  $result = db_query($sql, $data);

  if ($result) {
    $res = array(
      'err' => false,
      'msg' => 'Tu registro se efectuó con éxito. En breve recibirás un email con la agenda del bloque que elegiste.'
    );

    //$registro = existe_registro($email);
    //enviar_email($registro);
  } else {
    $res = array(
      'err' => true,
      'msg' => 'Ocurrió un error con el registro. Intenta nuevamente.'
    );
  }
  //header( 'Content-type: application/json' );
  //echo json_encode($res);
}

if ( isset($_POST['idCliente']) )

  update_form_clientes(
    $_POST['celularCliente'],
    $_POST['nombreCliente'],
    $_POST['apellidosCliente'],
    $_POST['ciudadCliente'],
    $_POST['barrioCliente'],
    $_POST['direccionCliente'],
    $_POST['idCliente']
  );

/* fin cliente */

