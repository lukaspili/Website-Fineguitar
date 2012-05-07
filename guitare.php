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
	
	if (ISSET($HTTP_GET_VARS['i']) && $HTTP_GET_VARS['i'] != '' && $HTTP_GET_VARS['i'] != '0' && is_numeric($HTTP_GET_VARS['i']) && strpos($HTTP_GET_VARS['i'], '.') === false) {
		$SelectContent = mysql_query('SELECT Nom_modele, Prix_modele, Description_modele, DescriptionUK_modele, Photo1_modele, Photo2_modele, Photo3_modele, Photo4_modele, Photo5_modele, Photo6_modele FROM modele WHERE Id_modele = "' . $HTTP_GET_VARS['i'] . '" AND Fabricant_modele = "' . $SearchVarID . '" AND Famille_modele = "' . $SearchVarF . '" AND Sous_famille_modele = "' . $SearchVarSF . '"');
		if (mysql_num_rows($SelectContent) != 0) {
			$CheckContent = mysql_fetch_array($SelectContent);
			
			$PrintNomModele = $CheckContent['Nom_modele'];
			$PrintPrix = $CheckContent['Prix_modele'];
			if ($_SESSION['lang'] == 'uk' && $CheckContent['DescriptionUK_modele'] != '') {
				$PrintDescription = nl2br($CheckContent['DescriptionUK_modele']);
			}
			else {
				$PrintDescription = nl2br($CheckContent['Description_modele']);
			}
			$PrintIllus = '';
			
			if ($CheckContent['Photo1_modele'] != '') {
				$PrintIllus .= '<img src="' . $CheckContent['Photo1_modele'] . '" border="0" alt="" title="" style="margin: 10px 0px 10px 0px; max-width: 379px; width: expression(this.width > 379 ? 379 : true);" /><br />';
			}
			if ($CheckContent['Photo2_modele'] != '') {
				$PrintIllus .= '<img src="' . $CheckContent['Photo2_modele'] . '" border="0" alt="" title="" style="padding: 10px 0px 10px 0px; max-width: 379px; width: expression(this.width > 379 ? 379 : true);" /><br />';
			}
			if ($CheckContent['Photo3_modele'] != '') {
				$PrintIllus .= '<img src="' . $CheckContent['Photo3_modele'] . '" border="0" alt="" title="" style="padding: 10px 0px 10px 0px; max-width: 379px; width: expression(this.width > 379 ? 379 : true);" /><br />';
			}
			if ($CheckContent['Photo4_modele'] != '') {
				$PrintIllus .= '<img src="' . $CheckContent['Photo4_modele'] . '" border="0" alt="" title="" style="padding: 10px 0px 10px 0px; max-width: 379px; width: expression(this.width > 379 ? 379 : true);" /><br />';
			}
			if ($CheckContent['Photo5_modele'] != '') {
				$PrintIllus .= '<img src="' . $CheckContent['Photo5_modele'] . '" border="0" alt="" title="" style="padding: 10px 0px 10px 0px; max-width: 379px; width: expression(this.width > 379 ? 379 : true);" /><br />';
			}
			if ($CheckContent['Photo6_modele'] != '') {
				$PrintIllus .= '<img src="' . $CheckContent['Photo6_modele'] . '" border="0" alt="" title="" style="padding: 10px 0px 10px 0px; max-width: 379px; width: expression(this.width > 379 ? 379 : true);" /><br />';
			}
		}
		else {
			header("Location: fabricant.php" . $URLVarF . $URLVarSF . '&id=' . $SearchVarID);
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
					<td align="center" colspan="3" bgcolor="#000000" style="padding: 6px; font-size: 15px; line-height: 17px;"><span style="text-transform: uppercase;"><?php echo $PrintTitle; ?></span> : <?php echo $PrintFabTitle; ?> - <?php echo $PrintNomModele; ?></td>
				</tr>
				<tr>
					<td width="226" bgcolor="#000000">
						<table border="0" cellpadding="10" cellspacing="0" width="100%">
							<tr>
								<td align="center" valign="middle"><?php echo $PrintInstru1; ?></td>
							</tr>
						</table>
					</td>
					<td width="228"bgcolor="#000000">
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
							<tr>
								<td align="left" valign="top" style="padding: 5px; font-size: 13px; line-height: 15px;"><?php echo $PrintDescription; ?><br /><br />
								Prix indicatif TTC : <?php
								$Prix = substr($PrintPrix, 0, strpos($PrintPrix, '.'));
								if ($Prix == '0') {
									echo 'NC';
								}
								else {
									echo $Prix . ' &euro;';
								}
								?></td>
								<td align="center" valign="top" bgcolor="#FFFFFF" style="width: 400px;"><?php echo $PrintIllus; ?></td>
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