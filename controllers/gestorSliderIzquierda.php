<?php

class SlidersIzquierda{
	public function seleccionarSlidersIzquierdaController(){
    $respuesta = SlidersIzquierdaModels::seleccionarSliderIzquierdaModel("nuestros_clientes");
		foreach ($respuesta as $row => $item){
      echo '
      <li class="slider-items">
        <img class="slider__img" src="backend/'.$item['ruta_imagen'].'" alt="">
      </li>';
		}

	}
}