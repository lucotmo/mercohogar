<?php

require_once "models/conexion.php";
class GestorProductosModel{

  public function guardarProductoModel($datosModel, $tabla){
    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (imagen, titulo, medida, precio_viejo, precio_actual, promocion, id_ciudad, id_categoria)
      VALUES( :imagen, :titulo, :medida, :precio_viejo, :precio_actual, :promocion, :id_ciudad, :id_categoria )");

    $stmt -> bindParam(":imagen", $datosModel["imagen"], PDO::PARAM_STR);
    $stmt -> bindParam(":titulo", $datosModel["titulo"], PDO::PARAM_STR);
    $stmt -> bindParam(":medida", $datosModel["medida"], PDO::PARAM_STR);
    $stmt -> bindParam(":precio_viejo", $datosModel["precio_viejo"], PDO::PARAM_STR);
    $stmt -> bindParam(":precio_actual", $datosModel["precio_actual"], PDO::PARAM_STR);
    $stmt -> bindParam(":promocion", $datosModel["promocion"], PDO::PARAM_STR);
    $stmt -> bindParam(":id_ciudad", $datosModel["id_ciudad"], PDO::PARAM_STR);
    $stmt -> bindParam(":id_categoria", $datosModel["id_categoria"], PDO::PARAM_STR);

    if($stmt->execute()){
			return "ok";
		}
		else{
			return "error";
		}
		$stmt->close();
  }

  # MOSTRAR PRODUCTO
  #------------------------------------------
  public function mostrarProductoModel($tabla, $tabla2){
    $stmt = Conexion::conectar()->prepare("SELECT producto_id, imagen, titulo, medida, precio_viejo, precio_actual, promocion, id_ciudad, id_categoria, $tabla2.nombre_categoria FROM $tabla INNER JOIN $tabla2 ON $tabla.id_categoria = $tabla2.categoria_id ORDER BY titulo ASC");
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
  }
  # BORRAR PRODUCTO
  #------------------------------------------
  public function borrarProductoModel($datosModel, $tabla){
    $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE producto_id = :producto_id");
    $stmt->bindParam(":producto_id", $datosModel, PDO::PARAM_INT);
    if($stmt->execute()){
			return "ok";
		}
		else{
			return "error";
		}
		$stmt->close();
  }

  # EDITAR PRODUCTO
  #------------------------------------------
  public function editarProductoModel($datosModel, $tabla){
    $stmt = Conexion::conectar()->prepare("UPDATE $tabla
      SET imagen = :imagen, titulo = :titulo, medida = :medida, precio_viejo = :precio_viejo, precio_actual = :precio_actual, promocion = :promocion, id_ciudad = :id_ciudad, id_categoria = :id_categoria
      WHERE producto_id = :producto_id");

    $stmt -> bindParam(":imagen", $datosModel["imagen"], PDO::PARAM_STR);
    $stmt -> bindParam(":titulo", $datosModel["titulo"], PDO::PARAM_STR);
    $stmt -> bindParam(":medida", $datosModel["medida"], PDO::PARAM_STR);
    $stmt -> bindParam(":precio_viejo", $datosModel["precio_viejo"], PDO::PARAM_STR);
    $stmt -> bindParam(":precio_actual", $datosModel["precio_actual"], PDO::PARAM_STR);
    $stmt -> bindParam(":promocion", $datosModel["promocion"], PDO::PARAM_STR);
    $stmt -> bindParam(":id_ciudad", $datosModel["id_ciudad"], PDO::PARAM_STR);
    $stmt -> bindParam(":id_categoria", $datosModel["id_categoria"], PDO::PARAM_STR);
    $stmt -> bindParam(":producto_id", $datosModel["producto_id"], PDO::PARAM_STR);

    if($stmt->execute()){
			return "ok";
		}
		else{
			return "error";
		}
		$stmt->close();
  }

  public function filtarProductoModel(){
    $sql = "SELECT * FROM producto WHERE 1";
    $search_terms = isset($_GET['filtro']) ?$_GET['filtro'] : '';
    $search_arr = explode( ' ', $search_terms );

    $arr_sql_terms = array();
    $n = 0;
    foreach( $search_arr as $search_term )
    {
      $sql .= " AND id_categoria LIKE :search{$n}";
      $arr_sql_terms[":search{$n}"] = '%' . $search_term . '%';
      $n++;
    }
    $statement_count = Conexion::conectar()->prepare($sql);
    $statement_count->execute($arr_sql_terms);
    $statement_count->fetchAll();
    //$stmt = Conexion::conectar()->prepare();
  }
}

/* $sql = 'SELECT * FROM news WHERE 1';
$search_terms = isset($_GET['title']) ?$_GET['title'] : '';
$search_arr = explode( ' ', $search_terms );

$arr_sql_terms = array();
$n = 0;
foreach( $search_arr as $search_term )
{
  $sql .= " AND title LIKE :search{$n}";
  $arr_sql_terms[":search{$n}"] = '%' . $search_term . '%';
  $n++;
}

$statement_count = $pdo->prepare($sql);
$statement_count->execute($arr_sql_terms);
$results_without_paging = COUNT($statement_count->fetchAll());
//echo $results_without_paging;

$total_rows_to_show = 4;

$total_pages_to_show = ceil( $results_without_paging / $total_rows_to_show );

$current_page = isset( $_GET['page']) ? $_GET['page'] : 0 ;
$sql_page_param = $current_page * $total_rows_to_show;

$sql .= " LIMIT {$sql_page_param},{$total_rows_to_show}";

$statement = $pdo->prepare($sql);
$statement->execute($arr_sql_terms);
$results = $statement->fetchAll(); */