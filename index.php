<?php

require_once "models/model.php";
require_once "models/gestorCategorias.php";
require_once "models/gestorProductos.php";
require_once "models/gestorCiudades.php";
require_once "models/gestorNuestrosClientes.php";
require_once "models/gestorSliderIzquierda.php";
require_once "models/gestorSliderDerecha.php";
require_once "models/gestorComoPedir.php";
require_once "models/gestorAfiliate.php";
/* require_once "models/gestorPedido.php"; */


require_once "controllers/controller.php";
require_once "controllers/gestorCategorias.php";
require_once "controllers/gestorProductos.php";
require_once "controllers/gestorCiudades.php";
require_once "controllers/gestorNuestrosClientes.php";
require_once "controllers/gestorSliderIzquierda.php";
require_once "controllers/gestorSliderDerecha.php";
require_once "controllers/gestorComoPedir.php";
require_once "controllers/gestorAfiliate.php";
/* require_once "controllers/gestorPedido.php"; */


$mvc = new MvcController();
$mvc -> plantilla();