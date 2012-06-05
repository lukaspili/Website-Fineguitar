<?php
/**********************************************************************************/
// Connexion BDD
/**********************************************************************************/
include("inc/fct.php");

require('inc/session.php');

// Récupération du nombre de fabricants
$ControlFabricants = mysql_query('SELECT count(Id_fabricant) FROM fabricant');
$CheckFabricants = mysql_fetch_row($ControlFabricants);
$PrintNbFab = $CheckFabricants[0];

// Récupération du nombre de modèle
$ControlModeles = mysql_query('SELECT count(Id_modele) FROM modele');
$CheckModeles = mysql_fetch_row($ControlModeles);
$PrintNbMod = $CheckModeles[0];

$IncVar = '0';
$ControlInc = '1';
$PrintPhoto['0'] = '';
$PrintPhoto['1'] = '';
$PrintPhoto['2'] = '';
$PrintPhoto['3'] = '';
$PrintPhoto['4'] = '';
$PrintPhoto['5'] = '';

$SelectContent = mysql_query('SELECT Photo1_modele FROM modele ORDER BY RAND() LIMIT 18');
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
		
		$('.illus1 img').first().show();
		$('.illus2 img').first().show();
		$('.illus3 img').first().show();
		$('.illus4 img').first().show();
		$('.illus5 img').first().show();
		
		$('.illus1').cycle({fx: 'fade'});
		setTimeout(function() {$('.illus2').cycle({fx: 'fade'})}, 1000);
		setTimeout(function() {$('.illus3').cycle({fx: 'fade'})}, 2000);
		setTimeout(function() {$('.illus4').cycle({fx: 'fade'})}, 3000);
		setTimeout(function() {$('.illus5').cycle({fx: 'fade'})}, 4000);
	});
	</script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<center>

<?php require('inc/header.php'); ?>

<table border="0" cellpadding="0" cellspacing="0" width="700">
	<tr>
		<td valign="top" bgcolor="#FFFFFF">
			<table border="0" cellpadding="0" cellspacing="5" width="700">
				<tr>
					<td align="center" colspan="3" bgcolor="#000000" style="padding: 6px;">
						<table border="0" cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td width="33%" align="left" style="font-size: 15px; line-height: 17px;">Luthiers &amp; Artisans&nbsp;&nbsp;&nbsp;<span class="rouge"><?php echo $PrintNbFab; ?></span></td>
								<td width="34%" align="center" style="font-size: 15px; line-height: 17px;">GALERIE G&Eacute;N&Eacute;RALE</td>
								<td width="33%" align="right" style="font-size: 15px; line-height: 17px;"><span class="rouge"><?php echo $PrintNbMod; ?></span>&nbsp;&nbsp;&nbsp;Produits &amp; Services</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr height="111">
					<td width="226" bgcolor="#FFFFFF" style="border: 2px solid #000000;">
						<div class="illus1" style="width: 206px; height:90px; margin: 5px auto;">
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
				<tr height="111">
					<td width="226" bgcolor="#FFFFFF" style="border: 2px solid #000000;">
						<div class="illus4" style="width: 206px; height: 90px; margin: 5px auto;">
							<?php echo $PrintPhoto['3']; ?>
						</div>
					</td>
					<td width="228" align="center" bgcolor="#000000" style="border: 2px solid #000000;">
						<div>
							<a href="liste.php"><img src="img/luthiers_artisants.gif" border="0" width="224" height="111" alt="" title="" style="" /></a>
						</div>
					</td>
					<td width="226" bgcolor="#FFFFFF" style="border: 2px solid #000000;">
						<div class="illus5" style="width: 206px; height: 90px; margin: 5px auto;">
							<?php echo $PrintPhoto['5']; ?>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="3"><img src="img/illus_bandeau.jpg" width="690" height="63" border="0" alt="Le luxe de la lutherie moderne française" title="Le luxe de la lutherie moderne française" /></td>
				</tr>
				<tr height="290">
					<td align="left" valign="middle" colspan="3" bgcolor="#000000" style="padding: 15px; font-size: 16px; line-height: 22px; background-image: url(img/illus_home.jpg); background-repeat: no-repeat; background-position: left top;">FineGuitar.net est le portail d&eacute;di&eacute; aux Guitaristes & Bassistes<br />passionn&eacute;s par les tr&egrave;s beaux instruments, originaux et innovants ...<br /><br />
					FineGuitar.net rassemble pour vous les informations sur les<br />meilleurs luthiers, artisans et pr&eacute;parateurs qui sauront vous &eacute;blouir<br />par leurs r&eacute;alisations et vous faire partager leurs talents ...<br /><br />
					FineGuitar.net vous invite &agrave; d&eacute;couvrir un univers de produits et de<br />services exceptionnels ...</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<?php require('inc/footer.php'); ?>
<?php require('inc/nav_' . $_SESSION['lang'] . '.php'); ?>


<?php
	$result = mysql_query('SELECT Nom_fabricant AS name FROM fabricant LIMIT 300');
	
	while($row = mysql_fetch_assoc($result)){
		//echo("<span style='float: left; width: 10%;'>" . $row['name'] . "</span>");
	}
	
?>


</center>
</body>
</html>
