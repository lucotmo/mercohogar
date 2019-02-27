<?php

class SlidersDerecha{
	public function seleccionarSlidersDerechaController(){
    $respuesta = SlidersDerechaModels::seleccionarSlidersDerechaModel("slides_derecha");
		foreach ($respuesta as $row => $item){
      echo '
      <li class="slider-items">
        <img class="slider__img" src="backend/'.$item['ruta_imagen'].'" alt="">
      </li>';
		}

	}

}