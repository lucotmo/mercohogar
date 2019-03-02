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

<style>
iframe {
    max-width: 100%;
    width:100%; 
    height:600px; 
    border:0;
}
</style>
<div class="mainReset-content">
  <div class="title-content">
    <h1 class="title__titulo"><?php echo $_GET["action"]; ?></h1>
    <!--<form class="buscar" name="titulo" action="" method="get">
      <input class="filtro" type="text" placeholder="Producto..." id="search-item">
      <button type="submit" class="icono fa fa-search"></button>
    </form>--> 
  </div>
  
  <iframe allowfullscreen src="https://drive.google.com/embeddedfolderview?id=1u7EvMeTmnj2mQMAQdg38y9niKTLhg1Nj#grid""></iframe>

</div>