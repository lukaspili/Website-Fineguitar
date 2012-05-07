<?php
/**********************************************************************************/
// Connexion BDD
/**********************************************************************************/
include("inc/fct.php");
require('inc/session.php');

// Listing des entrées
$PrintData = '';
$SelectData = mysql_query('SELECT Id_evenement, TitreFR_evenement, TitreUK_evenement, Datedeb_evenement, Datefin_evenement, DescriptionFR_evenement, DescriptionUK_evenement, Photo1_evenement, Photo2_evenement, Photo3_evenement, Visible_evenement FROM evenement WHERE Visible_evenement="1" ORDER BY Datedeb_evenement DESC, Datefin_evenement DESC, TitreFR_evenement ASC');
if (mysql_num_rows($SelectData) != 0) {
	while ($CheckData = mysql_fetch_object($SelectData)) {
		if ($_SESSION['lang'] == 'uk' && $CheckData->TitreUK_evenement != '') {
			$PrintTitre = $CheckData->TitreUK_evenement;
		}
		else {
			$PrintTitre = $CheckData->TitreFR_evenement;
		}
		if ($CheckData->Datedeb_evenement != '') {
			$PrintDatedeb = 'du ' . date("d/m/Y",strtotime($CheckData->Datedeb_evenement)) . ' ';
		}
		else {
			$PrintDatedeb = '';
		}
		if ($CheckData->Datefin_evenement != '') {
			$PrintDatefin = 'au ' . date("d/m/Y",strtotime($CheckData->Datefin_evenement));
		}
		else {
			$PrintDatefin = '';
		}
		if ($_SESSION['lang'] == 'uk' && $CheckData->DescriptionUK_evenement) {
			$PrintDescription = nl2br($CheckData->DescriptionUK_evenement);
		}
		else {
			$PrintDescription = nl2br($CheckData->DescriptionFR_evenement);
		}
		if ($CheckData->Photo2_evenement != '') {
			$PrintPhoto2 = '<br /><br /><img src="' . $CheckData->Photo2_evenement .'" border="0" alt="" title="" style="margin: 0px 20px 0px 20px; max-width: 100px; max-height: 100px; width: expression(this.width > 100 ? 100 : true); height: expression(this.height > 100 ? 100 : true);" />';
		}
		else {
			$PrintPhoto2 = '';
		}
		if ($CheckData->Photo3_evenement != '') {
			$PrintPhoto3 = '<br /><br /><img src="' . $CheckData->Photo3_evenement .'" border="0" alt="" title="" style="margin: 0px 20px 0px 20px; max-width: 100px; max-height: 100px; width: expression(this.width > 100 ? 100 : true); height: expression(this.height > 100 ? 100 : true);" />';
		}
		else {
			$PrintPhoto3 = '';
		}
		
		if ($PrintData != '') {
			$PrintData .= '<table border="0" cellpadding="0" cellspacing="0" width="650"><tr height="1"><td bgcolor="#FFFFFF" width="650"></td></tr></table>';
		}
		$PrintData .= '<table border="0" cellpadding="0" cellspacing="0" width="650" style="padding: 30px 0px 30px 0px;"><tr><td align="left" valign="top" style="font-size: 13px; line-height: 15px;"><span style="text-transform: uppercase; font-weight: bold;">' . $PrintTitre . '</span><br />' . $PrintDatedeb . $PrintDatefin . '<br /><br />' . $PrintDescription . '</td><td align="right" valign="top"><img src="' . $CheckData->Photo1_evenement .'" border="0" alt="" title="" style="margin: 0px 20px 0px 20px; max-width: 100px; max-height: 100px; width: expression(this.width > 100 ? 100 : true); height: expression(this.height > 100 ? 100 : true);" />' . $PrintPhoto2 . $PrintPhoto3 . '</td></tr></table>';
	}
}
else {
	$PrintData = '<span class="rouge">AUCUN &Eacute;V&Eacute;NEMENT TROUV&Eacute;</span>';
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

<table border="0" cellpadding="0" cellspacing="0" width="700">
	<tr>
		<td valign="top" bgcolor="#FFFFFF">
			<table border="0" cellpadding="0" cellspacing="5" width="700">
				<tr>
					<td align="center" bgcolor="#000000" style="padding: 6px; font-size: 15px; line-height: 17px;">&Eacute;V&Eacute;NEMENTS</td>
				</tr>
				<tr>
					<td align="left" valign="middle" bgcolor="#000000" style="padding: 40px 20px 0px 20px; font-size: 13px; line-height: 15px;"><?php echo $PrintData; ?></td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<?php require('inc/footer.php'); ?>
<?php require('inc/nav_' . $_SESSION['lang'] . '.php'); ?>

</center>
</body>
</html>	