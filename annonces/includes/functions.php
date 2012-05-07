<?php
////////////////////////////////////////////////////////////
//Functions: call to all the includes
////////////////////////////////////////////////////////////

//starts installation, you can erase this line to optimize code
if(file_exists('install.lock')) die(header('Location: install/'));

//Initial defines
define('VERSION','1.7.5.1');
define('DEBUG',false);//if you change this to true, returns error in the page instead of email, also enables debug from phpMyDB and disables disqus

if (!DEBUG){//do not display any error message and expire Headers for 24hours
    error_reporting(0);
    ini_set('display_errors','off');
}
else{//displays error messages 
	error_reporting(E_ALL | E_STRICT);
	ini_set('display_errors','on');
}

if (extension_loaded('zlib')) {//check extension is loaded
    if(!ob_start('ob_gzhandler')) ob_start();//start HTML compression, if not normal buffer input mode
}

//init session
if (!session_id()) session_start();//don't start it in the admin since it's already been started

//config includes
require_once('config.php');//configuration file
require_once('error.php');//handler for errors

//language locales	
require_once('gettext/gettext.inc');//gettext override

if ( !function_exists('_') ){//check if gettext exists if not use dropin
	T_setlocale(LC_MESSAGES, LANGUAGE.LOCALE_EXT);
	bindtextdomain('messages',SITE_ROOT.'/languages/');
	bind_textdomain_codeset('messages', CHARSET);
	textdomain('messages');
}
else{//gettext exists using fallback in case locale doesn't exists
	T_setlocale(LC_MESSAGES, LANGUAGE.LOCALE_EXT);
	T_bindtextdomain('messages',SITE_ROOT.'/languages/');
	T_bind_textdomain_codeset('messages', CHARSET);
	T_textdomain('messages');
}
//end language locales


//loading all classes
require_once('classes/wrapperCache.php');//wrapper cache
require_once('classes/fileCache.php');//cache
require_once('classes/phpMyDB.php');//class for database handling
require_once('classes/phpSEO.php');//class for SEO handling
if (AKISMET!='') require_once('classes/Akismet.class.php');//akismet class 
require_once('classes/wordcloud.class.php');//tag generator
require_once('classes/class.phpmailer.php');//mailer
require_once('classes/class.account.php');//account
require_once('classes/class.ocaku.php');//ocaku integration
//end loading classes


require_once('common.php');//common functions
require_once('item-common.php');//item common functions
require_once('search-advanced.php');//common functions
require_once('controller.php');//loads the value of the items/categories  if there's , and starts system variables
require_once('theme.php');//loads the selected theme, see define in config.php
require_once('menu.php');//menu functions generation and some functions that returns stats
require_once('sidebar.php');//sidebar functions generation
require_once('seo.php');//metas for the html, title,description, keywords
require_once('sitemap.php');//sitemap generation
if (PAYPAL_ACTIVE) require_once('paypal.php');//paypal functions

//special functions from the theme if they exists
if (file_exists(SITE_ROOT.'/themes/'.THEME.'/functions.php')){
	require_once(SITE_ROOT.'/themes/'.THEME.'/functions.php'); 
}


?>