<?php
session_start();
if(!$_SESSION["validar"]){
	header("location:ingreso");
	exit();
}

require "views/modules/app.php";

require "views/modules/header.php";
require "views/modules/navegacionStart.php";
require "views/modules/navegacionEnd.php";
//echo "<pre>".print_r($_SESSION,1 )."</pre>";
?>

<div class="mainReset-content">
  <div class="title-content">
    <h1 class="title__titulo"><?php echo $_GET["action"]; ?></h1>
    <form class="buscar" name="titulo" action="" method="get">
      <input class="filtro" type="text" placeholder="Cliente..." id="search-item">
      <button type="submit" class="icono fa fa-search"></button>
    </form>
  </div>
  <div class="containerDatosClientesReferido">
    <?php obtener_clientes_referido($_SESSION["celular"]); ?>
    <!-- <div class="datosCliente-container">
      <div class="datosCliente-content">
        <table class="table-responsive">
          <thead>
            <tr>
              <th>Celular</th>
              <th>Cliente</th>
              <th>No. Ventas</th>
              <th>Acciones</th>
              <th></th>
            </tr>
          </thead>
        <tbody>
          <tr>
            <td>Celular</td>
            <td>Cliente</td>
            <td>No. Ventas</td>
            <td>Acciones</td>
          </tr>
        </tbody>
        </table>
      </div>
      <div class="datosComisionCliente">
        <table class="table-responsive-precio">
          <thead>
            <tr>
              <th>Categoria</th>
              <th>Comision</th>
              <th>Valor Total</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>fruta</td>
              <td class="comision">5</td>
              <td>25000</td>
            </tr>
            <tr>
              <td>verdura</td>
              <td class="comision">10</td>
              <td>2000</td>
            </tr>
            <tr>
              <td>hortalizas</td>
              <td class="comision">15</td>
              <td>23000</td>
            </tr>
            <tr>
              <td></td>
              <td><strong>Total</strong></td>
              <td>60000</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="datosCliente-container">
      <div class="datosCliente-content">
        <table class="table-responsive">
          <thead>
            <tr>
              <th>Celular</th>
              <th>Cliente</th>
              <th>No. Ventas</th>
              <th>Acciones</th>
              <th></th>
            </tr>
          </thead>
        <tbody>
          <tr>
            <td>Celular</td>
            <td>Cliente</td>
            <td>No. Ventas</td>
            <td>Acciones</td>
          </tr>
        </tbody>
        </table>
      </div>
      <div class="datosComisionCliente">
        <table class="table-responsive-precio">
          <thead>
            <tr>
              <th>Categoria</th>
              <th>Comision</th>
              <th>Valor Total</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>fruta</td>
              <td class="comision">5</td>
              <td>25000</td>
            </tr>
            <tr>
              <td>verdura</td>
              <td class="comision">10</td>
              <td>2000</td>
            </tr>
            <tr>
              <td>hortalizas</td>
              <td class="comision">15</td>
              <td>23000</td>
            </tr>
            <tr>
              <td></td>
              <td><strong>Total</strong></td>
              <td>60000</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div> -->
  </div>

</div>