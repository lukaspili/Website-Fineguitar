<?php
$SearchVarID = '';
$SearchVarF = '';
$SearchVarSF = '';
$URLVarF = '';
$URLVarSF = '';
$PrintTitle = '';
$PrintFabTitle = '';
$PrintFab1 = '';
$PrintFab2 = '';

if (ISSET($HTTP_GET_VARS['f']) && $HTTP_GET_VARS['f'] != '' && $HTTP_GET_VARS['f'] != '0' && is_numeric($HTTP_GET_VARS['f']) && strpos($HTTP_GET_VARS['f'], '.') === false) {
	$SearchVarF = $HTTP_GET_VARS['f'];
	$URLVarF = '?f=' . $HTTP_GET_VARS['f'];
	$AddSearch1 = '';
	$AddSearch2 = '';
	$AddSearch3 = '';
	
	if (ISSET($HTTP_GET_VARS['sf']) && $HTTP_GET_VARS['sf'] != '' && $HTTP_GET_VARS['sf'] != '0' && is_numeric($HTTP_GET_VARS['sf']) && strpos($HTTP_GET_VARS['sf'], '.') === false) {
		$SearchVarSF = $HTTP_GET_VARS['sf'];
		$URLVarSF = '&sf=' . $HTTP_GET_VARS['sf'];
		$AddSearch1 = ', Id_sous_famille, Nom_sous_famille';
		$AddSearch2 = ' LEFT JOIN sous_famille ON famille.Id_famille = sous_famille.IdRef_famille';
		$AddSearch3 = ' AND sous_famille.Id_sous_famille = "' . $HTTP_GET_VARS['sf'] . '"';
	}
	
	$SelectModele = mysql_query('SELECT Id_famille, Nom_famille' . $AddSearch1 .' FROM famille' . $AddSearch2 .' WHERE famille.Id_famille = "' . $SearchVarF . '"' . $AddSearch3);
	if (mysql_num_rows($SelectModele) != 0) {
		$CheckModele = mysql_fetch_array($SelectModele);
		/* Récupération du modèle */
		$PrintTitle = $CheckModele['Nom_famille'];
		if (ISSET($CheckModele['Id_sous_famille']) && $CheckModele['Id_sous_famille'] != '') {
			$PrintTitle .= ' ' . $CheckModele['Nom_sous_famille'];
		}
		/* Récupération des fabricants */
		if ($SearchVarSF != '') {
			$AddSearch = ' AND modele.Sous_famille_modele = "' . $CheckModele['Id_sous_famille'] . '"';
		}
		$SelectFab = mysql_query('SELECT DISTINCT(Nom_fabricant), Id_fabricant FROM fabricant LEFT JOIN modele ON fabricant.Id_fabricant = modele.Fabricant_modele WHERE fabricant.Visible_fabricant = "1" AND modele.Famille_modele = "' . $CheckModele['Id_famille'] . '"' . $AddSearch . ' ORDER BY Nom_fabricant ASC');
		if (mysql_num_rows($SelectFab) != 0) {
			$IncVar = '0';
			while ($CheckFab = mysql_fetch_object($SelectFab)) {
				$IncVar++;
				
				/* Vérification de la variable fabricant */
				if (ISSET($HTTP_GET_VARS['id']) && $HTTP_GET_VARS['id'] != '' && $HTTP_GET_VARS['id'] != '0' && is_numeric($HTTP_GET_VARS['id']) && strpos($HTTP_GET_VARS['id'], '.') === false && $HTTP_GET_VARS['id'] == $CheckFab->Id_fabricant) {
					$SearchVarID = $HTTP_GET_VARS['id'];
					$PrintFabTitle = $CheckFab->Nom_fabricant;
					$CheckNav = ' class="rouge"';
				}
				else {
					$CheckNav = '';
				}
				
				if ($IncVar <= '48') {
					$PrintFab1 .= '<a href="fabricant.php' . $URLVarF . $URLVarSF . '&id=' . $CheckFab->Id_fabricant . '"' . $CheckNav .'>' . $CheckFab->Nom_fabricant . '</a><br />';
				}
				else {
					$PrintFab2 .= '<a href="fabricant.php' . $URLVarF . $URLVarSF . '&id=' . $CheckFab->Id_fabricant . '"' . $CheckNav .'>' . $CheckFab->Nom_fabricant . '</a><br />';
				}
			}
		}
	}
	else {
		header("Location: index.php");
	}
}
else {
	header("Location: index.php");
}
?>