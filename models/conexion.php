<?php

$mysqli = new mysqli('127.0.0.1', 'root', '', 'merco3');

if ( $mysqli->connect_errno ){
  echo "No se ha podido conectar a la base de datos".$mysqli->connect_error;
}


/* $mysqli = new mysqli('190.8.176.71', 'lucotmoc_lucho', 'CHARLYotero64378', 'lucotmoc_mercohogar');

if ( $mysqli->connect_errno ){
  echo "No se ha podido conectar a la base de datos".$mysqli->connect_error;
} */
