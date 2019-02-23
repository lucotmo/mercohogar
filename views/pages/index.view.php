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

<main class="Main">
  <?php require 'views/partials/navegacion.view.php' ?>
  <section class="lista">
    <div class="seccion">
      <div class="seccion-categoria">
        <h1 class="titulo">Productos</h1>
        <form class="buscar" name="titulo" action="" method="get">
          <input class="filtro" type="text" placeholder="Producto..." id="search-item">
          <button onclick="return false" style="cursor:none" type="submit" class="icono fa fa-search"></button>
        </form>
      </div>
      <div class="titles__products"><span class="titles__producto">Producto</span><span class="titles__medida">Medida</span><span class="titles__valor">Valor</span><span class="titles__cantidad">Cantidad</span></div>
    </div>
    <ul class="productos">
      <?php

        $productos = new Productos();
        $productos -> seleccionarProductosController();

      ?>
    </ul>
  </section>
  <?php require 'views/partials/listado.view.php' ?>

  <a class="btn-tu_pedido-movil" href="#">
    <span class="btn-tu_pedido-movil__title">Tu pedido: $</span>
    <span class="btn-tu_pedido-movil__total">0</span>
  </a>
</main>

<!--====  Fin de CONTENT  ====-->


<?php require 'views/partials/form.view.php' ?>

<div class="respuestaEnvio"></div>

<!--=====================================
FOOTER
======================================-->


<?php require 'views/partials/footer.view.php' ?>

<!--====  Fin de FOOTER  ====-->

<script src="views/js/index.js"></script>
<script src="views/js/script.js"></script>
</body>
</html>
