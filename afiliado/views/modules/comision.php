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
?>

<div class="mainReset-content">
  <div class="title-content">
    <h1 class="title__titulo"><?php echo $_GET["action"]; ?></h1>
  </div>
  <div class="datosComisionCliente-container">
    <div class="datosComisionCliente">
      <table class="table-responsive-precio">
      	<caption>No pagada</caption>
        <thead>
          <tr>
            <th>Categoria</th>
            <th>Comision</th>
            <th>Valor Total</th>
          </tr>
        </thead>
        <tbody>
        <?php 
        $result_np = comision_no_pagada($_SESSION["celular"]); 
        $tt_no = 0;
        foreach ($result_np as  $r) { ?>
        	<tr>
	            <td><?php echo $r['nombre_categoria'] ?></td>
	            <td class="comision"><?php echo $r['comision'] ?></td>
	            <td><?php echo $r['_real'] ?></td>
          	</tr>
        <?php  $tt_no+= $r['_real']; } ?>
        <tr>
            <td></td>
            <td><strong>Total</strong></td>
            <td><?php echo $tt_no ?></td>
          </tr>
        </tbody>
      </table>
    </div>
    
    <div class="datosComisionCliente">
      <table class="table-responsive-precio">
      	<caption>Pagada</caption>
        <thead>
          <tr>
            <th>Categoria</th>
            <th>Comision</th>
            <th>Valor Total</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $result_p = comision_pagada($_SESSION["celular"]); 
          $tt_p = 0;
          foreach ($result_p as  $r) { ?>
        	<tr>
	            <td><?php echo $r['nombre_categoria'] ?></td>
	            <td class="comision"><?php echo $r['comision'] ?></td>
	            <td><?php echo $r['_real'] ?></td>
          	</tr>
        <?php $tt_p+= $r['_real']; } ?>
        <tr>
            <td></td>
            <td><strong>Total</strong></td>
            <td><?php echo $tt_p?></td>
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