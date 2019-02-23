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
  </div>
  <div class="datosComisionCliente-container">
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

  <div class="infoData">
    <p>Tus comisiones son retiradas por mercado, consignación o pago en efectivo.
Para retirarlas por consignación o pago en efectivo el valor debe ser mayor de $80.000.
Los cobros en la consignación son restados al valor.</p>
  </div>

</div>