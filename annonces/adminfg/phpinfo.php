<?php
require_once('access.php');
require_once('header.php');

?>
<h2><?php _e("PHP Info");?></h2>
<blockquote>
<?php
ob_start();                                                                                                        
phpinfo();                                                                                                     
$info = ob_get_contents();                                                                                         
ob_end_clean();                                                                                                    
echo preg_replace('%^.*<body>(.*)</body>.*$%ms', '$1', $info);
?>
</blockquote>
<?php
require_once('footer.php');
?>
