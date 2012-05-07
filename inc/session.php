<?php
session_start();
$_SESSION['lang'] = "fr";
/*
// Si pas de session en cours, attribuer la langue du navigateur en priorité FR
// $LinkVersion permet de basculer d'une langue à l'autre au travers du lien prévu à cet effet
if (!isset($_SESSION['lang']) && !isset($_GET['lang'])) {
	if (strpos($_SERVER['HTTP_ACCEPT_LANGUAGE'], 'en') === false) {
	    $_SESSION['lang'] = "fr";
		$LinkVersion = "uk";
	}
	else {
		$_SESSION['lang'] = "uk";
		$LinkVersion = "fr";
	}
}
// Si la variable langue est passée par l'URL, appliquer la version en question
// $LinkVersion permet de basculer d'une langue à l'autre au travers du lien prévu à cet effet
else if (isset($_GET['lang'])) {
	$_SESSION['lang'] = $_GET['lang'];
	
	if ($_GET['lang'] == "fr") {
		$LinkVersion = "uk";
	}
	else {
		$LinkVersion = "fr";
	}
}
// Perpétuer la session en cours
// $LinkVersion permet de basculer d'une langue à l'autre au travers du lien prévu à cet effet
else {
	if ($_SESSION['lang'] == "fr") {
		$LinkVersion = "uk";
	}
	else {
		$LinkVersion = "fr";
	}
}
*/
?>