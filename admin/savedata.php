<?php
header("Cache-Control: no-cache, must-revalidate");
require('inc/session.php');
/**********************************************************************************/
// Connexion BDD
/**********************************************************************************/
include("../inc/fct.php");
include("inc/valid.php");

$date = date("d-m-Y"); // On définit le variable $date (ici, son format)

$backup ="bdd_fineguitar_".$date.".sql.gz";
// Utilise les fonctions système : MySQLdump & GZIP pour générer un backup gzipé
$command = "mysqldump -h$host -u$logbase -p$pass $base | gzip> $backup";
system($command);
// Démarre la procédure de téléchargement
$taille = filesize($backup);
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-Type: application/gzip");
header("Content-Disposition: attachment; filename=$backup;");
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".$taille);
@readfile($backup);
// Supprime le fichier temporaire du serveur
unlink($backup);
?>