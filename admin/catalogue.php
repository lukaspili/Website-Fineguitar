<?php
require('inc/session.php');
/**********************************************************************************/
// Connexion BDD
/**********************************************************************************/
include("../inc/fct.php");
include("inc/valid.php");

function tronque($chaine, $longueur = 255) {
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
}

// Listing des fabricants
$NbrInc = '0';
$NbrPage = '1';
$PrintCatalogue = '';
$ControlFabInfos = mysql_query('SELECT Id_fabricant, Nom_fabricant, Adresse_fabricant, Pays_fabricant FROM fabricant ORDER BY Nom_fabricant ASC');
if (mysql_num_rows($ControlFabInfos) != 0) {
	while ($CheckFabInfos = mysql_fetch_object($ControlFabInfos)) {
		
		$ControlModeleInfos = mysql_query('SELECT modele.Nom_modele, modele.Description_modele, modele.Photo1_modele, modele.Photo2_modele, modele.Photo3_modele, modele.Photo4_modele, modele.Photo5_modele, modele.Photo6_modele, famille.Nom_famille, sous_famille.Nom_sous_famille FROM modele LEFT JOIN famille ON modele.Famille_modele=famille.Id_famille LEFT JOIN sous_famille ON modele.Sous_famille_modele=sous_famille.Id_sous_famille WHERE Fabricant_modele="' . $CheckFabInfos->Id_fabricant . '" ORDER BY Nom_modele ASC');
		if (mysql_num_rows($ControlModeleInfos) != 0) {
			while ($CheckModeleInfos = mysql_fetch_object($ControlModeleInfos)) {
				
				if ($NbrInc == '0') {
					$PrintCatalogue .= '<page>
					<page_header>
						<table border="0" cellpadding="0" cellspacing="20" width="700"><tr><td width="660" style="padding: 20px; border: 1px solid #000000;">' . $CheckFabInfos->Adresse_fabricant . '</td></tr></table>
					</page_header><br /><br /><br /><br /><br />';
				}
				
				if ($CheckModeleInfos->Photo1_modele != '' && ( substr($CheckModeleInfos->Photo1_modele, -3, 3) == 'jpg' || substr($CheckModeleInfos->Photo1_modele, -3, 3) == 'gif' ) && ( strpos('$', $CheckModeleInfos->Photo1_modele) === false || strpos('%', $CheckModeleInfos->Photo1_modele) === false || strpos('#', $CheckModeleInfos->Photo1_modele) === false )) {
					$PrintPhoto1 = '<img src="../' . $CheckModeleInfos->Photo1_modele . '" border="0" width="100" height="100" alt="" title="" style="float: left; margin: 3px; border: 1px solid #000000;" />';
				}
				else {
					$PrintPhoto1 = '';
				}
				if ($CheckModeleInfos->Photo2_modele != '' && ( substr($CheckModeleInfos->Photo2_modele, -3, 3) == 'jpg' || substr($CheckModeleInfos->Photo2_modele, -3, 3) == 'gif' ) && ( strpos('$', $CheckModeleInfos->Photo2_modele) === false || strpos('%', $CheckModeleInfos->Photo2_modele) === false || strpos('#', $CheckModeleInfos->Photo2_modele) === false )) {
					$PrintPhoto2 = '<img src="../' . $CheckModeleInfos->Photo2_modele . '" border="0" width="100" height="100" alt="" title="" style="float: left; margin: 3px; border: 1px solid #000000;" />';
				}
				else {
					$PrintPhoto2 = '';
				}
				/* if ($CheckModeleInfos->Photo3_modele != '' && ( substr($CheckModeleInfos->Photo3_modele, -3, 3) == 'jpg' || substr($CheckModeleInfos->Photo3_modele, -3, 3) == 'gif' ) && ( strpos('$', $CheckModeleInfos->Photo3_modele) === false || strpos('%', $CheckModeleInfos->Photo3_modele) === false || strpos('#', $CheckModeleInfos->Photo3_modele) === false )) {
					$PrintPhoto3 = '<img src="../' . $CheckModeleInfos->Photo3_modele . '" border="0" width="100" height="100" alt="" title="" style="margin: 3px; border: 1px solid #000000;" />';
				}
				else {
					$PrintPhoto3 = '';
				}
				if ($CheckModeleInfos->Photo4_modele != '' && ( substr($CheckModeleInfos->Photo4_modele, -3, 3) == 'jpg' || substr($CheckModeleInfos->Photo4_modele, -3, 3) == 'gif' ) && ( strpos('$', $CheckModeleInfos->Photo4_modele) === false || strpos('%', $CheckModeleInfos->Photo4_modele) === false || strpos('#', $CheckModeleInfos->Photo4_modele) === false )) {
					$PrintPhoto4 = '<img src="../' . $CheckModeleInfos->Photo4_modele . '" border="0" width="100" height="100" alt="" title="" style="float: left; margin: 3px; border: 1px solid #000000;" />';
				}
				else {
					$PrintPhoto4 = '';
				}
				if ($CheckModeleInfos->Photo5_modele != '' && ( substr($CheckModeleInfos->Photo5_modele, -3, 3) == 'jpg' || substr($CheckModeleInfos->Photo5_modele, -3, 3) == 'gif' ) && ( strpos('$', $CheckModeleInfos->Photo5_modele) === false || strpos('%', $CheckModeleInfos->Photo5_modele) === false || strpos('#', $CheckModeleInfos->Photo5_modele) === false )) {
					$PrintPhoto5 = '<img src="../' . $CheckModeleInfos->Photo5_modele . '" border="0" width="100" height="100" alt="" title="" style="float: left; margin: 3px; border: 1px solid #000000;" />';
				}
				else {
					$PrintPhoto5 = '';
				}
				if ($CheckModeleInfos->Photo6_modele != '' && ( substr($CheckModeleInfos->Photo6_modele, -3, 3) == 'jpg' || substr($CheckModeleInfos->Photo6_modele, -3, 3) == 'gif' ) && ( strpos('$', $CheckModeleInfos->Photo6_modele) === false || strpos('%', $CheckModeleInfos->Photo6_modele) === false || strpos('#', $CheckModeleInfos->Photo6_modele) === false )) {
					$PrintPhoto6 = '<img src="../' . $CheckModeleInfos->Photo6_modele . '" border="0" width="100" height="100" alt="" title="" style="margin: 3px; border: 1px solid #000000;" />';
				}
				else {
					$PrintPhoto6 = '';
				} */
				
				$PrintCatalogue .= '<table border="0" cellpadding="0" cellspacing="0" width="700" style="margin: 60px 0px 0px 20px; border-collapse: collapse;"><tr><td width="660" colspan="2" style="padding: 20px; border: 1px solid #000000;"><strong>' . $CheckModeleInfos->Nom_modele . ' / ' . $CheckModeleInfos->Nom_famille . ' ' . $CheckModeleInfos->Nom_sous_famille . '</strong></td></tr><tr><td width="260" valign="top" style="padding: 20px; border: 1px solid #000000;"><em>' . nl2br(tronque($CheckModeleInfos->Description_modele)) . '</em></td><td width="320" valign="top" style="padding: 20px; border: 1px solid #000000;">' . $PrintPhoto1 . $PrintPhoto2 . /* $PrintPhoto3 . '<br />' . $PrintPhoto4 . $PrintPhoto5 . $PrintPhoto6 . */'</td></tr></table>';
				
				$NbrInc++;
				
				if ($NbrInc == '2') {
					$PrintCatalogue .= '<page_footer>
						<table border="0" cellpadding="0" cellspacing="20" width="700"><tr><td width="660" align="right" style="padding: 20px;"><em>Page ' . $NbrPage . '</em></td></tr></table>
					</page_footer>
					</page>';
					
					$NbrInc = '0';
					$NbrPage++;
				}
			}
		}
	}
}
if ($NbrInc < '2' && $NbrInc != '0') {
	$PrintCatalogue .= '<page_footer>
		<table border="0" cellpadding="0" cellspacing="20" width="700"><tr><td width="660" align="right" style="padding: 20px;"><em>Page ' . $NbrPage . '</em></td></tr></table>
	</page_footer>
	</page>';
}

$IntitCatalogue = 'pdf/catalogue_' . date("Ymd") . '.pdf';
require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
$html2pdf = new HTML2PDF('P','A4','fr', true, 'UTF-8', '0');
$html2pdf->WriteHTML($PrintCatalogue);
$html2pdf->Output($IntitCatalogue, 'F');
header('Content-type: application/pdf');
header('Content-Disposition: attachment; filename="pdf/catalogue_' . date("Ymd") . '.pdf"');
readfile('pdf/catalogue_' . date("Ymd") . '.pdf');
?>