<?php
/**********************************************************************************/
// Connexion BDD
/**********************************************************************************/
include("inc/fct.php");

require('inc/session.php');
require('inc/modelfab.php');

if ($PrintFabTitle == '') {
	header("Location: rubrique.php" . $URLVarF . $URLVarSF);
}
else {
	require('inc/instrunav.php');
	
	$PrintVideo = '';
	$PrintVideoLien = '';
	$CheckLien1 = '';
	$CheckLien2 = '';
	$CheckLien3 = '';
	$CheckLien4 = '';
	
	$SelectContent = mysql_query('SELECT Logo_fabricant, Video1_fabricant, Video2_fabricant, Video3_fabricant, Video4_fabricant FROM fabricant WHERE Id_fabricant = "' . $SearchVarID . '" AND Video1_fabricant <> ""');
	if (mysql_num_rows($SelectContent) != 0) {
		$CheckContent = mysql_fetch_array($SelectContent);
		$PrintLogo = '<img src="' . $CheckContent['Logo_fabricant'] . '" border="0" alt="" title="" style="max-width: 140px; width: expression(this.width > 140 ? 140 : true);" /><br />';
		
		if (ISSET($HTTP_GET_VARS['v']) && $HTTP_GET_VARS['v'] != '' && $HTTP_GET_VARS['v'] != '0' && is_numeric($HTTP_GET_VARS['v']) && strpos($HTTP_GET_VARS['v'], '.') === false) {
			if ($HTTP_GET_VARS['v'] == '2' && $CheckContent['Video2_fabricant'] != '') {
				$CheckLien2 = ' class="rouge"';
				$PrintVideoLien = $CheckContent['Video2_fabricant'];
			}
			else if ($HTTP_GET_VARS['v'] == '3' && $CheckContent['Video3_fabricant'] != '') {
				$CheckLien3 = ' class="rouge"';
				$PrintVideoLien = $CheckContent['Video3_fabricant'];
			}
			else if ($HTTP_GET_VARS['v'] == '4' && $CheckContent['Video4_fabricant'] != '') {
				$CheckLien4 = ' class="rouge"';
				$PrintVideoLien = $CheckContent['Video4_fabricant'];
			}
			else  {
				$CheckLien1 = ' class="rouge"';
				$PrintVideoLien = $CheckContent['Video1_fabricant'];
			}
		}
		else {
			$CheckLien1 = ' class="rouge"';
			$PrintVideoLien = $CheckContent['Video1_fabricant'];
		}
		
		if ($CheckContent['Video1_fabricant'] != '') {
			$PrintVideo1 .= '<a href="videos.php' . $URLVarF . $URLVarSF . '&id=' . $SearchVarID . '&v=1"' . $CheckLien1 .'>Vid&eacute;o 1</a>';
		}
		if ($CheckContent['Video2_fabricant'] != '') {
			$PrintVideo1 .= '<br /><a href="videos.php' . $URLVarF . $URLVarSF . '&id=' . $SearchVarID . '&v=2"' . $CheckLien2 .'>Vid&eacute;o 2</a>';
		}
		if ($CheckContent['Video3_fabricant'] != '') {
			$PrintVideo2 .= '<a href="videos.php' . $URLVarF . $URLVarSF . '&id=' . $SearchVarID . '&v=3"' . $CheckLien3 .'>Vid&eacute;o 3</a>';
		}
		if ($CheckContent['Video4_fabricant'] != '') {
			$PrintVideo2 .= '<br /><a href="videos.php' . $URLVarF . $URLVarSF . '&id=' . $SearchVarID . '&v=4"' . $CheckLien4 .'>Vid&eacute;o 4</a>';
		}
	}
	else {
		header("Location: fabricant.php" . $URLVarF . $URLVarSF . '&id=' . $SearchVarID);
	}
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
	<?php require('js/dynamicpage.js'); ?>
	<script type="text/javascript">
	<?php require('js/jquery.dropdown.js'); ?>
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
				<tr>
					<td align="center" colspan="3" bgcolor="#000000" style="padding: 6px; font-size: 15px; line-height: 17px;"><span style="text-transform: uppercase;"><?php echo $PrintTitle; ?></span> : <?php echo $PrintFabTitle; ?></td>
				</tr>
				<tr>
					<td width="226" bgcolor="#000000">
						<table border="0" cellpadding="10" cellspacing="0" width="100%">
							<tr>
								<td align="center" valign="middle"><?php echo $PrintInstru1; ?></td>
							</tr>
						</table>
					</td>
					<td width="228" bgcolor="#000000">
						<table border="0" cellpadding="10" cellspacing="0" width="100%">
							<tr>
								<td align="center" valign="middle"><?php echo $PrintInstru2; ?></td>
							</tr>
						</table>
					</td>
					<td width="226" bgcolor="#000000">
						<table border="0" cellpadding="10" cellspacing="0" width="100%">
							<tr>
								<td align="center" valign="middle"><?php echo $PrintInstru3; ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr height="655">
					<td align="left" valign="top" colspan="3" bgcolor="#000000">
						<table border="0" cellpadding="0" cellspacing="5" width="690">
							<tr height="150">
								<td width="120" align="right" valign="middle" style="padding: 5px; font-size: 11px; line-height: 30px;"><?php echo $PrintVideo1; ?></td>
								<td width="440" align="center" valign="middle" style="padding: 5px; font-size: 11px; line-height: 30px;"><?php echo $PrintLogo; ?></td>
								<td width="120" align="left" valign="middle" style="padding: 5px; font-size: 11px; line-height: 30px;"><?php echo $PrintVideo2; ?></td>
							</tr>
							<tr>
								<td align="center" valign="top" colspan="3">
									<object width="680" height="490">
										<param name="movie" value="<?php echo $PrintVideoLien; ?>"></param>
										<param name="allowFullScreen" value="true"></param>
										<param name="allowscriptaccess" value="always"></param>
										<embed src="<?php echo $PrintVideoLien; ?>" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="680" height="490"></embed>
									</object>
								</td>
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