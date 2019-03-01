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
    <h1 class="title__titulo">¿Como <?php echo $_GET["action"]; ?>?</h1>
  </div>
  <div class="btnAgregar-content">
    <button class="btnAgregar btnAgregarNuevoContenidoComoPedir">Nuevo Contenido</button>
  </div>
  <!-- <div class="formsResets">
    <div class="formGuardar-content">
      <h3 class="title-form">Nuevo Contenido</h3>
      <fieldset>
        <legend>Nro. de pasos</legend>
        <form method="POST" action="pedir">
          <input class="legendNumber" type="text" name="cantInputsNuevo" placeholder="Nro. de pasos">
          <input class="btnLegendGenerar" type="submit" name="" value="Generar">
        </form>
      </fieldset>
      <form action="" class="formGuardarPedir">
        <div class="titleVideoPedir">
          <div class="inpGuardarPedirTitle-content">
            <input type="text" class="inpGuardarPedirTitle" name="GuardarPedirTitle" placeholder="Titulo">
          </div>
          <div class="GuardarPedirVideo-content">
            <input type="file">
            <label class="labelGuardarPedirVideo" for=""></label>
          </div>
        </div>
        <div class="inpGuardarPedirTitle-content">
          <h3 class="title__editarPedir">Pasos</h3>
        </div>
        <?php if(isset($_POST['cantInputsNuevo'])) { ?>
          <?php for ($i= 1; $i <= $_POST['cantInputsNuevo'] ; $i++) { ?>
            <div class="inpGroupGuardarPedirPaso-content">
              <input class="inpNumberPedirPaso" type="text" name="numeroPaso[]" placeholder="No."><br>
              <textarea class="textareaNumberPedirPaso" type="text" name="parrafoPaso[]" placeholder="Parrafo..."></textarea>
            </div>
          <?php } ?>
        <?php } ?>
        <div class="btnInputGuardar-content">
          <input class="btnInputGuardar" type="submit" value="Guardar">
        </div>
      </form>
    </div>
    <div class="formGuardar-content">
      <h3 class="title-form">Editar Contenido</h3>
      <fieldset>
        <legend>Nro. de pasos</legend>
        <form method="POST" action="pedir">
          <input class="legendNumber" type="text" name="cantInputsEditar" placeholder="Nro. de pasos">
          <input class="btnLegendGenerar" type="submit" name="" value="Generar">
        </form>
      </fieldset>
      <form action="" class="formEditarPedir">
        <div class="titleVideoPedir">
          <div class="inpEditarPedirTitle-content">
            <input type="text" class="inpEditarPedirTitle" name="EditarPedirTitle" placeholder="Titulo">
          </div>
          <div class="EditarPedirVideo-content">
            <input type="file">
            <label class="labelEditarPedirVideo" for=""></label>
          </div>
        </div>
        <div class="inpEditarPedirTitle-content">
          <h3 class="title__editarPedir">Pasos</h3>
        </div>
        <?php if(isset($_POST['cantInputsEditar'])) { ?>
          <?php for ($i= 1; $i <= $_POST['cantInputsEditar'] ; $i++) { ?>
            <div class="inpGroupEditarPedirPaso-content">
              <input class="inpNumberPedirPaso" type="text" name="numeroPaso[]" placeholder="No."><br>
              <textarea class="textareaNumberPedirPaso" type="text" name="parrafoPaso[]" placeholder="Parrafo..."></textarea>
            </div>
          <?php } ?>
        <?php } ?>
        <div class="btnInputGuardar-content">
          <input class="btnInputGuardar" type="submit" value="Guardar">
        </div>
      </form>
    </div>
  </div> -->

  <div class="pedir-container">
    <?php

    $comoPedir = new ComoPedir();
    $comoPedir -> seleccionarComoPedirController();

    ?>
    <!-- <div class="pedir__title-content">
      <h1 class="pedir__title">Hacer tu pedido</h1>
    </div>
    <div class="pedir__video-content">

    </div>
    <div class="pedir__pasos__title-content">
      <h6 class="pedir_pasos__title">Pasos</h6>
    </div>
    <div class="pedir__pasos__paso-container">
      <div class="pedir__pasos__paso-content">
        <h3 class="pedir__pasos__paso__number">3</h3>
        <p class="pedir__pasos__paso__contenido">Empresa dedicada a la venta y distribución de frutas y verduras de calidad y a un precio ideal para la familia.</p>
      </div>
    </div> -->
  </div>

  <div class="containerFormComoPedir">

  </div>
</div>