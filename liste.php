<?php
/**********************************************************************************/
// Connexion BDD
/**********************************************************************************/
include("inc/fct.php");

require('inc/session.php');

$PrintTotal = '';
$PrintNbFam = '';
$ControlFamilles = mysql_query('SELECT famille.Id_famille, famille.Nom_famille, sous_famille.Id_sous_famille, sous_famille.Nom_sous_famille FROM famille LEFT JOIN sous_famille ON famille.Id_famille=sous_famille.IdRef_famille ORDER BY Id_famille ASC, Id_sous_famille ASC');
if (mysql_num_rows($ControlFamilles) != 0) {
	while ($CheckFamilles = mysql_fetch_object($ControlFamilles)) {
		$Total = "0";
		$PrintNbFam .= '<td align="center" valign="top" bgcolor="#FFFFFF" style="font-size: 11px; color: #000000; font-weight: bold;">' . $CheckFamilles->Nom_famille . ' ' . $CheckFamilles->Nom_sous_famille . '</td>';
		
		$ControlFabInfos = mysql_query('SELECT Id_fabricant, Nom_fabricant, CP_fabricant FROM fabricant ORDER BY Nom_fabricant ASC');
		if (mysql_num_rows($ControlFabInfos) != 0) {
			while ($CheckFabInfos = mysql_fetch_object($ControlFabInfos)) {
				$PrintFabInfos[$CheckFabInfos->Id_fabricant] = '<td align="center" valign="top" bgcolor="#FFFFFF" style="font-size: 11px; color: #000000; font-weight: bold;">' . $CheckFabInfos->Nom_fabricant . '</td><td align="center" valign="top" bgcolor="#FFFFFF" style="font-size: 11px; color: #000000;">' . $CheckFabInfos->CP_fabricant . '</td>';
				
				$ControlModeleInfos = mysql_query('SELECT count(Id_modele) FROM modele WHERE Fabricant_modele="' . $CheckFabInfos->Id_fabricant . '" AND Famille_modele="' . $CheckFamilles->Id_famille . '" AND Sous_famille_modele="' . $CheckFamilles->Id_sous_famille . '"');
				$CheckModeleInfos = mysql_fetch_row($ControlModeleInfos);
				if ($CheckModeleInfos[0] == '0') {
					$PrintCount = '-';
				}
				else {
					$PrintCount = $CheckModeleInfos[0];
				}
				$PrintModeleInfos[$CheckFabInfos->Id_fabricant] .= '<td align="center" valign="top" bgcolor="#FFFFFF" style="font-size: 11px; color: #000000;">' . $PrintCount . '</td>';
				
				$Total = $Total + $CheckModeleInfos[0];
			}
		}
		$PrintTotal .= '<td align="center" valign="top" bgcolor="#FFFFFF" style="font-size: 11px; color: #000000; font-weight: bold;">' . $Total . '</td>';
	}
}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>FINEGUITAR</title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
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

<table border="0" cellpadding="0" cellspacing="20" width="700">
	<tr>
		<td valign="top" bgcolor="#FFFFFF">
			<table border="0" cellpadding="0" cellspacing="5" width="700">
				<tr>
					<td align="center" colspan="3" bgcolor="#000000" style="padding: 6px; font-size: 15px; line-height: 17px; text-transform: uppercase;">Liste des Luthiers & Artisans</td>
				</tr>
				<?php /* ?>
				<tr>
					<td width="226" bgcolor="#000000">
						<table border="0" cellpadding="10" cellspacing="0" width="100%">
							<tr>
								<td align="center" valign="middle"><a href="liste.php?class=1" style="font-size: 11px; line-height: 18px;">Vision / Famille</a></td>
							</tr>
						</table>
					</td>
					<td width="228"bgcolor="#000000">
						<table border="0" cellpadding="10" cellspacing="0" width="100%">
							<tr>
								<td align="center" valign="middle"><a href="liste.php?class=2" style="font-size: 11px; line-height: 18px;">Vision géographique</a></td>
							</tr>
						</table>
					</td>
					<td width="226" bgcolor="#000000"></td>
				</tr>
				<?php */ ?>
				<tr height="450">
					<td align="left" valign="top" colspan="3" bgcolor="#000000">
						<table border="0" cellpadding="0" cellspacing="10" width="690">
							<tr>
								<td align="left" valign="top" style="font-size: 13px; line-height: 15px;">
									<?php require('inc/navliste_' . $_SESSION['lang'] . '.php'); ?><br />
									<table border="0" cellpadding="5" cellspacing="2">
										<tr>
											<td></td>
											<td align="center" valign="top" bgcolor="#FFFFFF" style="font-size: 11px; color: #000000; font-weight: bold;">Département</td>
											<?php echo $PrintNbFam; ?>
										</tr>
										<?php
										$ControlPrintInfos = mysql_query('SELECT Id_fabricant FROM fabricant ORDER BY Nom_fabricant ASC');
										if (mysql_num_rows($ControlPrintInfos) != 0) {
											while ($CheckPrintInfos = mysql_fetch_object($ControlPrintInfos)) {
												echo '<tr>' . $PrintFabInfos[$CheckPrintInfos->Id_fabricant] . $PrintModeleInfos[$CheckPrintInfos->Id_fabricant] . '</tr>';
											}
										}
										?>
										<tr>
											<td align="center" valign="top" bgcolor="#FFFFFF" colspan="2" style="font-size: 11px; color: #000000; font-weight: bold;">Total</td>
											<?php echo $PrintTotal; ?>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
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