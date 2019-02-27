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

<main class="main-clientes">
  <!-- <div class="nuestros-clientes">
    <div class="nuestros-clientes-container">
      <div class="nuestros-clientes-content">
        <h6 class="clientes__title">nuestros clientes</h6>
        <p class="nuestros__parrafo">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum minus placeat ex quasi excepturi, asperiores non impedit veritatis dolore quod fugit consequuntur nostrum vitae? Aliquam deleniti amet optio quibusdam saepe.</p>
      </div>
      <div class="nuestros-clientes-video">
        <a href="https://vimeo.com/90791304" class="modal-vimeo">
          <img src="views/imagenes/video.png" alt="">
          <i class="fa fa-play-circle"></i>
        </a>
      </div>
    </div>
    <div class="nuestros-clientes-container">
      <div class="nuestros-clientes-content">
        <h6 class="clientes__title">nuestro grupo</h6>
        <p class="nuestros__parrafo">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum minus placeat ex quasi excepturi, asperiores non impedit veritatis dolore quod fugit consequuntur nostrum vitae? Aliquam deleniti amet optio quibusdam saepe.</p>
      </div>
      <div class="nuestros-clientes-video">
        <a href="https://vimeo.com/90791304" class="modal-vimeo">
          <img src="views/imagenes/video.png" alt="">
          <i class="fa fa-play-circle"></i>
        </a>
      </div>
    </div>
    <div class="nuestros-clientes-container">
      <div class="nuestros-clientes-content">
        <h6 class="clientes__title">Nuestros aliados</h6>
        <p class="nuestros__parrafo">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum minus placeat ex quasi excepturi, asperiores non impedit veritatis dolore quod fugit consequuntur nostrum vitae? Aliquam deleniti amet optio quibusdam saepe.</p>
      </div>
      <div class="nuestros-clientes-video">
        <a href="https://vimeo.com/90791304" class="modal-vimeo">
          <img src="views/imagenes/video.png" alt="">
          <i class="fa fa-play-circle"></i>
        </a>
      </div>
    </div>
  </div> -->
  <div class="nuestros-clientes">
    <!-- <div class="nuestros-clientes-container">
      <div class="nuestros-clientes-content">
        <h6 class="clientes__title">nuestros clientes</h6>
        <p class="nuestros__parrafo">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum minus placeat ex quasi excepturi, asperiores non impedit veritatis dolore quod fugit consequuntur nostrum vitae? Aliquam deleniti amet optio quibusdam saepe.</p>
      </div>
      <div class="nuestros-clientes-video">
        <div class="video-responsive">
        <iframe src="https://player.vimeo.com/video/90791304" frameborder="0" allowfullscreen="allowfullscreen" ></iframe>
        </div>
      </div>
    </div> -->
    <?php

      $nuestrosClientes = new NuestrosClientes();
      $nuestrosClientes -> seleccionarNuestrosClientesController();

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
  <pre>

  <pre>
</main>

<!--====  Fin de CONTENT  ====-->




<!--=====================================
FOOTER
======================================-->

<?php require 'views/partials/footer.view.php' ?>

<!--====  Fin de FOOTER  ====-->


<?php require 'views/partials/end.view.php' ?>