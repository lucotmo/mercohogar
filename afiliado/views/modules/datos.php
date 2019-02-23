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
  <form action="" class="formInicial">
    <div class="inpPadre">
      <div class="inpText-container">
        <div class="inpText-content">
          <label class="labelText" for="celular">Celular</label>
          <input type="text" class="inpText" value="<?php echo $_SESSION["celular"]; ?>" name="celular" id="celular" placeholder="Celular">
        </div>
      </div>
      <div class="inpText-container">
        <div class="inpText-content">
          <label class="labelText" for="nombre">Nombre</label>
          <input type="text" class="inpText" value="<?php echo $_SESSION["nombre"]; ?>" name="nombre" id="nombre" placeholder="Nombre">
        </div>
        <div class="inpText-content">
          <label class="labelText" for="apellidos">Apellidos</label>
          <input type="text" class="inpText" value="<?php echo $_SESSION["apellidos"]; ?>" name="apellidos" id="apellidos" placeholder="Celular">
        </div>
      </div>
      <div class="inpText-container">
        <div class="inpSelect-content">
          <label class="labelText" for="ciudad">Ciudad</label>
          <select type="text" value="<?php echo $_SESSION["ciudad"]; ?>" class="inpSelect" name="ciudad" id="ciudad" placeholder="Ciudad">
            <option value="">Seleciona una ciudad</option>
            <option value="">Bucaramanga</option>
            <option value="">Giron</option>
            <option value="">Piedecuesta</option>
            <option value="">Floridablanca</option>
          </select>
        </div>
        <div class="inpText-content">
          <label class="labelText" for="barrio">Barrio</label>
          <input type="text" class="inpText" value="<?php echo $_SESSION["barrio"]; ?>" name="barrio" id="barrio" placeholder="Barrio">
        </div>
      </div>
      <div class="inpText-container">
        <div class="inpText-content">
          <label class="labelText" for="direccion">Direccion</label>
          <input type="text" class="inpText" value="<?php echo $_SESSION["direccion"]; ?>" name="direccion" id="direccion" placeholder="Direccion">
        </div>
      </div>
      <div class="inpText-container">
        <div class="inpSelect-content">
          <label class="labelText" for="tipo_doc">Tipo documento</label>
          <select class="inpSelect" value="<?php echo $_SESSION["tipo_doc"]; ?>"
            name="tipoDoc" id="">
            <option value="">Seleccion</option>
            <option value="">C.C</option>
            <option value="">T.I</option>
          </select>
        </div>
        <div class="inpText-content">
          <label class="labelText" for="celular">Documento</label>
          <input type="text" class="inpText" value="<?php echo $_SESSION["documento"]; ?>" name="celular" id="celular" placeholder="Documento">
        </div>
        <div class="inpText-content">
          <label class="labelText" for="celular">Cuenta Bancaria</label>
          <input type="text" class="inpText" value="<?php echo $_SESSION["cuenta_bancaria"]; ?>" name="celular" id="celular" placeholder="Cuenta Bancaria">
        </div>
      </div>
      <div class="inpText-container">
        <div class="inpText-content">
          <label class="labelText" for="celular">Banco</label>
          <select class="inpSelect" value="<?php echo $_SESSION["banco"]; ?>" name="Banco" id="">
            <option value="">Selecciona un banco</option>
            <option value="">Bancolombia</option>
            <option value="">Bogota</option>
            <option value="">AV villas</option>
            <option value="">Caja Social</option>
          </select>
        </div>
        <div class="inpText-content">
          <label class="labelText" for="celular">Tipo de cuenta</label>
          <select class="inpSelect" value="<?php echo $_SESSION["tipo_cuenta"]; ?>" name="Tipo de cuenta" id="" value="2">
            <option value="0">Selecciona el tipo</option>
            <option value="1">Ahorro</option>
            <option value="2">Corriente</option>
          </select>
        </div>
      </div>
    </div>
    <div class="inpPadre">
      <div class="inpText-content">
        <label class="labelText" for="correo">Correo</label>
        <input type="text" class="inpText" value="<?php echo $_SESSION["correo"]; ?>" name="correo" id="correo" placeholder="Correo">
      </div>
      <div class="inpText-content">
        <label class="labelText" for="password">Contraseña</label>
        <input type="password" class="inpText" value="" name="password" id="password" placeholder="contraseña">
      </div>
      <div class="inpText-content">
        <label class="labelText" for="password2">Confirmar Contraseña</label>
        <input type="password" class="inpText" value="" name="password2" id="password2" placeholder="Confirmar contraseña">
      </div>
      <div class="inpSubmit-content">
        <input type="submit" class="inpSubmit" value="Guardar">
      </div>
    </div>


  </form>

</div>

<!-- $_SESSION["id"] = $respuesta["id"];
            $_SESSION["celular"] = $respuesta["celular"];
            $_SESSION["nombre"] = $respuesta["nombre"];
            $_SESSION["apellidos"] = $respuesta["apellidos"];
            $_SESSION["ciudad"] = $respuesta["ciudad"];
            $_SESSION["barrio"] = $respuesta["barrio"];
            $_SESSION["direccion"] = $respuesta["direccion"];
            $_SESSION["tipo_doc"] = $respuesta["tipo_doc"];
            $_SESSION["documento"] = $respuesta["documento"];
            $_SESSION["cuenta_bancaria"] = $respuesta["cuenta_bancaria"];
            $_SESSION["banco"] = $respuesta["banco"];
            $_SESSION["tipo_cuenta"] = $respuesta["tipo_cuenta"];
            $_SESSION["correo"] = $respuesta["correo"];
            $_SESSION["password"] = $respuesta["password"];
            $_SESSION["intentos"] = $respuesta["intentos"]; -->