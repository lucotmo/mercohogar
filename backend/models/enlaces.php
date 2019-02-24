<?php
class EnlacesModels{
	public function enlacesModel($enlaces){
		if($enlaces == "inicio" ||
		   $enlaces == "ingreso" ||
		   $enlaces == "afiliate" ||
		   $enlaces == "clientes" ||
		   $enlaces == "enviados" ||
		   $enlaces == "ingreso" ||
		   $enlaces == "pedir" ||
		   $enlaces == "categorias" ||
		   $enlaces == "pendientes" ||
		   $enlaces == "productos" ||
		   $enlaces == "realizados" ||
		   $enlaces == "finalizados" ||
		   $enlaces == "ventas" ||
		   $enlaces == "perfil" ||
		   $enlaces == "app" ||
		   $enlaces == "salir"){

			$module = "views/modules/".$enlaces.".php";
		}
		else if($enlaces == "index"){
			$module = "views/modules/ingreso.php";
		}
		else{
			$module = "views/modules/ingreso.php";
		}
		return $module;
	}
}

