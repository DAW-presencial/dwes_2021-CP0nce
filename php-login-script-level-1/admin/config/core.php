<?php

//error 
error_reporting(E_ALL);

//iniciar sesion de php
session_start();

//indicas tu zona horaria
date_default_timezone_set("Europe/Madrid");

//url de la pagina inicio
$home_url="http://localhost/cms/php-login-script-level-1/";

$page = isset($_GET['page']) ? $_GET['page'] : 1;

//nº por página
$records_per_page = 5;

//calcular por la query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;


?>