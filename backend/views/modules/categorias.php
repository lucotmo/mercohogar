<?php

session_start();

if(!$_SESSION["validar"]){

	header("location:ingreso");

	exit();

}

require "views/modules/header.php";
require "views/modules/navegacionStart.php";
require "views/modules/navegacionEnd.php";

?>

<div class="mainReset-content">
  <div class="title-content">
    <h1 class="title__titulo"><?php echo $_GET["action"]; ?></h1>
    <form class="buscar" name="titulo" action="" method="get">
      <input class="filtro" type="text" placeholder="Categoria..." id="search-item-categorias">
      <button type="submit" class="icono fa fa-search" style="pointer-events:none"></button>
    </form>
  </div>
  <div class="btnAgregar-content">
    <button class="btnAgregar" id="btnAgregarCategorias">Nueva Categoria</button>
  </div>
  <div class="formsResets">
    <div class="formGuardar-content" id="formGuardarCategorias-container" style="display:none;">
      <h3 class="title-form">Nueva Categoria</h3>
      <form method="post" class="formGuardar" id="formGuardarCategorias">
        <div class="inpsGuardar-container">
          <div class="inpGuardar-content">
            <label class="labelText" for="">Categoria</label>
            <input type="text" class="inpGuardar" name="nuevaCategoria" placeholder="Categoria">
          </div>
          <div class="inpGuardar-content">
            <label class="labelText" for="">Comision</label>
            <input type="text" class="inpGuardar" name="nuevaComision" placeholder="Comision">
          </div>
        </div>
        <div class="btnInputGuardar-content">
          <input class="btnInputGuardar" type="submit" value="Guardar">
        </div>
      </form>
    </div>
    <!-- <div class="formGuardar-content">
      <h3 class="title-form">Editar Categoria</h3>
      <form action="" class="formGuardar">
        <div class="inpsGuardar-container">
          <div class="inpGuardar-content">
            <label class="labelText" for="">Categoria</label>
            <input type="text" class="inpGuardar" name="updateCategoria" placeholder="Categoria">
          </div>
          <div class="inpGuardar-content">
            <label class="labelText" for="">Comision</label>
            <input type="text" class="inpGuardar" name="updateComision" placeholder="Comision">
          </div>
        </div>
        <div class="btnInputGuardar-content">
          <input class="btnInputGuardar" type="submit" value="Guardar">
        </div>
      </form>
    </div> -->
  </div>
  <?php
    $categoria = new Categorias();
    $categoria -> guardarCategoriaController();
    $categoria -> editarCategoriaController();
  ?>
  <table class="responsive-table" id="tableCategoria">
    <thead>
      <tr>
        <th>Categoria</th>
        <th>Comision</th>
        <th>Acciones</th>
        <th></th>
      </tr>
    </thead>
    <?php
      $categoria = new Categorias();
      $categoria -> mostrarCategoriasController();
      $categoria -> borrarCategoriaController();
    ?>
  </table>
</div>