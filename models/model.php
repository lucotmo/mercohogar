<?php

class EnlacesPaginas{
	public function enlacesPaginasModel($enlacesModel){
		if($enlacesModel == "pedir" ||
		   $enlacesModel == "clientes" ||
		   $enlacesModel == "envioo" ||
		   $enlacesModel == "afiliate" ){

		   $module = "./views/pages/".$enlacesModel.".view.php";

		}else if($enlacesModel == "index" ){
			$module = "./views/pages/index.view.php";
		}else{
			$module = "./views/pages/index.view.php";
		}
		return $module;
	}
}
