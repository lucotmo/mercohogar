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
    <h1 class="title__titulo">Nuestros <?php echo $_GET["action"]; ?></h1>
  </div>
  <div class="btnAgregar-content">
    <button class="btnAgregar">Nuevo Contenido</button>
  </div>
  <div class="formsResets">

    <form action="" class="formGuardar-content">
      <h3 class="title-form">Nuevo contenido</h3>
      <div class="contentTitleContCliente">
        <div class="inpClienteTitleNuevo-content">
          <label for="titleClienteNuevo" >Titulo</label>
          <input type="text" id="titleClienteNuevo" name="titulo" class="inpClienteTitleNuevo" placeholder="Titulo">
        </div>
        <div class="inpClienteContenidoNuevo-content">
          <label for="contenidoClienteNuevo" >Contenido</label>
          <textarea type="text" id="contenidoClienteNuevo" name="titulo" class="inpClienteTitleNuevo" placeholder="contenido"></textarea>
        </div>
      </div>

      <div class="inpClienteVideoNuevo-content">
        <input type="file">
      </div>
      <div class="btnInputGuardar-content">
        <input class="btnInputGuardar" type="submit" value="Guardar">
      </div>
    </form>
    <form action="" class="formGuardar-content">
      <h3 class="title-form">Editar contenido</h3>
      <div class="contentTitleContCliente">
        <div class="inpClienteTitleEditar-content">
          <label for="titleClienteEditar" >Titulo</label>
          <input type="text" id="titleClienteEditar" name="titulo" class="inpClienteTitleEditar" placeholder="Titulo">
        </div>
        <div class="inpClienteContenidoEditar-content">
          <label for="contenidoClienteEditar" >Contenido</label>
          <textarea type="text" id="contenidoClienteEditar" name="titulo" class="inpClienteTitleEditar" placeholder="contenido"></textarea>
        </div>
      </div>

      <div class="inpClienteVideoEditar-content">
        <input type="file">
      </div>
      <div class="btnInputGuardar-content">
        <input class="btnInputGuardar" type="submit" value="Guardar">
      </div>
    </form>
  </div>
</div>