<?php 
////////////////////////////////////////////////////////////
//Common footer for all the themes
////////////////////////////////////////////////////////////
require_once(SITE_ROOT.'/themes/'.THEME.'/footer.php');

$ocdb->closeDB();
$ocdb->returnDebug();
echo "<!--".$ocdb->getQueryCounter().T_(" queries generated in ").round((microtime(true)-$app_time),3)."s and ".$ocdb->getQueryCounter("cache")." queries cached-->"; 
?>


</body>
</html>
