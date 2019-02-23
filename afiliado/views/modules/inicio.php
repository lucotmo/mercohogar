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


<div class="main-content">
  <h1 class="tu">Bienvenido al administrador</h1>
  <ul class="menu__navegacion-inicio">
    <li class="menu__items-inicio"><a href="pendientes" class="menu__link-inicio">Pendientes</a></li>
    <li class="menu__items-inicio"><a href="realizados" class="menu__link-inicio">Realizados</a></li>
    <li class="menu__items-inicio"><a href="enviados" class="menu__link-inicio">Enviados</a></li>
    <li class="menu__items-inicio"><a href="venta" class="menu__link-inicio">Venta</a></li>
    <li class="menu__items-inicio"><a href="productos" class="menu__link-inicio">Productos</a></li>
    <li class="menu__items-inicio"><a href="pedir" class="menu__link-inicio">Como pedir</a></li>
    <li class="menu__items-inicio"><a href="somos" class="menu__link-inicio">Somos</a></li>
    <li class="menu__items-inicio"><a href="nuestros" class="menu__link-inicio">Nuestros</a></li>
    <li class="menu__items-inicio"><a href="clientes" class="menu__link-inicio">Clientes</a></li>
    <li class="menu__items-inicio"><a href="afiliados" class="menu__link-inicio">Afiliados</a></li>
  </ul>
</div>