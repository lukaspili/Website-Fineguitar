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
					<td align="center" bgcolor="#000000" style="padding: 6px; font-size: 15px; line-height: 17px;">PRESSE</td>
				</tr>
				<tr>
					<td align="left" valign="middle" bgcolor="#000000" style="padding: 40px 20px 40px 20px; font-size: 13px; line-height: 15px;">Vous trouverez ci-apr&egrave;s les liens vers les Sites de Presse, d’Information et Communautaires qui ont publi&eacute; des informations &agrave; propos de FineGuitar.net &copy; :<br /><br />
					...</td>
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