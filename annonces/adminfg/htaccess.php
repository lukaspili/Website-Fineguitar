<?php 
require_once('access.php');
require_once('../includes/functions.php');


$rewritebase=str_replace('http://'.$_SERVER["SERVER_NAME"],"",$_POST["SITE_URL"]);
if ($_SERVER["SERVER_PORT"]!="80") $rewritebase=str_replace(":".$_SERVER["SERVER_PORT"],"",$rewritebase);
if ($rewritebase=="") $rewritebase="/";

$offer=u(T_("Offer"));
if ($offer=="") $offer="offer";

$need=u(T_("Need"));
if ($need=="") $need="need";

$cat=u(T_("Category"));
if ($cat=="") $cat="category";

$typ=u(T_("Type"));
if ($typ=="") $typ="type";

$new=u(T_("Publish a new Ad"));
if ($new=="") $new="new";

$con=u(T_("Contact"));
if ($con=="") $con="contact";

$pol=u(T_("Privacy Policy"));
if ($pol=="") $pol="policy";

$sm=u(T_("Sitemap"));
if ($sm=="") $sm="sitemap";

$sch=u(T_("Advanced Search"));
if ($sch=="") $sch="search";

$gm=u(T_("Map"));
if ($gm=="") $gm="map";

$ads=u(T_("Classifieds"));
if ($ads=="") $ads="ads";

$alogin=u(T_("Login"));
if ($alogin=="") $alogin="login";

$alogout=u(T_("Logout"));
if ($alogout=="") $alogout="logout";

$aforgotpwd=u(T_("Forgot My Password"));
if ($aforgotpwd=="") $aforgotpwd="forgot-password";

$aconfig=u(T_("Settings"));
if ($aconfig=="") $aconfig="settings";

$account=u(T_("My Account"));
if ($account=="") $account="my-account";

$terms=u(T_("Terms"));
if ($terms=="") $account="terms";

$new=u(T_("Publish a new Ad"));
if ($new=="") $new="publish-a-new-ad-for-free";

$aregister =u(T_("Register new account"));
if ($aregister=="") $aregister="register";

$htaccess_content = "ErrorDocument 404 ".$rewritebase."content/404.php
<IfModule mod_rewrite.c>
RewriteEngine on
RewriteBase $rewritebase
RewriteRule ^([0-9]+)$ index.php?page=$1 [L]
RewriteRule ^install/$ install/index.php [L]
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
	
//saving htaccess
if(is_writable('../.htaccess')){
    $file = fopen('../.htaccess' , "w+");
    if (fwrite($file, $htaccess_content)=== FALSE) {
        $msg=T_("Cannot write to the configuration file")." '.htaccess'";
        $succeed=false;
    }else $succeed=true;
    fclose($file);
}
else {
    $msg=T_("The configuration file")." '/.htaccess' ".T_("is not writable").". ".T_("Change its permissions and try again");
    $succeed=false;
}
if ($succeed) jsRedirect(SITE_URL."/adminfg/settings.php?msg=".T_("Updated"));
else echo $msg;
die();
?>
