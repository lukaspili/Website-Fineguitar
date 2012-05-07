<?php
$host		= "mysql51-25.pro";
$logbase	= "fineguitare";
$pass		= "S3bZq8Ua";

$connexion = mysql_connect($host,$logbase,$pass) or die("<strong>Erreur !</strong><br />Serveur temporairement indisponible.");

$base		= "fineguitare";
mysql_select_db($base) or die("<strong>Erreur !</strong><br />Base de donn&eacute;e inaccessible.");
?>