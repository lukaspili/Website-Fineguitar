<?php
require_once('access.php');
require_once('../includes/functions.php');

header('Content-Type: application/text'); 
header('Content-Disposition: attachment; filename="emails.txt"'); 

$query="SELECT p.email
				FROM ".TABLE_PREFIX."posts p
				group by p.email";

$resultSearch=$ocdb->getRows($query);

foreach ($resultSearch as $row){
	echo($row['email']."\n");
}

?>
