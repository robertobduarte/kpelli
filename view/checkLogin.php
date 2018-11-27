<?php
include_once __DIR__ . "/../config.php";

$m_autenticacao = new Autenticacao();
$m_session = new Session();

echo '<pre>';
print_r($_POST);
echo '</pre>';

if( $m_autenticacao->login($_POST) ){

	$url = $m_session->getValue( 'url', true );
	$location = ( !empty( $url ) )? $url : 'home.php';
	header("location:".$location);
	exit();

}else{
	$m_session->setValue( 'login', false );
	header("location: login.php");	
	exit();
}






?>