<section class="categorias-container">
  <h3 class="caterorias__title">Categorias</h3>
  <nav class="categorias-content">
    <a class="categorias__items is-checked" id="carro" href="#" data-filter="all">Todos</a>
    <?php

      $categorias = new Categorias();
      $categorias -> seleccionarCategoriasController();

    ?>
    <a class="categorias__items" id="carro" href="#" data-filter="oferta">Promociones</a>
  </nav>
  <div class="banner">
    <div class="banner__img-content" style="left: 0%;">
      <div class="banner__img-item">
        <img class="banner__img" src="views/imagenes/slides/p-1.png" alt="">
      </div>
      <div class="banner__img-item">
        <img class="banner__img" src="views/imagenes/slides/p-2.png" alt="">
      </div>
      <div class="banner__img-item">
        <img class="banner__img" src="views/imagenes/slides/p-3.png" alt="">
      </div>
      <div class="banner__img-item">
        <img class="banner__img" src="views/imagenes/slides/p-4.png" alt="">
      </div>
      <!-- <div class="banner__img-item">
        <img class="banner__img" src="views/imagenes/slides/p-5.png" alt="">
      </div>
      <div class="banner__img-item">
        <img class="banner__img" src="views/imagenes/slides/p-6.png" alt="">
      </div> -->
    </div>
  </div>
  <div class="redes">
    <a class="footer__link-social" href="#"><img class="footer__img-social" src="views/imagenes/facebook.svg" alt="facebook"></a>
    <a class="footer__link-social" href="#"><img class="footer__img-social" src="views/imagenes/instagram.svg" alt="instagram"></a>
    <a class="footer__link-social" href="#"><img class="footer__img-social" src="views/imagenes/vimeo.svg" alt="vimeo"></a>
  </div>
</section>