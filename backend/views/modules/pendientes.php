<?php

session_start();

if(!$_SESSION["validar"]){

	header("location:ingreso");

  exit();

}

require "views/modules/header.php";
require "views/modules/navegacionStart.php";
require "views/modules/navegacionEnd.php";


?>
<div class="mainReset-content">
  <div class="title-content">
    <h1 class="title__titulo"><?php echo $_GET["action"]; ?></h1>
    <form class="buscar" name="titulo" action="" method="get">
      <input class="filtro" type="text" placeholder="No. Pedido..." id="search-item-pedido">
      <button type="submit" class="icono fa fa-search" style="pointer-events:none"></button>
    </form>
  </div>

  <div class="respuestaPedido">
    <!-- <div class="vistaRespuesta">
      <div class="vistaDelPedido">
        <a class="btnCerrarVistaPedido" href="">X</a>
        <h1 class="title__titulo">Datos</h1>
        <table class="responsivePedido-table">
          <tr>
            <th>No. Pedido</th>
            <th>Cliente</th>
            <th>Celular</th>
            <th>Ciudad</th>
            <th>Barrio</th>
            <th>Direccion</th>
            <th></th>
          </tr>
          <tr>
            <td id="pedidoId">25</td>
            <td>Andres Rosales</td>
            <td>3189645566</td>
            <td>Ciudad</td>
            <td>san francisco</td>
            <td>Cll 14 #25-03</td>
          </tr>
        </table>
        <h1 class="title__titulo">Productos</h1>
        <table class="responsivePedido-table">
          <tr>
            <th>Nombre</th>
            <th>Medida</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Precio total</th>
            <th>Acciones</th>
            <th></th>
          </tr>
          <tr>
            <td >Fresa</td>
            <td >Lb</td>
            <td>2</td>
            <td>2500</td>
            <td>5000</td>
            <td>
              <a href="#" class="fa fa-trash btn__perfilDatos"></a>
            </td>
          </tr>
          <tr>
            <td >Fresa</td>
            <td >Lb</td>
            <td>2</td>
            <td>2500</td>
            <td>5000</td>
            <td>
              <a href="#" class="fa fa-trash btn__perfilDatos"></a>
            </td>
          </tr>
          <tr>
            <td >Fresa</td>
            <td >Lb</td>
            <td>2</td>
            <td>2500</td>
            <td>5000</td>
            <td>
              <a href="#" class="fa fa-trash btn__perfilDatos"></a>
            </td>
          </tr>
        </table>
      </div>
    </div> -->
  </div>


  <table class="responsivePedido-table">
    <?php
      $pedido = new Pedidos();
      $pedido -> seleccionarPedidosController();
    ?>
  </table>
</div>

