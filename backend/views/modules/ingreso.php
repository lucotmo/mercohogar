<!--=============================
=            INGRESO            =
==============================-->

<div class="formularioAdmin">
  <form class="formulario" action="" method="post" onsubmit="return validarIngreso()">
    <h1>Sesión Admin</h1>
    <div class="usuCont">
      <div class="usuario">
        <label for="" class="usu-title">Usuario</label>
        <input type="text" name="usuarioIngreso" class="usu-inp" placeholder="Usuario" id="usuarioIngreso">
      </div>
      <div class="contrasena">
        <label for="" class="cont-title">Contraseña</label>
        <input type="text" name="passwordIngreso" class="cont-inp" placeholder="Contraseña" id="passwordIngreso">
      </div>
    </div>
      <?php

        $ingreso = new Ingreso();
        $ingreso -> ingresoController();

      ?>
    <div class="btn-session-admin">
      <input class="btn-session" type="submit" value="Iniciar sesión">
    </div>

  </form>
</div>



<!--====  End of INGRESO  ====-->
