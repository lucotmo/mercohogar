<?php

session_start();
if(!$_SESSION["validar"]){
	header("location:ingreso");
	exit();
}

require "views/modules/app.php";
require  "models/gestorAfiliado.php";

require "views/modules/header.php";
require "views/modules/navegacionStart.php";
require "views/modules/navegacionEnd.php";

//echo "<pre>". print_r($_SESSION,1)."</pre>";
?>

<div class="mainReset-content">
  <div class="title-content">
    <h1 class="title__titulo"><?php echo $_GET["action"]; ?></h1>
  </div>
  <?php 
    if($_POST) {
    	$afiliado = new GestorAfiliadosModel();
    	//echo "<pre>". print_r($_POST,1)."</pre>";
    	if( ( !empty($_POST['password']) &&  !empty($_POST['password2']) )
    	||
    	( !empty($_POST['password']) &&  empty($_POST['password2']) )
    	||
    	( empty($_POST['password']) &&  !empty($_POST['password2']) )
    	) {
    		if( $_POST['password'] !=  $_POST['password2'] ) {
    			echo "<h3>* Las contraseñas no son identicas</h3>";
    		} else {
    			$afiliado->updateAfiliado($_POST);
    		}
    	} else {
    		$afiliado->updateAfiliado($_POST);
    	}
    }
    ?>
  <form action="" class="formInicial" method="post">
    <div class="inpPadre">
      <div class="inpText-container">
        <div class="inpText-content">
          <label class="labelText" for="celular">Celular</label>
          <input type="hidden" name="id_usario" value="<?php echo $_SESSION["id"]; ?>">
          <input type="text" class="inpText" value="<?php echo $_SESSION["celular"]; ?>" name="celular" placeholder="Celular">
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
          <select type="text" class="inpSelect" name="ciudad" id="ciudad" placeholder="Ciudad">
            <option value="">Seleciona una ciudad</option>
            <?php 
            $c = select_ciudades();
            foreach ($c as  $ciudad){
			?>
            <option <?php echo ($_SESSION["ciudad"] == $ciudad['ciudad_id']) ? 'selected' : '' ?>  value="<?php echo $ciudad['ciudad_id']?>"><?php echo ucwords(strtolower($ciudad['nombre']))?></option>
            <?php } ?>
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
          <select class="inpSelect" name="tipoDoc">
            <option value="">Seleccion</option>
            <?php 
			$doc = select_tdoc();
			foreach ($doc as $do){
			?>
            <option <?php echo ($_SESSION["tipo_doc"] == $do['tipo_doc_id']) ? 'selected' : '' ?> value="<?php echo $do['tipo_doc_id'] ?>"><?php echo $do['nombre_tipo'] ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="inpText-content">
          <label class="labelText" for="celular">Documento</label>
          <input type="text" class="inpText" value="<?php echo $_SESSION["documento"]; ?>" name="documento"  placeholder="Documento">
        </div>
        <div class="inpText-content">
          <label class="labelText" for="celular">Cuenta Bancaria</label>
          <input type="text" class="inpText" value="<?php echo $_SESSION["cuenta_bancaria"]; ?>" name="cuenta_bancaria" placeholder="Cuenta Bancaria">
        </div>
      </div>
      <div class="inpText-container">
        <div class="inpText-content">
          <label class="labelText" for="celular">Banco</label>
          <select class="inpSelect" name="banco">
            <option value="">Selecciona un banco</option>
            <?php
			$bancos = select_banco();
			foreach ($bancos as $banco) {
			?>
            <option <?php echo ($_SESSION["banco"] == $banco['banco_id']) ? 'selected' : '' ?> value="<?php echo $banco['banco_id'] ?>"><?php echo $banco['nombre_banco'] ?></option>
            <?php }?>
          </select>
        </div>
        <div class="inpText-content">
          <label class="labelText" for="celular">Tipo de cuenta</label>
          <select class="inpSelect" name="tipo_de_cuenta">
            <option value="">Selecciona el tipo</option>
            <?php
			$tcuentas = select_tcuenta();
			foreach ($tcuentas as $tcuenta) {
			?>
            <option <?php echo ($_SESSION["tipo_cuenta"] == $tcuenta['tipo_id']) ? 'selected' : '' ?> value="<?php echo $tcuenta['tipo_id'] ?>"><?php echo ucwords(strtolower($tcuenta['nombre_tipo_cuenta'])) ?></option>
            <?php }?>
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
        <input type="password" class="inpText" name="password" id="password" placeholder="contraseña">
      </div>
      <div class="inpText-content">
        <label class="labelText" for="password2">Confirmar Contraseña</label>
        <input type="password" class="inpText" name="password2" id="password2" placeholder="Confirmar contraseña">
      </div>
      <div class="inpSubmit-content">
        <input type="submit" class="inpSubmit" value="Guardar">
      </div>
    </div>


  </form>

</div>