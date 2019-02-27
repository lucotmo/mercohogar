<aside class="aside">
  <a class="close-aside" href="#">x</a>
  <div class="contenedor-total-pedido">
    <section class="container-pedido">
      <h3 class="ped">Tu pedido</h3>
      <section class="lista-pedido">
        <ul class="productos" id="pedido">
        </ul>
      </section>
    </section>

    <div class="precio-container">
      <div class="precio-content">
        <span class="precio__text">Tu pedido actual</span>
        <span class="precio-total__final">0</span>
      </div>

      <a class="btn__pedir" href="#">Generar Pedido</a>
    </div>
  </div>

  <!-- <section class="banner__promos">
    <h3 class="banner__promos-title">banner de promos</h3>

    <div class="banner__promos__img-content">
      <div class="banner__promos__img-item">
        <img class="banner__promos__img" src="views/imagenes/slides/1.png" alt="">
      </div>
      <div class="banner__promos__img-item">
        <img class="banner__promos__img" src="views/imagenes/slides/2.png" alt="">
      </div>
      <div class="banner__promos__img-item">
        <img class="banner__promos__img" src="views/imagenes/slides/3.png" alt="">
      </div>
      <div class="banner__promos__img-item">
        <img class="banner__promos__img" src="views/imagenes/slides/4.png" alt="">
      </div>

    </div>

  </section> -->
  <section id="slider-derecho-banner" class="banner__promos slider-derecho-container">
    <ul class="slider-derecho-content">
      <?php

      $slidesDerecha = new SlidersDerecha();
      $slidesDerecha -> seleccionarSlidersDerechaController();

      ?>
    </ul>
  </section>

  <!-- <nav class="ToDo">
    <input type="text" id="task" class="Task" placeholder="Tarea...", spellcheck>
    <ul id="list" class="list"> -->

    </ul>
  </nav>
</aside>