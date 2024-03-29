<?php
//paypal functions

function paypalForm($idItem,$amount=PAYPAL_AMOUNT){
	if (PAYPAL_SANDBOX) $paypalWeb = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; // TEST SANDBOX
	else $paypalWeb = 'https://www.paypal.com/cgi-bin/webscr'; 
	?>
        <div style="font-family: Arial; font-size: 20px; text-align: center; margin-top: 200px;"> 
        	<?php  _e('Please wait while we transfer you to Paypal');?><br /> 
        	<img src="<?php echo SITE_URL; ?>/images/loader.gif" border="0"> 
        </div> 
		<form name="form1" id="form1" action="<?php echo $paypalWeb;?>" method="post"> 
		<input type="hidden" name="cmd" value="_xclick"> 
		<input type="hidden" name="cbt" value="Return To <?php echo SITE_NAME;?>"> 
		<input type="hidden" name="business" value="<?php echo PAYPAL_ACCOUNT;?>"> 
		<input type="hidden" name="item_name" value="<?php echo T_('Pay to post in ').SITE_NAME; ?>"> 
		<input type="hidden" name="item_number" value="<?php echo $idItem; ?>"> 
		<input type="hidden" name="amount" value="<?php echo $amount; ?>"> 
		<input type="hidden" name="quantity" value="1"> 
		<input type="hidden" name="undefined_quantity" value="0"> 
		<input type="hidden" name="no_shipping" value="0"> 
		<input type="hidden" name="shipping" value="0"> 
		<input type="hidden" name="shipping2" value="0"> 
		<input type="hidden" name="handling" value="0.00"> 
		<input type="hidden" name="return" value="<?php echo SITE_URL; ?>"> 
		<input type="hidden" name="notify_url" value="<?php echo SITE_URL; ?>/ipn.php"> 
		<input type="hidden" name="no_note" value="1"> 
		<input type="hidden" name="custom" value=""> 
		<input type="hidden" name="currency_code" value="<?php echo PAYPAL_CURRENCY;?>"> 
		<input type="hidden" name="rm" value="2">
		<input type="submit" value="Paypal"> 
		</form> 	       
		<script type="text/javascript">form1.submit();</script>
	<?php 
	require_once(SITE_ROOT.'/includes/footer.php');
	die();
}

//validates the IPN
function validate_ipn(){
	if (PAYPAL_SANDBOX) $URL='ssl://www.sandbox.paypal.com';
	else $URL='ssl://www.paypal.com';
	$result = FALSE;

	// read the post from PayPal system and add 'cmd'
	$req = 'cmd=_notify-validate';

	foreach ($_REQUEST as $key => $value) {
		$value = urlencode(stripslashes($value));
		if($key=="sess" || $key=="session") continue;
		$req .= "&$key=$value";
	}

	// post back to PayPal system to validate
	$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
	$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
	$fp = fsockopen ($URL, 443, $errno, $errstr, 60);
	
	if (!$fp) {
		//error email
		paypalProblem('Paypal connection error');
	} else {
		fputs ($fp, $header . $req);
		while (!feof($fp)) {
			$res = fgets ($fp, 1024);
			if (strcmp ($res, "VERIFIED") == 0) {
				$result = TRUE;
			}
			else if (strcmp ($res, "INVALID") == 0) {
				//log the error in some system?
				//paypalProblem('Invalid payment');
			}
		}
		fclose ($fp);
	}
	return $result;
}

//paypal problem on payment for IPN
function paypalProblem($problem='Problem with paypal payment'){
	sendEmail(PAYPAL_ACCOUNT,$problem,$problem.'This email informs you that somebody tried to cheat the payment system of paypal, please check next values:'. print_r($_POST,true));
	die();
}


?>