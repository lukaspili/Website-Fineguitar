<?php
session_start();
// Temps de référence pour le timeout
$inactive = 10*60;
// Contrôler le temps de session
if(isset($_SESSION['timeout'])) {
	$session_life = time() - $_SESSION['timeout'];
	if($session_life > $inactive) {
		session_destroy();
		header("Location: index.php");
	}
}
$_SESSION['timeout'] = time();

// Mise en place de la session d'identification
if (!isset($_SESSION['adminlogsite'])) {
	$_SESSION['adminlogsite'] = '';
}
?>