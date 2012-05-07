<?php
require('inc/session.php');
/**********************************************************************************/
// Connexion BDD
/**********************************************************************************/
include("../inc/fct.php");
include("inc/valid.php");

// Listing des statistiques
$ControlFabricants = mysql_query('SELECT count(Id_fabricant) FROM fabricant');
$CheckFabricants = mysql_fetch_row($ControlFabricants);
$PrintNbFab = $CheckFabricants[0];

$ControlModeles = mysql_query('SELECT count(Id_modele) FROM modele');
$CheckModeles = mysql_fetch_row($ControlModeles);
$PrintNbMod = $CheckModeles[0];

$PrintNbFam = '';
$ControlFamilles = mysql_query('SELECT Id_famille, Nom_famille FROM famille');
if (mysql_num_rows($ControlFamilles) != 0) {
	while ($CheckFamilles = mysql_fetch_object($ControlFamilles)) {
		$SynchroFamilles = mysql_query('SELECT count(Id_modele) FROM modele WHERE Famille_modele = "' . $CheckFamilles->Id_famille . '"');
		$CheckSynchroFamilles = mysql_fetch_row($SynchroFamilles);
		$PrintNbFam .= '<tr><td style="font-size: 12px; line-height: 14px;">- Nombre de mod&egrave;les famille ' . $CheckFamilles->Nom_famille . ' :</td><td>' . $CheckSynchroFamilles[0] . '</td></tr>';
	}
}

$PrintNbSousFam = '';
$ControlSousFamilles = mysql_query('SELECT sous_famille.Id_sous_famille, sous_famille.Nom_sous_famille, famille.Nom_famille FROM sous_famille LEFT JOIN famille ON sous_famille.IdRef_famille=famille.Id_famille');
if (mysql_num_rows($ControlSousFamilles) != 0) {
	while ($CheckSousFamilles = mysql_fetch_object($ControlSousFamilles)) {
		$SynchroSousFamilles = mysql_query('SELECT count(Id_modele) FROM modele WHERE Sous_famille_modele = "' . $CheckSousFamilles->Id_sous_famille . '"');
		$CheckSynchroSousFamilles = mysql_fetch_row($SynchroSousFamilles);
		$PrintNbSousFam .= '<tr><td style="font-size: 12px; line-height: 14px;">- Nombre de mod&egrave;les famille ' . $CheckSousFamilles->Nom_famille . ' ' . $CheckSousFamilles->Nom_sous_famille . ' :</td><td>' . $CheckSynchroSousFamilles[0] . '</td></tr>';
	}
}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>FINEGUITAR - Administration des statistiques</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" style="background-color: #000000;">
<center>

<?php require('inc/header.php'); ?>

<table border="0" cellpadding="0" cellspacing="0" width="700">
	<tr>
		<td valign="top">
			<table border="0" cellpadding="0" cellspacing="5" width="700" bgcolor="#FFFFFF">
				<tr>
					<td align="center" bgcolor="#000000">

						<table border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td class="intit" style="padding-top: 20px; font-size: 12px; line-height: 14px;">STATISTIQUES<br />
									<div class="sep" style="margin-top: 10px;"><img src="img/pix.gif" border="0" width="1" height="1" alt="" title="" /></div>
									<table border="0" cellpadding="0" cellspacing="10">
										<tr>
											<td style="font-size: 12px; line-height: 14px;">- Nombre de fabricants :</td>
											<td><?php echo $PrintNbFab; ?></td>
										</tr>
										<tr>
											<td style="font-size: 12px; line-height: 14px;">- Nombre de mod&egrave;les :</td>
											<td><?php echo $PrintNbMod; ?></td>
										</tr>
										<tr height="10">
											<td coslpan="2"></td>
										</tr>
										<?php echo $PrintNbFam; ?>
										<tr height="10">
											<td coslpan="2"></td>
										</tr>
										<?php echo $PrintNbSousFam; ?>
									</table>
								</td>
							</tr>
						</table><br />

					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<?php include('inc/calendar.php'); ?>

</center>
</body>
</html>
</html>