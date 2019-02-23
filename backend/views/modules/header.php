<!--=====================================
HEADER
======================================-->

<header class="header-admin"><a class="logo-container" href="./"><img class="Logo" src="views/imagenes/logo-mercohogar.svg"></a><a class="open-menu" href="#" id="open"><span class="btn-menu"></span></a>
  <nav class="admin">
    <div class="info-admin">
      <h5>Teléfonos: (7) 6314762 | 318 222 0604</h5>
    </div>
    <nav class="btn-admin">
      <img src="<?php echo $_SESSION["photo"]; ?>" class="img-circle">
      <span><?php echo $_SESSION["usuario"]; ?></span>
      <a href="#" class="btn__perfil">
        <i class="fa fa-caret-down icon-admin"></i>
        <ol class="perfil-options">
          <li><a href="perfil"><span class="fa fa-user perfil__btn"></span>Configuraciones</a></li>
          <li><a href="terminos.pdf"><span class="fa fa-file-text perfil__btn__terminos"></span>Términos y Condiciones</a></li>
          <li><a href="salir"><span class="fa fa-times perfil__btn__salir"></span>Salir</a></li>
        </ol>
      </a>

    </nav>
  </nav>
</header>

<!--====  Fin de HEADER  ====-->