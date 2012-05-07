<?php
/**********************************************************************************/
// Connexion BDD
/**********************************************************************************/
include("inc/fct.php");

require('inc/session.php');
require('inc/modelfab.php');

if ($PrintFabTitle == '') {
	header("Location: rubrique.php" . $URLVarF . $URLVarSF);
}
else {
	require('inc/instrunav.php');		
	
	$PrintLien = '';
	$PrintVideo = '';
	
	$SelectContent = mysql_query('SELECT Logo_fabricant, Portrait_fabricant, Description_fabricant, DescriptionUK_fabricant, Lien_fabricant, Video1_fabricant FROM fabricant WHERE Id_fabricant = "' . $SearchVarID . '"');
	if (mysql_num_rows($SelectContent) != 0) {
		$CheckContent = mysql_fetch_array($SelectContent);
		if ($_SESSION['lang'] == 'uk' && $CheckContent['DescriptionUK_fabricant'] != '') {
			$PrintDescription = nl2br($CheckContent['DescriptionUK_fabricant']);
		}
		else {
			$PrintDescription = nl2br($CheckContent['Description_fabricant']);
		}
		
		list($width, $height) = getimagesize($CheckContent['Logo_fabricant']);
		
		if ($width >= '206') {
			if ($height >= '90') {
				$PrintMarginLeft = (round((226-(((90/$height)*100)*$width/100))/2) - 10);
				
				if ($PrintMarginLeft < '0') {
					$PrintMarginLeft = '0';
				}
			}
			else {
				$PrintMarginLeft = '5';
			}
		}
		else {
			if ($height >= '90') {
				$PrintMarginLeft = (round((226-(((90/$height)*100)*$width/100))/2) - 10);
				
				if ($PrintMarginLeft < '0') {
					$PrintMarginLeft = '0';
				}
			}
			else {
				$PrintMarginLeft = round((226-$width)/2);
			}
		}
		
		if ($height >= '90') {
			$PrintMarginTop = '0';
		}
		else {
			$PrintMarginTop = round((90-$height)/2);
	}
	
		$PrintLogo = '<img src="' . $CheckContent['Logo_fabricant'] . '" border="0" alt="" title="" style="margin-left: ' . $PrintMarginLeft . 'px; //margin-left: 5px; margin-top: ' . $PrintMarginTop . 'px; max-width: 206px; max-height: 90px; width: expression(this.width > 206 ? 206 : true); height: expression(this.height > 90 ? 90 : true);" />';
		
		if ($CheckContent['Portrait_fabricant'] != '') {
			$PrintPortrait = '<img src="' . $CheckContent['Portrait_fabricant'] . '" border="0" alt="" title="" style="padding-bottom: 20px; max-width: 206px; width: expression(this.width > 206 ? 206 : true);" /><br />';
		}
		else {
			$PrintPortrait = '';
		}
		if ($CheckContent['Lien_fabricant'] != '') {
			$PrintLien = '<a href="' . $CheckContent['Lien_fabricant'] . '" target="_blank" style="font-size: 11px; line-height: 18px;">Lien vers le site</a>';
		}
		if ($CheckContent['Video1_fabricant'] != '') {
			$PrintVideo = '<a href="videos.php' . $URLVarF . $URLVarSF . '&id=' . $SearchVarID . '" style="font-size: 11px; line-height: 18px;">Regarder les vid&eacute;os</a>';
		}
	}
}

$IncVar = '0';
$ControlInc = '1';
$PrintPhoto['0'] = '';
$PrintPhoto['1'] = '';

$SelectContent = mysql_query('SELECT Photo1_modele, Photo2_modele, Photo3_modele, Photo4_modele, Photo5_modele, Photo6_modele FROM modele WHERE Fabricant_modele = "' . $SearchVarID . '" AND Famille_modele = "' . $SearchVarF . '"' . $AddSearchInstru .' ORDER BY Nom_modele LIMIT 6');
if (mysql_num_rows($SelectContent) != 0) {
	while ($CheckContent = mysql_fetch_object($SelectContent)) {
		if ($CheckContent->Photo1_modele != '') {
			
			if ($ControlInc == '1') { $Longueur = '228'; }
			else { $Longueur = '226'; }
			
			list($width, $height) = getimagesize($CheckContent->Photo1_modele);
			
			if ($width >= '206') {
				if ($height >= '90') {
					$PrintMarginLeft = (round(($Longueur-(((90/$height)*100)*$width/100))/2) - 10);
					
					if ($PrintMarginLeft < '0') {
						$PrintMarginLeft = '0';
					}
				}
				else {
					$PrintMarginLeft = '5';
				}
			}
			else {
				if ($height >= '90') {
					$PrintMarginLeft = (round(($Longueur-(((90/$height)*100)*$width/100))/2) - 10);
					
					if ($PrintMarginLeft < '0') {
						$PrintMarginLeft = '0';
					}
				}
				else {
					$PrintMarginLeft = round(($Longueur-$width)/2);
				}
			}
			
			if ($height >= '90') {
				$PrintMarginTop = '0';
			}
			else {
				$PrintMarginTop = round((90-$height)/2);
			}
			
			$PrintPhoto[$IncVar] .= '<img src="' . $CheckContent->Photo1_modele . '" border="0" alt="" title="" style="margin-left: ' . $PrintMarginLeft . 'px; //margin-left: 5px; margin-top: ' . $PrintMarginTop . 'px; max-width: 206px; max-height: 90px; width: expression(this.width > 206 ? 206 : true); height: expression(this.height > 90 ? 90 : true);" />';
			$ControlInc++;
			if ($ControlInc > '2') {
				$IncVar++;
				$ControlInc = '1';
			}
		}
		if ($CheckContent->Photo2_modele != '') {
			
			if ($ControlInc == '1') { $Longueur = '228'; }
			else { $Longueur = '226'; }
			
			list($width, $height) = getimagesize($CheckContent->Photo2_modele);
			
			if ($width >= '206') {
				if ($height >= '90') {
					$PrintMarginLeft = (round(($Longueur-(((90/$height)*100)*$width/100))/2) - 10);
					
					if ($PrintMarginLeft < '0') {
						$PrintMarginLeft = '0';
					}
				}
				else {
					$PrintMarginLeft = '5';
				}
			}
			else {
				if ($height >= '90') {
					$PrintMarginLeft = (round(($Longueur-(((90/$height)*100)*$width/100))/2) - 10);
					
					if ($PrintMarginLeft < '0') {
						$PrintMarginLeft = '0';
					}
				}
				else {
					$PrintMarginLeft = round(($Longueur-$width)/2);
				}
			}
			
			if ($height >= '90') {
				$PrintMarginTop = '0';
			}
			else {
				$PrintMarginTop = round((90-$height)/2);
			}
			
			$PrintPhoto[$IncVar] .= '<img src="' . $CheckContent->Photo2_modele . '" border="0" alt="" title="" style="margin-left: ' . $PrintMarginLeft . 'px; //margin-left: 5px; margin-top: ' . $PrintMarginTop . 'px; max-width: 206px; max-height: 90px; width: expression(this.width > 206 ? 206 : true); height: expression(this.height > 90 ? 90 : true);" />';
			$ControlInc++;
			if ($ControlInc > '2') {
				$IncVar++;
				$ControlInc = '1';
			}
		}
		if ($CheckContent->Photo3_modele != '') {
			
			if ($ControlInc == '1') { $Longueur = '228'; }
			else { $Longueur = '226'; }
			
			list($width, $height) = getimagesize($CheckContent->Photo3_modele);
			
			if ($width >= '206') {
				if ($height >= '90') {
					$PrintMarginLeft = (round(($Longueur-(((90/$height)*100)*$width/100))/2) - 10);
					
					if ($PrintMarginLeft < '0') {
						$PrintMarginLeft = '0';
					}
				}
				else {
					$PrintMarginLeft = '5';
				}
			}
			else {
				if ($height >= '90') {
					$PrintMarginLeft = (round(($Longueur-(((90/$height)*100)*$width/100))/2) - 10);
					
					if ($PrintMarginLeft < '0') {
						$PrintMarginLeft = '0';
					}
				}
				else {
					$PrintMarginLeft = round(($Longueur-$width)/2);
				}
			}
			
			if ($height >= '90') {
				$PrintMarginTop = '0';
			}
			else {
				$PrintMarginTop = round((90-$height)/2);
			}
			
			$PrintPhoto[$IncVar] .= '<img src="' . $CheckContent->Photo3_modele . '" border="0" alt="" title="" style="margin-left: ' . $PrintMarginLeft . 'px; //margin-left: 5px; margin-top: ' . $PrintMarginTop . 'px; max-width: 206px; max-height: 90px; width: expression(this.width > 206 ? 206 : true); height: expression(this.height > 90 ? 90 : true);" />';
			$ControlInc++;
			if ($ControlInc > '2') {
				$IncVar++;
				$ControlInc = '1';
			}
		}
		if ($CheckContent->Photo4_modele != '') {
			
			if ($ControlInc == '1') { $Longueur = '228'; }
			else { $Longueur = '226'; }
			
			list($width, $height) = getimagesize($CheckContent->Photo4_modele);
			
			if ($width >= '206') {
				if ($height >= '90') {
					$PrintMarginLeft = (round(($Longueur-(((90/$height)*100)*$width/100))/2) - 10);
					
					if ($PrintMarginLeft < '0') {
						$PrintMarginLeft = '0';
					}
				}
				else {
					$PrintMarginLeft = '5';
				}
			}
			else {
				if ($height >= '90') {
					$PrintMarginLeft = (round(($Longueur-(((90/$height)*100)*$width/100))/2) - 10);
					
					if ($PrintMarginLeft < '0') {
						$PrintMarginLeft = '0';
					}
				}
				else {
					$PrintMarginLeft = round(($Longueur-$width)/2);
				}
			}
			
			if ($height >= '90') {
				$PrintMarginTop = '0';
			}
			else {
				$PrintMarginTop = round((90-$height)/2);
			}
			
			$PrintPhoto[$IncVar] .= '<img src="' . $CheckContent->Photo4_modele . '" border="0" alt="" title="" style="margin-left: ' . $PrintMarginLeft . 'px; //margin-left: 5px; margin-top: ' . $PrintMarginTop . 'px; max-width: 206px; max-height: 90px; width: expression(this.width > 206 ? 206 : true); height: expression(this.height > 90 ? 90 : true);" />';
			$ControlInc++;
			if ($ControlInc > '2') {
				$IncVar++;
				$ControlInc = '1';
			}
		}
		if ($CheckContent->Photo5_modele != '') {
			
			if ($ControlInc == '1') { $Longueur = '228'; }
			else { $Longueur = '226'; }
			
			list($width, $height) = getimagesize($CheckContent->Photo5_modele);
			
			if ($width >= '206') {
				if ($height >= '90') {
					$PrintMarginLeft = (round(($Longueur-(((90/$height)*100)*$width/100))/2) - 10);
					
					if ($PrintMarginLeft < '0') {
						$PrintMarginLeft = '0';
					}
				}
				else {
					$PrintMarginLeft = '5';
				}
			}
			else {
				if ($height >= '90') {
					$PrintMarginLeft = (round(($Longueur-(((90/$height)*100)*$width/100))/2) - 10);
					
					if ($PrintMarginLeft < '0') {
						$PrintMarginLeft = '0';
					}
				}
				else {
					$PrintMarginLeft = round(($Longueur-$width)/2);
				}
			}
			
			if ($height >= '90') {
				$PrintMarginTop = '0';
			}
			else {
				$PrintMarginTop = round((90-$height)/2);
			}
			
			$PrintPhoto[$IncVar] .= '<img src="' . $CheckContent->Photo5_modele . '" border="0" alt="" title="" style="margin-left: ' . $PrintMarginLeft . 'px; //margin-left: 5px; margin-top: ' . $PrintMarginTop . 'px; max-width: 206px; max-height: 90px; width: expression(this.width > 206 ? 206 : true); height: expression(this.height > 90 ? 90 : true);" />';
			$ControlInc++;
			if ($ControlInc > '2') {
				$IncVar++;
				$ControlInc = '1';
			}
		}
		if ($CheckContent->Photo6_modele != '') {
			
			if ($ControlInc == '1') { $Longueur = '228'; }
			else { $Longueur = '226'; }
			
			list($width, $height) = getimagesize($CheckContent->Photo6_modele);
			
			if ($width >= '206') {
				if ($height >= '90') {
					$PrintMarginLeft = (round(($Longueur-(((90/$height)*100)*$width/100))/2) - 10);
					
					if ($PrintMarginLeft < '0') {
						$PrintMarginLeft = '0';
					}
				}
				else {
					$PrintMarginLeft = '5';
				}
			}
			else {
				if ($height >= '90') {
					$PrintMarginLeft = (round(($Longueur-(((90/$height)*100)*$width/100))/2) - 10);
					
					if ($PrintMarginLeft < '0') {
						$PrintMarginLeft = '0';
					}
				}
				else {
					$PrintMarginLeft = round(($Longueur-$width)/2);
				}
			}
			
			if ($height >= '90') {
				$PrintMarginTop = '0';
			}
			else {
				$PrintMarginTop = round((90-$height)/2);
			}
			
			$PrintPhoto[$IncVar] .= '<img src="' . $CheckContent->Photo6_modele . '" border="0" alt="" title="" style="margin-left: ' . $PrintMarginLeft . 'px; //margin-left: 5px; margin-top: ' . $PrintMarginTop . 'px; max-width: 206px; max-height: 90px; width: expression(this.width > 206 ? 206 : true); height: expression(this.height > 90 ? 90 : true);" />';
			$ControlInc++;
			if ($ControlInc > '2') {
				$IncVar++;
				$ControlInc = '1';
			}
		}
	}
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
	<script type="text/javascript" src="js/jquery.imgcycle.js"></script>
	<?php require('js/dynamicpage.js'); ?>
	<script type="text/javascript">
	<?php require('js/jquery.dropdown.js'); ?>
	$(document).ready(function() {
		$('.illus1 img').each(function(){
			$(this).hide();
		});
		$('.illus2 img').each(function(){
			$(this).hide();
		});
		
		$('.illus1 img').first().show();
		$('.illus2 img').first().show();
		
		$('.illus1').cycle({fx: 'fade'});
		setTimeout(function() {$('.illus2').cycle({fx: 'fade'})}, 3000);
	});
	</script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<center>

<?php require('inc/header.php'); ?>

<table border="0" cellpadding="0" cellspacing="0" width="1000">
	<tr>
		<td align="right" valign="top" width="150" id="fabg" style="padding: 0px 10px 0px 0px; font-size: 11px; line-height: 15px;"><?php echo $PrintFab1; ?></td>
		<td valign="top" bgcolor="#FFFFFF">
			<table border="0" cellpadding="0" cellspacing="5" width="700">
				<tr>
					<td align="center" colspan="3" bgcolor="#000000" style="padding: 6px; font-size: 15px; line-height: 17px;"><span style="text-transform: uppercase;"><?php echo $PrintTitle; ?></span> : <?php echo $PrintFabTitle; ?></td>
				</tr>
				<tr>
					<td width="226" bgcolor="#FFFFFF" style="border: 2px solid #000000;">
						<div style="width: 206px; height: 90px; margin: 5px auto;">
							<?php echo $PrintLogo; ?>
						</div>
					</td>
					<td width="228" bgcolor="#FFFFFF" style="border: 2px solid #000000;">
						<div class="illus1" style="width: 206px; height: 90px; margin: 5px auto;">
							<?php echo $PrintPhoto['0']; ?>
						</div>
					</td>
					<td width="226" bgcolor="#FFFFFF" style="border: 2px solid #000000;">
						<div class="illus2" style="width: 206px; height: 90px; margin: 5px auto;">
							<?php echo $PrintPhoto['1']; ?>
						</div>
					</td>
				</tr>
				<tr>
					<td bgcolor="#000000" valign="top">
						<table border="0" cellpadding="10" cellspacing="0" width="100%">
							<tr>
								<td align="center"><?php echo $PrintInstru1; ?></td>
							</tr>
						</table>
					</td>
					<td bgcolor="#000000" valign="top">
						<table border="0" cellpadding="10" cellspacing="0" width="100%">
							<tr>
								<td align="center"><?php echo $PrintInstru2; ?></td>
							</tr>
						</table>
					</td>
					<td bgcolor="#000000" valign="top">
						<table border="0" cellpadding="10" cellspacing="0" width="100%">
							<tr>
								<td align="center"><?php echo $PrintInstru3; ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr height="503">
					<td align="left" valign="top" colspan="3" bgcolor="#000000" style="padding: 10px; font-size: 13px; line-height: 15px;"><?php echo $PrintPortrait . $PrintDescription; ?></td>
				</tr>
				<tr>
					<td bgcolor="#000000">
						<table border="0" cellpadding="10" cellspacing="0" width="100%">
							<tr>
								<td align="center" valign="middle"><?php echo $PrintVideo; ?></td>
							</tr>
						</table>
					</td>
					<td bgcolor="#000000">
						<table border="0" cellpadding="10" cellspacing="0" width="100%">
							<tr>
								<td align="center" valign="middle"><?php echo $PrintLien; ?></td>
							</tr>
						</table>
					</td>
					<td bgcolor="#000000">
						<table border="0" cellpadding="10" cellspacing="0" width="100%">
							<tr>  
								<td align="center" valign="middle"><a href="contact.php<?php echo $URLVarF . $URLVarSF . '&id=' . $HTTP_GET_VARS['id']; ?>" style="font-size: 11px; line-height: 18px;">Contact</a></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
		<td align="left" valign="top" width="150" id="fabd" style="padding: 0px 0px 0px 10px; font-size: 11px; line-height: 15px;"><?php echo $PrintFab2; ?></td>
	</tr>
</table>

<?php require('inc/footer.php'); ?>
<?php require('inc/nav_' . $_SESSION['lang'] . '.php'); ?>

</center>
</body>
</html>