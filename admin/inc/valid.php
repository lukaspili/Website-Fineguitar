<?php
// Vérifie la validité de l'accès utilisateur
if ($_SESSION['adminlogsite'] != 'okpourlog') {
	$_SESSION['adminlogsite'] = '';
	header('Location: index.php');
}
?>