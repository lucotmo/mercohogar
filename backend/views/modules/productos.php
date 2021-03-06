<?php

session_start();

if(!$_SESSION["validar"]){

	header("location:ingreso");

	exit();

}

require "views/modules/app.php";
require "views/modules/header.php";
require "views/modules/navegacionStart.php";

$categorias = new Categorias();
$categorias -> seleccionarCategoriasController();

require "views/modules/navegacionEnd.php";
?>


<div class="mainReset-content">
  <div class="title-content">
    <h1 class="title__titulo"><?php echo $_GET["action"]; ?></h1>
    <form class="buscar" name="titulo" action="" method="get">
      <input class="filtro" type="text" placeholder="Producto..." id="search-item">
      <button type="submit" class="icono fa fa-search"></button>
    </form>
  </div>
  <div class="btnAgregar-content">
    <button id="btnAgregarProducto" class="btnAgregar">Nuevo Producto</button>
  </div>
  <div class="list-product-exits">
    <h3>Lista de productos</h3>
    <?php
      $mostrarProducto = new gestorProductos();
      $mostrarProducto->mostrarProductoController();
      $mostrarProducto->filtrarProductoController();
      $mostrarProducto->borrarProductoController();
    ?>
  </div>

</div>



<div class="container-formularios">
  <div class="formModal-container" id="formModalNuevoProduct" style="display:none">
    <form class="formModal-content" method="post" enctype="multipart/form-data">
      <a class="btnCerrarFormModal" href="" >X</a>
      <div class="" style="width: 100%">
        <div class="inpText-container" style="display:flex; justify-content:space-between; align-items:center">
          <div class="content-subirFoto">
            <input type="file" name="imagenProducto" class="imagenProducto" id="cargarFoto">
            <label for="cargarFoto" class="input" id="arrastrarImagenProducto">
              <img src="views/imagenes/producto.jpg" alt="" style="width:48px; heigth: 48px">
              <i class="fa fa-camera icon-camera"></i>
            </label>
          </div>
          <div class="inpText-content">
            <label class="labelText" for="">Titulo</label>
            <input class="inpText" name="tituloProducto" type="text" placeholder="Título..." class="formTitle" required></div>
          <div class="inpText-content">
            <label class="labelText" for="">Medida</label>
            <select class="inpSelect" type="text" name="medidaProducto" required>
            <?php
              $m = select_medidas();
              foreach ($m as  $medida){
              ?>
              <option value="<?php echo $medida['nombre_medida']?>"><?php echo ucwords(strtolower($medida['nombre_medida']))?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="inpText-container">
          <div class="inpText-content">
            <label class="labelText" for="">Precio Viejo</label>
            <input class="inpText" name="precioProductoViejo" type="text" placeholder="Precio Viejo..." class="formPrecioViejo">
          </div>
          <div class="inpText-content">
            <label class="labelText" for="">Precio</label>
            <input class="inpText" name="precioProductoActual" type="text" placeholder="Precio..." class="formPrecioActual" required>
          </div>
          <div class="inpText-content">
            <label class="labelText" for="">Promocion</label>
            <select class="inpSelect" type="text" name="promocionProducto">
              <option value="">promo...</option>
              <option value="oferta">Oferta</option>
              <option value="nuevo">Nuevo</option>
            </select>
          </div>
          <div class="inpText-content">
            <label class="labelText" for="">Ciudad</label>
            <select class="inpSelect" type="text" required name="ciudadProducto">
              <option value="">Ciudad...</option>
              <?php
              $cn = select_ciudad_negocio();
              foreach ($cn as  $ciudad){
              ?>
              <option value="<?php echo $ciudad['id_ciudad_negocio']?>"><?php echo ucwords(strtolower($ciudad['nombre_ciudad']))?></option>
              <?php } ?>
            </select>
          </div>
          <div class="inpText-content">
            <label class="labelText" for="">Categoria</label>
            <select class="inpText" type="text" required name="categoriaProducto">
              <option value="">Categoria</option>
              <?php
              $ca = select_categorias();
              foreach ($ca as  $categoria){
              ?>
              <option value="<?php echo $categoria['categoria_id']?>"><?php echo ucwords(strtolower($categoria['nombre_categoria']))?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="inpSubmit-content">
          <input class="inpSubmit" type="submit" id="guardarProducto" value="Guardar" >
        </div>
      </div>
      <div id="infoTamañoImagen"></div>
    </form>
  </div>
</div>



<!-- <div class="form" id="formNuevoProducto">
  <div class="title">
    <h6 >Nuevo producto</h6>
  </div>
  <form method="post" enctype="multipart/form-data">
    <div class="content-subirFoto">
      <input type="file" name="imagen" class="imagenProducto" id="subirFoto" required>
      <label for="subirFoto" class="input" id="arrastreImagenProducto">
        <img src="./views/imagenes/producto.jpg" alt="">
        <i class="fa fa-camera icon-camera"></i>
      </label>
    </div>
    <div><input name="tituloProducto" type="text" placeholder="Título..." class="formTitle" required></div>
    <div><input name="medidaProducto" type="text" placeholder="Medida..." class="formMedida" required></div>
    <div><input name="precioProductoViejo" type="text" placeholder="Precio Viejo..." class="formPrecioViejo"></div>
    <div><input name="precioProductoActual" type="text" placeholder="Precio..." class="formPrecioActual" required></div>
    <div>
      <select class="selectProducto" type="text" name="promocion">
        <option value="">promo...</option>
        <option value="oferta">Oferta</option>
        <option value="nuevo">Nuevo</option>
      </select>
    </div>
    <div>
      <select class="selectProducto" type="text" required name="ciudad">
        <option value="">Ciudad...</option>
        <option value="1">Bucaramanga</option>
        <option value="2">Bogota</option>
      </select>
    </div>
    <div>
      <select class="selectProducto" type="text" required name="categoria">
        <option value="">categoria</option>
        <option value="1">fruta</option>
        <option value="2">verduras</option>
        <option value="3">hortalizas</option>
        <option value="4">pulpas</option>
        <option value="5">emprendedores</option>
      </select>
    </div>
    <div class="content-btnGuardarProduct">
      <input class="btnGuardarProducto" type="submit" id="guardarProducto" value="Guardar" >
    </div>
  </form>
  <div id="infoTamañoImagen"></div>
</div> -->




<!-- <div class="form" id="formNuevoProducto">
  <div class="title" style="font-size:2.5em">
    <h6 >Nuevo producto</h6>
  </div>
  <form method="post" enctype="multipart/form-data">
    <div class="" style="width: 100%">
      <div class="inpText-container" style="display:flex; justify-content:space-between; align-items:center">
        <div class="content-subirFoto">
          <input type="file" name="imagen" class="imagenProducto" id="subirFoto" required>
          <label for="subirFoto" class="input" id="arrastreImagenProducto">
            <img src="./views/imagenes/producto.jpg" alt="" style="width:48px; heigth: 48px">
            <i class="fa fa-camera icon-camera"></i>
          </label>
        </div>
        <div class="inpText-content">
          <label class="labelText" for="">Titulo</label>
          <input class="inpText" name="tituloProducto" type="text" placeholder="Título..." class="formTitle" required></div>
        <div class="inpText-content">
          <label class="labelText" for="">Medida</label>
          <select class="inpSelect" type="text" name="medidaProducto" required>
          <?php
            $m = select_medidas();
            foreach ($m as  $medida){
            ?>
            <option value="<?php echo $medida['nombre_medida']?>"><?php echo ucwords(strtolower($medida['nombre_medida']))?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="inpText-container">
        <div class="inpText-content">
          <label class="labelText" for="">Precio Viejo</label>
          <input class="inpText" name="precioProductoViejo" type="text" placeholder="Precio Viejo..." class="formPrecioViejo">
        </div>
        <div class="inpText-content">
          <label class="labelText" for="">Precio</label>
          <input class="inpText" name="precioProductoActual" type="text" placeholder="Precio..." class="formPrecioActual" required>
        </div>
        <div class="inpText-content">
          <label class="labelText" for="">Promocion</label>
          <select class="inpSelect" type="text" name="promocion">
            <option value="">promo...</option>
            <option value="oferta">Oferta</option>
            <option value="nuevo">Nuevo</option>
          </select>
        </div>
        <div class="inpText-content">
          <label class="labelText" for="">Ciudad</label>
          <select class="inpSelect" type="text" required name="ciudad">
            <option value="">Ciudad...</option>
            <?php
            $cn = select_ciudad_negocio();
            foreach ($cn as  $ciudad){
            ?>
            <option value="<?php echo $ciudad['id_ciudad_negocio']?>"><?php echo ucwords(strtolower($ciudad['nombre_ciudad']))?></option>
            <?php } ?>
          </select>
        </div>
        <div class="inpText-content">
          <label class="labelText" for="">Categoria</label>
          <select class="inpText" type="text" required name="categoria">
            <option value="">Categoria</option>
            <?php
            $ca = select_categorias();
            foreach ($ca as  $categoria){
            ?>
            <option value="<?php echo $categoria['categoria_id']?>"><?php echo ucwords(strtolower($categoria['nombre_categoria']))?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="inpSubmit-content">
        <input class="inpSubmit" type="submit" id="guardarProducto" value="Guardar" >
      </div>
    </div>
  </form>
  <div id="infoTamañoImagen"></div>
</div> -->