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
$PrintIntit = 'ENTRER UN NOUVEAU MOD&Egrave;LE';

// Modification d'une entrée
if (isset($HTTP_GET_VARS['selection']) && ($HTTP_GET_VARS['selection'] != '')) {
	$PrintAction = 'modification';
	$PrintIntit = 'MODIFIER CE MOD&Egrave;LE';
	$PrintNom = '';
	$PrintPrix = '';
	$SelectFab = '';
	$SelectFam = '';
	$SelectSFam = '';
	$PrintDescription = '';
	$PrintDescriptionUK = '';
	$PrintPhoto1 = '';
	$PrintPhoto2 = '';
	$PrintPhoto3 = '';
	$PrintPhoto4 = '';
	$PrintPhoto5 = '';
	$PrintPhoto6 = '';
	$SelectData = mysql_query('SELECT Id_modele, Nom_modele, Prix_modele, Fabricant_modele, Famille_modele, Sous_famille_modele, Description_modele, DescriptionUK_modele, Photo1_modele, Photo2_modele, Photo3_modele, Photo4_modele, Photo5_modele, Photo6_modele FROM modele WHERE Id_modele="' . $HTTP_GET_VARS['selection'] . '"');
	if (mysql_num_rows($SelectData) != 0) {
		$CheckData = mysql_fetch_array($SelectData);
		
		$PrintID = '<input type="hidden" name="id" value="' . $HTTP_GET_VARS['selection'] . '">';
		$PrintNom = $CheckData['Nom_modele'];
		$PrintPrix = $CheckData['Prix_modele'];
		$SelectFab = $CheckData['Fabricant_modele'];
		$SelectFam = $CheckData['Famille_modele'];
		$SelectSFam = $CheckData['Sous_famille_modele'];
		$PrintDescription = $CheckData['Description_modele'];
		$PrintDescriptionUK = $CheckData['DescriptionUK_modele'];
		$PrintPhoto1 = $CheckData['Photo1_modele'];
		$PrintPhoto2 = $CheckData['Photo2_modele'];
		$PrintPhoto3 = $CheckData['Photo3_modele'];
		$PrintPhoto4 = $CheckData['Photo4_modele'];
		$PrintPhoto5 = $CheckData['Photo5_modele'];
		$PrintPhoto6 = $CheckData['Photo6_modele'];
	}
	else {
		$PrintAction = 'inscription';
		$PrintIntit = 'ENTRER UN NOUVEAU MOD&Egrave;LE';
		$IdentRetour = '<span class="rouge">CE MOD&Egrave;LE N\'EST PAS MODIFIABLE</span>';
	}
}

// Suppression d'une entrée
if (isset($HTTP_POST_VARS['suppid']) && ($HTTP_POST_VARS['suppid'] != '')) {
	$SelectData = mysql_query('SELECT Nom_modele, Photo1_modele, Photo2_modele, Photo3_modele, Photo4_modele, Photo5_modele, Photo6_modele FROM modele WHERE Id_modele="' . $HTTP_POST_VARS['suppid'] . '"');
	if (mysql_num_rows($SelectData) != 0) {
		$CheckData = mysql_fetch_array($SelectData);
		unlink('../' . $CheckData["Photo1_modele"]);
		unlink('../' . $CheckData["Photo2_modele"]);
		unlink('../' . $CheckData["Photo3_modele"]);
		unlink('../' . $CheckData["Photo4_modele"]);
		unlink('../' . $CheckData["Photo5_modele"]);
		unlink('../' . $CheckData["Photo6_modele"]);
		mysql_query('DELETE FROM modele WHERE Id_modele="' . $HTTP_POST_VARS['suppid'] . '"');
		$DeleteRetour = '<span class="rouge">LE MOD&Egrave;LE ' . $CheckData["Nom_modele"] . ' A &Eacute;T&Eacute; SUPPRIM&Eacute;</span>';
	}
	else {
		$DeleteRetour = '<span class="rouge">CE MOD&Egrave;LE EST INEXISTANT</span>';
	}
}

// Validation du formulaire
if ((isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'inscription')) || (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'modification'))) {
	$PrintAction = $HTTP_GET_VARS['action'];
	if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'modification')) {
		$PrintIntit = 'MODIFIER CE MOD&Egrave;LE';
		$PrintID = '<input type="hidden" name="id" value="' . $_POST['id'] . '">';
	}
	else {
		$PrintIntit = 'ENTRER UN NOUVEAU MOD&Egrave;LE';
		$PrintID = '';
	}
	$InsertRetour = '';
	$RetourPhoto1 = '';
	$RetourPhoto2 = '';
	$RetourPhoto3 = '';
	$RetourPhoto4 = '';
	$RetourPhoto5 = '';
	$RetourPhoto6 = '';
	$checkError = '0';
	$ErrorNom = '';
	$ErrorPrix = '';
	$ErrorFabricant = '';
	$ErrorFamille = '';
	$ErrorDescription = '';
	$ErrorPhoto1 = '';
	$PrintNom = '';
	$PrintPrix = '';
	$SelectFab = '';
	$SelectFam = '';
	$SelectSFam = '';
	$PrintDescription = '';
	$PrintDescriptionUK = '';
	$PrintPhoto1 = '';
	if ($_POST['nom'] == '') {
		$checkError++;
		$ErrorNom = '<span class="rouge">*</span>';
	}
	else {
		$PrintNom = $_POST['nom'];
	}
	if ($_POST['prix'] == '') {
		$checkError++;
		$ErrorPrix = '<span class="rouge">*</span>';
	}
	else {
		$PrintPrix = $_POST['prix'];
	}
	if ($_POST['fab'] == '') {
		$checkError++;
		$ErrorFabricant = '<span class="rouge">*</span>';
	}
	else {
		$SelectFab = $_POST['fab'];
	}
	if ($_POST['famille'] == '') {
		$checkError++;
		$ErrorFamille = '<span class="rouge">*</span>';
	}
	else {
		$SelectFam = $_POST['famille'];
	}
	if ($_POST['sfamille'] != '') {
		$SelectSFam = $_POST['sfamille'];
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
	if (($_FILES['photo1']['name'] != '' || $_FILES['photo2']['name'] != '' || $_FILES['photo3']['name'] != '' || $_FILES['photo4']['name'] != '' || $_FILES['photo5']['name'] != '' || $_FILES['photo6']['name'] != '') && $checkError == '0') {
		// Traitement de l'illustration
		$Inscription = 'img/item/modele/';
		$Destination = '../img/item/modele/';
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
		if ($_FILES['photo4']['name'] != '') {
			$Loop[$LoopInc] = '4';
			$LoopInc++;
		}
		if ($_FILES['photo5']['name'] != '') {
			$Loop[$LoopInc] = '5';
			$LoopInc++;
		}
		if ($_FILES['photo6']['name'] != '') {
			$Loop[$LoopInc] = '6';
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
			
			$SelectPhoto = mysql_query('SELECT Id_modele FROM modele WHERE Photo1_modele="' . ${'PhotoBDD'.$Loop[$i]} . '" OR Photo2_modele="' . ${'PhotoBDD'.$Loop[$i]} . '" OR Photo3_modele="' . ${'PhotoBDD'.$Loop[$i]} . '" OR Photo4_modele="' . ${'PhotoBDD'.$Loop[$i]} . '" OR Photo5_modele="' . ${'PhotoBDD'.$Loop[$i]} . '" OR Photo6_modele="' . ${'PhotoBDD'.$Loop[$i]} . '"');
			
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
		if ($HTTP_GET_VARS['action'] == 'inscription') {
			$InsertData = mysql_query("INSERT INTO modele (Nom_modele, Prix_modele, Fabricant_modele, Famille_modele, Sous_famille_modele, Description_modele, DescriptionUK_modele, Photo1_modele, Photo2_modele, Photo3_modele, Photo4_modele, Photo5_modele, Photo6_modele) VALUES ('" . $_POST['nom'] . "','" . $_POST['prix'] . "','" . $_POST['fab'] . "','" . $_POST['famille'] . "','" . $_POST['sfamille'] . "','" . $_POST['description'] . "','" . $_POST['descriptionuk'] . "','" . $PhotoBDD1 . "','" . $PhotoBDD2 . "','" . $PhotoBDD3 . "','" . $PhotoBDD4 . "','" . $PhotoBDD5 . "','" . $PhotoBDD6 . "')");
			$InsertRetour = '<span class="rouge">LE MOD&Egrave;LE ' . $_POST["nom"] . ' A &Eacute;T&Eacute; AJOUT&Eacute;</span>';
		}
		if ($HTTP_GET_VARS['action'] == 'modification') {
			if ($_FILES['photo1']['name'] != '') {
				$PrintPhotoBDD1 = ', Photo1_modele="' . $PhotoBDD1 . '"';
			}
			else {
				$PrintPhotoBDD1 = '';
			}
			if ($_FILES['photo2']['name'] != '') {
				$PrintPhotoBDD2 = ', Photo2_modele="' . $PhotoBDD2 . '"';
			}
			else {
				$PrintPhotoBDD2 = '';
			}
			if ($_FILES['photo3']['name'] != '') {
				$PrintPhotoBDD3 = ', Photo3_modele="' . $PhotoBDD3 . '"';
			}
			else {
				$PrintPhotoBDD3 = '';
			}
			if ($_FILES['photo4']['name'] != '') {
				$PrintPhotoBDD4 = ', Photo4_modele="' . $PhotoBDD4 . '"';
			}
			else {
				$PrintPhotoBDD4 = '';
			}
			if ($_FILES['photo5']['name'] != '') {
				$PrintPhotoBDD5 = ', Photo5_modele="' . $PhotoBDD5 . '"';
			}
			else {
				$PrintPhotoBDD5 = '';
			}
			if ($_FILES['photo6']['name'] != '') {
				$PrintPhotoBDD6 = ', Photo6_modele="' . $PhotoBDD6 . '"';
			}
			else {
				$PrintPhotoBDD6 = '';
			}
			
			$UpdateData = mysql_query('UPDATE modele SET Nom_modele="' . $_POST['nom'] . '", Prix_modele="' . $_POST['prix'] . '", Fabricant_modele="' . $_POST['fab'] . '", Famille_modele="' . $_POST['famille'] . '", Sous_famille_modele="' . $_POST['sfamille'] . '", Description_modele="' . $_POST['description'] . '", DescriptionUK_modele="' . $_POST['descriptionuk'] . '"' . $PrintPhotoBDD1 . $PrintPhotoBDD2 . $PrintPhotoBDD3 . $PrintPhotoBDD4 . $PrintPhotoBDD5 . $PrintPhotoBDD6 . ' WHERE Id_modele="' . $_POST['id'] . '"');
			
			$InsertRetour = '<span class="rouge">LE MOD&Egrave;LE ' . $_POST["nom"] . ' A &Eacute;T&Eacute; MODIFI&Eacute;</span>';
			$PrintAction = 'inscription';
			$PrintIntit = 'ENTRER UN NOUVEAU MOD&Egrave;LE';
		}
		$ErrorNom = '';
		$ErrorPrix = '';
		$ErrorFabricant = '';
		$ErrorFamille = '';
		$ErrorDescription = '';
		$ErrorPhoto1 = '';
		$PrintNom = '';
		$PrintPrix = '';
		$SelectFab = '';
		$SelectFam = '';
		$SelectSFam = '';
		$PrintDescription = '';
		$PrintDescriptionUK = '';
		$PrintPhoto1 = '';
	}
}

// Listing des entrées
$PrintData = '';
$PrintNum = '1';
$SelectData = mysql_query('SELECT modele.Id_modele, modele.Nom_modele, fabricant.Nom_fabricant, famille.Nom_famille, sous_famille.Nom_sous_famille FROM modele LEFT JOIN fabricant ON modele.Fabricant_modele = fabricant.Id_fabricant LEFT JOIN famille ON modele.Famille_modele = famille.Id_famille LEFT JOIN sous_famille ON modele.Sous_famille_modele = sous_famille.Id_sous_famille ORDER BY Nom_fabricant ASC, Nom_famille ASC, Nom_sous_famille ASC, Nom_modele ASC');
if (mysql_num_rows($SelectData) != 0) {
	$PrintData .= '<table border="0" cellpadding="0" cellspacing="5" width="700" bgcolor="#FFFFFF"><tr><td align="center" bgcolor="#000000"><table border="0" cellpadding="0" cellspacing="0" width="600"><tr><td class="intit" style="padding-top: 20px; font-size: 12px; line-height: 14px;">LISTE DES MOD&Egrave;LES<br /><div class="sep" style="margin-top: 10px;"><img src="img/pix.gif" border="0" width="1" height="1" alt="" title="" /></div><table border="0" cellpadding="0" cellspacing="10"><tr><td align="center" style="font-size: 12px; line-height: 14px;">#</td><td align="center" style="font-size: 12px; line-height: 14px;">NOM</td><td align="center" style="font-size: 12px; line-height: 14px;">FABRICANT</td><td align="center" style="font-size: 12px; line-height: 14px;">FAMILLE</td><td align="center" style="font-size: 12px; line-height: 14px;">SOUS-FAMILLE</td><td align="center" colspan="2" style="font-size: 12px; line-height: 14px;">ACTION</td></tr>';
	while ($CheckData = mysql_fetch_object($SelectData)) {
		$PrintData .= '<tr><td colspan="7" style="background-color: #FFFFFF; height: 1px;"></td></tr><tr><td align="right" valign="top" style="font-size: 12px; line-height: 14px;">' . $PrintNum . '.</td><td align="left" valign="top" style="font-size: 12px; line-height: 14px;">' . $CheckData->Nom_modele . '</td><td align="center" valign="top" style="font-size: 12px; line-height: 14px;">' . $CheckData->Nom_fabricant . '</td><td align="center" valign="top" style="font-size: 12px; line-height: 14px;">' . $CheckData->Nom_famille . '</td><td align="center" valign="top" style="font-size: 12px; line-height: 14px;">' . $CheckData->Nom_sous_famille . '</td><td valign="top"><input type="button" value="modifier" onClick="document.location.href=\'' . $_SERVER['PHP_SELF'] . '?selection=' . $CheckData->Id_modele . '\';" class="btnmodif" /><td valign="top"><form name="supp' . $CheckData->Id_modele . '" action="' . $_SERVER['PHP_SELF'] . '" method="post"><input type="hidden" name="suppid" value="' . $CheckData->Id_modele . '"><input type="button" value="supprimer" onClick="verif_form(this.form)" class="btnsupp" style="border: 0px; background-color: #FF3131;" /></form></td</td></tr>';
		$PrintNum++;
	}
	$PrintData .= '</table></td></tr></table><br /></td></tr></table>';
}
else {
	$PrintData = '<span class="rouge">AUCUN MOD&Egrave;LE TROUV&Eacute;</span>';
}

$SelectFabricant = mysql_query('SELECT Id_fabricant, Nom_fabricant FROM fabricant ORDER BY Nom_fabricant ASC');
if (mysql_num_rows($SelectFabricant) == 0) {
	$PrintFabricant = '';
}
else {
	while ($CheckFabricant = mysql_fetch_object($SelectFabricant)) {
		if ($SelectFab != '' && $SelectFab == $CheckFabricant->Id_fabricant) {
			$CheckFab = ' selected';
		}
		else {
			$CheckFab = '';
		}
		$PrintFabricant .= '<option value="' . $CheckFabricant->Id_fabricant . '"'. $CheckFab . '>' . $CheckFabricant->Nom_fabricant . '</option>';
	}
}

/* $SelectFamille = mysql_query('SELECT Id_famille, Nom_famille FROM famille ORDER BY Nom_famille ASC');
if (mysql_num_rows($SelectFamille) == 0) {
	$PrintFamille = '';
}
else {
	while ($CheckFamille = mysql_fetch_object($SelectFamille)) {
		if ($SelectFam != '' && $SelectFam == $CheckFamille->Id_famille) {
			$CheckFam = ' selected';
		}
		else {
			$CheckFam = '';
		}
		$PrintFamille .= '<option value="' . $CheckFamille->Id_famille . '"'. $CheckFam . '>' . $CheckFamille->Nom_famille . '</option>';
	}
}

$SelectSFamille = mysql_query('SELECT Id_sous_famille, Nom_sous_famille FROM sous_famille ORDER BY Nom_sous_famille ASC');
if (mysql_num_rows($SelectSFamille) == 0) {
	$PrintSFamille = '';
}
else {
	while ($CheckSFamille = mysql_fetch_object($SelectSFamille)) {
		if ($SelectSFam != '' && $SelectSFam == $CheckSFamille->Id_sous_famille) {
			$CheckSFam = ' selected';
		}
		else {
			$CheckSFam = '';
		}
		$PrintSFamille .= '<option value="' . $CheckSFamille->Id_sous_famille . '"'. $CheckSFam . '>' . $CheckSFamille->Nom_sous_famille . '</option>';
	}
} */

$CheckNomQuery = "nestpasdanslaliste";
$CheckNbQuery = 0;
$Nom_Famille = "";
$BuildScript = "";
$LunchScript = "";
$GetFam = mysql_query("SELECT DISTINCT(famille.Nom_famille), famille.Id_famille, sous_famille.Id_sous_famille, sous_famille.Nom_sous_famille FROM famille LEFT JOIN sous_famille ON famille.Id_famille = sous_famille.IdRef_famille ORDER BY famille.Nom_famille ASC, sous_famille.Nom_sous_famille ASC");
if (mysql_num_rows($GetFam) != 0) {
	while ($InfoFam = mysql_fetch_object($GetFam)) {
		$Nom_Famille = $InfoFam->Nom_famille;
		
		if ($SelectFam != '' && $SelectFam == $InfoFam->Id_famille) {
			$CheckFam = ' selected';
			$LunchScript = "<script type=\"text/javascript\">\n
			PopulateContact();\n
			document.getElementById('sfamille').value = ".$SelectSFam.";\n
			</script>";
		}
		else { $CheckFam = ""; }
		
		if ($CheckNomQuery != $Nom_Famille) {
			$PrintFamille .= '<option value="' . $InfoFam->Id_famille . '"'. $CheckFam . '>' . $InfoFam->Nom_famille . '</option>';
			if ($InfoFam->Id_sous_famille != "") {
				if ($CheckNbQuery != 0) {
					$BuildScript .= "}\n";
				}
				$BuildScript .= "if (ValueFam == \"".$InfoFam->Id_famille."\") {\n";
				/* $BuildScript .= "AddToOptionList(document.getElementById('sfamille'), \"\", \"\");\n"; */
				$BuildScript .= "AddToOptionList(document.getElementById('sfamille'), \"".$InfoFam->Id_sous_famille."\", \"". $InfoFam->Nom_sous_famille ."\");\n";
			}
			$CheckNomQuery = $Nom_Famille;
		}
		else {
			$BuildScript .= "AddToOptionList(document.getElementById('sfamille'), \"".$InfoFam->Id_sous_famille."\", \"". $InfoFam->Nom_sous_famille ."\");\n";
		}
		if ($BuildScript != "") {
			$CheckNbQuery++;
		}
	}
}
$BuildScript .= "}\n";
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>FINEGUITAR - Administration des mod&egrave;les</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css" />
	<script type="text/javascript">
	function PopulateContact() {
		ClearOptions(document.getElementById('sfamille'));
		
		var ValueFam = document.getElementById('famille').options[document.getElementById('famille').selectedIndex].value;
		<?php print $BuildScript; ?>
	}
	function ClearOptions(OptionList) {
		for (x = OptionList.length; x >= 0; x = x - 1) {
			OptionList[x] = null;
		}
	}
	function AddToOptionList(OptionList, OptionValue, OptionText) {
		OptionList[OptionList.length] = new Option(OptionText, OptionValue);
	}
	function verif_form(monForm) {
		var answer = confirm('Etes-vous certain de vouloir supprimer ce modèle ?');
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
								if ($RetourPhoto4 != '') {
									echo '<br /><span class="rouge">' . $RetourPhoto4 . '</span>';
								}
								if ($RetourPhoto5 != '') {
									echo '<br /><span class="rouge">' . $RetourPhoto5 . '</span>';
								}
								if ($RetourPhoto6 != '') {
									echo '<br /><span class="rouge">' . $RetourPhoto6 . '</span>';
								}
								echo $InsertRetour;
								echo $DeleteRetour;
								echo $IdentRetour;
								?>
									<div class="sep" style="margin-top: 10px;"><img src="img/pix.gif" border="0" width="1" height="1" alt="" title="" /></div>
									<table border="0" cellpadding="0" cellspacing="10">
										<tr>
											<td style="font-size: 12px; line-height: 14px;">Nom<?php echo ' ' . $ErrorNom; ?></td>
											<td><input type="text" name="nom" value="<?php echo $PrintNom; ?>" /></td>
										</tr>
										<tr>
											<td style="font-size: 12px; line-height: 14px;">Prix<?php echo ' ' . $ErrorPrix; ?></td>
											<td><input type="text" name="prix" value="<?php echo $PrintPrix; ?>" /></td>
										</tr>
										<tr>
											<td style="font-size: 12px; line-height: 14px;">Fabricant<?php echo ' ' . $ErrorFabricant; ?></td>
											<td><select name="fab" class="select">
												<option value=""></option>
												<?php echo $PrintFabricant; ?>
											</select></td>
										</tr>
										<tr>
											<td style="font-size: 12px; line-height: 14px;">Famille<?php echo ' ' . $ErrorFamille; ?></td>
											<td><select name="famille" id="famille" class="select" onchange="PopulateContact();">
												<option value=""></option>
												<?php echo $PrintFamille; ?>
											</select></td>
										</tr>
										<tr>
											<td style="font-size: 12px; line-height: 14px;">Sous-famille</td>
											<td><select name="sfamille" id="sfamille" class="select">
												<?php // echo $PrintSFamille; ?>
											</select></td>
										</tr>
										<tr>
											<td valign="top" style="font-size: 12px; line-height: 14px;">Description<?php echo ' ' . $ErrorDescription; ?></td>
											<td><textarea name="description" class="textarea"><?php echo $PrintDescription; ?></textarea></td>
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
											<td style="font-size: 12px; line-height: 14px;">Photo 4</td>
											<td><input type="file" name="photo4" />
											<?php
											if ($PrintPhoto4 != '') {
											?>
												<br /><img src="../img/pix.gif" width="1" height="5" border="0" alt="" title="" /><br />
												<span style="font-size: 12px; line-height: 14px;"><?php echo '<a href="../' .$PrintPhoto4 . '" target="_blank" class="rouge">' . $PrintPhoto4. '</a>'; ?></span>
												<?php
											}
											?></td>
										</tr>
										<tr>
											<td style="font-size: 12px; line-height: 14px;">Photo 5</td>
											<td><input type="file" name="photo5" />
											<?php
											if ($PrintPhoto5 != '') {
											?>
												<br /><img src="../img/pix.gif" width="1" height="5" border="0" alt="" title="" /><br />
												<span style="font-size: 12px; line-height: 14px;"><?php echo '<a href="../' .$PrintPhoto5 . '" target="_blank" class="rouge">' . $PrintPhoto5. '</a>'; ?></span>
												<?php
											}
											?></td>
										</tr>
										<tr>
											<td style="font-size: 12px; line-height: 14px;">Photo 6</td>
											<td><input type="file" name="photo6" />
											<?php
											if ($PrintPhoto6 != '') {
											?>
												<br /><img src="../img/pix.gif" width="1" height="5" border="0" alt="" title="" /><br />
												<span style="font-size: 12px; line-height: 14px;"><?php echo '<a href="../' .$PrintPhoto6 . '" target="_blank" class="rouge">' . $PrintPhoto6. '</a>'; ?></span>
												<?php
											}
											?></td>
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

<?php print $LunchScript; ?>

</center>
</body>
</html>
</html>