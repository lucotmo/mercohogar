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
      <input class="filtro" type="text" placeholder="Producto..." id="search-item">
      <button type="submit" class="icono fa fa-search"></button>
    </form>
  </div>
  <form action="" class="formInicial">
    <div class="inpPadre">
      <div class="inpText-container">
        <div class="inpText-content">
          <label class="labelText" for="celular">Celular</label>
          <input type="text" class="inpText" name="celular" id="celular" placeholder="Celular">
        </div>
        <div class="inpText-content">
          <label class="labelText" for="nombre">Nombre</label>
          <input type="text" class="inpText" name="nombre" id="nombre" placeholder="Nombre">
        </div>
      </div>
      <div class="inpText-container">
        <div class="inpSelect-content">
          <select type="text" class="inpSelect" name="ciudad" id="ciudad" placeholder="Ciudad">
            <option value="">Seleciona una ciudad</option>
            <option value="">Bucaramanga</option>
            <option value="">Giron</option>
            <option value="">Piedecuesta</option>
            <option value="">Floridablanca</option>
          </select>
        </div>
        <div class="inpText-content">
          <label class="labelText" for="barrio">Barrio</label>
          <input type="text" class="inpText" name="barrio" id="barrio" placeholder="Barrio">
        </div>
      </div>
      <div class="inpText-container">
        <div class="inpText-content">
          <label class="labelText" for="direccion">Direccion</label>
          <input type="text" class="inpText" name="direccion" id="direccion" placeholder="Direccion">
        </div>
      </div>
      <div class="inpText-container">
        <div class="inpSelect-content">
          <select class="inpSelect" name="tipoDoc" id="">
            <option value="">cc</option>
            <option value="">ti</option>
          </select>
        </div>
        <div class="inpText-content">
          <label class="labelText" for="celular">Documento</label>
          <input type="text" class="inpText" name="celular" id="celular" placeholder="Documento">
        </div>
        <div class="inpText-content">
          <label class="labelText" for="celular">Cuenta Bancaria</label>
          <input type="text" class="inpText" name="celular" id="celular" placeholder="Cuenta Bancaria">
        </div>
      </div>
      <div class="inpText-container">
        <div class="inpText-content">
          <label class="labelText" for="celular">Banco</label>
          <select class="inpSelect" name="Banco" id="">
            <option value="">Bancolombia</option>
            <option value="">Bogota</option>
            <option value="">AV villas</option>
            <option value="">Caja Social</option>
          </select>
        </div>
        <div class="inpText-content">
          <label class="labelText" for="celular">Tipo de cuenta</label>
          <select class="inpSelect" name="Tipo de cuenta" id="">
            <option value="">Seleccion</option>
            <option value="">Ahorro</option>
            <option value="">Corriente</option>
          </select>
        </div>
      </div>
    </div>
    <div class="inpPadre">
      <div class="inpText-content">
        <label class="labelText" for="correo">Correo</label>
        <input type="text" class="inpText" name="correo" id="correo" placeholder="Correo">
      </div>
      <div class="inpText-content">
        <label class="labelText" for="password">Contraseña</label>
        <input type="text" class="inpText" name="password" id="password" placeholder="contraseña">
      </div>
      <div class="inpText-content">
        <label class="labelText" for="password2">Confirmar Contraseña</label>
        <input type="text" class="inpText" name="password2" id="password2" placeholder="Confirmar contraseña">
      </div>
      <div class="inpSubmit-content">
        <input type="submit" class="inpSubmit" value="Guardar">
      </div>
    </div>


  </form>

</div>