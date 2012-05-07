<?php
require_once('access.php');
require_once('header.php');
?>
<h2><?php _e("Administration");?></h2>
<div class="form-tab"><?php _e("Quick View");?></div>
<div class="clear"></div>
<div class="dashboard">
    <ul>
    <li><?php _e("Version");?>: <?php echo VERSION;?></li>
    <li><?php _e("Language");?>: <?php echo LANGUAGE;?></li>
    <li><?php _e("Theme");?>: <?php echo THEME;?></li>
    <li><?php echo T_("Total Ads").': '.totalAds();?>
    <li><?php echo T_("Total Views").': '.totalViews();?></li>
    </ul>
</div>

<a href="http://open-classifieds.com/support/professional-support/"><h1>Need a professional Open Classifieds site?</h1>
Just for 50 EUR, software installation, premium support, Yenii theme and much more.</a><br/>

<a href="http://phpmarket.org/buy/25"><h1>Yenii Premium Theme</h1>
Get the best Open Classifieds theme for just 25 EUR.</a> <a href="http://aderous.com/?theme=yenii">Demo</a><br/>

<?php
   echo '<br /><b><a href="http://open-classifieds.com/blog/" target="_blank">'.T_("Blog Updates").':</a></b><ul>'.rssReader('http://feeds.feedburner.com/OpenClassifieds',5,CACHE_ACTIVE,'<li>','</li>').'</ul>';
   echo '<br /><b><a href="http://open-classifieds.com/forum" target="_blank">'.T_("Support Forum").':</a></b><ul>'.rssReader('http://feeds.feedburner.com/Forum-OpenClassifiedsRecentTopics',5,CACHE_ACTIVE,'<li>','</li>').'</ul>';
?>
<?php
require_once('footer.php');
?>