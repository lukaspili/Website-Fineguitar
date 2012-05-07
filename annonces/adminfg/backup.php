<?php
require_once('access.php');
require_once('header.php');
?>
<h2><?php _e("Backup");?></h2>
<div id="formBackup">
	<div id="form-tab" class="form-tab"><?php _e("Database");?></div>
	<div class="clear"></div>
	<form name="Backup" action="" method="post">
		<fieldset>
			<p>
				<?php _e("Click the button below to download a database backup");?>
			</p>   
            <a href="backup_db.php" class="button-submit" title="<?php _e("Submit");?>"><?php _e("Submit");?></a>     
			<input type="hidden" name="action" value="backup" />
		</fieldset>
	</form>
</div>
<?php
require_once('footer.php');
?>