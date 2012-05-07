<?php
if(!file_exists('../install.lock')) die('Installation seems to be done');//prevents from new install to be done
include("../includes/common.php");//adding common library

define('VERSION','1.7.5.1');
define('DEBUG', false);
define('CHARSET', 'UTF-8');

	
if (!DEBUG){//do not display any error message
    error_reporting(0);
    ini_set('display_errors','off');
}
else ini_set('display_errors','on');//displays error messages

//language locales	
require_once('../includes/gettext/gettext.inc');//gettext override

if ($_POST["LANGUAGE"]!='') $locale_language=$_POST["LANGUAGE"];
elseif ($_GET["LANGUAGE"]!='') $locale_language=$_GET["LANGUAGE"];
else  $locale_language='en_EN';

if ( !function_exists('_') ){//check if gettext exists if not use dropin
	T_setlocale(LC_MESSAGES, $locale_language);
	bindtextdomain('messages','../languages/');
	bind_textdomain_codeset('messages', CHARSET);
	textdomain('messages');
}
else{//gettext exists using fallback in case locale doesn't exists
	T_setlocale(LC_MESSAGES, $locale_language);
	T_bindtextdomain('messages','../languages/');
	T_bind_textdomain_codeset('messages', CHARSET);
	T_textdomain('messages');
}
//end language locales	

$step="";
if (isset($_POST["step"])) $step=$_POST["step"];

$terms="";
if (isset($_POST["terms"])) $terms=$_POST["terms"];

$SITE_URL="";
if (isset($_POST["SITE_URL"])) $SITE_URL=$_POST["SITE_URL"];

$SITE_ROOT="";
if (isset($_POST["SITE_ROOT"])) $SITE_ROOT=$_POST["SITE_ROOT"];

$DB_HOST="";
if (isset($_POST["DB_HOST"])) $DB_HOST=$_POST["DB_HOST"];

$DB_USER="";
if (isset($_POST["DB_USER"])) $DB_USER=$_POST["DB_USER"];

$DB_PASS="";
if (isset($_POST["DB_PASS"])) $DB_PASS=$_POST["DB_PASS"];

$DB_NAME="";
if (isset($_POST["DB_NAME"])) $DB_NAME=$_POST["DB_NAME"];

$DB_CHARSET="";
if (isset($_POST["DB_CHARSET"])) $DB_CHARSET=$_POST["DB_CHARSET"];

$TABLE_PREFIX="";
if (isset($_POST["TABLE_PREFIX"])) $TABLE_PREFIX=$_POST["TABLE_PREFIX"];

$SAMPLE_DB="";
if (isset($_POST["SAMPLE_DB"])) $SAMPLE_DB=$_POST["SAMPLE_DB"];

$SITE_NAME="";
if (isset($_POST["SITE_NAME"])) $SITE_NAME=$_POST["SITE_NAME"];

$NOTIFY_EMAIL="";
if (isset($_POST["NOTIFY_EMAIL"])) $NOTIFY_EMAIL=$_POST["NOTIFY_EMAIL"];

$LANGUAGE="";
if (isset($_POST["LANGUAGE"])) $LANGUAGE=$_POST["LANGUAGE"];

$TIMEZONE="";
if (isset($_POST["TIMEZONE"])) $TIMEZONE=$_POST["TIMEZONE"];

$ADMIN="";
if (isset($_POST["ADMIN"])) $ADMIN=$_POST["ADMIN"];

$ADMIN_PWD="";
if (isset($_POST["ADMIN_PWD"])) $ADMIN_PWD=$_POST["ADMIN_PWD"];

$OCAKU = 0;
if (isset($_POST["OCAKU"])) $OCAKU=$_POST["OCAKU"];

//////////////////////////////////////////////////////////////////////

$db_check_succeed=true;
$db_check_message="";

if ($step=="3"){
$link = mysql_connect("$DB_HOST", "$DB_USER", "$DB_PASS");
		if (!$link) {
			$db_check_message.= "<p>".T_("Cannot connect to server")." '" . $DB_HOST . "'</p>\n";
        	$db_check_message.= "<p>".mysql_error()."</p>";
		}
	if ($link) {
        if ($DB_NAME){
            $dbcheck = mysql_select_db("$DB_NAME");
            if (!$dbcheck) $db_check_message.= "<p>".mysql_error()."</p>";
        } else {
    		$db_check_message.= "<p>".T_("No database name was given").". ".T_("Available databases").":</p>\n";
    		$db_list = mysql_list_dbs($link);
    		$db_check_message.= "<pre>\n";
    		while ($row = mysql_fetch_object($db_list)) {
         		$db_check_message.= $row->Database . "\n";
    		}
    		$db_check_message.= "</pre>\n";
        }
	}
    
    $db_check_succeed=$db_check_message=="";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Open Classifieds - Install</title>
	<meta name="author" content="chema@garridodiaz.com" />
	<meta name="generator" content="Open Classifieds" />
	<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
	<link rel="shortcut icon" href="../favicon.ico" />
	<script type="text/javascript" src="../includes/js/common.js"></script>
</head>
<body>
<div id="container">
    <div id="header">
        <h1>Open Classifieds &raquo; <span>Free Classifieds PHP Script</span></h1>
        <ul id="nav_main">
            <li><a href="index.php" title="<?php _e("Welcome")?>" <?php if ($step=="" || $terms==""){?>class="current"<?php }?>><?php _e("Welcome")?></a></li>
            <li><a href="#" title="<?php _e("Requirements")?>" <?php if ($step=="requirements" && $terms!=""){?>class="current"<?php }?>><?php _e("Requirements")?></a></li>
            <li><a href="#" title="<?php _e("Path Settings")?>" <?php if ($step=="1"){?>class="current"<?php }?>><?php _e("Path Settings")?></a></li>
            <li><a href="#" title="<?php _e("Database")?>" <?php if ($step=="2" || !$db_check_succeed){?>class="current"<?php }?>><?php _e("Database")?></a></li>
            <li><a href="#" title="<?php _e("Basic Configuration")?>" <?php if ($step=="3" && $db_check_succeed){?>class="current"<?php }?>><?php _e("Basic Configuration")?></a></li>
            <li><a href="#" title="<?php _e("Review & Install")?>" <?php if ($step=="review" || $step=="install"){?>class="current"<?php }?>><?php _e("Review & Install")?></a></li>
        </ul>
    </div>
    <div id="main">
<div id="content">
<?php

//if (file_exists("../includes/config.php")){
//	echo "<p>".T_("Configuration file already exists")."!!!</p><p>".T_("If you want to reinstall").", ".T_("please remove the file then try again").".";	
//}
//else{//config file doesnt exists

if ($_POST && $step=="install"){//if there's post step=install
	$succeed=false;

	//1st try sql if not no install
	if (!mysql_connect($_POST["DB_HOST"],$_POST["DB_USER"],$_POST["DB_PASS"])){
		$msg=mysql_error();
		$succeed=false;
	}
	else{//succedded connecting to mysql server
	    $succeed=true;//connected!
	    //2nd import sql tables
	    $TABLE_PREFIX=$_POST["TABLE_PREFIX"];
	    $DB_CHARSET=$_POST["DB_CHARSET"];
	    mysql_select_db($_POST["DB_NAME"]);//selecting the db
	    mysql_query('SET NAMES '.$DB_CHARSET);
	    include("sql.php");//dump tables
	    mysql_close();
	}
	
	if($succeed){		
	    
	    if ($OCAKU == 1)
	    {
	        include("../includes/classes/class.ocaku.php");//ocaku integration
	        	    
	        //ocaku register new site!
	        $ocaku=new ocaku();
	        $data=array(
	        					'siteName'=>$_POST["SITE_NAME"],
	        					'siteUrl'=>$_POST["SITE_URL"],
	        					'email'=>$_POST["NOTIFY_EMAIL"],
	        					'language'=>substr($_POST["LANGUAGE"],0,2)
	        );
	        $apiKey=$ocaku->newSite($data);
	        unset($ocaku);
	        //end ocaku register
	    }	
	    else $apiKey="";
        
        //4th create config file
		$config_content = "<?php\n//Open Classifieds ".T_("Config")." ".date("d/m/Y G:i:s")."\n";
		foreach  ($_POST AS $key => $value){
				if ($key!="submit" and $key!="TIMEZONE"){
					$config_content.="define('$key','$value');\n";		
				}
		}
		$config_content.="date_default_timezone_set('".$_POST["TIMEZONE"]."');
define('CHARSET','UTF-8');
define('LOCALE_EXT','');
define('DEFAULT_THEME', 'wpClassifieds');
define('THEME_SELECTOR',false);
define('THEME_MOBILE',false);
define('ITEMS_PER_PAGE',10);
define('DISPLAY_PAGES',10);
define('FRIENDLY_URL', true);
define('COUNT_POSTS', true);
define('HTML_EDITOR', true);
define('DATE_FORMAT', 'dd-mm-yyyy');
define('MIN_SEARCH_CHAR',4);
define('PASSWORD_SIZE',8);
define('SEPARATOR',' | ');
define('SIDEBAR_ORIG','account,item_tools,new,search,locations,categories_cloud,infolinks,comments,advertisement,donate,popular,links,theme,translator,rss');
define('SIDEBAR','account,item_tools,search,locations,infolinks,advertisement,donate,popular');
define('ADVERT_TOP','<script type=\"text/javascript\">google_ad_client = \"pub-9818256176049741\";google_ad_slot = \"5864321500\"; google_ad_width = 728;google_ad_height = 15;</script><script type=\"text/javascript\" src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\"></script>');
define('ADVERT_SIDEBAR','<script type=\"text/javascript\">google_ad_client = \"pub-9818256176049741\";google_ad_slot = \"4162447127\";google_ad_width = 250;google_ad_height = 250;</script><script type=\"text/javascript\" src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\"></script>');
define('CURRENCY','&euro;');
define('CURRENCY_FORMAT','AMOUNTCURRENCY');
define('MAX_IMG_SIZE', 4000000);
define('IMG_UPLOAD', '/images/');
define('IMG_UPLOAD_DIR', SITE_ROOT.IMG_UPLOAD);
define('MAX_IMG_NUM',4);
define('IMG_TYPES','gif,jpeg,jpg,png');
define('IMG_RESIZE',600);
define('IMG_RESIZE_THUMB',100);
define('RSS_ITEMS',15);
define('RSS_IMAGES',true);
define('SITEMAP_FILE',SITE_ROOT.'/sitemap.xml.gz');
define('SITEMAP_EXPIRE',86400);
define('SITEMAP_DEL_ON_POST',true);
define('SITEMAP_DEL_ON_CAT',true);
define('SITEMAP_PING',false);
define('TYPE_OFFER',0);
define('TYPE_NEED',1);
define('CACHE_ACTIVE',true);
define('CACHE_TYPE','filecache');
define('CACHE_DATA_FILE',SITE_ROOT.'/cache/');
define('CACHE_EXPIRE',86400);
define('CACHE_DEL_ON_POST',true);
define('CACHE_DEL_ON_CAT',true);
define('ANALYTICS','');
define('AKISMET','');
define('MAP_KEY','');
define('MAP_INI_POINT','');
define('DISQUS','');
define('GMAIL',false);
define('GMAIL_USER','');
define('GMAIL_PASS','');
define('VIDEO',false);
define('LOCATION',false);
define('LOCATION_ROOT','');
define('SMTP_HOST','');
define('SMTP_PORT','');
define('SMTP_AUTH',false);
define('SMTP_USER','');
define('SMTP_PASS','');
define('LOGON_TO_POST',false);
define('OCAKU_KEY','".$apiKey."');
define('ALLOWED_HTML_TAGS','<b><i><u><div><center><blockquote><li><ul><a><p><br><br />');
define('SITE_DESCRIPTION','');
define('PARENT_POSTS',true);
define('CONFIRM_POST',false);
define('EXPIRE_POST',0);
define('RSS_SIDEBAR_URL','http://ocaku.com/en/rss/');
define('RSS_SIDEBAR_NAME','Ocaku');
define('RSS_SIDEBAR_COUNT','5');
define('PAYPAL_ACTIVE',false);
define('PAYPAL_ACCOUNT','paypal@open-classifieds.com');
define('PAYPAL_AMOUNT','2');
define('PAYPAL_CURRENCY','EUR');
define('PAYPAL_SANDBOX',false);
define('PAYPAL_AMOUNT_CATEGORY',false);
define('CAPTCHA',true);
define('SPAM_COUNTRY',false);
define('SPAM_COUNTRIES','');
define('NEED_OFFER',false);
\n?>";//	echo $config_content;
	
		if(is_writable('../includes/config.php')){
			$file = fopen('../includes/config.php' , "w+");
			if (fwrite($file, $config_content)=== FALSE) {
				$msg=T_("Cannot write to the configuration file")." '/includes/config.php'";
				$succeed=false;
			}else $succeed=true;
			fclose($file);
		}
		else {
			$msg=T_("The configuration file")." '/includes/config.php' ".T_("is not writable").". ".T_("Change its permissions, then try again").".";
			$succeed=false;
		}
	}

	//5th create robots.txt
	if($succeed){
	    //include("../languages/".$_POST["LANGUAGE"].".php");//adding language for the type
	
	    $con=friendly_url(html_entity_decode(T_("Contact"),ENT_QUOTES,'UTF-8'));
        if ($con=="") $con="contact";
		$robots_content = "User-agent: *
Allow: /images/*
Disallow: /includes/
Disallow: /manage/
Disallow: /admin/
Disallow: /cache/
Disallow: /install/
Disallow: /$con/
Disallow: /?s=
Allow: /rss/$
Sitemap: ".$_POST["SITE_URL"]."/sitemap.xml.gz";//	echo $robots_content;
	
		if(is_writable('../robots.txt')){
			$file = fopen('../robots.txt' , "w+");
			if (fwrite($file, $robots_content)=== FALSE) {
				$msg=T_("Cannot write to the configuration file")." '/robots.txt'";
				$succeed=false;
			}else $succeed=true;
			fclose($file);
		}
		else {
			$msg=T_("The configuration file")." '/robots.txt' ".T_("is not writable").". ".T_("Change its permissions, then try again").".";
			$succeed=false;
		}
	}

    //6th create .htaccess
	if($succeed){
        $rewritebase=str_replace('http://'.$_SERVER["SERVER_NAME"],"",$_POST["SITE_URL"]);
        if ($_SERVER["SERVER_PORT"]!="80") $rewritebase=str_replace(":".$_SERVER["SERVER_PORT"],"",$rewritebase);
        if ($rewritebase=="") $rewritebase="/";
        
        $offer=friendly_url(html_entity_decode(T_("Offer"),ENT_QUOTES,'UTF-8'));
        if ($offer=="") $offer="offer";

        $need=friendly_url(html_entity_decode(T_("Need"),ENT_QUOTES,'UTF-8'));
        if ($need=="") $need="need";

        $cat=friendly_url(html_entity_decode(T_("Category"),ENT_QUOTES,'UTF-8'));
        if ($cat=="") $cat="category";

        $typ=friendly_url(html_entity_decode(T_("type"),ENT_QUOTES,'UTF-8'));
        if ($typ=="") $typ="type";

        $new=friendly_url(html_entity_decode(T_("Publish a new Ad"),ENT_QUOTES,'UTF-8'));
        if ($new=="") $new="new";

        $pol=friendly_url(html_entity_decode(T_("Privacy Policy"),ENT_QUOTES,'UTF-8'));
        if ($pol=="") $pol="policy";

        $sm=friendly_url(html_entity_decode(T_("Sitemap"),ENT_QUOTES,'UTF-8'));
        if ($sm=="") $sm="sitemap";

        $sch=friendly_url(html_entity_decode(T_("Advanced Search"),ENT_QUOTES,'UTF-8'));
        if ($sch=="") $sch="search";

        $gm=friendly_url(html_entity_decode(T_("Map"),ENT_QUOTES,'UTF-8'));
        if ($gm=="") $gm="map";
        
        $ads=friendly_url(html_entity_decode(T_("Classifieds"),ENT_QUOTES,'UTF-8'));
        if ($ads=="") $ads="ads";

        $aregister=friendly_url(html_entity_decode(T_("Register new account"),ENT_QUOTES,'UTF-8'));
        if ($aregister=="") $aregister="register-new-account";

        $alogin=friendly_url(html_entity_decode(T_("Login"),ENT_QUOTES,'UTF-8'));
        if ($alogin=="") $alogin="login";

        $alogout=friendly_url(html_entity_decode(T_("Logout"),ENT_QUOTES,'UTF-8'));
        if ($alogout=="") $alogout="logout";

        $aforgotpwd=friendly_url(html_entity_decode(T_("Forgot My Password"),ENT_QUOTES,'UTF-8'));
        if ($aforgotpwd=="") $aforgotpwd="forgot-password";

        $aconfig=friendly_url(html_entity_decode(T_("Settings"),ENT_QUOTES,'UTF-8'));
        if ($aconfig=="") $aconfig="settings";

        $account=friendly_url(html_entity_decode(T_("My Account"),ENT_QUOTES,'UTF-8'));
        if ($account=="") $account="my-account";
        
        $terms=friendly_url(html_entity_decode(T_("Terms"),ENT_QUOTES,'UTF-8'));
        if ($terms=="") $account="terms";

$htaccess_content = "ErrorDocument 404 ";
if ($rewritebase=="/") $htaccess_content .= $rewritebase."content/404.php";
else $htaccess_content .= $rewritebase."/content/404.php";

$htaccess_content .= "
<IfModule mod_rewrite.c>
RewriteEngine on
RewriteBase $rewritebase
RewriteRule ^([0-9]+)$ index.php?page=$1 [L]
RewriteRule ^install/$ install/ [L]
RewriteRule ^adminfg/$ adminfg/index.php [L]
RewriteRule ^rss/$ content/feed-rss.php [L]
RewriteRule ^manage/$ content/item-manage.php [L]
RewriteRule ^$new.htm content/item-new.php [L]
RewriteRule ^$con.htm content/contact.php [L]
RewriteRule ^$terms.htm content/terms.php [L]
RewriteRule ^conditions-dutilisation.htm content/terms-of-use.php [L]
RewriteRule ^qui-sommes-nous.htm content/about-us.php [L]
RewriteRule ^mentions-legales.htm content/imprint.php [L]
RewriteRule ^$sm.htm content/site-map.php [L]
RewriteRule ^$sch.htm content/search.php [L]
RewriteRule ^$gm.htm content/map.php [L]
RewriteRule ^$aregister.htm content/account/register.php [L]
RewriteRule ^$alogin.htm content/account/login.php [L]
RewriteRule ^$alogout.htm content/account/logout.php [L]
RewriteRule ^$aforgotpwd.htm content/account/recoverpassword.php [L]
RewriteRule ^$aconfig.htm content/account/settings.php [L]
RewriteRule ^$account/$ content/account/index.php [L]
RewriteRule ^$offer/(.+)/(.+)/$ index.php?category=$1&type=0&location=$2 [L]
RewriteRule ^$offer/(.+)$ index.php?category=$1&type=0  [L]
RewriteRule ^$need/(.+)/(.+)/$ index.php?category=$1&type=1&location=$2 [L]
RewriteRule ^$need/(.+)$ index.php?category=$1&type=1 [L]
RewriteRule ^$ads/(.+)/([0-9]+)$ index.php?location=$1&page=$2 [L]
RewriteRule ^$ads/(.+)/$ index.php?location=$1 [L]
RewriteRule ^(.+)/(.+)/(.+)/$ index.php?category=$2&location=$3 [L]
RewriteRule ^(.+)/(.+)/$ index.php?category=$2 [L]
RewriteRule ^$cat/(.+) $1/ [R=301,L]
RewriteRule ^(.+)/(.+)/(.+)/([0-9]+)$ index.php?category=$2&location=$3&page=$4 [L]
RewriteRule ^(.+)/$ index.php?category=$1 [L]
RewriteRule ^(.+)/(.+)/([0-9]+)$ index.php?category=$2&page=$3 [L]
RewriteRule ^(.+)/([0-9]+)$ index.php?category=$1&page=$2 [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.+)/(.+)/(.+)/(.+)$ /$3/$4-$1.htm [R=301,L]
RewriteRule ^(.+)/(.+)/(.+)-([0-9]+).htm$  item.php?category=$2&item=$4 [L]
RewriteRule ^(.+)/(.+)-([0-9]+).htm$  item.php?category=$1&item=$3 [L]
</IfModule>";
	//	echo $htaccess_content;
	
		if(is_writable('../.htaccess')){
			$file = fopen('../.htaccess' , "w+");
			if (fwrite($file, $htaccess_content)=== FALSE) {
				$msg=T_("Cannot write to the configuration file")." '.htaccess'";
				$succeed=false;
			}else $succeed=true;
			fclose($file);
		}
		else {
			$msg=T_("The configuration file")." '/.htaccess' ".T_("is not writable").". ".T_("Change its permissions, then try again").".";
			$succeed=false;
		}
	}
	
	////////////////////////////////////////////////

	if ($succeed){
		$msg= "<p>".T_("Congratulations").". ".T_("Installation done").".</p>
				<p><b>".T_("Please now erase the folder")." /install/</b> <br />
				<a href=\"".$SITE_URL."\">".T_("Go to Your Website")."</a> | 
				<a href=\"".$SITE_URL."/adminfg/\">Admin</a> (user: ".$_POST["ADMIN"]." pass: ".$_POST["ADMIN_PWD"].")</p>
				<p><a href=\"http://j.mp/ocdonate\">".T_("Make a donation").". ".T_("We really appreciate it")."</a></p>";
		
        // notify new installation, you can remove this if you want to
		mail($_POST["NOTIFY_EMAIL"], T_("Congratulations").". ".T_("Installation done"), $msg);
		
		unlink("../install.lock");//prevents from new install
		echo $msg;
	} 
	else{
	    
	    if ($OCAKU==1)
	    {
	        //delete ocaku site
	        $ocaku=new ocaku();
	        $ocaku->deleteSite($apiKey);
	        unset($ocaku);
	    }
		
		//unlink("../includes/config.php");
		_e("Error");
		echo ": $msg <br/><a href=\"javascript:history.go(-1)\">".T_("Go Back")."</a>";
	}
}
else{//else post
?>
<?php if ($step=="" || $terms==""){?>
<h2><?php _e("Welcome to");?> Open Classifieds <?php _e("installation");?></h2>
<p>
<?php _e("Welcome to the super easy and fast installation");?>. <?php _e("If you need any help please check");?> <a href="http://open-classifieds.com/forum/" target="_blank"><?php _e("the forum");?></a>.
</p>
<p>
<?php if ($_POST && $terms==""){?><a href="#terms"><?php _e("Please read the following license agreement and accept the terms to continue");?>:</a></strong>
<?php } else {?><?php _e("Please read the following license agreement and accept the terms to continue");?>:<?php }?></p>
<iframe width="770" height="250" src="http://www.gnu.org/licenses/gpl.txt" frameborder="1"></iframe>
<form method="post" action="">
<input type="hidden" name="step" id="step" value="requirements" />
<p>
<a name="terms"></a>
<label for="terms"><input type="checkbox" id="terms" name="terms" value="1" /> <?php _e("I accept the license terms");?>.</label>
</p>
<p>
<input type="submit" name="action" id="action" value="<?php _e("Continue");?> >>" class="button-submit" />
</p>
</form>
<?php } elseif ($step=="requirements"){?>
<h2><?php _e("Requirements");?></h2>
<p><?php _e("Please carefully review the requirements check list below");?>:</p>
<div class="form-tab"><?php _e("Server software");?></div>
<div class="clear"></div>
<div class="install_info">
<a href="http://www.php.net"><span class="caps">PHP</span></a> <strong><?php _e("version");?> 5.2 <?php _e("or higher");?></strong>: 			
<?php
$succeed=true;

//echo PHP_VERSION;
$phpversion = substr(PHP_VERSION, 0, 6);
if($phpversion >= 5.2) _e("Yes"); 
else{
    $succeed=false;
	_e("No");
	echo ", ".T_("Please upgrade")." PHP ".T_("in order to proceed");
}
?>
<br />
<a href="http://www.mysql.com">MySQL</a>: 
<?php 
if (!extension_loaded('mysql')){
    _e("Not found");
	echo ", ".T_("Please install")." MySQL ".T_("in order to proceed");
    $succeed=false;
}
else _e("Found");
?><br />
Curl: 
<?php 
if (!extension_loaded('curl')){
    _e("Not found");
	echo ", ".T_("Please install")." Curl ";
    $succeed=false;
}
else _e("Found");
?><br />
<?php _e("URL rewriting");?>: 
<?php 
if (function_exists("apache_get_modules")){
    if (in_array('mod_rewrite',apache_get_modules())) echo 'Found';
    else echo '<strong>'.T_("Not found").', '.T_("it is strongly recommended to install it").'</strong>';
}else _e("Cannot check if installed");
?>
<br />
<?php _e("Language support");?> (gettext): 
<?php 
if ( !extension_loaded('gettext') || !function_exists('_') ){
    echo '<strong>'.T_("Not found").', '.T_("it is strongly recommended to install it").'</strong>';
}
else _e("Found");
?><br />
</div>
<div class="form-tab"><?php _e("Writeable folders");?></div>
<div class="clear"></div>
<div class="install_info">
<?php _e("Site root");?> "/" (<?php _e("install will update");?>: .htaccess, robots.txt, sitemap.xml.gz)
<br/>
".htaccess"
			<?php if(is_writable('../.htaccess')) { 
				_e("OK - Writable"); 
			} elseif(!file_exists('../.htaccess')) { 
				_e("File not found"); } 
			else {
			 _e("Unwritable (check permissions)");
			}  ?>
			<br />
"robots.txt"
			<?php if(is_writable('../robots.txt')) { 
				_e("OK - Writable"); 
			} elseif(!file_exists('../robots.txt')) { 
				_e("File not found"); } 
			else {
			 _e("Unwritable (check permissions)");
			}  ?>
			<br />
"sitemap.xml.gz"
			<?php if(is_writable('../sitemap.xml.gz')) { 
				_e("OK - Writable"); 
			} elseif(!file_exists('../sitemap.xml.gz')) { 
				_e("File not found"); } 
			else {
			 _e("Unwritable (check permissions)");
			}  ?>
			<br />
"/images/" 
			<?php if(is_writable('../images')) { 
				_e("OK - Writable"); 
			} elseif(!file_exists('../images')) { 
				_e("File not found"); } 
			else  _e("Unwritable (check permissions)"); ?>
			<br />
"/cache/"
			<?php if(is_writable('../cache')) { 
				_e("OK - Writable"); 
			} elseif(!file_exists('../cache')) { 
				_e("File not found"); } 
			else  _e("Unwritable (check permissions)"); ?>
			<br/>
"/includes/config.php" (<?php _e("mandatory to perform installation");?>)
			<?php if(is_writable('../includes/config.php')) { 
				_e("OK - Writable"); 
			} elseif(!file_exists('../includes/config.php')) { 
                $succeed=false;
				_e("File not found"); 
			} 
			else { 
                $succeed=false;
				_e("Unwritable (check permissions)");
				} ?>
</div>
<form method="post" action="">
<input type="hidden" name="terms" id="terms" value="1" />
<?php if ($succeed){?>
<input type="hidden" name="step" id="step" value="1" />
<?php } else {?>
<p><a href="#"><?php _e("Please correct the items described above then click the button below to run the requirements check again");?></a></p>
<input type="hidden" name="step" id="step" value="requirements" />
<?php }?>
<p><input type="submit" name="action" id="action" value="<?php _e("Continue");?> >>" class="button-submit" /></p>
</form>
<?php } elseif ($step=="1"){?>
<?php
    // Try to guess installation path
    $suggest_path = substr(__FILE__,0,-18);
    $suggest_path = str_replace("\\","/",$suggest_path);

    // Try to guess installation URL
    $suggest_url = 'http://'.$_SERVER["SERVER_NAME"];
    if ($_SERVER["SERVER_PORT"] != "80") $suggest_url = $suggest_url.":".$_SERVER["SERVER_PORT"];
    if ($_SERVER["REQUEST_URI"]!="/install/"){//check if it's in a subfolder
        if(stristr($_SERVER["REQUEST_URI"], 'index.php')) $suggest_url .=substr($_SERVER["REQUEST_URI"],0,-18);//erase install
        else $suggest_url .=substr($_SERVER["REQUEST_URI"],0,-9);//erase install
    }
?>
<h2><?php _e("Path Settings");?></h2>
<div class="form-tab"><?php _e("Check your path settings");?></div>
<div class="clear"></div>
<form method="post" action="" onsubmit="return checkForm(this);">
<fieldset>
<p>
    <label><?php _e("Site URL");?>:</label>
    <input  type="text" size="75" name="SITE_URL" value="<?php echo $suggest_url;?>" lang="false" onblur="validateText(this);" class="text-long" />
</p>
<p>
    <label><?php _e("Suggested path");?>:</label>
    <input  type="text" size="75" name="SITE_ROOT" value="<?php echo $suggest_path;?>" lang="false" onblur="validateText(this);" class="text-long" />&nbsp;<?php _e("please check this carefully");?>
</p>
<p>
    <input type="hidden" name="terms" id="terms" value="1" />
    <input type="hidden" name="step" id="step" value="2" />
	<input type="submit" name="action" id="action" value="<?php _e("Continue");?> >>" class="button-submit" /></p>
</fieldset>
</form>
<?php } elseif ($step=="2" || !$db_check_succeed){?>
<h2><?php _e("Database");?></h2>
<?php if (!$db_check_succeed){?>
<p><?php echo $db_check_message;?></p>
<p><a href="#"><?php _e("Please correct the items described above to continue");?></a></p>
<?php } ?>
<div class="form-tab"><?php _e("Enter your MySQL database details below");?></div>
<div class="clear"></div>
<form method="post" action="" onsubmit="return checkForm(this);">
<fieldset>
<p>
	<label><?php _e("Host name");?>:</label>
	<input  type="text" name="DB_HOST" value="localhost" lang="false" class="text-long" />
</p>

<p>
	<label><?php _e("User name");?>:</label>
	<input  type="text" name="DB_USER"  value="root" lang="false"  class="text-long" />
</p>
<p>
	<label><?php _e("Password");?>:</label>
	<input type="password" name="DB_PASS" value="" class="text-long" />		
</p>
<p>
	<label><?php _e("Database name");?>:</label>
	<input type="text" name="DB_NAME" value="openclassifieds" lang="false" class="text-long" />
</p>
<p>
	<label><?php _e("Database charset");?>:</label>
	<input type="text" name="DB_CHARSET" value="utf8" lang="false"  class="text-long" />
</p>
<p>
	<label><?php _e("Table prefix");?>:</label>
	<input type="text" name="TABLE_PREFIX" value="oc_" class="text-medium" />&nbsp;<?php _e("Allows multiple installations in one database if you give each one a unique prefix");?>. <?php _e("Only numbers, letters, and underscores");?>.
</p>
<p>
	<label><?php _e("Sample data");?>:</label>
	<input type="checkbox" name="SAMPLE_DB"  value="1" />&nbsp;<?php _e("Yes")." (".T_("Creates few sample categories and posts").")";?>
</p>
<p>
    <input type="hidden" name="terms" id="terms" value="3" />
    <input type="hidden" name="SITE_URL" id="SITE_URL" value="<?php echo $SITE_URL;?>" />
    <input type="hidden" name="SITE_ROOT" id="SITE_ROOT" value="<?php echo $SITE_ROOT;?>" />
    <input type="hidden" name="step" id="step" value="3" />
	<input type="submit" name="action" id="action" value="<?php _e("Continue");?> >>" class="button-submit" />
</p>
</fieldset>
</form>
<?php } elseif ($step=="3" && $db_check_succeed){?>
<h2><?php _e("Basic Configuration");?></h2>
<p><?php _e("Basic Configuration");?>. <?php _e("More settings available in the website admin");?>.</p>
<form method="post" action="" onsubmit="return checkForm(this);">
<input type="hidden" name="terms" id="terms" value="1" />
<input type="hidden" name="SITE_URL" id="SITE_URL" value="<?php echo $SITE_URL;?>" />
<input type="hidden" name="SITE_ROOT" id="SITE_ROOT" value="<?php echo $SITE_ROOT;?>" />

<input type="hidden" name="DB_HOST" id="DB_HOST" value="<?php echo $DB_HOST;?>" />
<input type="hidden" name="DB_USER" id="DB_USER" value="<?php echo $DB_USER;?>" />
<input type="hidden" name="DB_PASS" id="DB_PASS" value="<?php echo $DB_PASS;?>" />
<input type="hidden" name="DB_NAME" id="DB_NAME" value="<?php echo $DB_NAME;?>" />
<input type="hidden" name="DB_CHARSET" id="DB_CHARSET" value="<?php echo $DB_CHARSET;?>" />
<input type="hidden" name="TABLE_PREFIX" id="TABLE_PREFIX" value="<?php echo $TABLE_PREFIX;?>" />
<input type="hidden" name="SAMPLE_DB" id="SAMPLE_DB" value="<?php echo $SAMPLE_DB;?>" />

<input type="hidden" name="step" id="step" value="review" />
<fieldset>
<p>
	<label><?php _e("Site Name");?>:</label>
	<input  type="text" name="SITE_NAME" value="Open Classifieds" lang="false" onblur="validateText(this);" class="text-long" />
</p>

<p>
	<label><?php _e("Email address");?>:</label>
	<input type="text" name="NOTIFY_EMAIL"  value="your@emailhere.info" lang="false" onblur="validateEmail(this);" class="text-long" />&nbsp;<?php _e("for notifications, and set as recipient in the emails sent from the site");?>.
</p>
<p>
	<label><?php _e("Site Language");?>:</label>
	<select name="LANGUAGE" >
	<option value="en_EN">en_EN</option>
	    <?php
	    $languages = scandir("../languages");
	    foreach ($languages as $lang) {
		    
		    if( strpos($lang,'.')==false && $lang!='.' && $lang!='..' && $lang!=LANGUAGE){
			    echo "<option value=\"$lang\">$lang</option>";
		    }
	    }
	    ?>
	</select>&nbsp;<?php _e("you can add more languages in");?> /languages
</p>
<p>
	<label><?php _e("Time Zone");?>:</label>
	<?php echo get_select_timezones();?>
</p>
<p>
	<label><?php _e("Admin Name");?>:</label>
	<input type="text" name="ADMIN" value="admin" lang="false" onblur="validateText(this);" class="text-long" />
</p>
<p>
	<label><?php _e("Admin Password");?>:</label>
	<input type="password" name="ADMIN_PWD" value="" class="text-long" />	
</p>
<p>
	<label><?php _e("Ocaku registration");?>:</label>
	<input type="checkbox" name="OCAKU" value="1" checked="checked" />
	<?php _e("Allow site to be in Ocaku, classifieds community (recommended)");?>
		<a target="_blank" href="http://ocaku.com/en/terms.html"><?php echo _e('Terms');?></a>
</p>
<p>
	<input type="submit" name="action" id="action" value="<?php _e("Continue");?> >>" class="button-submit" />
</p>
</fieldset>
</form>
<?php } elseif ($step=="review"){?>
<h2><?php _e("Review & Install");?></h2>
<p><?php _e("Please review the following summary and click the button below to install");?> Open Classifieds</p>
<form method="post" action="">
<input type="hidden" name="terms" id="terms" value="1" />
<input type="hidden" name="SITE_URL" id="SITE_URL" value="<?php echo $SITE_URL;?>" />
<input type="hidden" name="SITE_ROOT" id="SITE_ROOT" value="<?php echo $SITE_ROOT;?>" />

<input type="hidden" name="DB_HOST" id="DB_HOST" value="<?php echo $DB_HOST;?>" />
<input type="hidden" name="DB_USER" id="DB_USER" value="<?php echo $DB_USER;?>" />
<input type="hidden" name="DB_PASS" id="DB_PASS" value="<?php echo $DB_PASS;?>" />
<input type="hidden" name="DB_NAME" id="DB_NAME" value="<?php echo $DB_NAME;?>" />
<input type="hidden" name="DB_CHARSET" id="DB_CHARSET" value="<?php echo $DB_CHARSET;?>" />
<input type="hidden" name="TABLE_PREFIX" id="TABLE_PREFIX" value="<?php echo $TABLE_PREFIX;?>" />
<input type="hidden" name="SAMPLE_DB" id="SAMPLE_DB" value="<?php echo $SAMPLE_DB;?>" />

<input type="hidden" name="SITE_NAME" id="SITE_NAME" value="<?php echo $SITE_NAME;?>" />
<input type="hidden" name="NOTIFY_EMAIL" id="NOTIFY_EMAIL" value="<?php echo $NOTIFY_EMAIL;?>" />
<input type="hidden" name="LANGUAGE" id="LANGUAGE" value="<?php echo $LANGUAGE;?>" />
<input type="hidden" name="TIMEZONE" id="TIMEZONE" value="<?php echo $TIMEZONE;?>" />
<input type="hidden" name="ADMIN" id="ADMIN" value="<?php echo $ADMIN;?>" />
<input type="hidden" name="ADMIN_PWD" id="ADMIN_PWD" value="<?php echo $ADMIN_PWD;?>" />
<input type="hidden" name="OCAKU" id="OCAKU" value="<?php echo $OCAKU;?>" />
<input type="hidden" name="step" id="step" value="install" />
<div class="form-tab"><?php _e("Path Settings");?></div>
<div class="clear"></div>
<fieldset>
<p>
    <label><?php _e("Site URL");?>:</label>
    <input type="text" readonly="readonly" value="<?php echo $SITE_URL;?>" class="text-long" />
</p>
<p>
    <label><?php _e("Path");?>:</label>
    <input type="text" readonly="readonly" value="<?php echo $SITE_ROOT;?>" class="text-long" />
</p>
</fieldset>
<div class="form-tab"><?php _e("Database");?></div>
<div class="clear"></div>
<fieldset>
<p>
	<label><?php _e("Host name");?>:</label>
	<input type="text" readonly="readonly" value="<?php echo $DB_HOST;?>" class="text-long" />
</p>

<p>
	<label><?php _e("User name");?>:</label>
	<input type="text" readonly="readonly" value="<?php echo $DB_USER;?>" class="text-long" />
</p>
<p>
	<label><?php _e("Password");?>:</label>
	<input type="text" readonly="readonly" value="<?php echo $DB_PASS;?>" class="text-long" />
</p>
<p>
	<label><?php _e("Database name");?>:</label>
	<input type="text" readonly="readonly" value="<?php echo $DB_NAME;?>" class="text-long" />
</p>
<p>
	<label><?php _e("Database charset");?>:</label>
	<input type="text" readonly="readonly" value="<?php echo $DB_CHARSET;?>" class="text-long" />
</p>
<p>
	<label><?php _e("Table prefix");?>:</label>
	<input type="text" readonly="readonly" value="<?php echo $TABLE_PREFIX;?>" class="text-long" />
</p>
<p>
	<label><?php _e("Sample data");?>:</label>
	<input type="text" readonly="readonly" value="<?php if ($SAMPLE_DB) _e("Yes"); else _e("No");?>" class="text-long" />
</p>
</fieldset>
<div class="form-tab"><?php _e("Basic Configuration");?></div>
<div class="clear"></div>
<fieldset>
<p>
	<label><?php _e("Site Name");?>:</label>
	<input type="text" readonly="readonly" value="<?php echo $SITE_NAME;?>" class="text-long" />
</p>
<p>
	<label><?php _e("Email address");?>:</label>
	<input type="text" readonly="readonly" value="<?php echo $NOTIFY_EMAIL;?>" class="text-long" />
</p>
<p>
	<label><?php _e("Site language");?>:</label>
	<input type="text" readonly="readonly" value="<?php echo $LANGUAGE;?>" class="text-long" />
</p>
<p>
	<label><?php _e("Time Zone");?>:</label>
	<input type="text" readonly="readonly" value="<?php echo $TIMEZONE;?>" class="text-long" />
</p>
<p>
	<label><?php _e("Admin Name");?>:</label>
    <input type="text" readonly="readonly" value="<?php echo $ADMIN;?>" class="text-long" />
</p>
<p>
	<label><?php _e("Admin Password");?>:</label>
	<input type="text" readonly="readonly" value="<?php echo "********";?>" class="text-long" />
</p>
<p>
	<label>Ocaku:</label>
	<?php 
	    if ($OCAKU==1) $OCAKU_res=T_('Activated');
	    else $OCAKU_res=T_('Deactivated');
	?>
	<input type="text" readonly="readonly" value="<?php echo $OCAKU_res;?>" class="text-long" />
</p>
</fieldset>
<p>
<input type="submit" name="submit" id="submit" value="<?php _e("Install");?>" class="button-submit" />
</p>
</form>
<?php }?>
<?php }
//}//end if config file exists?>
</div>
<div class="clear"></div>
</div>
<div id="footer">
    <ul>
        <li class="credits">
        &copy; 2009 - <?php echo date('Y');?> <a title="Open Classifieds | Free Advertisements Classifieds web | PHP + MYSQL" href="http://open-classifieds.com/">Open Classifieds</a></li>
        <li class="copyright"><a href="http://www.gnu.org/licenses/gpl.html" target="_blank">GNU General Public License</a></li>
    </ul>
    <center><a href="http://j.mp/ocdonate" target="_blank">
					<img src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0" alt="" />
				</a></center>
</div>
</div>
</body>
</html>

