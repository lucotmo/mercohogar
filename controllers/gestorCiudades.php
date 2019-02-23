<?php

class Ciudades{
	public function seleccionarCiudadesController(){
		$respuesta = CiudadesModels::seleccionarCiudadesModel("ciudades");
		foreach ($respuesta as $row => $item){
      echo '
        <option value="'.$item["ciudad_id"].'">'.ucwords(strtolower($item["nombre"])).'</option>
      ';
    }

	}

}