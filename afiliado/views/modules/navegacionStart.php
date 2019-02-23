<!--========================================
=            COLUMNA NAVEGACION            =
=========================================-->
<main class="main-admin">
  <aside class="aside-admin">
    <div class="bienvenidaAfiliado-container">
      <span class="holaBienvenida">¡Hola <?php echo $_SESSION["nombre"];  ?>!</span>
      <nav class="btn-admin">
        <img src="views/imagenes/photo.jpg" class="img-circle">
        <a href="#" class="btn__perfil">
          <i class="fa fa-caret-down icon-admin"></i>
          <ol class="perfil-options">
            <li><a href="terminos.pdf"><span class="fa fa-file-text perfil__btn__terminos"></span>Términos y Condiciones</a></li>
            <li><a href="salir"><span class="fa fa-times perfil__btn__salir"></span>Salir</a></li>
          </ol>
        </a>
      </nav>
    </div>
    <section class="pedidos-container">
      <nav class="categorias-content-admin">
        <a class="categorias__items-admin " href="datos" >Datos</a>
        <a class="categorias__items-admin"  href="clientes" >Clientes</a>
        <a class="categorias__items-admin" href="comision" >Comision</a>
        <a class="categorias__items-admin"  href="archivos" >Archivos</a>
      </nav>
    </section>
  </aside>
<!--====  End of COLUMNA NAVEGACION  ====-->


