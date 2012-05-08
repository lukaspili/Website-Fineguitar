<?php
include("inc/fct.php");
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
					<td align="center" bgcolor="#000000" style="padding: 6px; font-size: 15px; line-height: 17px;">PETITES ANNONCES DEDIEES A L’UNIVERS DE LA LUTHERIE</td>
				</tr>
				<tr>
					<td align="left" valign="middle" bgcolor="#000000" style="padding: 40px 20px 40px 20px; font-size: 13px; line-height: 15px;">
						<p>
						<strong>Petites Annonces dédiées exclusivement à l’univers de la Lutherie</strong><br />

						Le Portail des Luthier <strong>FineGuitar.net</strong>. propose aux luthiers & artisans ainsi qu’aux particuliers un  site internet rattaché, <strong>Annonces FineGuitar.net</strong>, service de petites annonces gratuites dédiées à la Lutherie.<br />
						<br />
						<strong>Annonces FineGuitar.net</strong> est modéré, maintenu et exploité professionnellement par l’équipe de <strong>FineGuitar.net</strong>.<br />
						<br />
						<strong>Annonces FineGuitar.net</strong> est exclusivement réservé aux dépôts et aux consultations de petites annonces gratuites relatives à la vente, l’achat ou l’échange d’instruments de musique (guitares, basses), d’équipements associés (amplificateurs, effets) et d’accessoires (micros, accessoires divers) dont les fabricants sont exclusivement des luthiers & artisans français ou étrangers, dans l’esprit du site <strong>FineGuitar.net</strong>, portail des luthiers & artisans français.<br />
						<br />
						Les particuliers comme les luthiers & artisans sont autorisés à utiliser tous les services du site.<br />
						<br />
						<strong>Annonces FineGuitar.net</strong> propose un lieu unique de rencontre des musiciens passionnés par les instruments et les équipements des luthiers & artisans français mais aussi étrangers.<br />
						<br />
						<strong>Annonces FineGuitar.net</strong> rassemble pratiquement tous les services nécessaires pour réaliser des ventes, achats et échanges, mais exclusivement dans l’univers de la Guitare et de la Basse des luthiers & artisans.<br />
						<br />
						Pour accéder au service Annonces <strong>FineGuitar.net</strong>, cliquer sur l’icône [PA] présente sur l’ensemble du site <strong>FineGuitar.net</strong>.
						</p>
			</tr>
			</table>
		</td>
	</tr>
</table>
<?php require('inc/footer.php'); ?>
<?php require('inc/nav_' . $_SESSION['lang'] . '.php'); ?>

</center>
</body>
</html>	
