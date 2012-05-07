<?php
////////////////////////////////////////////////////////////
// Error handler functions
////////////////////////////////////////////////////////////
function ocErrorHandler($errno, $errstr, $errfile, $errline)
{
    switch ($errno) {
    case E_USER_ERROR:
    	if ($errstr == "(SQL)"){
            // handling an sql error
            $error_body= SQLMESSAGE . "<br />PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n
            				Aborting...<br />\n";
        } else {
	    	$error_body= "<b>ERROR CRITICAL</b> [$errno] $errstr<br />\n
	       		  		Fatal error on line $errline in file $errfile
	       				 , PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n
	         			Aborting...<br />\n";
        }		

   		if (DEBUG) echo $error_body;
		elseif (!DEBUG){//send email
			mail(NOTIFY_EMAIL,"ERROR $errno ".SITE_NAME, $error_body,'From: Error Handler');
		}
		
        exit(1);
        break;

    case E_USER_WARNING:
       	if (DEBUG) echo "<b>ERROR WARNING</b> [$errno] $errstr<br />\n";
        break;

    case E_USER_NOTICE:
        if (DEBUG) echo "<b>NOTICE</b> [$errno] $errstr<br />\n";
        break;

   default:
        //if (DEBUG) echo "Unknown error type: [$errno] $errstr<br />\n";
        break; 
    }
    

    return true;
}
////////////////////////////////////////////////////////////
function ocSqlError($ERROR){
    define("SQLMESSAGE", $ERROR);
    trigger_error("(SQL)", E_USER_ERROR);
}
////////////////////////////////////////////////////////////
set_error_handler('ocErrorHandler');//setting the error handler

?>
