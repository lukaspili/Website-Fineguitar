		</div><!-- close content -->
		<?php
		if(strpos($_SERVER["REQUEST_URI"], "login.php")<=0){//do not display for login?>
		<div id="sidebar">
			<ul id="nav_sub">
				<li><a href="<?php echo SITE_URL;?>/adming2s/index.php"><?php _e("Dashboard");?></a></li>
				<li><a href="listing.php"><?php _e("Listings");?></a></li>
				<li><a href="categories.php"><?php _e("Categories");?></a></li>
				<li><a href="locations.php"><?php _e("Locations");?></a></li>
				<li><a href="accounts.php"><?php _e("Accounts");?></a></li>
				<li><a href="settings.php"><?php _e("Settings");?></a></li>
				<li><a href="stats.php"><?php _e("Site Statistics");?></a></li>
			</ul>
			<ul id="tools">
				<li><a href="optimize.php?action=cache" onclick="return confirm('<?php _e("Are you sure");?>?');"><?php _e("Delete Cache");?></a></li>
				<li><a href="optimize.php?action=notconfirmed" onclick="return confirm('<?php _e("Are you sure");?>?');"><?php _e("Delete Ads not confirmed in 3 days");?></a></li>
				<li><a href="optimize.php?action=db" onclick="return confirm('<?php _e("Are you sure");?>?');"><?php _e("Optimize Database Tables");?></a></li>
                <li><a href="backup.php"><?php _e("Backup");?></a></li>
				<li><a href="admin_sitemap.php"><?php _e("Sitemap");?></a></li>
				<li><a href="phpinfo.php"><?php _e("PHP Info");?></a></li>
			</ul>
			<blockquote>
				<ul>
					<li><a href="http://j.mp/bLgA8C"><?php _e("Advertise Here");?></a></li>
				</ul>
				<p><?php _e("Please think about helping us with a donation. We need your support to maintain this software");?></p>
				<a href="http://j.mp/ocdonate" target="_blank">
					<img src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0" alt="" />
				</a>
			</blockquote>
		</div>
	<?php } ?>
		<div class="clear"></div>
	</div>
	<div id="footer">
		<?php 
		////////////////////////////////////////////////////////////
		//Common footer for admin
		////////////////////////////////////////////////////////////
		$ocdb->closeDB();
		$ocdb->returnDebug();
		echo "<p>".$ocdb->getQueryCounter().T_("queries generated in").round((microtime(true)-$app_time),3)."s - ".$ocdb->getQueryCounter("cache")." ".T_("queries cached")."</p>";
		?>
		<ul>
			<li class="credits">&copy; <?php echo date('Y')?> <a title="Open Classifieds | Free Advertisements Classifieds web | PHP + MYSQL" href="http://open-classifieds.com/">Open Classifieds</a> <strong>version <?php echo VERSION;?></strong></li>
			<li class="copyright"><a href="http://www.gnu.org/licenses/gpl.html" target="_blank">GNU General Public License</a></li>
		</ul>
	</div>
</div>
</body>
</html>
