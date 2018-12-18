<?php
include_once __DIR__ . "/config.php";

$m_session = new Session();

//$url = $m_session->getValue( 'url', true );
$location = ( $url )? $url : 'view/home.php';
header("location:".$location);
exit();

?>