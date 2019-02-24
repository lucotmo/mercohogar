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
  public function mostrarCategoriasController(){
		$respuesta = CategoriasModels::seleccionarCategoriasModel("categoria");
		foreach ($respuesta as $row => $item){
      echo '<tr>
        <td class="tabla__item__categoria">'.$item["nombre_categoria"].'</td>
        <td class="tabla__item__comision">'.$item["comision"].'</td>
        <td>
          <a class="categoriaId" id="'.$item["categoria_id"].'" style="display:none;"></a>
          <a href="#" class="fa fa-edit btn__perfilDatos" id="btnEditarCategoria"></a>
        </td>
      </tr>';
      /* echo '<tr>
        <td class="tabla__item__categoria">'.$item["nombre_categoria"].'</td>
        <td class="tabla__item__comision">'.$item["comision"].'</td>
        <td>
          <a class="categoriaId" id="'.$item["categoria_id"].'" style="display:none;"></a>
          <a href="#" class="fa fa-edit btn__perfilDatos" id="btnEditarCategoria"></a>
          <a href="index.php?action=categorias&idBorrar='.$item["categoria_id"].'" class="fa fa-trash btn__perfilDatos"></a>
        </td>
      </tr>'; */
    }
  }
  public function guardarCategoriaController(){
    if ( isset($_POST["nuevaCategoria"]) ){
      $datosController = array("nombre_categoria"=>$_POST["nuevaCategoria"],
				                     "comision"=>$_POST["nuevaComision"]);

      $respuesta = CategoriasModels::guardarCategoriasModel($datosController, "categoria");

      if ( $respuesta == 'ok' ){
        echo '<script>
          swal({
              title: "¡OK!",
              text: "¡La categoria ha sido creada correctamente!",
              type: "success",
              confirmButtonText: "Cerrar",
              closeOnConfirm: false
          },
          function(isConfirm){
                if (isConfirm) {
                  window.location = "categorias";
                }
          });
        </script>';
      }else{
        echo $respuesta;
      }
    }

  }

  public function borrarCategoriaController(){
    if ( isset($_GET['idBorrar']) ){
      $datosController = $_GET['idBorrar'];

      $respuesta = CategoriasModels::borrarCategoriasModel($datosController, "categoria");

      if ( $respuesta == 'ok' ){
        echo '<script>
					swal({
						  title: "¡OK!",
						  text: "¡La categoria ha sido borrada correctamente!",
						  type: "success",
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
					},
					function(isConfirm){
							 if (isConfirm) {
							    window.location = "categorias";
							  }
          });
				</script>';
      }else{
        echo $respuesta;
      }
    }
  }

  public function editarCategoriaController(){

    if ( isset($_POST["updateCategoria"]) ){
      $datosController = array("categoria_id"=>$_POST["updateId"],
                               "nombre_categoria"=>$_POST["updateCategoria"],
                               "comision"=>$_POST["updateComision"]);

      $respuesta = CategoriasModels::editarCategoriasModel($datosController, "categoria");

      if ( $respuesta == 'ok' ){
        echo '<script>
					swal({
						  title: "¡OK!",
						  text: "¡La categoria ha sido actualizada correctamente!",
						  type: "success",
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
					},
					function(isConfirm){
							 if (isConfirm) {
							    window.location = "categorias";
							  }
          });
				</script>';
      }else{
        echo $respuesta;
      }
    }
  }

}