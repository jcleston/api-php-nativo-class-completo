<?php

//Habilitando erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR);

//======================================================================
// PARAMENTROS DO BANCO DE DADOS - POSTGRESQL + PDO PARA O WEBSERVICES
//======================================================================
include_once 'conexao.php';

//======================================================================
// OUTROS PARAMENTROS
//======================================================================
define('DS', DIRECTORY_SEPARATOR);
define('DIR_APP', __DIR__);
define('DIR_PROJETO', 'api');
define('IP_PERMITIDO', '127.0.0.1');

if (file_exists('autoload.php')) {
    include 'autoload.php';
} else {
    die('Falha ao carregar autoload!');
}
