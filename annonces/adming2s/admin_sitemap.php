<?php
require_once('access.php');
require_once('header.php');
?>
<h2><?php _e("Sitemap Generator");?></h2>
<p>
<?php _e("Click");?> <a href="admin_sitemap.php?action=renew" onClick="return confirm('<?php _e("Are you sure");?>?');"><?php _e("Sitemap");?> <?php echo round((time()-filemtime(SITEMAP_FILE))/60,1);?> <?php _e("minutes");?></a>
</p>
<?php 
if (cG("action")=="renew") {
	$sitemap=generateSitemap();
	echo "<br/><textarea cols=60 rows=30>$sitemap</textarea>";
}
?>
<p>
<a target="_blank" href="<?php echo SITE_URL;?>/sitemap.xml.gz"><?php _e("Open Sitemap");?></a>
</p>
<?php
require_once('footer.php');
?>
