<?php
//theme selector, allows to change the theme
//More themes at open-classifieds.com
 
if (THEME_MOBILE && cG("mobile")!="0" && !isset($_SESSION['theme_mobile']) ){
    $mobile=isMobile();
}
else{
    $_SESSION['theme_mobile']=1;
    $mobile=false;
}
//$mobile=true;

if (!$mobile){
	if (THEME_SELECTOR){//see config.php
		if (cG("theme")!=""){//select them by request
			$theme= str_replace(array('..', '&', '\\', '//', ' '), '', cG("theme"));//for secure reasons we remove dots and slashes
			$theme_dir=SITE_ROOT."/themes/$theme";//directory for the theme
			if (is_dir($theme_dir)){//the folder exists
				define('THEME', $theme);
				$_SESSION['theme']=$theme;
				setcookie ("theme",$theme, time() + 3600*24*365, "/", ".".$_SERVER['SERVER_NAME']);
			}
			else define('THEME', DEFAULT_THEME);//default theme doesnt exists the theme :S
		}
		else if (isset($_SESSION['theme'])){//theme keept in the session
			define('THEME', $_SESSION['theme']);
		}
		else if (isset($_COOKIE['theme'])){//theme from the cookie
			define('THEME', $_COOKIE['theme']);
			$_SESSION['theme']=$_COOKIE['theme'];
		}
		else define('THEME', DEFAULT_THEME);//default theme
	}
	else  define('THEME', DEFAULT_THEME);//default theme
}
else define('THEME', 'neoMobile');//mobile version
	
	
////////////////////////////////////////////////////////////////////////////////////
//Detection function for mobile devices
function isMobile(){
	if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
	   return true;
	}
	 
	if((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml')>0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
	   return true;
	}    
	 
	$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4));
	$mobile_agents = array(
	    'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
	    'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
	    'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
	    'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
	    'newt','noki','oper','palm','pana','pant','phil','play','port','prox',
	    'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
	    'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
	    'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
	    'wapr','webc','winw','winw','xda','xda-');
	 
	if(in_array($mobile_ua,$mobile_agents)) return true; 
	if (strpos(strtolower($_SERVER['ALL_HTTP']),'OperaMini')>0) return true;
	
	return false;
}
?>
