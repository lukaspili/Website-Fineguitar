<?php
/**********************************************************************************/
// Connexion BDD
/**********************************************************************************/
include("inc/fct.php");

require('inc/session.php');
require('inc/modelfab.php');
require('inc/instrunav.php');		

$id = intval($_GET['id']);
$result = mysql_query("SELECT * FROM fabricant WHERE id_fabricant=$id");

$frabricant = mysql_fetch_assoc($result);
if(!$frabricant){
	die(404);
}

if ($frabricant['Lien_fabricant'] != '') {
	$PrintLien = '<a href="' . $frabricant['Lien_fabricant'] . '" target="_blank" style="font-size: 11px; line-height: 18px;">Lien vers le site</a>';
}
if ($frabricant['Video1_fabricant'] != '') {
	$PrintVideo = '<a href="videos.php' . $URLVarF . $URLVarSF . '&id=' . $SearchVarID . '" style="font-size: 11px; line-height: 18px;">Regarder les vid&eacute;os</a>';
}

$articles = array();
$result = mysql_query("SELECT * FROM articles WHERE fabricant_id=$id");
while($row = mysql_fetch_assoc($result)){
	$articles[]= $row;
}

$videos = array();
$result = mysql_query("SELECT * FROM videos WHERE fabricant_id=$id");
while($row = mysql_fetch_assoc($result)){
	$videos[]= $row;
}

?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>FINEGUITAR</title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<script type="text/javascript">
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-26062757-1']);
	_gaq.push(['_trackPageview']);
	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
	</script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.menu.js"></script>
	<script type="text/javascript" src="js/jquery.imgcycle.js"></script>
	<?php require('js/dynamicpage.js'); ?>
	<script type="text/javascript">
	<?php require('js/jquery.dropdown.js'); ?>
	$(document).ready(function() {
		$('.illus1 img').each(function(){
			$(this).hide();
		});
		$('.illus2 img').each(function(){
			$(this).hide();
		});
		
		$('.illus1 img').first().show();
		$('.illus2 img').first().show();
		
		$('.illus1').cycle({fx: 'fade'});
		setTimeout(function() {$('.illus2').cycle({fx: 'fade'})}, 3000);
	});
	</script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<center>

<?php require('inc/header.php'); ?>

<table border="0" cellpadding="0" cellspacing="0" width="1000">
	<tr>
		<td align="right" valign="top" width="150" id="fabg" style="padding: 0px 10px 0px 0px; font-size: 11px; line-height: 15px;"><?php echo $PrintFab1; ?></td>
		<td valign="top" bgcolor="#FFFFFF">
		
			<table border="0" cellpadding="0" cellspacing="5" width="700">
					<img src="<?php echo $frabricant['Logo_fabricant'] ?>" />
				
					<span>En savoir plus en partenariat avec <img src="img/logo-La-G.png" width="20px"/></span>
				
					<?php if(count($articles) > 0){
						echo "Articles LaGuitar.com :";
						
						$index = 1;
						foreach($articles as $article){
							echo $index . ") <a href=\"" . $article['url'] ."\" target=\"_blank\">" . $article['name'] . "</a>";
							$index++;
						}
						}
					?>

					<?php if(count($videos) > 0){
						echo "Vidéos LaGuitar.com :";
						
						$index = 1;
						foreach($videos as $video){
							echo $index . ") <a href=\"" . $video['url'] ."\" target=\"_blank\">" . $video['name'] . "</a>";
							$index++;
						}
						}
					?>					
					
			</table>
			<table border="0" cellpadding="0" cellspacing="5" width="700" style="margin-top: -5px;">
				<tr>
					<td bgcolor="#000000" width="25%">
						<table border="0" cellpadding="10" cellspacing="0" width="100%">
							<tr>
								<td align="center" valign="middle"><?php echo $PrintVideo; ?></td>
							</tr>
						</table>
					</td>
					<td bgcolor="#000000" width="25%">
						<table border="0" cellpadding="10" cellspacing="0" width="100%">
							<tr>
								<td align="center" valign="middle"><?php echo $PrintLien; ?></td>
							</tr>
						</table>
					</td>
					<td bgcolor="#000000" width="25%">
						<table border="0" cellpadding="10" cellspacing="0" width="100%">
							<tr>  
								<td align="center" valign="middle"><a href="contact.php<?php echo $URLVarF . $URLVarSF . '&id=' . $HTTP_GET_VARS['id']; ?>" style="font-size: 11px; line-height: 18px;">Contact</a></td>
							</tr>
						</table>
					</td>
					<td bgcolor="#000000" width="25%">
						<table border="0" cellpadding="10" cellspacing="0" width="100%">
							<tr>  
								<td align="center" valign="middle"><a href="more.php<?php echo $URLVarF . $URLVarSF . '&id=' . $HTTP_GET_VARS['id']; ?>" style="font-size: 11px; line-height: 18px;">En savoir plus...</a></td>
							</tr>
						</table>
					</td>
				</tr>			
			</table>	
			
		</td>
		<td align="left" valign="top" width="150" id="fabd" style="padding: 0px 0px 0px 10px; font-size: 11px; line-height: 15px;"><?php echo $PrintFab2; ?></td>
	</tr>
</table>

<?php require('inc/footer.php'); ?>
<?php require('inc/nav_' . $_SESSION['lang'] . '.php'); ?>

</center>
</body>
</html>
