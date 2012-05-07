<?php
require('inc/session.php');
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
	<?php require('js/dynamicpage.js'); ?>
	<script type="text/javascript">
	<?php require('js/jquery.dropdown.js'); ?>
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
					<td align="center" bgcolor="#000000" style="padding: 6px; font-size: 15px; line-height: 17px;">QUI SOMMES NOUS ?</td>
				</tr>
				<tr>
					<td align="left" valign="middle" bgcolor="#000000" style="padding: 40px 20px 40px 20px; font-size: 13px; line-height: 15px;">FineGuitar.net est le portail unique en France d&eacute;di&eacute; aux Guitaristes & Bassistes passionn&eacute;s par les tr&egrave;s beaux instruments, originaux et innovants ...<br /><br />
					FineGuitar.net rassemble pour vous les informations sur plus de 220 luthiers, artisans et pr&eacute;parateurs qui sauront vous &eacute;blouir par leurs r&eacute;alisations et vous faire partager leurs talents ...<br /><br />
					FineGuitar.net vous invite &agrave; d&eacute;couvrir un univers de plus de 1000 produits et services exceptionnels parmi :
					<ul style="margin: 20px; padding-left: 10px; list-style-type: disc;">
						<li>Les guitares classiques, acoustiques, &eacute;lectriques, manouches et jazz</li>
						<li>Les basses acoustiques, &eacute;lectriques</li>
						<li>Les amplificateurs pour guitare et pour basse</li>
						<li>Les effets pour guitare et pour basse</li>
						<li>Les accessoires et micros pour guitare et pour basse</li>
						<li>Les diff&eacute;rents services de r&eacute;paration et de modification des guitares, basses, amplificateurs et effets</li>
					</ul>
					En accord avec toutes les Personnes et Marques repr&eacute;sent&eacute;es, FineGuitar.net r&eacute;f&eacute;rence en un seul point de mani&egrave;res claire, logique et actualis&eacute;e, le meilleur des productions ind&eacute;pendantes françaises.<br /><br />
					La vocation de FineGuitar.net est &agrave; la fois :
					<ul style="margin: 20px; padding-left: 10px; list-style-type: disc;">
						<li>d'informer les Guitaristes et Bassistes sur la lutherie moderne et innovante en France</li>
						<li>de contribuer &agrave; promouvoir les Personnes et Marques repr&eacute;sent&eacute;es sur le Site</li>
						<li>de donner une tribune de qualit&eacute; au luxe "made in France"</li>
					</ul>
					<div align="center"><img id="Rotating" src="img/fineguitar1.jpg" border="0"></div></td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<?php require('inc/footer.php'); ?>
<?php require('inc/nav_' . $_SESSION['lang'] . '.php'); ?>

<script language="JavaScript">
var e = new Array("img/fineguitar1.jpg", "img/fineguitar2.jpg");
var f = document.getElementById('Rotating');

function RotateImages(Start) {
	if(Start>=e.length)
		Start=0;
	f.src = e[Start];
	window.setTimeout("RotateImages(" + (Start+1) + ")",4000);
}
RotateImages(0);
</script>

</center>
</body>
</html>