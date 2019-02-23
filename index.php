<?php

require_once "models/model.php";
require_once "models/gestorCategorias.php";
require_once "models/gestorProductos.php";
require_once "models/gestorCiudades.php";
/* require_once "models/gestorPedido.php"; */


require_once "controllers/controller.php";
require_once "controllers/gestorCategorias.php";
require_once "controllers/gestorProductos.php";
require_once "controllers/gestorCiudades.php";
/* require_once "controllers/gestorPedido.php"; */


$mvc = new MvcController();
$mvc -> plantilla();