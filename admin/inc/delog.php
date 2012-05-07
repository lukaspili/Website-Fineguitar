<?php
// Déconnexion et retour à l'écran d'identification
require('session.php');
if ($_SESSION['adminlogsite'] == 'okpourlog') {
	$_SESSION['adminlogsite'] = '';
	header('Location: ../index.php');
}
else {
	header('Location: ../index.php');
}
?>