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