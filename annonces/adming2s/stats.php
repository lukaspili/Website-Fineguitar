<?php
require_once('access.php');
require_once('header.php');
?>
<h2><?php _e("Site Usage Statistics");?></h2>
<blockquote>
<b><?php _e("Ads Views");?></b><br />
<?php _e("Yesterday");?>: <?php echo totalViews("all",1);?><br />
<?php _e("Last week");?>: <?php echo totalViews("all",8);?><br />
<?php _e("Last month");?>: <?php echo totalViews("all",30);?><br />
<?php _e("Total");?>: <?php echo totalViews();?><br />
</blockquote>
<blockquote>
<b><?php _e("Ads");?></b><br />
<?php _e("Yesterday");?>: <?php echo totalAds("all",1);?><br />
<?php _e("Last week");?>: <?php echo totalAds("all",8);?><br />
<?php _e("Last month");?>: <?php echo totalAds("all",30);?><br />
<?php echo T_("Total Ads").': '.totalAds();?><br />
</blockquote>
<?php
require_once('footer.php');
?>