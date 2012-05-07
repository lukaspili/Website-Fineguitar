<script type="text/javascript">
$(function() {
	// Déclaration des variables utiles
	var newHash      = "",
		linkVersion = '<?php echo $LinkVersion; ?>';
	
	// Applique le lien adéquat au changement de langue, en fonction de la version en cours
	$("#urlLink").click(function(){
		var pageURL = location.pathname.substr(location.pathname.lastIndexOf("/")+1,location.pathname.length);
		if (pageURL == 'index.php' || pageURL == 'liste.php' || pageURL == 'liste_dep.php' || pageURL == 'liste_guit.php' || pageURL == 'liste_bass.php' || pageURL == 'liste_amp.php' || pageURL == 'liste_eff.php' || pageURL == 'liste_acc.php' || pageURL == 'liste_rep.php' || pageURL == 'qui.php' || pageURL == 'contacter.php' || pageURL == 'evenements.php' || pageURL == 'presse.php' || pageURL == 'mentions.php') { // || pageURL == 'partenaires.php'
			window.location.href = '?lang='+linkVersion;
		}
		else {
			var searchString = document.location.search;
			var splitString = searchString.indexOf("&lang");
			
			if (splitString <= '0') {
				window.location.href = searchString+'&lang='+linkVersion;
			}
			else {
				var selectString = searchString.substring(0, splitString);
				window.location.href = selectString+'&lang='+linkVersion;
			}
		}
	});
});
</script>