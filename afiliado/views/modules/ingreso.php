<!--=============================
=            INGRESO            =
==============================-->

<div class="formularioAdmin">
  <form class="formulario" action="" method="post" onsubmit="return validarIngreso()">
    <h1>Sesión Afiliado</h1>
    <div class="usuCont">
      <div class="usuario">
        <label for="" class="usu-title">Celular</label>
        <input type="text" name="celularIngreso" class="usu-inp" placeholder="Celular" id="usuarioIngreso">
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



<!-- <h1>afiliado</h1>
  <main class="main-afiliado">
    <aside class="aside-afiliado">
      <section class="afiliado-container">
        <h3 class="caterorias__title-afiliado">Información</h3>
        <nav class="categorias-content-afiliado">
          <img src="" class="img-circle">
          <span>lucho</span>
          <a href="#" class="btn__perfil">
            <i class="fa fa-caret-down icon-admin"></i>
            <ol class="perfil-options">
              <li><a href="perfil"><span class="fa fa-user perfil__btn"></span>Editar Perfil</a></li>
              <li><a href="salir"><span class="fa fa-times perfil__btn__salir"></span>Salir</a></li>
            </ol>
          </a>
          <a class="categorias__items-afiliado " href="datos" >Datos</a>
          <a class="categorias__items-afiliado"  href="clientes" >Clientes</a>
          <a class="categorias__items-afiliado" href="comision" >Comisión</a>
          <a class="categorias__items-afiliado"  href="archivos" >Archivos</a>
          <a class="categorias__items-afiliado"  href="archivos/2" >otro</a>
        </nav>
      </section>
    </aside>
    <section>
      <h1>contenct</h1>
    </section>
  </main> -->