<?php
define('APP', "kpelli/");
define('PFX', "kpelli_");
define('SALT', "Uf58***rY9*gg");

date_default_timezone_set('America/Sao_Paulo');

error_reporting( E_ALL );

//local do arquivo de log
ini_set( 'error_log', 'error/log_de_erros.log' );

ini_set( 'ignore_repeated_source', true );    
ini_set( 'ignore_repeated_errors', true );
ini_set('display_errors', false);
ini_set( 'log_errors', true );

//classe e função callback chamada sempre que houver um erro
//require_once $_SERVER['DOCUMENT_ROOT'] . '/' . APP . "model/ErrorControl.php";
//set_error_handler(array('ErrorControl','errorAction'));

require_once $_SERVER['DOCUMENT_ROOT'] . '/' . APP . "autoload.php";


//VARIÁVEIS DE AMBIENTE environment.txt

$file = $_SERVER['DOCUMENT_ROOT'] . '/' . APP . "environment.txt";
$env = trim( file_get_contents($file) );

if( $env == 'desenvolvimento'){

	//BANCO DE DADOS***********
	define('DB', "mysql");
	define('DB_NAME', "kpelli");
	define('DB_HOST', "localhost");
	define('DB_USER', "root");
	define('DB_PASS', "mamufi2008");
	define('DB_PORT', "3306");

}else if( $env == 'producao'){
			
	//BANCO DE DADOS***********
	define('DB', "mysql");
	define('DB_NAME', "robertoduarte01");
	define('DB_HOST', "mysql.robertoduarte.com.br");
	define('DB_USER', "robertoduarte01");
	define('DB_PASS', "mamufi2008");
	define('DB_PORT', "3306");

}

function debug( $variavel ){

	echo '<br>';
	echo '***************><***************';
	echo '<pre>';
	print_r( $variavel );
	echo '</pre>';
	echo '***************><***************';
	echo '<br>';

}

?>
