<?php

class Categorias{
	public function seleccionarCategoriasController(){
		$respuesta = CategoriasModels::seleccionarCategoriasModel("categoria");
		foreach ($respuesta as $row => $item){
      echo '
      <a class="categorias__items" id="carro" href="#" data-filter="'.$item["nombre_categoria"].'">'.$item["nombre_categoria"].'</a>
      ';
    }

	}

}