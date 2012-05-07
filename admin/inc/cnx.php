<?php
// Vérification des accès utilisateur
if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'logacces')) {
	if ($HTTP_POST_VARS['login'] != '' && $HTTP_POST_VARS['pass'] != '') {
		$check_acces_query = mysql_query('SELECT First_admin_acces, Second_admin_acces FROM admin_acces');
		if (mysql_num_rows($check_acces_query) == 0) {
			$_SESSION['adminlogsite'] = 'errorlog';
		}
		else {
			while ($check_acces = mysql_fetch_object($check_acces_query)) {
				if ($HTTP_POST_VARS['login'] == $check_acces->First_admin_acces && md5($HTTP_POST_VARS['pass']) == $check_acces->Second_admin_acces) {
					$_SESSION['adminlogsite'] = 'okpourlog';
				}
			}
			if ($_SESSION['adminlogsite'] != 'okpourlog') {
				$_SESSION['adminlogsite'] = 'errorlog';
			}
		}
	}
	else {
		$_SESSION['adminlogsite'] = '';
	}
}
?>