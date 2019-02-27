<?php require 'views/partials/start.view.php' ?>
  <title>Mercohogar</title>
  <meta name="description" content="Empresa de venta de productos"/>
<?php require 'views/partials/start2.view.php' ?>
<body>
<!--=====================================
HEADER
======================================-->

<?php require 'views/partials/header.view.php' ?>

<!--====  Fin de HEADER  ====-->


<!--=====================================
CONTENT
======================================-->
<main class="main-pedir">
  <div class="pedir-container">
    <h6 class="pedir__subtitle">Como pedir</h6>
    <?php

      $comoPedir = new ComoPedir();
      $comoPedir -> seleccionarComoPedirController();

    ?>
    <!-- <div class="pedir-content">
      <div class="pedir__video-container">
        <div class="pedir__title-content">
          <h1 class="pedir__title">Hacer tu pedido ya es facil</h1>
        </div>
        <div class="pedir__video">
          <a href="https://vimeo.com/90791304" class="modal-vimeo">
            <img src="views/imagenes/video.png" alt="">
            <i class="fa fa-play-circle"></i>
          </a>
        </div>
      </div>
      <div class="pedir__pasos-content">
        <div class="pedir__pasos__title-content">
          <h6 class="pedir__pasos__title">Pasos</h6>
        </div>
        <div class="pedir__pasos__parrafo-container">
          <div class="pedir__pasos__parrafo-content">
            <h6 class="pedir__pasos__number">1</h6>
            <p class="pedir__pasos__parrafo">Empresa dedicada a la venta y distribución de frutas y verduras de calidad y a un precio ideal para la familia.</p>
          </div>
          <div class="pedir__pasos__parrafo-content">
            <h6 class="pedir__pasos__number">2</h6>
            <p class="pedir__pasos__parrafo">Empresa dedicada a la venta y distribución de frutas y verduras de calidad y a un precio ideal para la familia.</p>
          </div>
          <div class="pedir__pasos__parrafo-content">
            <h6 class="pedir__pasos__number">3</h6>
            <p class="pedir__pasos__parrafo">Empresa dedicada a la venta y distribución de frutas y verduras de calidad y a un precio ideal para la familia.</p>
          </div>
          <div class="pedir__pasos__parrafo-content">
            <h6 class="pedir__pasos__number">4</h6>
            <p class="pedir__pasos__parrafo">Empresa dedicada a la venta y distribución de frutas y verduras de calidad y a un precio ideal para la familia.</p>
          </div>
          <div class="pedir__pasos__parrafo-content">
            <h6 class="pedir__pasos__number">5</h6>
            <p class="pedir__pasos__parrafo">Empresa dedicada a la venta y distribución de frutas y verduras de calidad y a un precio ideal para la familia.</p>
          </div>
        </div>
      </div>

    </div> -->
  </div>
  <section id="slider-derecho-banner" class="banner__promos-pedir slider-derecho-container">
    <ul class="slider-derecho-content">
      <?php

      $slidesDerecha = new SlidersDerecha();
      $slidesDerecha -> seleccionarSlidersDerechaController();

      ?>
    </ul>
  </section>
</main>



<!--====  Fin de CONTENT  ====-->




<!--=====================================
FOOTER
======================================-->

<?php require 'views/partials/footer.view.php' ?>

<!--====  Fin de FOOTER  ====-->


<?php require 'views/partials/end.view.php' ?>