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
  </div>
  <div class="btnAgregar-content">
    <button class="btnAgregar">Nuevo Portada</button>
  </div>
  <h1 style="color:#aaa">Portada</h1>
  <div class="containerPortadaAfiliate">
      <?php
        $afiliate = new Afiliate();
        $afiliate -> PortadaAfiliateController();
      ?>
  </div>
  <div class="title-content">
    <h1 class="title__titulo">Contenido</h1>
  </div>
  <div class="btnAgregar-content">
    <button class="btnAgregar">Nuevo contenido</button>
  </div>
  <div class="containerContenidoAfiliate">
    <?php
      $afiliate = new Afiliate();
      $afiliate -> mostrarContenidoAfiliateController();
    ?>
  </div>
  <div class="title-content">
    <h1 class="title__titulo">Preguntas</h1>
  </div>
  <div class="btnAgregar-content">
    <button class="btnAgregar">Nueva Pregunta</button>
  </div>
  <div class="containerPreguntasAfiliate">
    <?php
      $afiliate2 = new Afiliate();
      $afiliate2 -> mostrarPreguntasAfiliateController();
    ?>
  </div>

  <!-- <div class="title-content">
    <h1 class="title__titulo">Beneficios</h1>
  </div>
  <div class="btnAgregar-content">
    <button class="btnAgregar">Nuevo Beneficio</button>
  </div> -->
  <!-- <div class="formsAfiliateBeneficio">
    <div class="formGuardar-content">
      <h3 class="title-form">Nuevo Contenido Beneficio</h3>
      <fieldset>
        <legend>Nro. de Subtitulos</legend>
        <form method="POST" action="afiliate">
          <input class="legendNumber" type="text" name="cantInputsNuevoBeneficio" placeholder="Nro. de Subtitulos">
          <input class="btnLegendGenerar" type="submit" name="" value="Generar">
        </form>
      </fieldset>
      <form action="" class="formGuardarAfiliateBeneficio">
        <div class="titleVideoAfiliateBeneficio">
          <div class="inpGuardarAfiliateBeneficioTitle-content">
            <input type="text" class="inpGuardarAfiliateBeneficioTitle" name="GuardarAfiliateBeneficioTitle" placeholder="Titulo">
          </div>
        </div>
        <div class="inpGuardarAfiliateBeneficioTitle-content">
          <h3 class="title__editarAfiliateBeneficio">Subtitulos</h3>
        </div>
        <?php if(isset($_POST['cantInputsNuevoBeneficio'])) { ?>
          <?php for ($i= 1; $i <= $_POST['cantInputsNuevoBeneficio'] ; $i++) { ?>
            <div class="inpGroupGuardarAfiliateBeneficioPaso-content">
              <input class="inpNumberAfiliateBeneficioPaso" type="text" name="numeroPaso[]" placeholder="No."><br>
              <textarea class="textareaNumberAfiliateBeneficioPaso" type="text" name="parrafoPaso[]" placeholder="Parrafo..."></textarea>
            </div>
          <?php } ?>
        <?php } ?>
        <div class="btnInputGuardarAfiliateBeneficio">
          <input class="inpBtnGuardarAfiliateBeneficio" type="submit" value="Guardar">
        </div>
      </form>
    </div>
    <div class="formGuardar-content">
      <h3 class="title-form">Editar Contenido Beneficio</h3>
      <fieldset>
        <legend>Nro. de Subtitulos</legend>
        <form method="POST" action="afiliate">
          <input class="legendNumber" type="text" name="cantInputsEditarBeneficio" placeholder="Nro. de Subtitulos">
          <input class="btnLegendGenerar" type="submit" name="" value="Generar">
        </form>
      </fieldset>
      <form action="" class="formEditarAfiliateBeneficio">
        <div class="titleVideoAfiliateBeneficio">
          <div class="inpEditarAfiliateBeneficioTitle-content">
            <input type="text" class="inpEditarAfiliateBeneficioTitle" name="EditarAfiliateBeneficioTitle" placeholder="Titulo">
          </div>

        </div>
        <div class="inpEditarAfiliateBeneficioTitle-content">
          <h3 class="title__editarAfiliateBeneficio">Subtitulos</h3>
        </div>
        <?php if(isset($_POST['cantInputsEditarBeneficio'])) { ?>
          <?php for ($i= 1; $i <= $_POST['cantInputsEditarBeneficio'] ; $i++) { ?>
            <div class="inpGroupEditarAfiliateBeneficioPaso-content">
              <input class="inpNumberAfiliateBeneficioPaso" type="text" name="numeroPaso[]" placeholder="No."><br>
              <textarea class="textareaNumberAfiliateBeneficioPaso" type="text" name="parrafoPaso[]" placeholder="Parrafo..."></textarea>
            </div>
          <?php } ?>
        <?php } ?>
        <div class="btnInputEditarAfiliateBeneficio">
          <input class="inpBtnEditarAfiliateBeneficio" type="submit" value="Guardar">
        </div>
      </form>
    </div>
  </div> -->
  <div class="title-content">
    <h1 class="title__titulo">Beneficios</h1>
  </div>
  <div class="btnAgregar-content">
    <button class="btnAgregar">Nueva Beneficio</button>
  </div>

  <div class="containerBeneficiosAfiliate">
    <?php
      $afiliate = new Afiliate();
      $afiliate -> mostrarBeneficiosAfiliateController();
    ?>
  </div>

</div>
