<?php
/************************************************************************/
/* ATutor																*/
/************************************************************************/
/* Copyright (c) 2013                                                   */
/* ATutorSpaces Inc.                                                    */
/* https://atutorspaces.com												*/
/*																		*/
/* This program is free software. You can redistribute it and/or        */
/* modify it under the terms of the GNU General Public License          */
/* as published by the Free Software Foundation.                        */
/************************************************************************/
// $Id$

define('AT_INCLUDE_PATH', '../../include/');
require (AT_INCLUDE_PATH.'vitals.inc.php');
admin_authenticate(AT_ADMIN_PRIV_COURSE_SEATS);

if($_POST['cancel']){
			$msg->addFeedback('CANCELLED');
			header("Location:".$_base_href."mods/course_seats/index_admin.php");
			exit;
}


if($_POST['save']){
	//$disable_create = intval($_POST['diable_create']);
	//$default_seats = intval($_POST['default_seats']);
	$seats_allow = intval($_POST['seats_allow']);
	$seat_price = number_format($_POST['seat_price'],2);
	
	
	if($seats_allow == "0" && $seat_price =="0.00"){
	//
	}else{
		// both seats allow and seat price must be set, or neither 
		if($_POST['seats_allow'] !="1"){
			$msg->addError('SEATS_MUST_ENABLE_ALLOW');
			$error = "1";
		}
		if($seat_price == 0 || $seat_price == ''){
			$msg->addError('SEATS_MUST_BE_NUMBER');
			$error = "1";		
		}
	}

	if(!isset($error)){
		unset($error);
		
		if($_POST['seats_allow']){
			$sql = "REPLACE into ".TABLE_PREFIX."config (`name`, `value`) VALUES('seats_allow','$seats_allow')";
			if(!$result = mysql_query($sql,$db)){
				$msg->addError('SEATS_SAVE_FAILED');
				$error=1;
			}
		}else{
			if($_config['seats_allow']){
			$sql = "DELETE from ".TABLE_PREFIX."config WHERE name='seats_allow'";
			$result = mysql_query($sql,$db);
			}
		}


		if($_POST['seat_price']){
			$sql = "REPLACE into ".TABLE_PREFIX."config (`name`, `value`) VALUES('seat_price','$seat_price')";
			if(!$result = mysql_query($sql,$db)){
				$msg->addError('SEATS_SAVE_FAILED');
				$error=1;
			}
		} else {
			if($_config['seat_price']){
				$sql = "DELETE from ".TABLE_PREFIX."config WHERE name='seat_price'";
				$result = mysql_query($sql,$db);
			}
		}
		
		if($_POST['default_seats']){
			$default_seats = intval($_POST['default_seats']);
			if($default_seats != ''){
				$sql = "REPLACE into ".TABLE_PREFIX."config (`name`, `value`) VALUES ('default_seats', $default_seats)";
				$result = mysql_query($sql,$db);
			}else{
				$msg->addError('SEATS_MUST_BE_NUMBER');
				$error = "1";
			}
		} else {
			if($_config['default_seats']){
				$sql = "DELETE from ".TABLE_PREFIX."config WHERE name='default_seats'";
				$result = mysql_query($sql,$db);
			}	
	
		}
	
		if($_POST['disable_create']){
			$disable_create = intval($_POST['disable_create']);
			if($disable_create != ''){
				$sql = "REPLACE into ".TABLE_PREFIX."config (`name`, `value`) VALUES ('disable_create', '$disable_create')";
				$result = mysql_query($sql,$db);
			}
		} else {
			if($_config['disable_create']){
				$sql = "DELETE from ".TABLE_PREFIX."config WHERE name='disable_create'";
				$result = mysql_query($sql,$db);
			}
		}
	
		if(!$error){
			$msg->addFeedback('ACTION_COMPLETED_SUCCESSFULLY');
			header("Location:".$_base_href."mods/course_seats/index_admin.php");
			exit;
		}
	}
	
}
if(isset($_config['seats_allow']) && $_config['seats_allow'] == "1"){
	$checked = ' checked="checked"';
}
if(isset($_config['disable_create']) && $_config['disable_create'] == "1"){
	$checkeddc = ' checked="checked"';
}


$sql = "SELECT * FROM ".TABLE_PREFIX."modules WHERE dir_name ='_core/services'";
$result = mysql_query($sql, $db);
if(mysql_num_rows($result) != 0 ){
	//This is a Service site 
	$service_site = 1;
}

$sql = "SELECT * FROM ".TABLE_PREFIX."modules WHERE dir_name ='payments'";
$result = mysql_query($sql, $db);
if(mysql_num_rows($result) != 0 ){
	//This is a Service site 
	$payment_site = 1;
}

if(!isset($payment_site)){
require (AT_INCLUDE_PATH.'header.inc.php'); ?>
<div class="input-form">
	<fieldset class="group_form">
	<legend class="group_form"><?php echo _AT('seats_config'); ?>  </legend>
	<p><?php echo _AT('seats_payments_install'); ?></p>
		</form>
	</fieldset>
</div>
<?php require (AT_INCLUDE_PATH.'footer.inc.php');
}
require (AT_INCLUDE_PATH.'header.inc.php');



?>
<div class="input-form">
	<fieldset class="group_form">
	<legend class="group_form"><?php echo _AT('seats_config'); ?></legend>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="form">
			<?php
			if(!isset($service_site)){ 
			?>
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					$("#disable_create").change(function() {
						if($(this).is(":checked")) {                
							$("#default_seats").attr("disabled", "disabled");
						}
						else {
							$("#default_seats").removeAttr("disabled");
						}
					});
				});
			</script>
			<p><?php echo _AT('seats_howto_config_create'); ?></p><p><br /></p>
			<label for="disable_create"><?php echo _AT('seats_disable_create'); ?></label>
			<input type="checkbox" value="1" name="disable_create" id="disable_create" <?php echo $checkeddc; ?>  /><br />
			
			<label for="default_seats"><?php echo _AT('seats_default_seats'); ?></label>
			<input type="text" maxlength="4" size="4" value="<?php echo $_config['default_seats']; ?>" name="default_seats" id="default_seats" /><br />
			<?php } ?>
			
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					$("#seats_allow").change(function() {
						if($(this).is(":checked")) { 
							$("#seat_price").removeAttr("disabled");					               
						}
						else {
							$("#seat_price").attr("disabled", "disabled");
						}
					});
				});
			</script>
			<p><br /><?php echo _AT('seats_howto_config'); ?></p><p><br /></p>
			<label for="seats_allow"><?php echo _AT('seats_allow'); ?></label>
			<input type="checkbox" value="1" name="seats_allow" id="seats_allow" <?php echo $checked; ?>/><br />
			
			<label for="seat_price"><?php echo _AT('seats_price'); ?></label> <?php echo $_config['ec_currency_symbol']; ?>
			<input type="text" size="7" maxlength="7" value="<?php echo $_config['seat_price']; ?>" name="seat_price" id="seat_price"/>
			
			<br /><br />
			<input type="submit" value="<?php echo _AT('save'); ?>" name="save" class="button">
			<input type="submit" value="<?php echo _AT('cancel'); ?>" name="cancel" class="button">
		</form>
	</fieldset>
</div>
<?php
require (AT_INCLUDE_PATH.'footer.inc.php');
?>