<?php

session_start();

if(!$_SESSION["validar"]){

	header("location:ingreso");

	exit();

}

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
    <button id="btnAgregarProducto" class="btnAgregar">Nueva Categoria</button>
  </div>
  <div class="forms">
    <div class="form" id="formNuevoProducto">
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
        <div><input name="precioProductoViejo price" type="text" placeholder="Precio Viejo..." class="formPrecioViejo"></div>
        <div><input name="precioProductoActual price" type="text" placeholder="Precio..." class="formPrecioActual" required></div>
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
    </div>
    <?php
      $crearProducto = new gestorProductos();
      $crearProducto->guardarProductoController();
    ?>
  </div>
  <div class="formEditContent">
    <?php
      $mostrarProducto = new gestorProductos();
      $crearProducto->editarProductoController();
    ?>
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
