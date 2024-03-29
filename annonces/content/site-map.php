<?php
require_once('../includes/header.php');

if (file_exists(SITE_ROOT.'/themes/'.THEME.'/site-map.php')){//site-map from the theme!
	require_once(SITE_ROOT.'/themes/'.THEME.'/site-map.php'); 
}
else{//not found in theme

?>
<h3><?php echo SITE_NAME.' '.T_("Sitemap");?>:</h3>
<h4><?php _e("Categories");?></h4>
<ul>
<?php
	foreach($resultSitemap as $row){
		 echo '<li><a title="'.htmlentities($row['description'], ENT_QUOTES, CHARSET).'" href="'.SITE_URL.catURL($row['friendlyName'],$row['parent']).'">'.$row['name'].'</a></li>';
	}
?>
</ul>
<br	/>

<?php if (LOCATION){?>
<h4><?php _e("Location");?></h4>
<ul>
<?php
	foreach($resultSitemapLoc as $row){
		 echo '<li><a title="'.htmlentities($row['name'], ENT_QUOTES, CHARSET).'" href="'.SITE_URL.catURL('','',$row['friendlyName']).'">'.$row['name'].'</a></li>';
	}
?>
</ul>
<br	/>
<?php }?>

<h4><?php _e("Links");?>:</h4>
<ul>
    <?php if(FRIENDLY_URL) {?>
	    <li><a href="<?php echo SITE_URL."/".u(T_("Advanced Search"));?>.htm"><?php _e("Advanced Search");?></a></li>
	    <li><a href="<?php echo SITE_URL."/".u(T_("Sitemap"));?>.htm"><?php _e("Sitemap");?></a></li>
		<li><a href="<?php echo SITE_URL."/".u(T_("Conditions d'utilisation"));?>.htm"><?php _e("Conditions d'utilisation");?></a></li>
		<li><a href="<?php echo SITE_URL."/".u(T_("Qui sommes nous"));?>.htm"><?php _e("Qui sommes nous");?></a></li>
		<li><a href="<?php echo SITE_URL."/".u(T_("Mentions légales"));?>.htm"><?php _e("Mentions légales");?></a></li>		
    <?php }else { ?>
        <li><a href="<?php echo SITE_URL;?>/content/search.php"><?php _e("Advanced Search");?></a></li>
        <li><a href="<?php echo SITE_URL;?>/content/site-map.php"><?php _e("Sitemap");?></a></li>
		<li><a href="<?php echo SITE_URL;?>/terms-of-use.php"><?php _e("Conditions d'utilisation");?></a></li>
		<li><a href="<?php echo SITE_URL;?>/about-us.php"><?php _e("Qui sommes nous");?></a></li>
		<li><a href="<?php echo SITE_URL;?>/imprint.php"><?php _e("Mentions légales");?></a></li>			
    <?php } ?>
    <li><a href="<?php echo SITE_URL."/".contactURL();?>"><?php _e("Contact");?></a></li>
    <li><a href="<?php echo SITE_URL."/".contactURL()."?subject=".T_("Suggest new category");?>"><?php _e("Suggest new category");?></a></li>
    <li><a href="<?php echo SITE_URL.newURL();?>"><?php _e("Publish a new Ad");?></a></li>
</ul>
<?php
}//if else

require_once('../includes/footer.php');
?>
