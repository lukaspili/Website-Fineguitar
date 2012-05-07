<?php
require('inc/session.php');
/**********************************************************************************/
// Connexion BDD
/**********************************************************************************/
include("../inc/fct.php");
include("inc/valid.php");

/* function tronque($chaine, $longueur = 120) {
	if (empty ($chaine)) { 
		return ""; 
	}
	elseif (strlen ($chaine) < $longueur) { 
		return $chaine;
	}
	elseif (preg_match ("/(.{1,$longueur})\s./ms", $chaine, $match)) {
		return $match [1] . "...";
	}
	else {
		return substr ($chaine, 0, $longueur) . "..."; 
	}
} */

$PrintID = '';
$InsertRetour = '';
$DeleteRetour = '';
$IdentRetour = '';

// Définition de l'action affiliée au formulaire
$PrintAction = 'inscription';
$PrintIntit = 'ENTRER UN NOUVEL &Eacute;V&Eacute;NEMENT';

// Modification d'une entrée
if (isset($HTTP_GET_VARS['selection']) && ($HTTP_GET_VARS['selection'] != '')) {
	$PrintAction = 'modification';
	$PrintIntit = 'MODIFIER CET &Eacute;V&Eacute;NEMENT';
	$PrintTitreFR = '';
	$PrintTitreUK = '';
	$PrintDatedeb = '';
	$PrintDatefin = '';
	$PrintDescription = '';
	$PrintDescriptionUK = '';
	$PrintPhoto1 = '';
	$PrintPhoto2 = '';
	$PrintPhoto3 = '';
	$CheckVisible = '';
	$SelectData = mysql_query('SELECT Id_evenement, TitreFR_evenement, TitreUK_evenement, Datedeb_evenement, Datefin_evenement, DescriptionFR_evenement, DescriptionUK_evenement, Photo1_evenement, Photo2_evenement, Photo3_evenement, Visible_evenement FROM evenement WHERE Id_evenement="' . $HTTP_GET_VARS['selection'] . '"');
	if (mysql_num_rows($SelectData) != 0) {
		$CheckData = mysql_fetch_array($SelectData);
		
		$PrintID = '<input type="hidden" name="id" value="' . $HTTP_GET_VARS['selection'] . '">';
		$PrintTitreFR = $CheckData['TitreFR_evenement'];
		$PrintTitreUK = $CheckData['TitreUK_evenement'];
		if ($CheckData['Datedeb_evenement'] != '') {
			$PrintDatedeb = date("d/m/Y",strtotime($CheckData['Datedeb_evenement']));
		}
		else {
			$PrintDatedeb = '';
		}
		if ($CheckData['Datefin_evenement'] != '') {
			$PrintDatefin = date("d/m/Y",strtotime($CheckData['Datefin_evenement']));
		}
		else {
			$PrintDatefin = '';
		}
		$PrintDescriptionFR = $CheckData['DescriptionFR_evenement'];
		$PrintDescriptionUK = $CheckData['DescriptionUK_evenement'];
		$PrintPhoto1 = $CheckData['Photo1_evenement'];
		$PrintPhoto2 = $CheckData['Photo2_evenement'];
		$PrintPhoto3 = $CheckData['Photo3_evenement'];
		if ($CheckData['Visible_evenement'] == '1') {
			$CheckVisible = ' checked';
		}
		else {
			$CheckVisible = '';
		}
	}
	else {
		$PrintAction = 'inscription';
		$PrintIntit = 'ENTRER UN NOUVEL &Eacute;V&Eacute;NEMENT';
		$IdentRetour = '<span class="rouge">CET &Eacute;V&Eacute;NEMENT N\'EST PAS MODIFIABLE</span>';
	}
}

// Suppression d'une entrée
if (isset($HTTP_POST_VARS['suppid']) && ($HTTP_POST_VARS['suppid'] != '')) {
	$SelectData = mysql_query('SELECT Titre_evenement, Photo1_evenement, Photo2_evenement, Photo3_evenement FROM evenement WHERE Id_evenement="' . $HTTP_POST_VARS['suppid'] . '"');
	if (mysql_num_rows($SelectData) != 0) {
		$CheckData = mysql_fetch_array($SelectData);
		unlink('../' . $CheckData["Photo1_evenement"]);
		unlink('../' . $CheckData["Photo2_evenement"]);
		unlink('../' . $CheckData["Photo3_evenement"]);
		mysql_query('DELETE FROM evenement WHERE Id_evenement="' . $HTTP_POST_VARS['suppid'] . '"');
		$DeleteRetour = '<span class="rouge">L\'&Eacute;V&Eacute;NEMENT ' . $CheckData["Titre_evenement"] . ' A &Eacute;T&Eacute; SUPPRIM&Eacute;</span>';
	}
	else {
		$DeleteRetour = '<span class="rouge">CET &Eacute;V&Eacute;NEMENT EST INEXISTANT</span>';
	}
}

// Validation du formulaire
if ((isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'inscription')) || (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'modification'))) {
	$PrintAction = $HTTP_GET_VARS['action'];
	if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'modification')) {
		$PrintIntit = 'MODIFIER CET &Eacute;V&Eacute;NEMENT';
		$PrintID = '<input type="hidden" name="id" value="' . $_POST['id'] . '">';
	}
	else {
		$PrintIntit = 'ENTRER UN NOUVEL &Eacute;V&Eacute;NEMENT';
		$PrintID = '';
	}
	$InsertRetour = '';
	$RetourPhoto1 = '';
	$RetourPhoto2 = '';
	$RetourPhoto3 = '';
	$checkError = '0';
	$ErrorTitreFR = '';
	$ErrorDatedeb = '';
	$ErrorDatefin = '';
	$ErrorDescriptionFR = '';
	$ErrorPhoto1 = '';
	$PrintTitreFR = '';
	$PrintTitreUK = '';
	$PrintDatedeb = '';
	$PrintDatefin = '';
	$PrintDescriptionFR = '';
	$PrintDescriptionUK = '';
	$PrintPhoto1 = '';
	if ($_POST['titrefr'] == '') {
		$checkError++;
		$ErrorTitreFR = '<span class="rouge">*</span>';
	}
	else {
		$PrintTitreFR = $_POST['titrefr'];
	}
	if ($_POST['titreuk'] != '') {
		$PrintTitreUK = $_POST['titreuk'];
	}
	if ($_POST['datedeb'] == '') {
		$checkError++;
		$ErrorDatedeb = '<span class="rouge">*</span>';
	}
	else {
		$PrintDatedeb = $_POST['datedeb'];
	}
	if ($_POST['datefin'] == '') {
		$checkError++;
		$ErrorDatefin = '<span class="rouge">*</span>';
	}
	else {
		$PrintDatefin = $_POST['datefin'];
	}
	if ($_POST['descriptionfr'] == '') {
		$checkError++;
		$ErrorDescriptionFR = '<span class="rouge">*</span>';
	}
	else {
		$PrintDescriptionFR = $_POST['descriptionfr'];
	}
	if ($_POST['descriptionuk'] != '') {
		$PrintDescriptionUK = $_POST['descriptionuk'];
	}
	if ($_POST['visible'] != '') {
		$CheckVisible = ' checked';
	}
	else {
		$CheckVisible = '';
	}
	if (($_FILES['photo1']['name'] != '' || $_FILES['photo2']['name'] != '' || $_FILES['photo3']['name'] != '') && $checkError == '0') {
		// Traitement de l'illustration
		$Inscription = 'img/item/event/';
		$Destination = '../img/item/event/';
		// Poids maximum (en octets)
		$PoidsRef = 400000;
		$ExtRef = array('.png','.PNG', '.gif', '.GIF', '.jpg', '.JPG', '.jpeg', '.JPEG');
		
		$LoopInc = '0';
		if ($_FILES['photo1']['name'] != '') {
			$Loop[$LoopInc] = '1';
			$LoopInc++;
		}
		if ($_FILES['photo2']['name'] != '') {
			$Loop[$LoopInc] = '2';
			$LoopInc++;
		}
		if ($_FILES['photo3']['name'] != '') {
			$Loop[$LoopInc] = '3';
			$LoopInc++;
		}
		
		for ($i = 0; $i < count($Loop); $i++) {
			$Fichier = $_FILES['photo'.$Loop[$i]]['name'];
			$FichierTmp = $_FILES['photo'.$Loop[$i]]['tmp_name'];
			
			$PosPoint = strrpos($Fichier, '.');
			${'PhotoBDD'.$Loop[$i]} = $Inscription . $Fichier;
			$PhotoFinale = $Destination . $Fichier;
			
			$Poids = filesize($_FILES['photo'.$Loop[$i]]['tmp_name']);
			$Ext = strrchr($Fichier, '.');
			
			$SelectPhoto = mysql_query('SELECT Id_evenement FROM evenement WHERE Photo1_evenement="' . ${'PhotoBDD'.$Loop[$i]} . '" OR Photo2_evenement="' . ${'PhotoBDD'.$Loop[$i]} . '" OR Photo3_evenement="' . ${'PhotoBDD'.$Loop[$i]} . '"');
			
			if (mysql_num_rows($SelectPhoto) != 0) {
				$checkError++;
				${'RetourPhoto'.$Loop[$i]} = '<span class="rouge">LE NOM DE LA PHOTO "' . $Loop[$i] .'" EXISTE D&Eacute;J&Agrave; EN BASE</span>';
				${'ErrorPhoto'.$Loop[$i]} = '<span class="rouge">*</span>';
			}
			if (!in_array($Ext, $ExtRef)) {
				$checkError++;
				${'RetourPhoto'.$Loop[$i]} = '<span class="rouge">LES EXTENSIONS AUTORIS&Eacute;ES POUR LA PHOTO "' . $Loop[$i] .'" SONT PNG, GIF, JPG et JPEG</span>';
				${'ErrorPhoto'.$Loop[$i]} = '<span class="rouge">*</span>';
			}
			else if ($Poids>$PoidsRef) {
				$checkError++;
				${'RetourPhoto'.$Loop[$i]} = '<span class="rouge">LE POIDS DE LA PHOTO "' . $Loop[$i] .'" DOIT FAIRE MOINS DE 400 KO</span>';
				${'ErrorPhoto'.$Loop[$i]} = '<span class="rouge">*</span>';
			}
			else {
				// Upload de l'illustration
				$Fichier = strtr($Fichier, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
				$Fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $Fichier);
				
				// Lit les dimensions de l'image
				$srcPhoto_img = imagecreatefromjpeg($FichierTmp);
				
				if (!move_uploaded_file($FichierTmp, $PhotoFinale)) {
					$checkError++;
					${'RetourPhoto'.$Loop[$i]} = '<br /><span class="rouge">LA PHOTO "' . $Loop[$i] .'" N\'A PU &Ecirc;TRE COPI&Eacute;E</span>';
					${'ErrorPhoto'.$Loop[$i]} = '<span class="rouge">*</span>';
				}
				imagedestroy($FichierTmp);
			}
		}
	}
	else if ($_FILES['photo1']['name'] == '' && $HTTP_GET_VARS['action'] == 'inscription') {
		$checkError++;
		$ErrorPhoto1 = '<span class="rouge">*</span>';
	}
	if ($checkError == '0') {
		$DatedebVar = substr($_POST['datedeb'],6,4)."-".substr($_POST['datedeb'],3,2)."-".substr($_POST['datedeb'],0,2);
		$DatefinVar = substr($_POST['datefin'],6,4)."-".substr($_POST['datefin'],3,2)."-".substr($_POST['datefin'],0,2);
		if ($HTTP_GET_VARS['action'] == 'inscription') {
			$InsertData = mysql_query("INSERT INTO evenement (TitreFR_evenement, TitreUK_evenement, Datedeb_evenement, Datefin_evenement, DescriptionFR_evenement, DescriptionUK_evenement, Photo1_evenement, Photo2_evenement, Photo3_evenement, Visible_evenement) VALUES ('" . $_POST['titrefr'] . "','" . $_POST['titreuk'] . "','" . $DatedebVar . "','" . $DatefinVar . "','" . $_POST['descriptionfr'] . "','" . $_POST['descriptionuk'] . "','" . $PhotoBDD1 . "','" . $PhotoBDD2 . "','" . $PhotoBDD3 . "','" . $_POST['visible'] . "')");
			$InsertRetour = '<span class="rouge">L\'&Eacute;V&Eacute;NEMENT ' . $_POST["titrefr"] . ' A &Eacute;T&Eacute; AJOUT&Eacute;</span>';
		}
		if ($HTTP_GET_VARS['action'] == 'modification') {
			if ($_FILES['photo1']['name'] != '') {
				$PrintPhotoBDD1 = ', Photo1_evenement="' . $PhotoBDD1 . '"';
			}
			else {
				$PrintPhotoBDD1 = '';
			}
			if ($_FILES['photo2']['name'] != '') {
				$PrintPhotoBDD2 = ', Photo2_evenement="' . $PhotoBDD2 . '"';
			}
			else {
				$PrintPhotoBDD2 = '';
			}
			if ($_FILES['photo3']['name'] != '') {
				$PrintPhotoBDD3 = ', Photo3_evenement="' . $PhotoBDD3 . '"';
			}
			else {
				$PrintPhotoBDD3 = '';
			}
			
			$UpdateData = mysql_query('UPDATE evenement SET TitreFR_evenement="' . $_POST['titrefr'] . '", TitreUK_evenement="' . $_POST['titreuk'] . '", Datedeb_evenement="' . $DatedebVar . '", Datefin_evenement="' . $DatefinVar . '", DescriptionFR_evenement="' . $_POST['descriptionfr'] . '", DescriptionUK_evenement="' . $_POST['descriptionuk'] . '"' . $PrintPhotoBDD1 . $PrintPhotoBDD2 . $PrintPhotoBDD3 . ', Visible_evenement="' . $_POST['visible'] . '" WHERE Id_evenement="' . $_POST['id'] . '"');
			
			$InsertRetour = '<span class="rouge">L\'&Eacute;V&Eacute;NEMENT ' . $_POST["nom"] . ' A &Eacute;T&Eacute; MODIFI&Eacute;</span>';
			$PrintAction = 'inscription';
			$PrintIntit = 'ENTRER UN NOUVEL &Eacute;V&Eacute;NEMENT';
		}
		$ErrorTitreFR = '';
		$ErrorDatedeb = '';
		$ErrorDatefin = '';
		$ErrorDescriptionFR = '';
		$ErrorPhoto1 = '';
		$PrintTitreFR = '';
		$PrintTitreUK = '';
		$PrintDatedeb = '';
		$PrintDatefin = '';
		$PrintDescriptionFR = '';
		$PrintDescriptionUK = '';
		$PrintPhoto1 = '';
	}
}

// Listing des entrées
$PrintData = '';
$PrintNum = '1';
$SelectData = mysql_query('SELECT Id_evenement, TitreFR_evenement, Datedeb_evenement, Datefin_evenement, Visible_evenement FROM evenement ORDER BY Datedeb_evenement DESC, Datefin_evenement DESC, TitreFR_evenement ASC');
if (mysql_num_rows($SelectData) != 0) {
	$PrintData .= '<table border="0" cellpadding="0" cellspacing="5" width="700" bgcolor="#FFFFFF"><tr><td align="center" bgcolor="#000000"><table border="0" cellpadding="0" cellspacing="0" width="600"><tr><td class="intit" style="padding-top: 20px; font-size: 12px; line-height: 14px;">LISTE DES &Eacute;V&Eacute;NEMENTS<br /><div class="sep" style="margin-top: 10px;"><img src="img/pix.gif" border="0" width="1" height="1" alt="" title="" /></div><table border="0" cellpadding="0" cellspacing="10"><tr><td align="center" style="font-size: 12px; line-height: 14px;">#</td><td align="center" style="font-size: 12px; line-height: 14px;">TITRE</td><td align="center" style="font-size: 12px; line-height: 14px;">DATE DE D&Eacute;BUT</td><td align="center" style="font-size: 12px; line-height: 14px;">DATE DE FIN</td><td align="center" style="font-size: 12px; line-height: 14px;">VISIBLE</td><td align="center" colspan="2" style="font-size: 12px; line-height: 14px;">ACTION</td></tr>';
	while ($CheckData = mysql_fetch_object($SelectData)) {
		if ($CheckData->Datedeb_evenement != '') {
			$ConfDatedeb = date("d/m/Y",strtotime($CheckData->Datedeb_evenement));
		}
		else {
			$ConfDatedeb = '';
		}
		if ($CheckData->Datefin_evenement != '') {
			$ConfDatefin = date("d/m/Y",strtotime($CheckData->Datefin_evenement));
		}
		else {
			$ConfDatefin = '';
		}
		if ($CheckData->Visible_evenement == '0') {
			$ConfVisible = 'non';
		}
		else {
			$ConfVisible = 'oui';
		}
		$PrintData .= '<tr><td colspan="7" style="background-color: #FFFFFF; height: 1px;"></td></tr><tr><td align="right" valign="top" style="font-size: 12px; line-height: 14px;">' . $PrintNum . '.</td><td align="left" valign="top" style="font-size: 12px; line-height: 14px;">' . $CheckData->TitreFR_evenement . '</td><td align="center" valign="top" style="font-size: 12px; line-height: 14px;">' . $ConfDatedeb . '</td><td align="center" valign="top" style="font-size: 12px; line-height: 14px;">' . $ConfDatefin . '</td><td align="center" valign="top" style="font-size: 12px; line-height: 14px;">' . $ConfVisible . '</td><td valign="top"><input type="button" value="modifier" onClick="document.location.href=\'' . $_SERVER['PHP_SELF'] . '?selection=' . $CheckData->Id_evenement . '\';" class="btnmodif" /><td valign="top"><form name="supp' . $CheckData->Id_evenement . '" action="' . $_SERVER['PHP_SELF'] . '" method="post"><input type="hidden" name="suppid" value="' . $CheckData->Id_evenement . '"><input type="button" value="supprimer" onClick="verif_form(this.form)" class="btnsupp" style="border: 0px; background-color: #FF3131;" /></form></td></tr>';
		$PrintNum++;
	}
	$PrintData .= '</table></td></tr></table><br /></td></tr></table>';
}
else {
	$PrintData = '<span class="rouge">AUCUN &Eacute;V&Eacute;NEMENT TROUV&Eacute;</span>';
}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>FINEGUITAR - Administration des &eacute;v&eacute;nements</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css" />
	<script type="text/javascript" src="js/calendar2.js"></script>
	<script type="text/javascript">
	function verif_form(monForm) {
		var answer = confirm('Etes-vous certain de vouloir supprimer cet événement ?');
		if (answer){
			monForm.submit();
		}
		else{
			return false;
		}
	}
	</script>
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

						<form name="class" action="<?php echo $_SERVER['PHP_SELF']; ?>?action=<?php echo $PrintAction; ?>" method="post" enctype="multipart/form-data">
						<?php echo $PrintID; ?>
						
						<table border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td class="intit" style="padding-top: 20px; font-size: 12px; line-height: 14px;"><?php echo $PrintIntit; ?><br />
								<?php
								if ($checkError > '0' && $ErrorIllus == '') {
									echo '<span class="rouge">LES CHAMPS MARQU&Eacute;S D\'UNE (*) SONT OBLIGATOIRES</span>';
								}
								if ($RetourPhoto1 != '') {
									echo '<br /><span class="rouge">' . $RetourPhoto1 . '</span>';
								}
								if ($RetourPhoto2 != '') {
									echo '<br /><span class="rouge">' . $RetourPhoto2 . '</span>';
								}
								if ($RetourPhoto3 != '') {
									echo '<br /><span class="rouge">' . $RetourPhoto3 . '</span>';
								}
								echo $InsertRetour;
								echo $DeleteRetour;
								echo $IdentRetour;
								?>
									<div class="sep" style="margin-top: 10px;"><img src="img/pix.gif" border="0" width="1" height="1" alt="" title="" /></div>
									<table border="0" cellpadding="0" cellspacing="10">
										<tr>
											<td style="font-size: 12px; line-height: 14px;">Titre<?php echo ' ' . $ErrorTitreFR; ?></td>
											<td><input type="text" name="titrefr" value="<?php echo $PrintTitreFR; ?>" /></td>
										</tr>
										<tr>
											<td style="font-size: 12px; line-height: 14px;">Titre UK</td>
											<td><input type="text" name="titreuk" value="<?php echo $PrintTitreUK; ?>" /></td>
										</tr>
										<tr>
											<td style="font-size: 12px; line-height: 14px;">Date de d&eacute;but<?php echo ' ' . $ErrorDatedeb; ?></td>
											<td><input type="text" name="datedeb" value="<?php echo $PrintDatedeb; ?>" id="p_date1" /></td>
											<td><img src="img/calendar.gif" width="15" height="13" alt="Calendrier" title="Calendrier" onclick="selectDate(event,1);" style="cursor: pointer;" /></td>
										</tr>
										<tr>
											<td style="font-size: 12px; line-height: 14px;">Date de fin<?php echo ' ' . $ErrorDatefin; ?></td>
											<td><input type="text" name="datefin" value="<?php echo $PrintDatefin; ?>" id="p_date2" /></td>
											<td><img src="img/calendar.gif" width="15" height="13" alt="Calendrier" title="Calendrier" onclick="selectDate(event,2);" style="cursor: pointer;" /></td>
										</tr>
										<tr>
											<td valign="top" style="font-size: 12px; line-height: 14px;">Description<?php echo ' ' . $ErrorDescriptionFR; ?></td>
											<td><textarea name="descriptionfr" class="textarea"><?php echo $PrintDescriptionFR; ?></textarea></td>
										</tr>
										<tr>
											<td valign="top" style="font-size: 12px; line-height: 14px;">Description UK</td>
											<td><textarea name="descriptionuk" class="textarea"><?php echo $PrintDescriptionUK; ?></textarea></td>
										</tr>
										<tr>
											<td style="font-size: 12px; line-height: 14px;">Photo 1<?php echo ' ' . $ErrorPhoto1; ?></td>
											<td><input type="file" name="photo1" />
											<?php
											if ($PrintPhoto1 != '') {
											?>
												<br /><img src="../img/pix.gif" width="1" height="5" border="0" alt="" title="" /><br />
												<span style="font-size: 12px; line-height: 14px;"><?php echo '<a href="../' .$PrintPhoto1 . '" target="_blank" class="rouge">' . $PrintPhoto1. '</a>'; ?></span>
												<?php
											}
											?></td>
										</tr>
										<tr>
											<td style="font-size: 12px; line-height: 14px;">Photo 2</td>
											<td><input type="file" name="photo2" />
											<?php
											if ($PrintPhoto2 != '') {
											?>
												<br /><img src="../img/pix.gif" width="1" height="5" border="0" alt="" title="" /><br />
												<span style="font-size: 12px; line-height: 14px;"><?php echo '<a href="../' .$PrintPhoto2 . '" target="_blank" class="rouge">' . $PrintPhoto2. '</a>'; ?></span>
												<?php
											}
											?></td>
										</tr>
										<tr>
											<td style="font-size: 12px; line-height: 14px;">Photo 3</td>
											<td><input type="file" name="photo3" />
											<?php
											if ($PrintPhoto3 != '') {
											?>
												<br /><img src="../img/pix.gif" width="1" height="5" border="0" alt="" title="" /><br />
												<span style="font-size: 12px; line-height: 14px;"><?php echo '<a href="../' .$PrintPhoto3 . '" target="_blank" class="rouge">' . $PrintPhoto3. '</a>'; ?></span>
												<?php
											}
											?></td>
										</tr>
										<tr>
											<td style="font-size: 12px; line-height: 14px;">Visible</td>
											<td colspan="2"><input name="visible" type="checkbox" value="1"<?php echo $CheckVisible; ?> /></td>
										</tr>
										<tr>
											<td></td>
											<td><input type="submit" value="Valider" class="btnvalid" style="float: left;" /><input type="buton" value="Annuler" onClick="document.location.href='<?php echo $_SERVER['PHP_SELF']; ?>';" class="btncancel" style="float: left; text-align: center; border: 0px; background-color: #FF3131;" /></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						
						</form><br />

					</td>
				</tr>
			</table>
			<br /><br />
			<?php echo $PrintData; ?>
			<br /><br />
		</td>
	</tr>
</table>

<?php include('inc/calendar2.php'); ?>

<?php print $LunchScript; ?>

</center>
</body>
</html>
</html>