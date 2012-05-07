<?php
/**********************************************************************************/
// Connexion BDD
/**********************************************************************************/
include("inc/fct.php");

require('inc/session.php');
require('inc/modelfab.php');
require('inc/instrunav.php');

$IncVar = '0';
$ControlInc = '1';
$PrintPhoto['0'] = '';
$PrintPhoto['1'] = '';
$PrintPhoto['2'] = '';
$PrintPhoto['3'] = '';
$PrintPhoto['4'] = '';
$PrintPhoto['5'] = '';

$SelectContent = mysql_query('SELECT Photo1_modele FROM modele WHERE Famille_modele = "' . $SearchVarF . '"' . $AddSearchInstru .' ORDER BY RAND() LIMIT 18');
if (mysql_num_rows($SelectContent) != 0) {
	while ($CheckContent = mysql_fetch_object($SelectContent)) {
		if ($CheckContent->Photo1_modele != '') {
			
			if ($ControlInc == '2') { $Longueur = '228'; }
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
			if ($ControlInc > '3') {
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
		$('.illus3 img').each(function(){
			$(this).hide();
		});
		$('.illus4 img').each(function(){
			$(this).hide();
		});
		$('.illus5 img').each(function(){
			$(this).hide();
		});
		$('.illus6 img').each(function(){
			$(this).hide();
		});
		
		$('.illus1 img').first().show();
		$('.illus2 img').first().show();
		$('.illus3 img').first().show();
		$('.illus4 img').first().show();
		$('.illus5 img').first().show();
		$('.illus6 img').first().show();
		
		$('.illus1').cycle({fx: 'fade'});
		setTimeout(function() {$('.illus2').cycle({fx: 'fade'})}, 1000);
		setTimeout(function() {$('.illus3').cycle({fx: 'fade'})}, 2000);
		setTimeout(function() {$('.illus4').cycle({fx: 'fade'})}, 3000);
		setTimeout(function() {$('.illus5').cycle({fx: 'fade'})}, 4000);
		setTimeout(function() {$('.illus6').cycle({fx: 'fade'})}, 5000);
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
					<td align="center" colspan="3" bgcolor="#000000" style="padding: 6px; font-size: 15px; line-height: 17px; text-transform: uppercase;">GALERIE <?php echo $PrintTitle; ?></td>
				</tr>
				<tr>
					<td width="226" bgcolor="#FFFFFF" style="border: 2px solid #000000;">
						<div class="illus1" style="width: 206px; height: 90px; margin: 5px auto;">
							<?php echo $PrintPhoto['0']; ?>
						</div>
					</td>
					<td width="228" bgcolor="#FFFFFF" style="border: 2px solid #000000;">
						<div class="illus2" style="width: 206px; height: 90px; margin: 5px auto;">
							<?php echo $PrintPhoto['1']; ?>
						</div>
					</td>
					<td width="226" bgcolor="#FFFFFF" style="border: 2px solid #000000;">
						<div class="illus3" style="width: 206px; height: 90px; margin: 5px auto;">
							<?php echo $PrintPhoto['2']; ?>
						</div>
					</td>
				</tr>
				<tr>
					<td width="226" bgcolor="#FFFFFF" style="border: 2px solid #000000;">
						<div class="illus4" style="width: 206px; height: 90px; margin: 5px auto;">
							<?php echo $PrintPhoto['3']; ?>
						</div>
					</td>
					<td width="228" bgcolor="#FFFFFF" style="border: 2px solid #000000;">
						<div class="illus5" style="width: 206px; height: 90px; margin: 5px auto;">
							<?php echo $PrintPhoto['4']; ?>
						</dive>
					</td>
					<td width="226" bgcolor="#FFFFFF" style="border: 2px solid #000000;">
						<div class="illus6" style="width: 206px; height: 90px; margin: 5px auto;">
							<?php echo $PrintPhoto['5']; ?>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="3"><img src="img/illus_bandeau.jpg" width="690" height="63" border="0" alt="Le luxe de la lutherie moderne française" title="Le luxe de la lutherie moderne française" /></td>
				</tr>
				<tr height="430">
					<td align="left" valign="middle" colspan="3" bgcolor="#000000" style="padding: 15px; font-size: 16px; line-height: 22px; background-image: url(img/illus_home_2.jpg); background-repeat: no-repeat; background-position: left top;">FineGuitar.net est le portail d&eacute;di&eacute; aux Guitaristes & Bassistes<br />passionn&eacute;s par les tr&egrave;s beaux instruments, originaux et innovants ...<br /><br />
					FineGuitar.net rassemble pour vous les informations sur les<br />meilleurs luthiers, artisans et pr&eacute;parateurs qui sauront vous &eacute;blouir<br />par leurs r&eacute;alisations et vous faire partager leurs talents ...<br /><br />
					FineGuitar.net vous invite &agrave; d&eacute;couvrir un univers de produits et de<br />services exceptionnels ...</td>
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