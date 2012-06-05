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
$PrintIntit = 'ENTRER UN NOUVEAU FABRICANT';

// Modification d'une entrée
if (isset($HTTP_GET_VARS['selection']) && ($HTTP_GET_VARS['selection'] != '')) {
	$PrintAction = 'modification';
	$PrintIntit = 'MODIFIER CE FABRICANT';
	$PrintNom = '';
	$PrintAdresse = '';
	$PrintCP = '';
	$PrinPays = '';
	$PrintEmail = '';
	$PrintTel = '';
	$PrintEmailDirect = '';
	$PrintTelDirect = '';	
	$PrintDescription = '';
	$PrintDescriptionUK = '';
	$PrintLien = '';
	$PrintVideo1 = '';
	$PrintVideo2 = '';
	$PrintVideo3 = '';
	$PrintVideo4 = '';
	$CheckPub = '';
	$CheckRef = '';
	$CheckVisible = '';
	$PrintMontant = '';
	$PrintGestion = '';
	$PrintHistorique = '';
	$SelectData = mysql_query('SELECT Id_fabricant, Nom_fabricant, Adresse_fabricant, CP_fabricant, Pays_fabricant, Email_fabricant, Tel_fabricant, Logo_fabricant, Portrait_fabricant, Description_fabricant, DescriptionUK_fabricant, Lien_fabricant, Video1_fabricant, Video2_fabricant, Video3_fabricant, Video4_fabricant, Publication_fabricant, Payant_fabricant, Montant_fabricant, Date_fabricant, Visible_fabricant, Gestion_fabricant, Historique_fabricant, phone_direct, mail_direct FROM fabricant WHERE Id_fabricant="' . $HTTP_GET_VARS['selection'] . '"');
	if (mysql_num_rows($SelectData) != 0) {
		$CheckData = mysql_fetch_array($SelectData);
		
		$PrintID = '<input type="hidden" name="id" value="' . $HTTP_GET_VARS['selection'] . '">';
		$PrintNom = $CheckData['Nom_fabricant'];
		$PrintAdresse = $CheckData['Adresse_fabricant'];
		$PrintCP = $CheckData['CP_fabricant'];
		$PrintPays = $CheckData['Pays_fabricant'];
		$PrintEmail = $CheckData['Email_fabricant'];
		$PrintTel = $CheckData['Tel_fabricant'];
		$PrintEmailDirect = $CheckData['mail_direct'];
		$PrintTelDirect = $CheckData['phone_direct'];
		$PrintLogo = $CheckData['Logo_fabricant'];
		$PrintPortrait = $CheckData['Portrait_fabricant'];
		$PrintDescription = $CheckData['Description_fabricant'];
		$PrintDescriptionUK = $CheckData['DescriptionUK_fabricant'];
		$PrintLien = $CheckData['Lien_fabricant'];
		$PrintVideo1 = $CheckData['Video1_fabricant'];
		$PrintVideo2 = $CheckData['Video2_fabricant'];
		$PrintVideo3 = $CheckData['Video3_fabricant'];
		$PrintVideo4 = $CheckData['Video4_fabricant'];
		if ($CheckData['Publication_fabricant'] == '1') {
			$CheckPub = ' checked';
		}
		else {
			$CheckPub = '';
		}
		if ($CheckData['Payant_fabricant'] == '1') {
			$CheckRef = ' checked';
		}
		else {
			$CheckRef = '';
		}
		$PrintMontant = $CheckData['Montant_fabricant'];
		if ($CheckData['Date_fabricant'] != '') {
			$PrintDate = date("d/m/Y",strtotime($CheckData['Date_fabricant']));
		}
		else {
			$PrintDate = '';
		}
		if ($CheckData['Visible_fabricant'] == '1') {
			$CheckVisible = ' checked';
		}
		else {
			$CheckVisible = '';
		}
		$PrintGestion = $CheckData['Gestion_fabricant'];
		$PrintHistorique = $CheckData['Historique_fabricant'];
	}
	else {
		$PrintAction = 'inscription';
		$PrintIntit = 'ENTRER UN NOUVEAU FABRICANT';
		$IdentRetour = '<span class="rouge">CE FABRICANT N\'EST PAS MODIFIABLE</span>';
	}
}

// Suppression d'une entrée
if (isset($HTTP_POST_VARS['suppid']) && ($HTTP_POST_VARS['suppid'] != '')) {
	$SelectData = mysql_query('SELECT Nom_fabricant, Logo_fabricant, Portrait_fabricant FROM fabricant WHERE Id_fabricant="' . $HTTP_POST_VARS['suppid'] . '"');
	if (mysql_num_rows($SelectData) != 0) {
		$CheckData = mysql_fetch_array($SelectData);
		unlink('../' . $CheckData["Logo_fabricant"]);
		unlink('../' . $CheckData["Portrait_fabricant"]);
		mysql_query('DELETE FROM fabricant WHERE Id_fabricant="' . $HTTP_POST_VARS['suppid'] . '"');
		$DeleteRetour = '<span class="rouge">LE FABRICANT ' . $CheckData["Nom_fabricant"] . ' A &Eacute;T&Eacute; SUPPRIM&Eacute;</span>';
	}
	else {
		$DeleteRetour = '<span class="rouge">CE FABRICANT EST INEXISTANT</span>';
	}
}

// Validation du formulaire
if ((isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'inscription')) || (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'modification'))) {
	$PrintAction = $HTTP_GET_VARS['action'];
	if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'modification')) {
		$PrintIntit = 'MODIFIER CE FABRICANT';
		$PrintID = '<input type="hidden" name="id" value="' . $_POST['id'] . '">';
	}
	else {
		$PrintIntit = 'ENTRER UN NOUVEAU FABRICANT';
		$PrintID = '';
	}
	$InsertRetour = '';
	$RetourLogo = '';
	$RetourPortrait = '';
	$checkError = '0';
	$ErrorNom = '';
	$ErrorAdresse = '';
	$ErrorCP = '';
	$ErrorPays = '';
	$ErrorEmail = '';
	$ErrorTel = '';
	$ErrorLogo = '';
	$ErrorPortrait = '';
	$ErrorDescription = '';
	$ErrorLien = '';
	$ErrorVideo1 = '';
	$PrintNom = '';
	$PrintAdresse = '';
	$PrintEmail = '';
	$PrintTel = '';
	$PrintDescription = '';
	$PrintDescriptionUK = '';
	$PrintLien = '';
	$PrintVideo1 = '';
	$PrintGestion = '';
	$PrintHistorique = '';
	if ($_POST['nom'] == '') {
		$checkError++;
		$ErrorNom = '<span class="rouge">*</span>';
	}
	else {
		$PrintNom = $_POST['nom'];
	}
	if ($_POST['adresse'] == '') {
		$checkError++;
		$ErrorAdresse = '<span class="rouge">*</span>';
	}
	else {
		$PrintAdresse = $_POST['adresse'];
	}
	if ($_POST['cp'] == '') {
		$checkError++;
		$ErrorCP = '<span class="rouge">*</span>';
	}
	else {
		$PrintCP = $_POST['cp'];
	}
	if ($_POST['pays'] == '') {
		$checkError++;
		$ErrorPays = '<span class="rouge">*</span>';
	}
	else {
		$PrintPays = $_POST['pays'];
	}
	if ($_POST['email'] == '') {
		$checkError++;
		$ErrorEmail = '<span class="rouge">*</span>';
	}
	else {
		$PrintEmail = $_POST['email'];
	}
	if ($_POST['tel'] == '') {
		$checkError++;
		$ErrorTel = '<span class="rouge">*</span>';
	}
	else {
		$PrintTel = $_POST['tel'];
	}
	if ($_POST['description'] == '') {
		$checkError++;
		$ErrorDescription = '<span class="rouge">*</span>';
	}
	else {
		$PrintDescription = $_POST['description'];
	}
	if ($_POST['descriptionuk'] != '') {
		$PrintDescriptionUK = $_POST['descriptionuk'];
	}
	if ($_POST['lien'] == '') {
		$checkError++;
		$ErrorLien = '<span class="rouge">*</span>';
	}
	else {
		$PrintLien = $_POST['lien'];
	}
	if ($_POST['video1'] == '') {
		$checkError++;
		$ErrorVideo1 = '<span class="rouge">*</span>';
	}
	else {
		$PrintVideo1 = $_POST['video1'];
	}
	if ($_POST['video2'] != '') {
		$PrintVideo2 = $_POST['video2'];
	}
	if ($_POST['video3'] != '') {
		$PrintVideo3 = $_POST['video3'];
	}
	if ($_POST['video4'] != '') {
		$PrintVideo4 = $_POST['video4'];
	}
	if ($_POST['pub'] != '') {
		$CheckPub = ' checked';
	}
	else {
		$CheckPub = '';
	}
	if ($_POST['ref'] != '') {
		$CheckRef = ' checked';
	}
	else {
		$CheckRef = '';
	}
	if ($_POST['montant'] != '') {
		$PrintMontant = $_POST['montant'];
	}
	if ($_POST['date'] != '') {
		$PrintDate = $_POST['date'];
	}
	if ($_POST['visible'] != '') {
		$CheckVisible = ' checked';
	}
	else {
		$CheckVisible = '';
	}
	if ($_POST['gestion'] != '') {
		$PrintGestion = $_POST['gestion'];
	}
	if ($_POST['historique'] != '') {
		$PrintHistorique = $_POST['historique'];
	}
	if ($_FILES['logo']['name'] != '' && $checkError == '0') {
		// Traitement de l'illustration
		$Inscription = 'img/item/logo/';
		$Destination = '../img/item/logo/';
		// Poids maximum (en octets)
		$PoidsRef = 400000;
		$ExtRef = array('.png','.PNG', '.gif', '.GIF', '.jpg', '.JPG', '.jpeg', '.JPEG');
		
		$Fichier = $_FILES['logo']['name'];
		$FichierTmp = $_FILES['logo']['tmp_name'];
		$Poids = filesize($_FILES['logo']['tmp_name']);
		
		$IllusLogo = $Inscription . $Fichier;
		$IllusFinale = $Destination . $Fichier;
		$Ext = strrchr($Fichier, '.');
		
		$SelectIllus = mysql_query('SELECT id_fabricant FROM fabricant WHERE Logo_fabricant="' . $IllusLogo . '"');
		
		if (mysql_num_rows($SelectIllus) != 0) {
			$checkError++;
			$RetourLogo = '<br /><span class="rouge">LE NOM DU LOGO EXISTE D&Eacute;J&Agrave; EN BASE</span>';
			$ErrorLogo = '<span class="rouge">*</span>';
		}
		else if (!in_array($Ext, $ExtRef)) {
			$checkError++;
			$RetourLogo = '<br /><span class="rouge">LES EXTENSIONS AUTORIS&Eacute;ES POUR LE LOGO SONT PNG, GIF, JPG et JPEG</span>';
			$ErrorLogo = '<span class="rouge">*</span>';
		}
		else if ($Poids>$PoidsRef) {
			$checkError++;
			$RetourLogo = '<br /><span class="rouge">LE POIDS DU LOGO DOIT FAIRE MOINS DE 400 KO</span>';
			$ErrorLogo = '<span class="rouge">*</span>';
		}
		else {
			// Upload de l'illustration
			$Fichier = strtr($Fichier, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
			$Fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $Fichier);
			
			$srcIllus_img = imagecreatefromjpeg($FichierTmp);
			
			if (!move_uploaded_file($FichierTmp, $IllusFinale)) {
				$checkError++;
				$RetourLogo = '<br /><span class="rouge">LE LOGO N\'A PU &Ecirc;TRE COPI&Eacute;E</span>';
				$ErrorLogo = '<span class="rouge">*</span>';
			}
			imagedestroy($FichierTmp);
		}
	}
	else if ($HTTP_GET_VARS['action'] == 'inscription') {
		$checkError++;
		$ErrorLogo = '<span class="rouge">*</span>';
	}
	if ($_FILES['portrait']['name'] != '' && $checkError == '0') {
		// Traitement de l'illustration
		$Inscription = 'img/item/portrait/';
		$Destination = '../img/item/portrait/';
		// Poids maximum (en octets)
		$PoidsRef = 400000;
		$ExtRef = array('.png','.PNG', '.gif', '.GIF', '.jpg', '.JPG', '.jpeg', '.JPEG');
		
		$Fichier = $_FILES['portrait']['name'];
		$FichierTmp = $_FILES['portrait']['tmp_name'];
		$Poids = filesize($_FILES['portrait']['tmp_name']);
		
		$IllusPortrait = $Inscription . $Fichier;
		$IllusFinale = $Destination . $Fichier;
		$Ext = strrchr($Fichier, '.');
		
		$SelectIllus = mysql_query('SELECT id_fabricant FROM fabricant WHERE Portrait_fabricant="' . $IllusPortrait . '"');
		
		if (mysql_num_rows($SelectIllus) != 0) {
			$checkError++;
			$RetourPortrait = '<br /><span class="rouge">LE NOM DU PORTRAIT EXISTE D&Eacute;J&Agrave; EN BASE</span>';
			$ErrorPortrait = '<span class="rouge">*</span>';
		}
		else if (!in_array($Ext, $ExtRef)) {
			$checkError++;
			$RetourPortrait = '<br /><span class="rouge">LES EXTENSIONS AUTORIS&Eacute;ES POUR LE PORTRAIT SONT PNG, GIF, JPG et JPEG</span>';
			$ErrorPortrait = '<span class="rouge">*</span>';
		}
		else if ($Poids>$PoidsRef) {
			$checkError++;
			$RetourPortrait = '<br /><span class="rouge">LE POIDS DU PORTRAIT DOIT FAIRE MOINS DE 400 KO</span>';
			$ErrorPortrait = '<span class="rouge">*</span>';
		}
		else {
			// Upload de l'illustration
			$Fichier = strtr($Fichier, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
			$Fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $Fichier);
			
			$srcIllus_img = imagecreatefromjpeg($FichierTmp);
			
			if (!move_uploaded_file($FichierTmp, $IllusFinale)) {
				$checkError++;
				$RetourPortrait = '<br /><span class="rouge">LE PORTRAIT N\'A PU &Ecirc;TRE COPI&Eacute;E</span>';
				$ErrorPortrait = '<span class="rouge">*</span>';
			}
			imagedestroy($FichierTmp);
		}
	}
	/* else if ($HTTP_GET_VARS['action'] == 'inscription') {
		$checkError++;
		$ErrorPortrait = '<span class="rouge">*</span>';
	} */
	if ($checkError == '0') {
		$DateVar = substr($_POST['date'],6,4)."-".substr($_POST['date'],3,2)."-".substr($_POST['date'],0,2);
		if ($HTTP_GET_VARS['action'] == 'inscription') {
			$InsertData = mysql_query("INSERT INTO fabricant (Nom_fabricant, Adresse_fabricant, CP_fabricant, Pays_fabricant, Email_fabricant, Tel_fabricant, Logo_fabricant, Portrait_fabricant, Description_fabricant, DescriptionUK_fabricant, Lien_fabricant, Video1_fabricant, Video2_fabricant, Video3_fabricant, Video4_fabricant, Publication_fabricant, Payant_fabricant, Montant_fabricant, Date_fabricant, Visible_fabricant, Gestion_fabricant, Historique_fabricant) VALUES ('" . $_POST['nom'] . "','" . $_POST['adresse'] . "','" . $_POST['cp'] . "','" . $_POST['pays'] . "','" . $_POST['email'] . "','" . $_POST['tel'] . "','" . $IllusLogo . "','" . $IllusPortrait . "','" . $_POST['description'] . "','" . $_POST['descriptionuk'] . "','" . $_POST['lien'] . "','" . $_POST['video1'] . "','" . $_POST['video2'] . "','" . $_POST['video3'] . "','" . $_POST['video4'] . "','" . $_POST['pub'] . "','" . $_POST['ref'] . "','" . $_POST['montant'] . "','" . $DateVar . "', '" . $_POST['visible'] . "', '" . $_POST['gestion'] . "', '" . $_POST['historique'] . "', '" .   $_POST['phone_direct']  . "', '" . $_POST['mail_direct']  . "')");
			$InsertRetour = '<span class="rouge">LE FABRICANT ' . $_POST["nom"] . ' A &Eacute;T&Eacute; AJOUT&Eacute;</span>';
		}
		if ($HTTP_GET_VARS['action'] == 'modification') {
			if ($_FILES['logo']['name'] != '') {
				$PrintLogoBDD = ', Logo_fabricant="' . $IllusLogo . '"';
			}
			else {
				$PrintLogoBDD = '';
			}
			if ($_FILES['portrait']['name'] != '') {
				$PrintPortraitBDD = ', Portrait_fabricant="' . $IllusPortrait . '"';
			}
			else {
				$PrintPortraitBDD = '';
			}
			
			$UpdateData = mysql_query('UPDATE fabricant SET Nom_fabricant="' . $_POST['nom'] . '", Adresse_fabricant="' . $_POST['adresse'] . '", CP_fabricant="' . $_POST['cp'] . '", Pays_fabricant="' . $_POST['pays'] . '", Email_fabricant="' . $_POST['email'] . '", Tel_fabricant="' . $_POST['tel'] . '"' . $PrintLogoBDD . '' . $PrintPortraitBDD . ', Description_fabricant="' . $_POST['description'] . '", DescriptionUK_fabricant="' . $_POST['descriptionuk'] . '", Lien_fabricant="' . $_POST['lien'] . '", Video1_fabricant="' . $_POST['video1'] . '", Video2_fabricant="' . $_POST['video2'] . '", Video3_fabricant="' . $_POST['video3'] . '", Video4_fabricant="' . $_POST['video4'] . '", Publication_fabricant="' . $_POST['pub'] . '", Payant_fabricant="' . $_POST['ref'] . '", Montant_fabricant="' . $_POST['montant'] . '", Date_fabricant="' . $DateVar . '", Visible_fabricant="' . $_POST['visible'] . '", Gestion_fabricant="' . $_POST['gestion'] . '", Historique_fabricant="' . $_POST['historique'] .          '", mail_direct="' . $_POST['mail_direct'] . '", phone_direct="' . $_POST['phone_direct'] .        '" WHERE Id_fabricant="' . $_POST['id'] . '"');
			
			$InsertRetour = '<span class="rouge">LE FABRICANT ' . $_POST["nom"] . ' A &Eacute;T&Eacute; MODIFI&Eacute;</span>';
			$PrintAction = 'inscription';
			$PrintIntit = 'ENTRER UN NOUVEAU FABRICANT';
		}
		$ErrorNom = '';
		$ErrorAdresse = '';
		$ErrorCP = '';
		$ErrorPays = '';
		$ErrorEmail = '';
		$ErrorTel = '';
		$ErrorLogo = '';
		$ErrorPortrait = '';
		$ErrorDescription = '';
		$ErrorLien = '';
		$ErrorVideo1 = '';
		$PrintNom = '';
		$PrintAdresse = '';
		$PrintCP = '';
		$PrintPays = '';
		$PrintEmail = '';
		$PrintTel = '';
		$PrintDescription = '';
		$PrintDescriptionUK = '';
		$PrintLien = '';
		$PrintVideo1 = '';
		$PrintVideo2 = '';
		$PrintVideo3 = '';
		$PrintVideo4 = '';
		$CheckPub = '';
		$CheckRef = '';
		$CheckVisible = '';
		$PrintMontant = '';
		$PrintDate = '';
		$PrintGestion = '';
		$PrintHistorique = '';
	}
}

// Listing des entrées
$PrintData = '';
$PrintNum = '1';
$SelectData = mysql_query('SELECT Id_fabricant, Nom_fabricant, CP_fabricant, Lien_fabricant, Publication_fabricant, Payant_fabricant FROM fabricant ORDER BY Nom_fabricant ASC');
if (mysql_num_rows($SelectData) != 0) {
	$PrintData .= '<table border="0" cellpadding="0" cellspacing="5" width="700" bgcolor="#FFFFFF"><tr><td align="center" bgcolor="#000000"><table border="0" cellpadding="0" cellspacing="0" width="600"><tr><td class="intit" style="padding-top: 20px; font-size: 12px; line-height: 14px;">LISTE DES FABRICANTS<br /><div class="sep" style="margin-top: 10px;"><img src="img/pix.gif" border="0" width="1" height="1" alt="" title="" /></div><table border="0" cellpadding="0" cellspacing="10"><tr><td align="center" style="font-size: 12px; line-height: 14px;">#</td><td align="center" style="font-size: 12px; line-height: 14px;">NOM</td><td align="center" style="font-size: 12px; line-height: 14px;">LIEN</td><td align="center" style="font-size: 12px; line-height: 14px;">D&Eacute;P.</td><td align="center" style="font-size: 12px; line-height: 14px;">PUBLICATION</td><td align="center" style="font-size: 12px; line-height: 14px;">R&Eacute;F.</td><td align="center" style="font-size: 12px; line-height: 14px;">QTY</td><td align="center" colspan="2" style="font-size: 12px; line-height: 14px;">ACTION</td></tr>';
	while ($CheckData = mysql_fetch_object($SelectData)) {
		
		$ControlDelete = mysql_query('SELECT count(Id_modele) FROM modele WHERE Fabricant_modele="' . $CheckData->Id_fabricant . '"');
		$CheckDelete = mysql_fetch_row($ControlDelete);
		if ($CheckDelete[0] > '0') {
			$PrintDelete = '<td align="center" valign="top" class="rouge" style="font-size: 12px; line-height: 14px;">-</td>';
		}
		else {
			$PrintDelete = '<td valign="top"><form name="supp' . $CheckData->Id_fabricant . '" action="' . $_SERVER['PHP_SELF'] . '" method="post"><input type="hidden" name="suppid" value="' . $CheckData->Id_fabricant . '"><input type="button" value="supprimer" onClick="verif_form(this.form)" class="btnsupp" style="border: 0px; background-color: #FF3131;" /></form></td>';
		}
		
		if ($CheckData->Publication_fabricant == '1') {
			$PrintPub = 'Oui';
		}
		else {
			$PrintPub = 'Non';
		}
		
		if ($CheckData->Payant_fabricant == '1') {
			$PrintRef = 'Oui';
		}
		else {
			$PrintRef = 'Non';
		}
		
		$PrintData .= '<tr><td colspan="9" style="background-color: #FFFFFF; height: 1px;"></td></tr><tr><td align="right" valign="top" style="font-size: 12px; line-height: 14px;">' . $PrintNum . '.</td><td align="left" valign="top" style="font-size: 12px; line-height: 14px;">' . $CheckData->Nom_fabricant . '</td><td align="left" valign="top" style="font-size: 12px; line-height: 14px;">' . $CheckData->Lien_fabricant . '</td><td align="center" valign="top" style="font-size: 12px; line-height: 14px;">' . $CheckData->CP_fabricant . '</td><td align="center" valign="top" style="font-size: 12px; line-height: 14px;">' . $PrintPub . '</td><td align="center" valign="top" style="font-size: 12px; line-height: 14px;">' . $PrintRef . '</td><td align="center" valign="top" style="font-size: 12px; line-height: 14px;">' . $CheckDelete[0] . '</td><td valign="top"><input type="button" value="modifier" onClick="document.location.href=\'' . $_SERVER['PHP_SELF'] . '?selection=' . $CheckData->Id_fabricant . '\';" class="btnmodif" />' . $PrintDelete . '</td></tr>';
		
		$PrintNum++;
	}
	$PrintData .= '</table></td></tr></table><br /></td></tr></table>';
}
else {
	$PrintData = '<span class="rouge">AUCUN FABRICANT TROUV&Eacute;</span>';
}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>FINEGUITAR - Administration des fabricants</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css" />
	<script type="text/javascript" src="js/calendar.js"></script>
	<script type="text/javascript">
	function verif_form(monForm) {
		var answer = confirm('Etes-vous certain de vouloir supprimer ce fabricant ?');
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
								if ($checkError > '0') {
									echo '<span class="rouge">LES CHAMPS MARQU&Eacute;S D\'UNE (*) SONT OBLIGATOIRES</span>';
								}
								echo $RetourLogo;
								echo $RetourPortrait;
								echo $InsertRetour;
								echo $DeleteRetour;
								echo $IdentRetour;
								?>
									<div class="sep" style="margin-top: 10px;"><img src="img/pix.gif" border="0" width="1" height="1" alt="" title="" /></div>
									<table border="0" cellpadding="0" cellspacing="10">
										<tr>
											<td style="font-size: 12px; line-height: 14px;">Nom<?php echo ' ' . $ErrorNom; ?></td>
											<td colspan="2"><input type="text" name="nom" value="<?php echo $PrintNom; ?>" /></td>
										</tr>
										<tr>
											<td valign="top" style="font-size: 12px; line-height: 14px;">Adresse<?php echo ' ' . $ErrorAdresse; ?></td>
											<td colspan="2"><textarea name="adresse" class="textarea"><?php echo $PrintAdresse; ?></textarea></td>
										</tr>
										<tr>
											<td style="font-size: 12px; line-height: 14px;">Code postal<?php echo ' ' . $ErrorCP; ?></td>
											<td colspan="2"><input type="text" name="cp" value="<?php echo $PrintCP; ?>" /></td>
										</tr>
										<tr>
											<td style="font-size: 12px; line-height: 14px;">Pays<?php echo ' ' . $ErrorPays; ?></td>
											<td colspan="2"><input type="text" name="pays" value="<?php echo $PrintPays; ?>" /></td>
										</tr>
										<tr>
											<td style="font-size: 12px; line-height: 14px;">Email<?php echo ' ' . $ErrorEmail; ?></td>
											<td colspan="2"><input type="text" name="email" value="<?php echo $PrintEmail; ?>" /></td>
										</tr>
										<tr>
											<td style="font-size: 12px; line-height: 14px;">T&eacute;l&eacute;phone<?php echo ' ' . $ErrorTel; ?></td>
											<td colspan="2"><input type="text" name="tel" value="<?php echo $PrintTel; ?>" /></td>
										</tr>

										<tr>
											<td style="font-size: 12px; line-height: 14px;">Email direct</td>
											<td colspan="2"><input type="text" name="mail_direct" value="<?php echo $PrintEmailDirect; ?>" /></td>
										</tr>
										<tr>
											<td style="font-size: 12px; line-height: 14px;">T&eacute;l&eacute;phone direct</td>
											<td colspan="2"><input type="text" name="phone_direct" value="<?php echo $PrintTelDirect; ?>" /></td>
										</tr>

										<tr>
											<td style="font-size: 12px; line-height: 14px;">Logo (illus)<?php echo ' ' . $ErrorLogo; ?></td>
											<td colspan="2"><input type="file" name="logo" />
											<?php
											if ($PrintLogo != '') {
											?>
												<br /><img src="../img/pix.gif" width="1" height="5" border="0" alt="" title="" /><br />
												<span style="font-size: 12px; line-height: 14px;"><?php echo '<a href="../' .$PrintLogo . '" target="_blank" class="rouge">' . $PrintLogo. '</a>'; ?></span>
												<?php
											}
											?></td>
										</tr>
										<tr>
											<td style="font-size: 12px; line-height: 14px;">Portrait (illus)<?php echo ' ' . $ErrorPortrait; ?></td>
											<td colspan="2"><input type="file" name="portrait" />
											<?php
											if ($PrintPortrait != '') {
											?>
												<br /><img src="../img/pix.gif" width="1" height="5" border="0" alt="" title="" /><br />
												<span style="font-size: 12px; line-height: 14px;"><?php echo '<a href="../' .$PrintPortrait . '" target="_blank" class="rouge">' . $PrintPortrait. '</a>'; ?></span>
												<?php
											}
											?></td>
										</tr>
										<tr>
											<td valign="top" style="font-size: 12px; line-height: 14px;">Description<?php echo ' ' . $ErrorDescription; ?></td>
											<td colspan="2"><textarea name="description" class="textarea"><?php echo $PrintDescription; ?></textarea></td>
										</tr>
										<tr>
											<td valign="top" style="font-size: 12px; line-height: 14px;">Description UK</td>
											<td colspan="2"><textarea name="descriptionuk" class="textarea"><?php echo $PrintDescriptionUK; ?></textarea></td>
										</tr>
										<tr>
											<td style="font-size: 12px; line-height: 14px;">Lien<?php echo ' ' . $ErrorLien; ?></td>
											<td colspan="2"><input type="text" name="lien" value="<?php echo $PrintLien; ?>" /></td>
										</tr>
										<tr>
											<td style="font-size: 12px; line-height: 14px;">Vid&eacute;o 1<?php echo ' ' . $ErrorVideo1; ?></td>
											<td colspan="2"><input type="text" name="video1" value="<?php echo $PrintVideo1; ?>" /></td>
										</tr>
										<tr>
											<td style="font-size: 12px; line-height: 14px;">Vid&eacute;o 2</td>
											<td colspan="2"><input type="text" name="video2" value="<?php echo $PrintVideo2; ?>" /></td>
										</tr>
										<tr>
											<td style="font-size: 12px; line-height: 14px;">Vid&eacute;o 3</td>
											<td colspan="2"><input type="text" name="video3" value="<?php echo $PrintVideo3; ?>" /></td>
										</tr>
										<tr>
											<td style="font-size: 12px; line-height: 14px;">Vid&eacute;o 4</td>
											<td colspan="2"><input type="text" name="video4" value="<?php echo $PrintVideo4; ?>" /></td>
										</tr>
										<tr>
											<td style="font-size: 12px; line-height: 14px;">Accord publication</td>
											<td colspan="2"><input name="pub" type="checkbox" value="1"<?php echo $CheckPub; ?> /></td>
										</tr>
										<tr>
											<td style="font-size: 12px; line-height: 14px;">R&eacute;f&eacute;rencement</td>
											<td colspan="2"><input name="ref" type="checkbox" value="1"<?php echo $CheckRef; ?> /></td>
										</tr>
										<tr>
											<td style="font-size: 12px; line-height: 14px;">Montant</td>
											<td colspan="2"><input type="text" name="montant" value="<?php echo $PrintMontant; ?>" /></td>
										</tr>
										<tr>
											<td style="font-size: 12px; line-height: 14px;">Date dernier paiement</td>
											<td><input type="text" name="date" value="<?php echo $PrintDate; ?>" id="p_date1" /></td>
											<td><img src="img/calendar.gif" width="15" height="13" alt="Calendrier" title="Calendrier" onclick="selectDate(event,1);" style="cursor: pointer;" /></td>
										</tr>
										<tr>
											<td style="font-size: 12px; line-height: 14px;">Visible</td>
											<td colspan="2"><input name="visible" type="checkbox" value="1"<?php echo $CheckVisible; ?> /></td>
										</tr>
										<tr>
											<td valign="top" style="font-size: 12px; line-height: 14px;">Gestion de la relation</td>
											<td colspan="2"><textarea name="gestion" class="textarea"><?php echo $PrintGestion; ?></textarea></td>
										</tr>
										<tr>
											<td valign="top" style="font-size: 12px; line-height: 14px;">Historique des RDV</td>
											<td colspan="2"><textarea name="historique" class="textarea"><?php echo $PrintHistorique; ?></textarea></td>
										</tr>
										<tr>
											<td></td>
											<td colspan="2"><input type="submit" value="Valider" class="btnvalid" style="float: left;" /><input type="buton" value="Annuler" onClick="document.location.href='<?php echo $_SERVER['PHP_SELF']; ?>';" class="btncancel" style="float: left; text-align: center; border: 0px; background-color: #FF3131;" /></td>
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

<?php include('inc/calendar.php'); ?>

</center>
</body>
</html>
</html>
