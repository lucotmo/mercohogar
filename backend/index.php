<?php

require_once "models/enlaces.php";
require_once "models/ingreso.php";
require_once "models/gestorCategorias.php";
require_once "models/gestorProductos.php";
require_once "models/gestorPedidos.php";
require_once "models/gestorPerfil.php";
require_once "models/gestorAfiliado.php";
require_once "models/gestorClientes.php";
require_once "models/gestorPaginaNuestrosClientes.php";
require_once "models/gestorPaginaComoPedir.php";
require_once "models/gestorPaginaAfiliate.php";


require_once "controllers/template.php";

require_once "controllers/enlaces.php";
require_once "controllers/ingreso.php";
require_once "controllers/gestorCategorias.php";
require_once "controllers/gestorProductos.php";
require_once "controllers/gestorPedidos.php";
require_once "controllers/gestorPerfil.php";
require_once "controllers/gestorAfiliado.php";
require_once "controllers/gestorClientes.php";

require_once "controllers/gestorPaginaNuestrosClientes.php";
require_once "controllers/gestorPaginaComoPedir.php";
require_once "controllers/gestorPaginaAfiliate.php";

$template = new TemplateController();
$template -> template();