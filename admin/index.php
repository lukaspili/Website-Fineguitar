<?php
require('inc/session.php');
/**********************************************************************************/
// Connexion BDD
/**********************************************************************************/
include("../inc/fct.php");
include("inc/cnx.php");
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>FINEGUITAR - Administration</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" style="background-color: #000000;">
<center>

<?php require('inc/header.php'); ?>

<table border="0" cellpadding="0" cellspacing="0" width="700">
	<tr>
		<td valign="top" bgcolor="#FFFFFF">
			<table border="0" cellpadding="0" cellspacing="5" width="700">
				<tr>
					<td align="center" colspan="3" bgcolor="#000000">
					
						<?php
						if ($_SESSION['adminlogsite'] == 'okpourlog') {
							?>
							
						<table border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td style="padding-top: 20px; font-size: 12px; line-height: 14px;">S&Eacute;LECTIONNER UNE RUBRIQUE</td>
							</tr>
							<tr>
								<td>
									<div style="padding-top: 10px; font-size: 12px; line-height: 14px;">- <a href="fab.php">Administration des fabricants</a></div>
									<div style="padding-top: 10px; font-size: 12px; line-height: 14px;">- <a href="instru.php">Administration des mod&egrave;les</a></div>
									<div style="padding-top: 10px; font-size: 12px; line-height: 14px;">- <a href="event.php">Administration des événements</a></div>
									<div style="padding-top: 10px; font-size: 12px; line-height: 14px;">- <a href="stats.php">Statistiques</a></div>
									<div style="padding-top: 10px; font-size: 12px; line-height: 14px;">- <a href="catalogue.php">Catalogue</a></div>
									<div style="padding-top: 10px; font-size: 12px; line-height: 14px;">- <a href="savedata.php">Sauvegarde BDD</a></div>
								</td>
							</tr>
							<tr>
								<td align="center" style="padding: 20px 0px 20px 0px;"><input type="button" value="D&eacute;connexion" onClick="document.location.href='inc/delog.php';" class="btndelog" /></td>
							</tr>
						</table>
							<?php
						}
						else if ($_SESSION['adminlogsite'] == 'errorlog') {
							$_SESSION['adminlogsite'] = '';
							?>
						<form name="logacces" action="<?php echo $_SERVER['PHP_SELF']; ?>?action=logacces" method="post">
						<table border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td style="padding-top: 20px; font-size: 12px; line-height: 14px;">IDENTIFICATION <span class="rouge">(ERREUR D'IDENTIFICATION)</span>
									<table border="0" cellpadding="0" cellspacing="10">
										<tr>
											<td style="font-size: 12px; line-height: 14px;">Nom d'utilisateur</td>
											<td><input type="text" name="login" value="" class="champtext" /></td>
										</tr>
										<tr>
											<td style="font-size: 12px; line-height: 14px;">Mot de passe</td>
											<td><input type="password" name="pass" value="" class="champtext" /></td>
										</tr>
										<tr>
											<td style="font-size: 12px; line-height: 14px;"></td>
											<td align="center" style="padding: 0px 0px 20px 0px;"><input type="submit" value="Valider" class="btnsubmit" /></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						</form>
							<?php
						}
						else {
							?>
						<form name="logacces" action="<?php echo $_SERVER['PHP_SELF']; ?>?action=logacces" method="post">
						<table border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td style="padding-top: 20px; font-size: 12px; line-height: 14px;">IDENTIFICATION
									<table border="0" cellpadding="0" cellspacing="10">
										<tr>
											<td style="font-size: 12px; line-height: 14px;">Nom d'utilisateur</td>
											<td><input type="text" name="login" value="" class="champtext" /></td>
										</tr>
										<tr>
											<td style="font-size: 12px; line-height: 14px;">Mot de passe</td>
											<td><input type="password" name="pass" value="" class="champtext" /></td>
										</tr>
										<tr>
											<td style="font-size: 12px; line-height: 14px;"></td>
											<td align="center" style="padding: 0px 0px 20px 0px;"><input type="submit" value="Valider" class="btnsubmit" /></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						</form>
							<?php
						}
						?>
					
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

</center>
</body>
</html>