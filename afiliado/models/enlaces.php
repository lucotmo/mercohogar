<?php
class EnlacesModels{
  public function enlacesModel($enlaces){
    if($enlaces == "ingreso" ||
       $enlaces == "archivos" ||
       $enlaces == "comision" ||
       $enlaces == "clientes" ||
       $enlaces == "inicio" ||
       $enlaces == "datos" ||
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

