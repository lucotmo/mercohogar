<?php

class Conexion{
	public function conectar(){
		$link = new PDO("mysql:host=127.0.0.1;dbname=merco3","root","", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
		//$link -> mysql_set_charset('utf8');
		return $link;
	}
}

/* class Conexion{
	public function conectar(){
		$link = new PDO("mysql:host=190.8.176.71;dbname=lucotmoc_mercohogar","lucotmoc_lucho","CHARLYotero64378", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
		//$link -> mysql_set_charset('utf8');
		return $link;
	}
} */