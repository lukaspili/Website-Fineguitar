<?php
require_once('../includes/header.php');

if (LOGON_TO_POST){
    $account = Account::createBySession();
    if ($account->exists){
        $name = $account->name;
        $email = $account->email;
    } 
    else redirect(accountLoginURL());
}

if (!isInSpamList($client_ip)){//no spammer
	require_once('../includes/classes/resize.php');
	if ($_POST && checkCSRF('newitem') ){	
		newPost();
	}//if post else die('something went wrong');
	
	if (file_exists(SITE_ROOT.'/themes/'.THEME.'/item-new.php')){//item-new from the theme!
    	require_once(SITE_ROOT.'/themes/'.THEME.'/item-new.php'); 
    }
    else{//not found in theme
?>
<h3><?php _e("Publish a new Ad");?> <?php echo $categoryName;?></h3>
<form action="" method="post" onsubmit="return checkForm(this);" enctype="multipart/form-data">
	<?php _e("Category");?>:<br />

	<?php 
	if (is_numeric(cP("category"))) $selectedCategory=cP("category");
		else $selectedCategory=$idCategory;
	if (PARENT_POSTS){
		$query="SELECT idCategory,name,(select name from ".TABLE_PREFIX."categories where idCategory=C.idCategoryParent) FROM ".TABLE_PREFIX."categories C order by idCategoryParent, `order`";
		if (PAYPAL_ACTIVE)
			sqlOptionGroupScript($query,"category",$selectedCategory,"","onchange=\"redirectCategory(this.value)\"");
		else
			sqlOptionGroup($query,"category",$selectedCategory);
	}
	else{
		$query="SELECT idCategory,name,(select name from ".TABLE_PREFIX."categories where idCategory=C.idCategoryParent) 
			FROM ".TABLE_PREFIX."categories C where C.idCategoryParent!=0 order by idCategoryParent, `order`";
		if (PAYPAL_ACTIVE)
			sqlOptionGroupScript($query,"category",$selectedCategory,"","onchange=\"redirectCategory(this.value)\"");
		else
			sqlOptionGroup($query,"category",$selectedCategory);
	}
	?>
	<br />
	<?php _e("Title");?>*:<br />
	<input style="width:520px;" id="title" name="title" type="text" value="<?php echo $_POST["title"];?>" maxlength="120" onblur="validateText(this);"  lang="false" />
	<input style="width:50px;" id="price" name="price" type="text" value="<?php echo $_POST["price"];?>" maxlength="8"  onkeypress="return isNumberKey(event);"   /><?php echo CURRENCY;?><br />
	<br />
	<?php _e("Description");?>*:<br />

	<?php if (HTML_EDITOR){?>
	    <script type="text/javascript">var SITE_URL="<?php echo SITE_URL;?>";</script>
		<script type="text/javascript" src="<?php echo SITE_URL;?>/includes/js/nicEdit.js"></script>
		<script type="text/javascript">
		//<![CDATA[
			bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
			//]]>
		</script>
		<textarea rows="10" cols="73" name="description" id="description"><?php echo stripslashes($_POST['description']);?></textarea>
	<?php }
	    else{?>
		<textarea rows="10" cols="73" name="description" id="description" onblur="validateText(this);"  lang="false"><?php echo strip_tags($_POST['description']);?></textarea><?php }?>
	<br />	
	<?php if (NEED_OFFER){?>
	<?php _e("Type");?>:<br />
	<select id="type" name="type">
		<option value="<?php echo TYPE_OFFER;?>"><?php _e("offer");?></option>
		<option value="<?php echo TYPE_NEED;?>"><?php _e("need");?></option>
	</select>
	<br />
	<?php }?>
	
	<?php if (LOCATION){?>
    <?php _e("Location");?>:<br />
	<?php 
	if (is_numeric(cP("location"))) $selectedLocation=cP("location");
    $query="SELECT idLocation,name,(select name from ".TABLE_PREFIX."locations where idLocation=C.idLocationParent) FROM ".TABLE_PREFIX."locations C order by idLocationParent, idLocation";
	echo sqlOptionGroup($query,"location",$selectedLocation);
	?>
    <?php }?>
    <br />
	<?php _e("Place");?>:<br />
	<?php if (MAP_KEY==""){//not google maps?>
	<input id="place" name="place" type="text" value="<?php echo $_POST["place"];?>" size="69" maxlength="120" /><br />
	<?php }
	else{//google maps
		if ($_POST["place"]!="") $m_value=$_POST["place"];
		else $m_value=MAP_INI_POINT;
	?>
	<input id="place" name="place" type="text" value="<?php echo $m_value;?>" onblur="showAddress(this.value);" size="69" maxlength="120" /><br />
	<div id="map" style="width: 100%; height: 200px;"></div>
	<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?php echo MAP_KEY;?>" type="text/javascript"></script>
	<script type="text/javascript">var init_street="<?php echo MAP_INI_POINT;?>";</script>
	<script type="text/javascript" src="<?php echo SITE_URL;?>/includes/js/map.js"></script>
	<script type="text/javascript" src="<?php echo SITE_URL;?>/includes/js/mapSmall.js"></script>
	<?php }?>
    <br />
	<?php _e("Your Name");?>*:<br />
	<input id="name" name="name" type="text" value="<?php if ($_POST) echo $_POST["name"]; else echo $name;?>" maxlength="75" onblur="validateText(this);"  lang="false"  /><br />
    <?php if ($email!=""){?>
    <input id="email" name="email" type="hidden" value="<?php echo $email;?>" />
    <?php } else {
       echo T_("Email (not published)")."*:<br />";
    ?>
    <input id="email" name="email" type="text" value="<?php echo $_POST["email"];?>" maxlength="120" onblur="validateEmail(this);" lang="false"  /><br />
    <?php }?>
	<?php _e("Your Phone (published)");?>:<br />
	<input id="phone" name="phone" type="text" value="<?php echo $_POST["phone"];?>" maxlength="11" /><br />
	<?php if (VIDEO){?>
    	<span style="cursor:pointer;" onclick="youtubePrompt();"><?php _e("YouTube video");?></span>: <br />
    	<input id="video" name="video" type="text" value="<?php echo $_POST["video"];?>" onclick="youtubePrompt();" size="40" /><br />
    	<div id="youtubeVideo"></div>
	<?php } ?>
	<?php 
	if (MAX_IMG_NUM>0){
		echo "<input type='hidden' name='MAX_FILE_SIZE' value='".MAX_IMG_SIZE."' />";
		echo "<br />".T_("Upload pictures max file size").": ".(MAX_IMG_SIZE/1000000)."Mb ".T_("format")." ".IMG_TYPES."<br />";
		for ($i=1;$i<=MAX_IMG_NUM;$i++){?>
			<label><?php _e("Picture");?> <?php echo $i?>:</label><input type="file" name="pic<?php echo $i?>" id="pic<?php echo $i?>" value="<?php echo $_POST["pic".$i];?>" /><br />
	<?php }
	}
	?>
	<br />
	<?php if (CAPTCHA){
		mathCaptcha('newitem');?>
	<p><input id="math" name="math" type="text" size="2" maxlength="2"  onblur="validateNumber(this);"  onkeypress="return isNumberKey(event);" lang="false" /></p>
	<br /><?php }?>
	<?php
	if (PAYPAL_ACTIVE){
		$amount = (float)PAYPAL_AMOUNT;
		if (PAYPAL_AMOUNT_CATEGORY)
			$amount = (float)$categoryPaypal_amount;
		
		if ($amount > 0){
			if (PAYPAL_AMOUNT_CATEGORY)
				echo "<input type=\"hidden\" name=\"cpaypal\" value=\"".$amount."\" />";
				
			echo T_('Price to post using Paypal: ').$amount.PAYPAL_CURRENCY.'<br />';
		}
		else
			echo T_('Price to post using Paypal: FREE ').'<br />';
	}?>
	<?php createCSRF('newitem');?>
	<input type="submit" id="submit" value="<?php _e("Post it!");?>" />
</form>

<?php
if (PAYPAL_ACTIVE)
?>
<script type="text/javascript">
	function getURLParam(strParamName){
	  var strReturn = "";
	  var strHref = window.location.href;
	  if ( strHref.indexOf("?") > -1 ){
	    var strQueryString = strHref.substr(strHref.indexOf("?")).toLowerCase();
	    var aQueryString = strQueryString.split("&");
	    for ( var iParam = 0; iParam < aQueryString.length; iParam++ ){
	      if (aQueryString[iParam].indexOf(strParamName.toLowerCase() + "=") > -1 ){
	        var aParam = aQueryString[iParam].split("=");
	        strReturn = aParam[1];
	        break;
	      }
	    }
	  }
	  return unescape(strReturn);
	}

	function redirectCategory(cvalue){
		var strHref = window.location.href;
		if (strHref.indexOf('category=') == -1)
		{
			if (strHref.indexOf('?') == -1)
				strHref = strHref + '?category='+cvalue;
			else
				strHref = strHref + '&category='+cvalue;
		}
		else
		{
			var pvalue = getURLParam('category');
			strHref = strHref.replace("=" + pvalue, "=" + cvalue);
		}
		
		window.location = strHref;
	}
</script>
<?php
    }//if theme
}
else {//is spammer
	alert(T_("NO Spam!"));
	jsRedirect(SITE_URL);
}


require_once('../includes/footer.php');
?>