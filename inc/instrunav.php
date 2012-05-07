<?php
$PrintInstru1 = '';
$PrintInstru2 = '';
$PrintInstru3 = '';

if ($SearchVarSF != '') {
	$AddSearchInstru = ' AND Sous_famille_modele = "' . $SearchVarSF . '"';
}
else {
	$AddSearchInstru = '';
}
$SelectInstru = mysql_query('SELECT Id_modele, Nom_modele FROM modele WHERE Fabricant_modele = "' . $SearchVarID . '" AND Famille_modele = "' . $SearchVarF . '"' . $AddSearchInstru .' ORDER BY Nom_modele ASC');
if (mysql_num_rows($SelectInstru) != 0) {
	$IncVar = '0';
	while ($CheckInstru = mysql_fetch_object($SelectInstru)) {
		$IncVar++;
		if (ISSET($HTTP_GET_VARS['i']) && $HTTP_GET_VARS['i'] == $CheckInstru->Id_modele) {
			$CheckClass = ' class="rouge"';
		}
		else {
			$CheckClass = '';
		}
		
		if ($IncVar <= '2') {
			$PrintInstru1 .= '<a href="guitare.php' . $URLVarF . $URLVarSF . '&id=' . $SearchVarID . '&i=' . $CheckInstru->Id_modele . '" style="font-size: 11px; line-height: 18px;"' . $CheckClass .'>' . $CheckInstru->Nom_modele . '</a><br />';
		}
		else if ($IncVar > '2' && $IncVar <= '4') {
			$PrintInstru2 .= '<a href="guitare.php' . $URLVarF . $URLVarSF . '&id=' . $SearchVarID . '&i=' . $CheckInstru->Id_modele . '" style="font-size: 11px; line-height: 18px;"' . $CheckClass .'>' . $CheckInstru->Nom_modele . '</a><br />';
		}
		else {
			$PrintInstru3 .= '<a href="guitare.php' . $URLVarF . $URLVarSF . '&id=' . $SearchVarID . '&i=' . $CheckInstru->Id_modele . '" style="font-size: 11px; line-height: 18px;"' . $CheckClass .'>' . $CheckInstru->Nom_modele . '</a><br />';
		}
	}
}
?>