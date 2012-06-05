<?php
require('inc/session.php');
include("../inc/fct.php");
include("inc/valid.php");

if($_GET['action'] == "remove"){
	$id = intval($_GET['id']);
	$frabricant_id = intval($_GET['frabricant_id']);
	mysql_query('DELETE FROM articles WHERE Id ="' . $id . '"');
}else{
	$frabricant_id = intval($_POST['frabricant_id']);
	mysql_query('INSERT INTO articles (fabricant_id, name, url) VALUES (' . $frabricant_id . ', "' . mysql_real_escape_string($_POST['name']) . '" , "' . mysql_real_escape_string($_POST['url']) . '" )');
}

header('Location: /admin/fab.php?selection=' . $frabricant_id);

?>
