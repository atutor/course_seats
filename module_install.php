<?php

if (!defined('AT_INCLUDE_PATH')) { exit; }

$_course_privilege = TRUE; // possible values: FALSE | AT_PRIV_ADMIN | TRUE
$_admin_privilege  = TRUE; // possible values: FALSE | TRUE


if (!$msg->containsErrors() && file_exists(dirname(__FILE__) . '/module.sql')) {
	require(AT_INCLUDE_PATH . 'classes/sqlutility.class.php');
	$sqlUtility = new SqlUtility();
	$sqlUtility->queryFromFile(dirname(__FILE__) . '/module.sql', TABLE_PREFIX);
	if ($_SESSION['lang']=='fr' && file_exists(dirname(__FILE__) . '/module-fr.sql')) {
		$sqlUtility->queryFromFile(dirname(__FILE__) . '/module-fr.sql', TABLE_PREFIX);
	}
}

?>